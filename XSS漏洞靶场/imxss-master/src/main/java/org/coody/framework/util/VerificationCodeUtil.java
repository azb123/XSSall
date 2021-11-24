package org.coody.framework.util;

import java.awt.Color;
import java.awt.Font;
import java.awt.FontMetrics;
import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.util.Random;

/**
 * 图片文字验证码生成类
 * 
 * @author Coody
 * @version 1.0 2014-8-29
 */
public class VerificationCodeUtil {
	private static Random rnad= new Random();
	private static Graphics graphics;
	private static BufferedImage img;
	private static BufferedImage baseImg;

	/**
	 * 
	 * @param imgWidth
	 *            图片宽度
	 * @param imgHeight
	 *            图片高度
	 * @param codeLenth
	 *            验证码长度
	 * @param fontSize
	 *            验证文字大小
	 * @return BufferedImage 验证码图片
	 */
	public static BufferedImage outCode(int imgWidth, int imgHeight, int codeLenth,
			int fontSize, String verCode) {
		getConn(imgWidth, imgHeight);// 初始化所需对象
		char[] code = verCode.toCharArray();// 验证码字符转为字节集合
		Font f = new Font("Consolas", Font.BOLD | Font.ITALIC, fontSize);
		FontMetrics fm = sun.font.FontDesignMetrics.getMetrics(f);
		for (int i = 0; i < code.length; i++) { // 循环在img上写出字符
			// 设置字体颜色
			graphics.setColor(new Color(rnad.nextInt(160), rnad.nextInt(160),
					rnad.nextInt(55) + 200));
			// 设置字体
			graphics.setFont(f);
			// 设置图片位置
			int x = (imgWidth / codeLenth) * i
					+ ((imgWidth / codeLenth - fm.charWidth(code[i])) / 2);
			int y = fm.charWidth(code[i]) + (imgHeight - fm.charWidth(code[i]))
					/ 2;
			// y = 15;
			graphics.drawString("" + code[i], x, y);
		}
		return img;
	}

	// 初始化所需對象
	private static void getConn(int width, int height) {
		if (rnad == null) {
			rnad = new Random();
		}
		if (baseImg == null) {
			baseImg = getBaseImg(width, height);
		}
		img = baseImg;
		graphics = getGraphics();
	}

	// 生成驗證碼背景顏色
	private static Graphics getGraphics() {
		Graphics graphic = img.getGraphics();
		int w = 0, h = 0, m = 0, n = 0;
		Color c = null;
		while (w < img.getWidth()) {
			n = rnad.nextInt(img.getWidth() / 15);
			h = 0;
			if (n > 0) {
				while (h < img.getHeight()) {
					m = rnad.nextInt(img.getHeight() / 5);
					if (m > 0) {
						// 获取随机颜色
						c = new Color(rnad.nextInt(35) + 220,
								rnad.nextInt(35) + 220, rnad.nextInt(35) + 220);
						graphic.setColor(c);
						// 生成随机背景块颜色
						graphic.fillRect(w, h, n, m);
						// 生成随机干扰线
						graphic.drawLine(n, m, w, h);
						h += m;
					}
				}
			}
			w += n;
		}
		return graphic;
	}

	// 獲取驗證碼字符串
	public static String getCodeStr(int codeLenth) {
		char[] ch = "0123456789".toCharArray();
		int lenth = ch.length;
		StringBuffer sb = new StringBuffer();
		for (int i = 0; i < codeLenth; i++) {
			sb.append(ch[rnad.nextInt(lenth)]);
		}
		return sb.toString();
	}


	private static BufferedImage getBaseImg(int width, int height) {
		baseImg = new BufferedImage(width, height, BufferedImage.TYPE_INT_RGB);
		return baseImg;
	}
}
