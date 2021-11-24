package com.imxss.web.install;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.text.MessageFormat;
import java.util.Properties;

import org.apache.tools.ant.Project;
import org.apache.tools.ant.taskdefs.SQLExec;
import org.apache.tools.ant.types.EnumeratedAttribute;
import org.coody.framework.context.base.BaseLogger;
import org.coody.framework.context.entity.MsgEntity;
import org.coody.framework.util.EncryptUtil;
import org.coody.framework.util.PrintException;
import org.coody.framework.util.SpringContextHelper;
import org.coody.framework.util.StringUtil;

import com.imxss.web.constant.FormatFinal;
import com.mchange.v2.c3p0.ComboPooledDataSource;

public class InstallHandle {

	private static BaseLogger logger = BaseLogger.getLogger(InstallHandle.class);

	public static Boolean isInstall;

	public static boolean isInstall() {
		if (isInstall == null) {
			String value = System.getProperty("installed");
			if ("0".equals(value)) {
				isInstall = false;
			} else {
				isInstall = true;
			}
		}
		return isInstall;
	}

	public static Connection getConnection(String host, String dbUser, String pwd, String dbName) {
		Connection conn = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");// 指定连接类型
			String url = MessageFormat.format("jdbc:mysql://{0}/{1}?useUnicode=true&characterEncoding=utf-8", host,
					dbName == null ? "" : dbName);
			conn = DriverManager.getConnection(url, dbUser, pwd);// 获取连接
			conn.setAutoCommit(true);
			return conn;
		} catch (Exception e) {
			return conn;
		}
	}

	public static boolean dbCheck(String host, String dbUser, String pwd, String dbName) {
		Connection conn = null;
		try {
			conn = getConnection(host, dbUser, pwd, dbName);
			return conn!=null;
		} catch (Exception e) {
			return false;
		} finally {
			if (conn != null) {
				try {
					conn.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
		}
	}

	// 创建数据库
	public static boolean createDataBase(String host, String dbUser, String pwd, String dbName) {
		Connection conn = getConnection(host, dbUser, pwd, null);
		try {
			String sql = "CREATE DATABASE `" + dbName + "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
			PreparedStatement stat = conn.prepareStatement(sql);
			int code = stat.executeUpdate();
			return code > 0;
		} catch (Exception e) {
			PrintException.printException(logger, e);
			return false;
		} finally {
			if (conn != null) {
				try {
					conn.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
		}
	}

	public static boolean createTables(String host, String dbUser, String pwd, String dbName) {
		String path = Thread.currentThread().getContextClassLoader().getResource("").getPath() + "/ImXSS.sql";
		try {
			SQLExec sqlExec = new SQLExec();
			Class.forName("com.mysql.jdbc.Driver");// 指定连接类型
			String url = MessageFormat.format("jdbc:mysql://{0}/{1}?useUnicode=true&characterEncoding=utf-8", host,
					dbName == null ? "" : dbName);
			sqlExec.setDriver("com.mysql.jdbc.Driver");
			sqlExec.setUrl(url);
			sqlExec.setUserid(dbUser);
			sqlExec.setPassword(pwd);
			sqlExec.setAutocommit(true);
			sqlExec.setSrc(new File(path));
			sqlExec.setEncoding("UTF-8");
			sqlExec.setOnerror((SQLExec.OnError) (EnumeratedAttribute.getInstance(SQLExec.OnError.class, "continue")));
			sqlExec.setPrint(true);
			sqlExec.setProject(new Project());
			sqlExec.execute();
			return true;
		} catch (Exception e) {
			PrintException.printException(logger, e);
			return false;
		}
	}
	
	public static boolean writeSetting(String host, String dbUser, String pwd, String dbName){
		Connection conn = getConnection(host, dbUser, pwd, dbName);
		try {
			String sql = "INSERT INTO `setting_info` set id='1', siteName='ImXSS 国内最专业的Xss渗透测试平台', keywords='国内最专业的Xss渗透测试平台  --ImXSS', description='ImXSS为Coody研发且开源。是国内最专业的Xss渗透平台', copyright='Copyright © 2014-2019 Scrum Group 版权所有',openReg= '1', needInvite='0'";
			PreparedStatement stat = conn.prepareStatement(sql);
			int code = stat.executeUpdate();
			return code > 0;
		} catch (Exception e) {
			PrintException.printException(logger, e);
			return false;
		} finally {
			if (conn != null) {
				try {
					conn.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
		}
	}

	public static boolean writeConfig(String fieldName, String value) {
		Properties properties = new Properties();
		FileOutputStream output = null;
		try {
			String classPath = Thread.currentThread().getContextClassLoader().getResource("").getPath();
			String path=classPath + "config/conf.properties";
			properties.load(new FileInputStream(new File(path)));
			output = new FileOutputStream(new File(path));
			properties.setProperty(fieldName, value);
			System.setProperty(fieldName, value);
			properties.store(output, "");
			properties.load(new FileInputStream(new File(path)));
			return true;
		} catch (IOException io) {
			io.printStackTrace();
			return false;
		} finally {
			if (output != null) {
				try {
					output.close();
				} catch (IOException e) {
					e.printStackTrace();
				}
			}
		}
	}

	public static boolean writeAdminUser(String host, String dbUser, String pwd, String dbName, String adminUser,
			String adminPwd) {
		Connection conn = getConnection(host, dbUser, pwd, dbName);
		String sql = "insert into user_info set email=?,userPwd=?,status=0,roleId=1,nickName='admin'";
		try {
			PreparedStatement stat = conn.prepareStatement(sql);
			stat.setObject(1, adminUser);
			stat.setObject(2, EncryptUtil.customEnCode(adminPwd));
			int code = stat.executeUpdate();
			return code > 0;
		} catch (Exception e) {
			PrintException.printException(logger, e);
			return false;
		} finally {
			if (conn != null) {
				try {
					conn.close();
				} catch (Exception e2) {
					// TODO: handle exception
				}
			}
		}
	}

	private static void writeDataSource(String jdbcUrl, String dbUser, String dbPwd) {
		ComboPooledDataSource dataSource = SpringContextHelper.getBean(ComboPooledDataSource.class);
		dataSource.setJdbcUrl(jdbcUrl);
		dataSource.setUser(dbUser);
		dataSource.setPassword(dbPwd);
		dataSource.resetPoolManager();
	}

	public static MsgEntity install(InstallConfig config) {
		if(isInstall()){
			return new MsgEntity(-1, "ImXSS已安装，如需重装请修改config/conf.properties下installed参数为0");
		}
		if (!StringUtil.isNullOrEmpty(config.host)) {
			config.host = config.host.replace("：", ":");
		}
		if (!StringUtil.isEmail(config.adminUser)) {
			return new MsgEntity(-1, "用户名格式有误");
		}
		if (!StringUtil.isMatcher(config.adminPwd, FormatFinal.USER_PWD)) {
			return new MsgEntity(-1, "密码格式有误");
		}
		if (!dbCheck(config.host, config.dbUser, config.dbPwd, "")) {
			return new MsgEntity(-1, "数据库连接失败");
		}
		if (dbCheck(config.host, config.dbUser, config.dbPwd, config.dbName)) {
			return new MsgEntity(-1, "数据库已存在");
		}
		createDataBase(config.host, config.dbUser, config.dbPwd, config.dbName);
		if (!createTables(config.host, config.dbUser, config.dbPwd, config.dbName)) {
			return new MsgEntity(-1, "数据内容导入失败");
		}
		String jdbcUrl = MessageFormat.format("jdbc:mysql://{0}/{1}?useUnicode=true&characterEncoding=utf-8",
				config.host, config.dbName);
		//写入超级管理员
		if(!writeAdminUser(config.host, config.dbUser, config.dbPwd, config.dbName, config.adminUser, config.adminPwd)){
			return new MsgEntity(-1, "管理员添加失败，请手动添加");
		}
		//写入网站配置
		writeSetting(config.host, config.dbUser, config.dbPwd, config.dbName);
		//写入配置文件
		if (!writeConfig("jdbc_url", jdbcUrl) || !writeConfig("jdbc_user", config.dbUser)
				|| !writeConfig("jdbc_password", config.dbPwd) || !writeConfig("installed", "1")) {
			return new MsgEntity(-1, "配置文件写入失败");
		}
		// 重置数据源
		writeDataSource(jdbcUrl, config.dbUser, config.dbPwd);
		// 刷新安装配置
		isInstall = null;
		return new MsgEntity(0, "安装成功");
	}

	public static class InstallConfig {
		String host;
		String dbUser;
		String dbPwd;
		String dbName;
		String adminUser;
		String adminPwd;
	}

}
