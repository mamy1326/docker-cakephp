CREATE TABLE stores (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL comment '店舗名',
  trade_name varchar(255) NOT NULL comment '屋号',
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  deleted datetime default NULL,
  PRIMARY KEY (id)
);
