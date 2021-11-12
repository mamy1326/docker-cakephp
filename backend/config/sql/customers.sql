CREATE TABLE customers (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  postal_code varchar(7) default NULL,
  area_id int(11) NOT NULL,
  influxe_id int(11) NOT NULL,
  prefecture_id int(11) NOT NULL,
  tel_1 varchar(255) NOT NULL,
  address_1 varchar(255) NOT NULL,
  tel_2 varchar(255) default NULL,
  address_2 varchar(255) default NULL,
  tel_3 varchar(255) default NULL,
  address_3 varchar(255) default NULL,
  email varchar(255) default NULL,
  deleted  datetime default NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) COMMENT='顧客テーブル';
