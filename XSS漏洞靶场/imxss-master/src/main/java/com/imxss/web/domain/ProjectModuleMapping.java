package com.imxss.web.domain;

import org.coody.framework.context.base.BaseModel;

@SuppressWarnings("serial")
public class ProjectModuleMapping extends BaseModel{

	private Integer projectId;
	private Integer moduleId;
	private String mappingUrl;
	private Integer userId;
	private String id;
	
	
	
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public Integer getUserId() {
		return userId;
	}
	public void setUserId(Integer userId) {
		this.userId = userId;
	}
	public Integer getProjectId() {
		return projectId;
	}
	public void setProjectId(Integer projectId) {
		this.projectId = projectId;
	}
	public Integer getModuleId() {
		return moduleId;
	}
	public void setModuleId(Integer moduleId) {
		this.moduleId = moduleId;
	}
	public String getMappingUrl() {
		return mappingUrl;
	}
	public void setMappingUrl(String mappingUrl) {
		this.mappingUrl = mappingUrl;
	}
	
	

}
