<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= \App\Core\Session::getCsrfToken() ?>">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Eisen Admin Dashboard'; ?></title>
    
    <!-- Google Fonts: Montserrat & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- ChartJS for reports -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Admin Style -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/style.css">

    <script>
        window.BASE_URL = '<?= BASE_URL ?>';
    </script>
</head>
<body>
    <div class="app-container">
        <?php include dirname(__DIR__) . '/partials/sidebar.php'; ?>
        
        <div class="main-wrapper">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
                        <i data-lucide="menu" class="icon-open"></i>
                        <i data-lucide="chevron-right" class="icon-closed"></i>
                    </button>
                    <span class="topbar-welcome">Eisen Corporation — Control Room</span>
                </div>
                
                <div class="topbar-right">
                    <div class="user-profile-container">
                        <div class="user-profile" id="userProfileToggle">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=c9a227&color=050d1a&bold=true" alt="Admin Profile">
                        </div>
                        
                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=c9a227&color=050d1a&bold=true" alt="Admin Profile">
                                <div class="user-meta">
                                    <p class="user-name">Eisen Admin</p>
                                    <p class="user-role">Super Administrator</p>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="<?= BASE_URL ?>/" class="dropdown-item">
                                <i data-lucide="external-link"></i>
                                <span>Go to Frontend</span>
                            </a>
                            <a href="<?= BASE_URL ?>/admin/login" class="dropdown-item logout-item">
                                <i data-lucide="log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-body">
