CREATE TABLE `##prefix##content` (
  `jf_id` int(11) NOT NULL auto_increment COMMENT 'id',
  `jf_area` varchar(20) NOT NULL COMMENT '场地',
  `jf_child` int(4) NOT NULL COMMENT '是否带小孩',
  `jf_pay` int(4) NOT NULL COMMENT '是否已支付',
  `jf_renshu` int(4) NOT NULL COMMENT '到场人数',
  `jf_comedate` date NOT NULL COMMENT '到场日期',
  `jf_user` varchar(10) NOT NULL COMMENT '联系人',
  `jf_pnum` varchar(14) NOT NULL COMMENT '联系电话',
  `jf_qq` varchar(14) NOT NULL COMMENT '联系QQ',
  `jf_note` text NOT NULL COMMENT '具体要求',
  `jf_ip` varchar(20) NOT NULL COMMENT 'ip地址',
  `jf_intime` int(10) unsigned NOT NULL COMMENT '提交时间',
  `jf_pass` varchar(4) NOT NULL COMMENT '是否审核通过',
  PRIMARY KEY  (`jf_id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=##charset## AUTO_INCREMENT=1;