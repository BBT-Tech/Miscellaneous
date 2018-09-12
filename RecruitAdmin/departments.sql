CREATE TABLE deps_all (
	name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO deps_all
VALUES
	('技术部 - 代码组'),
	('技术部 - 设计组'),
	('技术部（北校专业）'),
	('策划推广部'),
	('编辑部 - 原创写手'),
	('编辑部 - 摄影'),
	('编辑部 - 可视化设计'),
	('视觉设计部'),
	('视频部 - 策划导演'),
	('视频部 - 摄影摄像'),
	('视频部 - 剪辑特效'),
	('外联部'),
	('节目部 - 国语组'),
	('节目部 - 英语组'),
	('节目部 - 粤语组'),
	('人力资源部'),
	('综合管理部 - 行政管理'),
	('综合管理部 - 物资财务'),
	('综合新闻部 - 撰文记者'),
	('综合新闻部 - 摄影记者'),
	('产品运营部（北校专业）');



CREATE TABLE deps (
	name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO deps
VALUES
	('技术部'),
	('策划推广部'),
	('编辑部'),
	('视觉设计部'),
	('视频部'),
	('外联部'),
	('节目部'),
	('人力资源部'),
	('综合管理部'),
	('综合新闻部'),
	('产品运营部');
