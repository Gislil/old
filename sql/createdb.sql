#create the database
create database if not exists `orka`;

#create the table for the users
create table if not exists `orka`.`users` (
    `user_id` int(11) not null auto_increment,
    `fname` varchar(64) not null,
    `lname` varchar(64) not null,
    `email` varchar(64) collate utf8_unicode_ci not null,
    `user_password_hash` char(255) not null,
    `user_reg_date` date not null,
    primary key (`user_id`),
    unique key `email` (`email`)
) engine=InnoDb default charset=utf8 collate=utf8_unicode_ci comment='the user data';

#create table for devices
create table if not exists `orka`.`devices` (
	`device_id` varchar(32) not null,
	`assc_user_email` varchar(64) collate utf8_unicode_ci not null,
	primary key (`device_id`),
	foreign key (assc_user_email) references `orka`.`users`(email)
) engine=InnoDb default charset=utf8 collate=utf8_unicode_ci comment='device data';

# table for test devices
create table if not exists `orka`.`d0001` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0002` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0003` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0004` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0005` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0006` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0007` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0008` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

create table if not exists `orka`.`d0009` (
    `timestamp` int(11) not null,
    `volt` float(5,2),
    `amp` float(5,2),
    `pf` float(5,2),
    `temp` float(5,2),
    `wind` float(5,2),
    `humidity` float(5,2),
    primary key (`timestamp`)
) engine=InnoDb;

#dummy data
replace into `orka`.`users`
    (fname, lname, email, user_password_hash, user_reg_date)
	values 
    ('Jón', 'Jónsson', 'jon@jon.is', 'jonsi123', now()),
	('Gaur', 'Notandi', 'gaur@gaur.is', 'party', now()),
	('Test', 'User', 'test@user.is', 'testuser', now())
	;

replace into `orka`.`devices` (device_id, assc_user_email)
	values ('D0001', 'jon@jon.is'),
	('D0002', 'test@user.is'),
	('D0003', 'test@user.is'),
	('D0004', 'jon@jon.is'),
	('D0005', 'gaur@gaur.is'),
	('D0006', 'jon@jon.is'),
	('D0007', 'gaur@gaur.is'),
	('D0008', 'jon@jon.is'),
	('D0009', 'test@user.is');

    # create the mysql user that handles the registering users and logging in
    create user 'orkuadmin'@'localhost' identified by 'orkupass';
    grant select, insert, delete on orka.users  to 'orkuadmin';
    grant select, insert, delete on orka.devices  to 'orkuadmin';
    grant select, insert, delete on orka.*  to 'orkuadmin';