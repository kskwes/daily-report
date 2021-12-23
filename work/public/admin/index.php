<?php

$title = '管理ユーザーページ';
$is_home = false;
include '../parts/head.php';

$depts = getDepartment($pdo);

$posts = getPosts($pdo);

?>

</head>
<body>
    <main class="container">
        <?php include '../parts/header.php'; ?>

        <?php if (isset($_SESSION['id']) && $_SESSION['admin'] == 1): ?>
            <section class="user-rsvs mb-4">
                <?php if ($_GET['dept'] >= 1): ?>
                    <?php foreach ($depts as $dept): ?>
                        <?php if ($_GET['dept'] == $dept->department_id): ?>
                            <div class="h5">
                                <?= $dept->name; ?>
                            </div>
                            <div class="list-group modal_trigger">
                                <?php foreach ($posts as $post): ?>
                                    <?php if ($post->DEPT == $dept->department_id): ?>
                                        <div class="list-group-item list-group-item-action modal_btn">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?= h($post->DATE); ?></h5>
                                                <small><?= h($post->NAME); ?></small>
                                            </div>
                                            <p class="mb-1"><?= mb_strimwidth(h($post->POST), 0, 15, ' ......', 'UTF-8'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <!-- モーダル中身 -->
                    <div class="modal_area">
                        <?php foreach ($depts as $dept): ?>
                            <?php if ($_GET['dept'] == $dept->department_id): ?>
                                <?php foreach ($posts as $post): ?>
                                    <?php if ($post->DEPT == $dept->department_id): ?>
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
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else:?>
                    <div class="h5">
                        部署
                    </div>
                    <p>
                        <ul>
                            <?php foreach ($depts as $dept): ?>
                                <li>
                                    <a href="?dept=<?= $dept->department_id; ?>"><?= $dept->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </p>
                <?php endif; ?>
            </section>

        <?php else: ?>
            <section class="card user-rsvs mb-4">
                <div class="card-body">
                    管理者用ページです
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