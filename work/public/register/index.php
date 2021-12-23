<?php

$title = 'ユーザー登録';
$is_home = false;
include '../parts/head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, department, email, password, admin) VALUES(:name, :department, :email, :password, :admin)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':department', $_POST['department']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $hash_pass);
    $stmt->bindParam(':admin', $_POST['admin']);

    $stmt->execute();
}

?>

</head>
<body>
    <main class="container">
        <?php include '../parts/header.php'; ?>

        <section class="card user-rsvs mb-4">
            <div class="card-header">
                ユーザー登録
            </div>
            <form action="<?= SITE_URL . 'register/index.php'; ?>" method="post" class="card-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">名前</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">部署</label>
                    <select class="form-select" aria-label="Default select example" name="department">
                        <option selected>選択してください</option>
                        <option value="1">役員</option>
                        <option value="2">人事部</option>
                        <option value="3">営業部</option>
                        <option value="4">システム部</option>
                        <option value="5">デザイン部</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">メールアドレス</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">パスワード</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">ユーザー情報</label>
                    <select class="form-select" aria-label="Default select example" name="admin">
                        <option selected>選択してください</option>
                        <option value="1">管理ユーザー</option>
                        <option value="0">一般ユーザー</option>
                    </select>
                </div>
                <input type="submit" value="登録" class="btn btn-primary">
            </form>
        </section>

        <?php include 'parts/footer.php'; ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/dev/daily-report/work/public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>