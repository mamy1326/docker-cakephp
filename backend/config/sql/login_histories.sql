CREATE TABLE login_histories (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  ip_address bigint(10) NOT NULL,
  user_agent varchar(255) NOT NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
);
