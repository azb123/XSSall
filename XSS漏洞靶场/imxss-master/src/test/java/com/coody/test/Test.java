package com.coody.test;

import java.net.MalformedURLException;
import java.net.URL;

import org.coody.framework.util.FileUtils;

import sun.misc.BASE64Decoder;
import sun.misc.BASE64Encoder;

public class Test {

	
		public static void main(String[] args) throws MalformedURLException {
			String sr="http://127.0.0.1:8080/web_cc/src/components/logicalTabManage/logicalTable.html";
			URL url=new URL(sr);
			System.out.println(url.getProtocol()+"://"+url.getHost()+((url.getPort()==80||url.getPort()==443)?"":(":"+url.getPort())));
	}
}
