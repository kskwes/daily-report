<?php

$title = '日報一覧';
$is_home = false;
include '../parts/head.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addPost($pdo);

    header('Location: ' . SITE_URL . 'list/index.php');
    exit;
}

$posts = getPosts($pdo);

$months = getMonthGroup($pdo);

?>

</head>
<body>
    <main class="container">
        <?php include '../parts/header.php'; ?>

        <?php if (isset($_SESSION['id'])): ?>
            <ul class="nav justify-content-center nav-tabs mb-3">
                <li class="nav-item">
                    <?php if (!isset($_GET['month'])): ?>
                        <a href="./" class="nav-link active">すべて</a>
                    <?php else: ?>
                        <a href="./" class="nav-link">すべて</a>
                    <?php endif; ?>
                </li>
                
                <?php foreach ($months as $month): ?>
                    <li class="nav-item">
                        <?php if ($month->DATE_MONTH === $_GET['month']): ?>
                            <a href="?month=<?= $month->DATE_MONTH; ?>" class="nav-link active"><?= $month->DATE_MONTH; ?>月</a>
                        <?php else: ?>
                            <a href="?month=<?= $month->DATE_MONTH; ?>" class="nav-link"><?= $month->DATE_MONTH; ?>月</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <section class="list-group modal_trigger">
                <?php if ($_GET['month'] >= 1): ?>
                    <?php foreach ($posts as $post): ?>
                        <?php if ($post->ID === $_SESSION['id']): ?>
                            <?php if ($post->DATE_MONTH === $_GET['month']): ?>
                                <div class="list-group-item list-group-item-action modal_btn">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?= h($post->DATE); ?></h5>
                                        <small><?= h($post->NAME); ?></small>
                                    </div>
                                    <p class="mb-1"><?= mb_strimwidth(h($post->POST), 0, 15, ' ......', 'UTF-8'); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <?php if ($post->ID === $_SESSION['id']): ?>
                            <div class="list-group-item list-group-item-action modal_btn">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= h($post->DATE); ?></h5>
                                    <small><?= h($post->NAME); ?></small>
                                </div>
                                <p class="mb-1"><?= mb_strimwidth(h($post->POST), 0, 15, ' ......', 'UTF-8'); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif;?>
            </section>

            <!-- モーダル中身 -->
            <div class="modal_area">
                <?php foreach ($posts as $post): ?>
                    <?php if ($post->ID === $_SESSION['id']): ?>
                        <div class="modal_box">
                            <div class="modal_bg"></div>
                            <div class="modal_inner">
                                <div class="modal_block">
                                    <p class="h4 mb-4"><?= h($post->DATE); ?></p>
                                    <p class="h6">
                                        <?= nl2br(h($post->POST)); ?>
                                    </p>
                                </div>
                                <div class="modal_close h4">x</div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <section class="card user-rsvs mb-4">
                <div class="card-body">
                    ログインしてください
                </div>
            </section>
        <?php endif; ?>

        <?php include 'parts/footer.php'; ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/dev/daily-report/work/public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>