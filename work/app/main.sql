-- id           INT         NO  PRI NULL    auto_increment  ユーザーID
-- name         TEXT        YES     NULL                    ユーザー名
-- department   TEXT	    YES		NULL		            所属部署
-- email        TEXT	    YES		NULL		            メールアドレス
-- password	    VARCHAR(8)	YES		NULL		            パスワード
-- admin	    TYNYINT	    YES		NULL		            管理ユーザーかどうか
-- created_at	    DATETIME	YES		NULL		            登録日時
-- modified_at	    DATETIME	YES		NULL		            更新日時

-- id	        INT	        NO	PRI	NULL	auto_increment	投稿ID
-- user_id  	INT	        YES		NULL		            ユーザーID
-- images	    TEXT	    YES		NULL		            画像
-- post	        TEXT	    YES		NULL		            投稿内容
-- created_at	DATETIME	YES		NULL		            登録日時
-- modified_at	DATETIME	YES		NULL		            更新日時


CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    name TEXT,
    department TEXT,
    email TEXT,
    password VARCHAR(8),
    admin BOOL DEFAULT false,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO users (name) VALUES ('test taro');
INSERT INTO users (name, admin) VALUES ('test jiro', true);
INSERT INTO users (name) VALUES ('test ichiro');

INSERT INTO users (name, department, email, password) VALUES ('hanako', 'デザイン部', 'hanako@example.com', 1234);
INSERT INTO users (name, department, email, password, admin) VALUES ('leader', '人事部', 'jinji@example.com', 1234, true);
INSERT INTO users (name, department, email, password, admin) VALUES ('president', '社長', 'president@example.com', SHA1(1234), true);

SELECT * FROM users;

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT,
    images TEXT,
    post TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO posts (user_id, post) VALUES (2, '本日の日報です。');
INSERT INTO posts (user_id, post) VALUES ('1', '本日は早退しました。');
INSERT INTO posts (user_id, post) VALUES ('3', '本日は２時間残業しました。');

SELECT * FROM posts;

CREATE TABLE departments (
    id INT NOT NULL AUTO_INCREMENT,
    name TEXT,
    department_id TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- <option value="1">役員</option>
-- <option value="2">人事部</option>
-- <option value="3">営業部</option>
-- <option value="4">システム部</option>
-- <option value="5">デザイン部</option>

INSERT INTO departments (name, department_id) VALUES ('役員', 1);
INSERT INTO departments (name, department_id) VALUES ('人事部', 2);
INSERT INTO departments (name, department_id) VALUES ('営業部', 3);
INSERT INTO departments (name, department_id) VALUES ('システム部', 4);
INSERT INTO departments (name, department_id) VALUES ('デザイン部', 5);



-- ユーザーデータと投稿データを結合
SELECT
posts.id, users.id AS 'ID',
users.department AS 'DEPT',
users.name AS 'NAME',
posts.post AS 'POST',
DATE_FORMAT(posts.created_at, '%Y/%m/%d') AS 'DATE'
FROM users
INNER JOIN posts
ON users.id = posts.user_id
ORDER BY posts.created_at DESC



-- 部署データと結合
SELECT t.NAME, t.DEPT, departments.name, t.ADMIN, t.POST, t.DATE
FROM departments
INNER JOIN (
    SELECT
    a.name AS 'NAME',
    a.department AS 'DEPT',
    b.post AS 'POST',
    b.created_at AS 'DATE_O',
    DATE_FORMAT(b.created_at, '%Y/%m/%d') AS 'DATE',
    a.admin AS 'ADMIN'
    FROM users a
    INNER JOIN posts b
    ON a.id = b.user_id
) AS t
ON departments.department_id = t.DEPT
ORDER BY t.DATE_O DESC



-- 月別集計
SELECT t.DATE_MONTH
FROM departments
INNER JOIN (
    SELECT
    a.name AS 'NAME',
    a.department AS 'DEPT',
    b.post AS 'POST',
    b.created_at AS 'DATE_O',
    DATE_FORMAT(b.created_at, '%Y/%m/%d') AS 'DATE',
    DATE_FORMAT(b.created_at, '%Y/%m') AS 'DATE_MONTH',
    a.admin AS 'ADMIN'
    FROM users a
    INNER JOIN posts b
    ON a.id = b.user_id
) AS t
ON departments.department_id = t.DEPT
GROUP BY t.DATE_MONTH


SELECT 
substring(t.DATE, 6, 2) AS 'DATE_MONTH'
FROM departments
INNER JOIN (
    SELECT
    a.id AS 'ID', a.name AS 'NAME', a.department AS 'DEPT', b.post AS 'POST', b.created_at AS 'DATE_O', DATE_FORMAT(b.created_at, '%Y/%m/%d') AS 'DATE', a.admin AS 'ADMIN'
    FROM users a
    INNER JOIN posts b
    ON a.id = b.user_id
) AS t
ON departments.department_id = t.DEPT
GROUP BY DATE_MONTH