<?php

$title = '404 Page Not Found';
$is_home = false;
include '../parts/head.php';

?>
</head>
<body>
    <main class="container">
        <?php include '../parts/header.php'; ?>

        <section class="card user-rsvs mb-4">
            <div class="card-header">
                404 Page Not Found.
            </div>
            <div class="card-body">
                ページが見つかりません
            </div>
        </section>

        <?php include 'parts/footer.php'; ?>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/dev/daily-report/work/public/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>