CREATE TABLE drivers_stores (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  driver_id int(11) UNSIGNED NOT NULL,
  store_id int(11) UNSIGNED NOT NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE unq_driver_id_store_id (driver_id, store_id)
) COMMENT='ドライバー所属店舗中間テーブル';
