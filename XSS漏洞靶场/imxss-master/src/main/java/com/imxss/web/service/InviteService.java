package com.imxss.web.service;

import javax.annotation.Resource;

import org.coody.framework.context.annotation.CacheWipe;
import org.coody.framework.context.annotation.CacheWrite;
import org.coody.framework.context.entity.Pager;
import org.coody.framework.context.entity.Where;
import org.coody.framework.core.jdbc.JdbcHandle;
import org.coody.framework.util.StringUtil;
import org.springframework.stereotype.Service;

import com.imxss.web.constant.CacheFinal;
import com.imxss.web.domain.InviteInfo;
import com.oracle.webservices.internal.api.databinding.DatabindingMode;

@Service
public class InviteService {

	@Resource
	JdbcHandle jdbcHandle;

	@CacheWrite(key = CacheFinal.INVITE_INFO, validTime = 60, fields = "invite")
	public InviteInfo loadInviteInfo(String invite) {
		return jdbcHandle.findBeanFirst(InviteInfo.class, "inviteCode", invite);
	}

	@CacheWipe(key = CacheFinal.INVITE_INFO, fields = "invite")
	public Long popInvite(String invite) {
		String sql = "update invite_info set status=1 where status=0 and inviteCode=?";
		return jdbcHandle.doUpdate(sql, invite);
	}

	@CacheWipe(key = CacheFinal.INVITE_INFO, fields = "invite")
	public Long pushUserIdToInvite(String invite, Integer userId) {
		String sql = "update invite_info set status=1,userId=? where status=0 and inviteCode=?";
		return jdbcHandle.doUpdate(sql, userId, invite);
	}

	public Long writeInvite(InviteInfo inviteInfo) {
		return jdbcHandle.insert(inviteInfo);
	}

	@CacheWrite(key = CacheFinal.INVITE_LIST, fields = { "userId", "keyWorld", "pager.currPage",
			"pager.pageSize" }, validTime = 2)
	public Pager loadInvites(Pager pager, String keyWorld) {
		Where where = new Where();
		if (!StringUtil.isNullOrEmpty(keyWorld)) {
			where.set("inviteCode", keyWorld);
		}
		return jdbcHandle.findPager(InviteInfo.class, where, pager, "updateTime", true);
	}

}
