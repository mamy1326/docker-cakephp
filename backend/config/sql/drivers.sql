CREATE TABLE drivers (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  tel varchar(255) NOT NULL,
  email varchar(255) NOT NULL unique,
  description varchar(255) default NULL,
  deleted  datetime default NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) COMMENT='ドライバー情報';
