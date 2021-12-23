<?php
function w($num) {
    $week = [
        '日',
        '月',
        '火',
        '水',
        '木',
        '金',
        '土',
    ];

    return $week[$num];
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function addPost($pdo)
{
    $post = trim(filter_input(INPUT_POST, 'post'));
    if ($post === '') {
        return;
    }

    $sql = "INSERT INTO posts (post, user_id) VALUES (:post, :user_id)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('post', $post, PDO::PARAM_STR);
    $stmt->bindValue('user_id', $_SESSION['id']);
    $stmt->execute();
}

function getPosts($pdo)
{
    $sql = "SELECT 
            t.ID, t.NAME, t.DEPT, departments.name, t.ADMIN, t.POST, t.DATE, substring(t.DATE, 6, 2) AS 'DATE_MONTH'
            FROM departments
            INNER JOIN (
                SELECT
                a.id AS 'ID', a.name AS 'NAME', a.department AS 'DEPT', b.post AS 'POST', b.created_at AS 'DATE_O', DATE_FORMAT(b.created_at, '%Y/%m/%d') AS 'DATE', a.admin AS 'ADMIN'
                FROM users a
                INNER JOIN posts b
                ON a.id = b.user_id
            ) AS t
            ON departments.department_id = t.DEPT
            ORDER BY t.DATE_O DESC";
            
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll();
    return $posts;
}

function getMonthGroup($pdo)
{
    $sql = "SELECT 
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
            GROUP BY DATE_MONTH";
    
    $stmt = $pdo->query($sql);
    $months = $stmt->fetchAll();
    return $months;
}

function getDepartment($pdo)
{
    $stmt = $pdo->query("SELECT * FROM departments");
    $depts = $stmt->fetchAll();
    return $depts;
}