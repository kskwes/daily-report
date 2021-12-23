# 社内日報サービス

## 概要
- 社内で使用することを想定した日報管理サービス

## 開発
- PHP
- Bootstrap

## 仕様
1. 登録用ページでユーザー登録  
( /register/ )
- 名前（自由入力）
- 部署（選択式）
- メールアドレス
- パスワード
- ユーザー情報（一般・管理）
2. トップページからログイン  
( /public/ )
3. ログイン後、トップページから日報を投稿
4. 一覧ページで日報一覧を取得
( /list/ )
5. 管理ユーザーであれば各部署別に一般ユーザーの投稿を閲覧可能
- 管理者ページ：( /admin/ )
- 部署別一覧ページ：(?dept=1 ~ ?dept=5)
6. ログアウトページ
( /logout/ )

## データベース情報
### データベース
**daily_report**
### テーブル
**users: 登録ユーザー情報**  
  
|Field       |Type         |Null |Key |Default           |Extra                        |
|------------|-------------|-----|----|------------------|-----------------------------|
|id          |int(11)      |NO   |PRI |NULL              |auto_increment               |
|name        |text         |YES  |    |NULL              |                             |
|department  |tinyint(1)   |YES  |    |NULL              |                             |
|email       |text         |YES  |    |NULL              |                             |
|password    |varchar(255) |YES  |    |NULL              |                             |
|admin       |tinyint(1)   |YES  |    |0                 |                             |
|created_at  |datetime     |NO   |    |CURRENT_TIMESTAMP |                             |
|modified_at |datetime     |NO   |    |CURRENT_TIMESTAMP |on update CURRENT_TIMESTAMP  |  
  
  
**posts: 投稿内容**  
  
|Field       |Type     |Null |Key |Default           |Extra                       |
|------------|---------|-----|----|------------------|----------------------------|
|id          |int(11)  |NO   |PRI |NULL              |auto_increment              |
|user_id     |int(11)  |YES  |    |NULL              |                            |
|images      |text     |YES  |    |NULL              |                            |
|post        |text     |YES  |    |NULL              |                            |
|created_at  |datetime |NO   |    |CURRENT_TIMESTAMP |                            |
|modified_at |datetime |NO   |    |CURRENT_TIMESTAMP |on update CURRENT_TIMESTAMP |  
  

**departmentsers: 部署データ**  
  
|Field         |Type     |Null |Key |Default           |Extra                       |
|--------------|---------|-----|----|------------------|----------------------------|
|id            |int(11)  |NO   |PRI |NULL              |auto_increment              |
|name          |text     |YES  |    |NULL              |                            |
|department_id |text     |YES  |    |NULL              |                            |
|created_at    |datetime |NO   |    |CURRENT_TIMESTAMP |                            |
|modified_at   |datetime |NO   |    |CURRENT_TIMESTAMP |on update CURRENT_TIMESTAMP |  
  
  

