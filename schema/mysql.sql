create table if not exists `Contact`
(
	`id` int(10) not null auto_increment,
	`active` tinyint(1) default 1,
	`title` varchar(100) default null,
	`address` varchar(200) default null,
	`latitude` real default null,
	`longitude` real default null,
	`phones` text default null,
	`emails` text default null,
	primary key (`id`),
	key `geocode` (`latitude`,`longitude`)
) engine InnoDB;
