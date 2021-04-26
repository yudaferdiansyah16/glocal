<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>LINAS-ONE</title>
        <meta name="description" content="LINAS-ONE">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?= assets_url('css/vendors.bundle.css') ?>">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="<?= assets_url('css/app.bundle.css') ?>">
        <link id="myskin" rel="stylesheet" media="screen, print" href="<?= assets_url('css/skins/skin-master.css') ?>">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?= assets_url('img/favicon/apple-touch-icon.png') ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= assets_url('img/logo.png') ?>">
        <link rel="mask-icon" href="<?= assets_url('img/favicon/safari-pinned-tab.svg') ?>" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/themes/cust-theme-4.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/datagrid/datatables/datatables.bundle.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/notifications/sweetalert2/sweetalert2.bundle.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/formplugins/select2/select2.bundle.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/formplugins/summernote/summernote.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/formplugins/summernote/summernote-bs4.min.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/jquery-nestable/jquery.nestable.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/formplugins/bootstrap-fileinput/fileinput.min.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/notifications/toastr/toastr.css') ?>">
        <link rel="stylesheet" media="screen, print"
              href="<?= assets_url('css/miscellaneous/fullcalendar/fullcalendar.bundle.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/smartone.css') ?>">
        <link rel="stylesheet" media="screen, print" href="<?= assets_url('css/fa-duotone.css') ?>">
        <link rel="stylesheet" media="screen, printf" href="<?= assets_url('css/page-invoice.css') ?>">

        <script>var _baseurl = "<?= base_url() ?>";
        </script><?= $_notification ?><style>

            /* force select2 to match bootstrap form-control-sm */
            .select2,
            .select2-selection__rendered {
                line-height: calc(1.5em + .5rem + 3.5px) !important;
            }

            .select2-container .select2-selection--single {
                height: calc(1.5em + .5rem + 3.5px) !important;
            }

            .select2-selection__arrow {
                height: calc(1.5em + .5rem + 3.5px) !important;
            }

        </style>
    </head>
    <!-- BEGIN Body -->
    <!-- Possible Classes
    
        * 'header-function-fixed'         - header is in a fixed at all times
        * 'nav-function-fixed'            - left panel is fixed
        * 'nav-function-minify'           - skew nav to maximize space
        * 'nav-function-hidden'           - roll mouse on edge to reveal
        * 'nav-function-top'              - relocate left pane to top
        * 'mod-main-boxed'                - encapsulates to a container
        * 'nav-mobile-push'               - content pushed on menu reveal
        * 'nav-mobile-no-overlay'         - removes mesh on menu reveal
        * 'nav-mobile-slide-out'          - content overlaps menu
        * 'mod-bigger-font'               - content fonts are bigger for readability
        * 'mod-high-contrast'             - 4.5:1 text contrast ratio
        * 'mod-color-blind'               - color vision deficiency
        * 'mod-pace-custom'               - preloader will be inside content
        * 'mod-clean-page-bg'             - adds more whitespace
        * 'mod-hide-nav-icons'            - invisible navigation icons
        * 'mod-disable-animation'         - disables css based animations
        * 'mod-hide-info-card'            - hides info card from left panel
        * 'mod-lean-subheader'            - distinguished page header
        * 'mod-nav-link'                  - clear breakdown of nav links
    
        >>> more settings are described inside documentation page >>>
    -->

    <body class="mod-bg-1 mod-nav-link header-function-fixed nav-function-fixed mod-lean-subheader">
        <script>
            'use strict';
            var classHolder = document.getElementsByTagName("BODY")[0],
                    themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
                    themeURL = themeSettings.themeURL || '',
                    themeOptions = themeSettings.themeOptions || '';

        </script>

        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo w-100">
                        <a href="#" class="page-logo-link press-scale-down d-flex justify-content-center position-relative">
                            <img id="logo" src="<?= assets_url('img/logo6.png') ?>" alt="LINASONE">
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                                       tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                                   data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card" style="height: 80px">
                            <div class="info-card-text w-100 text-center" style="margin-left:0; margin-top: 10px">
                                <a href="#" class="text-white">
                                    <span class="">
                                        PT Glocal Indoasia
                                    </span>
                                </a><br>
                                <span
                                    class="d-inline-block text-truncate text-truncate-sm"><?= ucwords(strtolower($this->session->userdata('nama_priv'))) ?></span>
                            </div>
                            <img src="<?= assets_url('') ?>img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                               data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu ">
                            <li id="menu_dashboard">
                                <a href="<?= base_url('dashboard') ?>" title="Dashboard" data-filter-tags="dashboard">
                                    <i class="fad fa-home"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <?php
                            $lang_code = $this->session->userdata('lang_code');
                            $suffix = "";
                            switch ($lang_code) {
                                case "indonesia":
                                    $suffix = "id";
                                    break;
                                default:
                                    $suffix = "en";
                                    break;
                            }
                            $id_moduls = $this->session->userdata('id_moduls');
                            $clausePrivillage = "";
                            if (count($id_moduls) > 0) {
                                $clausePrivillage = " and id_modul in (" . implode(",", $id_moduls) . ")";
                            }
                            $query = $this->db->query("WITH RECURSIVE cte AS ( SELECT id_modul, nama_modul_$suffix, icon_class, url, tag, id_modul_parent, id_status, order_menu, 1 AS depth, CAST( LPAD(id_modul, 3, '0') AS CHAR ( 255 )) AS path FROM m_modul WHERE id_modul_parent = '0' UNION ALL SELECT c.id_modul, c.nama_modul_$suffix, c.icon_class, c.url, c.tag, c.id_modul_parent, c.id_status, c.order_menu, cte.depth + 1, CONCAT( cte.path, \",\", LPAD(c.id_modul, 3, '0') ) FROM m_modul c JOIN cte ON cte.id_modul = c.id_modul_parent ) SELECT * FROM cte WHERE id_status = '1' $clausePrivillage ORDER BY path");
                            $arrmodul = array();
                            $arractivepath = array();
                            foreach ($query->result() as $modul) {
                                if (!isset($arrmodul[$modul->id_modul_parent]))
                                    $arrmodul[$modul->id_modul_parent] = array();
                                array_push($arrmodul[$modul->id_modul_parent], array(
                                    'id_modul' => $modul->id_modul,
                                    'nama_modul' => $modul->{'nama_modul_' . $suffix},
                                    'url' => $modul->url,
                                    'tag' => $modul->tag,
                                    'path' => $modul->path,
                                    'icon_class' => $modul->icon_class
                                ));
                                $arrurl = explode('/', $modul->url);
                                if ($_controller == $arrurl[0] && $_method == (isset($arrurl[1]) ? $arrurl[1] : '')) {
                                    $arractivepath = explode(',', $modul->path);
                                }
                            }

                            function generateModulMenu($_controller, $_method, $arrmodul, $arractivepath, $id_modul_parent = 0) {
                                $stringMenu = "";
                                if (isset($arrmodul[$id_modul_parent])) {
                                    foreach ($arrmodul[$id_modul_parent] as $modul) {
                                        $txtClass = "";
                                        if (!isset($arrmodul[$modul['id_modul']])) {
                                            $arrurl = explode('/', $modul['url']);
                                        }
                                        if (in_array(str_pad($modul['id_modul'], 3, '0', STR_PAD_LEFT), $arractivepath)) {
                                            $txtClass = 'class="active"';
                                        }
                                        $stringMenu .= "<li id='" . $modul['id_modul'] . "' ".$txtClass.">";
                                        $stringMenu .= "<a href='" . (!isset($arrmodul[$modul['id_modul']]) ? base_url($modul['url']) : "#") . "' title='" . $modul['nama_modul'] . "' data-filter-tags='" . $modul['tag'] . "'>";
                                        $stringMenu .= (!empty($modul['icon_class']) ? "<i class='" . $modul['icon_class'] . "'></i>" : "");
                                        $stringMenu .= "<span class='nav-link-text'>" . $modul['nama_modul'] . "</span>";
                                        $stringMenu .= "</a>";
                                        if (isset($arrmodul[$modul['id_modul']])) {
                                            $stringMenu .= "<ul>";
                                            $stringMenu .= generateModulMenu($_controller, $_method, $arrmodul, $arractivepath, $modul['id_modul']);
                                            $stringMenu .= "</ul>";
                                        }
                                        $stringMenu .= "</li>";
                                    }
                                }
                                return $stringMenu;
                            }

                            echo generateModulMenu($_controller, $_method, $arrmodul, $arractivepath, 0);
                            ?>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                               data-toggle="modal" data-target="#modal-shortcut">
                                <img src="<?= assets_url('') ?>img/logo3.png" alt="SmartAdmin WebApp"
                                     aria-roledescription="logo">
                                <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                                <span
                                    class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn js-waves-off" data-action="toggle"
                               data-class="nav-function-minify" title="Minify Navigation">
                                <i class="ni ni-minify-nav"></i>
                            </a>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                               data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app user menu -->
                            <div class="hidden-md-down">
                                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                                   class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="<?= assets_url('img/demo/avatars/admin.png')?>"
                                         class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <!--foto-->
                                            <span class="mr-2">
                                                <img src="<?= assets_url('img/demo/avatars/admin.png')?>"
                                                     class="rounded-circle profile-image">
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg">
                                                    <?= $this->session->userdata('nama') ?>
                                                </div>
                                                <span class="text-truncate text-truncate-md opacity-80"><?= $this->session->userdata('email') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="<?= base_url('setting/profile') ?>">
                                        <span data-i18n="drpdwn.page-logout">Edit Profile</span>
                                    </a>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="<?= base_url('logout') ?>">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                </div>
                            </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <?php
                    if (isset($_controller) and isset($_method) and isset($_action))
                        include('page/' . $_controller . '/' . $_method . '/' . $_action . '.php');
                    if (isset($_modal)) {
                        foreach ($_modal as $r) {
                            insertModal($r);
                        }
                    }
                    ?>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">2020 © LINAS-ONE</span>
                        </div>
                    </footer>
                    <!-- END Page Footer -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <audio id="playm">
            <source src="<?= assets_url("sound/notif1.mp3") ?>" type="audio/mpeg">
        </audio>

        <audio id="errorwav">
            <source src="<?= assets_url("sound/error.wav") ?>" type="audio/mpeg">
        </audio>

        <!-- base vendor bundle:
     DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
                + pace.js (recommended)
                + jquery.js (core)
                + jquery-ui-cust.js (core)
                + popper.js (core)
                + bootstrap.js (core)
                + slimscroll.js (extension)
                + app.navigation.js (core)
                + ba-throttle-debounce.js (core)
                + waves.js (extension)
                + smartpanels.js (extension)
                + src/../jquery-snippets.js (core) -->
        
        <script src="<?= assets_url('js/vendors.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/app.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/jquery.qrcode.min.js') ?>"></script>
        <script src="<?= assets_url('js/datagrid/datatables/datatables.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/notifications/sweetalert2/sweetalert2.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/select2/select2.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/bootstrap-colorpicker/bootstrap-colorpicker.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/inputmask/inputmask.bundle.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/smartwizard/smartwizard.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/summernote/summernote.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/summernote/summernote-bs4.min.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/bootstrap-fileinput/fileinput.js') ?>"></script>
        <script src="<?= assets_url('js/dependency/moment/moment.js') ?>"></script>
        <script src="<?= assets_url('js/dependency/accounting/accounting.min.js') ?>"></script>
        <script src="<?= assets_url('js/jquery-nestable/jquery.nestable.js') ?>"></script>
        <script src="<?= assets_url('js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js') ?>"></script>
        <script src="<?= assets_url('js/notifications/toastr/toastr.js') ?>"></script>
        <script src="<?= assets_url('js/miscellaneous/fullcalendar/fullcalendar.bundle.js') ?>"></script>
        <script src="<?= assets_url('app/app.extended.js') ?>"></script>
        <script src="<?= assets_url('app/dt.extended.js') ?>"></script>
        <?php
        if (isset($_method) and isset($_action)) {
            js_url($_controller, $_method, $_action);
        }

        if (isset($_modal)) {
            foreach ($_modal as $r) {
                modal_url($r);
            }
        }
        ?>
    </body>
    <!-- END Body -->

</html>
