CREATE TABLE users (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  store_id int(11) UNSIGNED NOT NULL default 1 comment '所属店舗ID',
  visited  datetime default NULL comment '最終ログイン日時',
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  deleted  datetime default NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (email)
);

-- テスト・開発用（パスワードはリマインダーで更新すること）
INSERT INTO users
  (id, username, password, email, created, modified)
VALUES
  (1, 'your-name', 'password-hash', 'your-mail-address', NOW(), NOW());
