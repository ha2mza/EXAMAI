<?php
if (!function_exists('request_session')) {
    http_response_code(404);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <!-- core:css -->
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <?= style_init(); ?>

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= DOMAIN ?>/assets/images/favicon.png"/>
</head>
<body class="<?= current_lang() == 'ar' ? "rtl" : null ?>">
<div class="main-wrapper">

    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                Exam<span>AI</span>
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category"><?= trans('menu.main') ?></li>
                <li class="nav-item">
                    <a href="<?= DOMAIN ?>/" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title"><?= trans('menu.dashboard') ?></span>
                    </a>
                </li>
                <li class="nav-item nav-category"><?= trans('menu.classes-management') ?></li>
                <li class="nav-item">
                    <a href="<?= DOMAIN . '/candidates/' ?>" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title"><?= trans('menu.candidates') ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DOMAIN . '/classes/' ?>" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title"><?= trans('menu.classes') ?></span>
                    </a>
                </li>
                <li class="nav-item nav-category"><?= trans('menu.courses-management') ?></li>

                <li class="nav-item">
                    <a href="<?= DOMAIN . '/courses/' ?>" class="nav-link">
                        <i class="link-icon" data-feather="bookmark"></i>
                        <span class="link-title"><?= trans('menu.courses') ?></span>
                    </a>
                </li>
                <li class="nav-item nav-category"><?= trans('menu.exams-management') ?></li>

                <li class="nav-item">
                    <a href="<?= DOMAIN . '/exams/' ?>" class="nav-link">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title"><?= trans('menu.exams') ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= DOMAIN . '/calendar/' ?>" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title"><?= trans('menu.calendar') ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="settings-sidebar">
        <div class="sidebar-body">
            <a href="#" class="settings-sidebar-toggler">
                <i data-feather="settings"></i>
            </a>
            <h6 class="text-muted">Sidebar:</h6>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                               value="sidebar-light" checked>
                        Light
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                               value="sidebar-dark">
                        Dark
                    </label>
                </div>
            </div>
        </div>
    </nav>
    <!-- partial -->

    <div class="page-wrapper">

        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
            <div class="navbar-content">
                <form class="search-form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="navbarForm"
                               placeholder="<?= trans('header.search-here') ?>">
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-<?= flag_lang() ?> mt-1" title="<?= flag_lang() ?>"></i> <span
                                    class="font-weight-medium ml-1 mr-1"><?= flag_name() ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                            <a href="<?= DOMAIN . '/lang.php?lang=en' ?>" class="dropdown-item py-2">
                                <i class="flag-icon flag-icon-us" title="us" id="us"></i>
                                <span class="ml-1"> English </span>
                            </a>
                            <a href="<?= DOMAIN . '/lang.php?lang=fr' ?>" class="dropdown-item py-2">
                                <i class="flag-icon flag-icon-fr" title="fr" id="fr"></i>
                                <span class="ml-1"> Francais </span>
                            </a>
                            <a href="<?= DOMAIN . '/lang.php?lang=ar' ?>" class="dropdown-item py-2">
                                <i class="flag-icon flag-icon-ma" title="ma" id="ma"></i>
                                <span class="ml-1"> العربية </span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown nav-notifications">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            <div class="indicator">
                                <div class="circle"></div>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <p class="mb-0 font-weight-medium">6 New Notifications</p>
                                <a href="javascript:;" class="text-muted">Clear all</a>
                            </div>
                            <div class="dropdown-body">
                                <a href="javascript:;" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="user-plus"></i>
                                    </div>
                                    <div class="content">
                                        <p>New customer registered</p>
                                        <p class="sub-text text-muted">2 sec ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="gift"></i>
                                    </div>
                                    <div class="content">
                                        <p>New Order Recieved</p>
                                        <p class="sub-text text-muted">30 min ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="alert-circle"></i>
                                    </div>
                                    <div class="content">
                                        <p>Server Limit Reached!</p>
                                        <p class="sub-text text-muted">1 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="layers"></i>
                                    </div>
                                    <div class="content">
                                        <p>Apps are ready for update</p>
                                        <p class="sub-text text-muted">5 hrs ago</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="download"></i>
                                    </div>
                                    <div class="content">
                                        <p>Download completed</p>
                                        <p class="sub-text text-muted">6 hrs ago</p>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                <a href="javascript:;">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://via.placeholder.com/30x30" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="https://via.placeholder.com/80x80" alt="">
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0"><?= auth_user()->NOM_ENSEIGNANT . auth_user()->PRENOM_ENSEIGNANT ?></p>
                                    <p class="email text-muted mb-3"><?= auth_user()->EMAIL ?></p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="../../pages/general/profile.html" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link">
                                            <i data-feather="repeat"></i>
                                            <span>Switch User</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= DOMAIN . '/logout.php' ?>" class="nav-link">
                                            <i data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->

        <div class="page-content">
            <?= content_init() ?>
        </div>

        <!-- partial:../../partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © 2020 <a href="https://www.nobleui.com"
                                                                               target="_blank">ExamAI</a>. All rights
                reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i
                        class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
        </footer>
        <!-- partial -->

    </div>
</div>

<!-- core:js -->
<script src="<?= DOMAIN ?>/assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="<?= DOMAIN ?>/assets/vendors/feather-icons/feather.min.js"></script>
<script src="<?= DOMAIN ?>/assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->

<?= script_init() ?>

<!-- end custom js for this page -->
</body>
</html>
