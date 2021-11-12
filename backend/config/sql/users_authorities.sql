CREATE TABLE users_authorities (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id int(11) UNSIGNED NOT NULL,
  authority_id int(11) UNSIGNED NOT NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) COMMENT='管理者権限中間テーブル';
