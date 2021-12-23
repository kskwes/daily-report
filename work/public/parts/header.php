<header class="header d-flex flex-column align-items-center py-3 mb-4 border-bottom">
    <a href="/dev/daily-report/work/public/" class="d-flex align-items-center mb-3 text-dark text-decoration-none">
        <img src="/dev/daily-report/work/public/images/logo.png" alt="会社ロゴ" class="img-fluid">
    </a>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a href="/dev/daily-report/work/public/" class="nav-link">ホーム</a>
        </li>
        <li class="nav-item">
            <a href="/dev/daily-report/work/public/list/" class="nav-link">日報一覧</a>
        </li>
        <?php if ($_SESSION['admin'] === 1): ?>
        <li class="nav-item">
            <a href="/dev/daily-report/work/public/admin/" class="nav-link">管理者ページ</a>
        </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['id'])): ?>
        <li class="nav-item">
            <a href="/dev/daily-report/work/public/logout/" class="nav-link">ログアウト</a>
        </li>
        <?php endif; ?>
    </ul>
</header>