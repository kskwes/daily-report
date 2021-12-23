<?php

$title = 'ホーム';
$is_home = true;
include 'parts/head.php';

$today = date('Y/m/d');
$num = date('w');
$w = w($num);

if(!empty($_POST)) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$_POST['email']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($_POST['password'], $result['password'])) {
            $message = "メールアドレスかパスワードが違います";
        } else {
            session_regenerate_id(TRUE);
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['admin'] = $result['admin'];
            header('Location: ' . SITE_URL);
            exit();
        }
    }
}

$posts = getPosts($pdo);

$id = array_column($posts, 'ID');

?>

</head>
<body>
    <main class="container">
        <?php include 'parts/header.php'; ?>

        <?php if (isset($_SESSION['id'])): ?>
            <p class="text-end">ユーザー名: <?= h($_SESSION['name']); ?></p>
            <!-- ログインユーザー -->
            <section class="card user-info mb-4">
                <div class="card-header">
                    <?= $today . "(" . $w . ")"; ?>
                </div>

                <?php if (in_array($_SESSION['id'], array_column($posts, 'ID'))): ?>
                    <div class="card-body">
                        <div class="card-text">
                            本日の日報は投稿済みです。
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <form action="<?= SITE_URL . 'list/index.php'; ?>" method="post" class="card-text">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">日報入力フォーム</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['id']; ?>">
                            </div>
                            <input type="submit" value="送信" class="btn btn-primary">
                        </form>
                    </div>
                <?php endif; ?>
            </section>
        <?php else: ?>
            <!-- 非ログインユーザー -->
            <section class="card user-rsvs mb-4">
                <div class="card-header">
                    ログイン
                </div>
                <form action="<?= SITE_URL; ?>" method="post" class="card-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">メールアドレス</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">パスワード</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <input type="submit" value="ログイン" class="btn btn-primary">
                </form>
                <?= h($message); ?>
            </section>
        <?php endif; ?>

        <?php include 'parts/footer.php'; ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/dev/daily-report/work/public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>