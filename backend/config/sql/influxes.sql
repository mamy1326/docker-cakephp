CREATE TABLE influxes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  description varchar(255) default NULL,
  deleted  datetime default NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) COMMENT='流入マスタ';
