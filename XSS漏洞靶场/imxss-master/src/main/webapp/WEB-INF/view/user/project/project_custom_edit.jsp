<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="/WEB-INF/tld/c.tld"%>
<!doctype html>
<html>

<head>
<jsp:include page="../../includ/header.jsp" />
</head>

<body data-type="index">


	<header class="am-topbar am-topbar-inverse admin-header">
		<jsp:include page="../../includ/nav.jsp" />
	</header>

	<div class="tpl-page-container tpl-page-header-fixed">
		<div class="tpl-left-nav tpl-left-nav-hover">
			<jsp:include page="../../includ/left.jsp" />
		</div>





		<div class="tpl-content-wrapper">
			<ol class="am-breadcrumb">
				<li><a href="#" class="am-icon-home">项目中心</a></li>
				<li><a href="#" class="am-icon-home">模块定制</a></li>
				<li class="am-active">定制模块编辑</li>
			</ol>
			<div class="tpl-portlet-components">
				<div class="portlet-title">
					<div class="caption font-green bold">
						<span class="am-icon-code"></span> 定制模块编辑
					</div>
				</div>
				<div class="tpl-block">
					<div class="am-g">
						<div class="tpl-form-body tpl-form-line">
							<form class="am-form tpl-form-line-form" id="dataform"
								onsubmit="submitForm();return false;">
								<input type="hidden" name="projectId" value="${projectInfo.id }">
								<div class="am-form-group">
									<label for="user-name" class="am-u-sm-3 am-form-label">名称</label>
									<div class="am-u-sm-9">
										<input type="text" class="tpl-form-input" id="user-name"
											readonly="readonly" value="${projectInfo.title }"> <input
											type="hidden" name="id" value="${mapping.id }">
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-name" class="am-u-sm-3 am-form-label">来源</label>
									<div class="am-u-sm-9">
										<input type="text" class="tpl-form-input" id="user-name"
											name="mappingUrl" placeholder="请填写来源地址"
											value="${mapping.mappingUrl }"><small>(支持Ant通配符)</small>
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-phone" class="am-u-sm-3 am-form-label">模块
									</label>
									<div class="am-u-sm-9">
										<select name="moduleId">
											<c:if test="${!empty sysModules }">
												<optgroup label="系统模块">
													<c:forEach items="${sysModules }" var="module">
														<option value="${module.id }"
															${projectInfo.moduleId==module.id?'selected':'' }>${module.title }</option>
													</c:forEach>
												</optgroup>
											</c:if>
											<c:if test="${!empty userModules }">
												<optgroup label="我的模块">
													<c:forEach items="${userModules }" var="module">
														<option value="${module.id }"
															${projectInfo.moduleId==module.id?'selected':'' }>${module.title }</option>
													</c:forEach>
												</optgroup>
											</c:if>
										</select>
									</div>
								</div>
								<div class="am-form-group">
									<div class="am-u-sm-9 am-u-sm-push-3">
										<button type="submit"
											class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<jsp:include page="../../includ/js.jsp" />
</body>
<script>
	function submitForm() {
		$.ajax({
			type : "POST",
			dataType : 'json',
			data : $("#dataform").serialize(),
			url : 'projectModuleCustomSave.${defSuffix}',
			timeout : 60000,
			success : function(json) {
				alert(json.msg);
				if (json.code == 0) {
					location.href = document.referrer;
				}
			},
			error : function() {
				alert("系统繁忙");
			}
		});
	}
</script>

<style>
input {
	background-color: white !important;
}

.am-text-secondary {
	background-color: white !important;
}
</style>
</html>