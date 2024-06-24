<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="dual" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>PowerEye</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('assets/vendors/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script>
        window.config.set({
            phoenixNavbarPosition: 'dual-nav',
            phoenixNavbarTopStyle: 'default'
        });
    </script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/line.css') }}">
    <link href="{{ asset('assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
    <link href="{{ asset('assets/vendors/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/leaflet.markercluster/MarkerCluster.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/leaflet.markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
</head>

<body>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">
    <nav class="navbar navbar-top fixed-top navbar-expand-lg" id="dualNav">
        <div class="w-100">
            <div class="d-flex flex-between-center dual-nav-first-layer">
                <div class="navbar-logo">
                    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="{{ url('/') }}">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center"><img src="{{ asset('assets/img/icons/logo.png') }}" alt="phoenix" width="27" />
                                <p class="logo-text ms-2 d-none d-sm-block">powereye</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="search-box navbar-top-search-box d-none d-lg-block" data-list='{"valueNames":["title"]}' style="width:25rem;">
                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input fuzzy-search rounded-pill form-control-sm" type="search" placeholder="Search..." aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                    <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none" data-bs-dismiss="search"><button class="btn btn-link p-0" aria-label="Close"></button></div>
                    <div class="dropdown-menu border start-0 py-0 overflow-hidden w-100">
                        <div class="scrollbar-overlay" style="max-height: 30rem;">
                            <div class="list pb-3">
                                <h6 class="dropdown-header text-body-highlight fs-10 py-2">24 <span class="text-body-quaternary">results</span></h6>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Recently Searched </h6>
                                <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-clock-rotate-left" data-fa-transform="shrink-2"></span> Store Macbook</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-clock-rotate-left" data-fa-transform="shrink-2"></span> MacBook Air - 13″</div>
                                        </div>
                                    </a>
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Products</h6>
                                <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="file-thumbnail me-2"><img class="h-100 w-100 fit-cover rounded-3" src="../assets/img/products/60x60/3.png" alt="" /></div>
                                        <div class="flex-1">
                                            <h6 class="mb-0 text-body-highlight title">MacBook Air - 13″</h6>
                                            <p class="fs-10 mb-0 d-flex text-body-tertiary"><span class="fw-medium text-body-tertiary text-opactity-85">8GB Memory - 1.6GHz - 128GB Storage</span></p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item py-2 d-flex align-items-center" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="file-thumbnail me-2"><img class="img-fluid" src="../assets/img/products/60x60/3.png" alt="" /></div>
                                        <div class="flex-1">
                                            <h6 class="mb-0 text-body-highlight title">MacBook Pro - 13″</h6>
                                            <p class="fs-10 mb-0 d-flex text-body-tertiary"><span class="fw-medium text-body-tertiary text-opactity-85">30 Sep at 12:30 PM</span></p>
                                        </div>
                                    </a>
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Quick Links</h6>
                                <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-link text-body" data-fa-transform="shrink-2"></span> Support MacBook House</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-link text-body" data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                        </div>
                                    </a>
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Files</h6>
                                <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-file-zipper text-body" data-fa-transform="shrink-2"></span> Library MacBook folder.rar</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-file-lines text-body" data-fa-transform="shrink-2"></span> Feature MacBook extensions.txt</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-image text-body" data-fa-transform="shrink-2"></span> MacBook Pro_13.jpg</div>
                                        </div>
                                    </a>
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Members</h6>
                                <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center" href="../pages/members.html">
                                        <div class="avatar avatar-l status-online  me-2 text-body">
                                            <img class="rounded-circle " src="../assets/img/team/40x40/10.webp" alt="" />
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-0 text-body-highlight title">Carry Anna</h6>
                                            <p class="fs-10 mb-0 d-flex text-body-tertiary">anna@technext.it</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item py-2 d-flex align-items-center" href="../pages/members.html">
                                        <div class="avatar avatar-l  me-2 text-body">
                                            <img class="rounded-circle " src="../assets/img/team/40x40/12.webp" alt="" />
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-0 text-body-highlight title">John Smith</h6>
                                            <p class="fs-10 mb-0 d-flex text-body-tertiary">smith@technext.it</p>
                                        </div>
                                    </a>
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Related Searches</h6>
                                <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"><span class="fa-brands fa-firefox-browser text-body" data-fa-transform="shrink-2"></span> Search in the Web MacBook</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                        <div class="d-flex align-items-center">
                                            <div class="fw-normal text-body-highlight title"> <span class="fa-brands fa-chrome text-body" data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="fallback fw-bold fs-7 d-none">No Result Found.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-icons flex-row">
                    <li class="nav-item">
                        <div class="theme-control-toggle fa-icon-wait px-2"><input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="moon"></span></label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="sun"></span></label></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span class="d-block" style="height:20px;width:20px;"><span data-feather="bell" style="height:20px;width:20px;"></span></span></a>
                        <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                            <div class="card position-relative border-0">
                                <div class="card-header p-2">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-body-emphasis mb-0">Notifications</h5><button class="btn btn-link p-0 fs-9 fw-normal" type="button">Mark all as read</button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="scrollbar-overlay" style="height: 27rem;">
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative read border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="../assets/img/team/40x40/30.webp" alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">10m</span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:41 AM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3">
                                                        <div class="avatar-name rounded-circle"><span>J</span></div>
                                                    </div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Jane Foster</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>📅</span>Created an event.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">20m</span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:20 AM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img class="rounded-circle avatar-placeholder" src="../assets/img/team/40x40/avatar.webp" alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👍</span>Liked your comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">1h</span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">9:30 AM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="{{ asset('assets/img/57.webp') }}" alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Kiera Anderson</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">9:11 AM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="../assets/img/team/40x40/59.webp" alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Herman Carter</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👤</span>Tagged you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:58 PM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-2 px-sm-3 py-3 notification-card position-relative read ">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="../assets/img/team/40x40/58.webp" alt="" /></div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis">Benjamin Button</h4>
                                                        <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👍</span>Liked your comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                                                        <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:18 AM </span>August 7,2021</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                                    <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0 border-top border-translucent border-0">
                                    <div class="my-2 text-center fw-bold fs-10 text-body-tertiary text-opactity-85"><a class="fw-bolder" href="../pages/notifications.html">Notification history</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdownNindeDots" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false"><svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                                <circle cx="2" cy="8" r="2" fill="currentColor"></circle>
                                <circle cx="2" cy="14" r="2" fill="currentColor"></circle>
                                <circle cx="8" cy="8" r="2" fill="currentColor"></circle>
                                <circle cx="8" cy="14" r="2" fill="currentColor"></circle>
                                <circle cx="14" cy="8" r="2" fill="currentColor"></circle>
                                <circle cx="14" cy="14" r="2" fill="currentColor"></circle>
                                <circle cx="8" cy="2" r="2" fill="currentColor"></circle>
                                <circle cx="14" cy="2" r="2" fill="currentColor"></circle>
                            </svg></a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-nine-dots shadow border" aria-labelledby="navbarDropdownNindeDots">
                            <div class="card bg-body-emphasis position-relative border-0">
                                <div class="card-body pt-3 px-3 pb-0 overflow-auto scrollbar" style="height: 20rem;">
                                    <div class="row text-center align-items-center gx-0 gy-0">
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/behance.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Behance</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/google-cloud.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Cloud</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/slack.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Slack</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/gitlab.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Gitlab</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/bitbucket.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">BitBucket</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/google-drive.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Drive</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/trello.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Trello</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/figma.webp" alt="" width="20" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Figma</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/twitter.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Twitter</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/pinterest.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Pinterest</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/ln.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Linkedin</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/google-maps.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Maps</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/google-photos.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Photos</p>
                                            </a></div>
                                        <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img src="../assets/img/nav-icons/spotify.webp" alt="" width="30" />
                                                <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Spotify</p>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-l ">
                                <img class="rounded-circle " src="{{ asset('assets/img/57.webp') }}" alt="" />
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                            <div class="card position-relative border-0">
                                <div class="card-body p-0">
                                    <div class="text-center pt-4 pb-3">
                                        <div class="avatar avatar-xl ">
                                            <img class="rounded-circle " src="{{ asset('assets/img/57.webp') }}" alt="" />
                                        </div>
                                        <h6 class="mt-2 text-body-emphasis">Jerry Seinfield</h6>
                                    </div>
                                    <div class="mb-3 mx-3"><input class="form-control form-control-sm" id="statusUpdateInput" type="text" placeholder="Update your status" /></div>
                                </div>
                                <div class="overflow-auto scrollbar" style="height: 10rem;">
                                    <ul class="nav d-flex flex-column mb-2 pb-1">
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="user"></span><span>Profile</span></a></li>
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-body" data-feather="pie-chart"></span>Dashboard</a></li>
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="lock"></span>Posts &amp; Activity</a></li>
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="settings"></span>Settings &amp; Privacy </a></li>
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="help-circle"></span>Help Center</a></li>
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="globe"></span>Language</a></li>
                                    </ul>
                                </div>
                                <div class="card-footer p-0 border-top border-translucent">
                                    <ul class="nav d-flex flex-column my-3">
                                        <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="user-plus"></span>Add another account</a></li>
                                    </ul>
                                    <hr />
                                    <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="#!"> <span class="me-2" data-feather="log-out"> </span>Sign out</a></div>
                                    <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;<a class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;<a class="text-body-quaternary ms-1" href="#!">Cookies</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse navbar-top-collapse justify-content-center" id="navbarTopCollapse">
                <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span class="uil fs-8 me-2 uil-chart-pie"></span>Home</a>
                        <ul class="dropdown-menu navbar-dropdown-caret">
                            <li><a class="dropdown-item" href="../index.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="shopping-cart"></span>E commerce</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../dashboard/project-management.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="clipboard"></span>Project management</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../dashboard/crm.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="phone"></span>CRM</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../dashboard/travel-agency.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="briefcase"></span>Travel agency</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../apps/social/feed.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="share-2"></span>Social feed</div>
                                </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span class="uil fs-8 me-2 uil-cube"></span>Apps</a>
                        <ul class="dropdown-menu navbar-dropdown-caret">
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="e-commerce" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="shopping-cart"></span>E commerce</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="admin" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Admin</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/add-product.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add product</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/products.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Products</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/customers.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Customers</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/customer-details.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Customer details</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/orders.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Orders</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/order-details.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Order details</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/admin/refund.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Refund</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="customer" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Customer</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/homepage.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Homepage</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Product details</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/products-filter.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Products filter</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/cart.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Cart</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/checkout.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Checkout</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/shipping-info.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Shipping info</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/profile.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Profile</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/favourite-stores.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Favourite stores</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/wishlist.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Wishlist</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/order-tracking.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Order tracking</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/e-commerce/landing/invoice.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Invoice</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="CRM" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="phone"></span>CRM</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/crm/analytics.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Analytics</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/deals.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Deals</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/deal-details.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Deal details</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/leads.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Leads</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/lead-details.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Lead details</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/reports.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reports</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/report-details.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Report details</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/crm/add-contact.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add contact</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="project-management" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="clipboard"></span>Project management</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/project-management/create-new.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create new</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/project-management/project-list-view.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project list view</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/project-management/project-card-view.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project card view</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/project-management/project-board-view.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project board view</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/project-management/todo-list.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Todo list</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/project-management/project-details.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Project details</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="travel-agency" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="briefcase"></span>Travel agency</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/travel-agency/landing.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Landing</div>
                                        </a></li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="hotel" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Hotel</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="admin" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Admin</span></div>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/admin/add-property.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add property</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/admin/add-room.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Add room</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/admin/room-listing.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Room listing</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/admin/room-search.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Search room</div>
                                                        </a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="customer" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Customer</span></div>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/customer/homepage.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Homepage</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/customer/hotel-details.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Hotel details</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/customer/hotel-compare.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Hotel compare</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/customer/checkout.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Checkout</div>
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="../apps/travel-agency/hotel/customer/payment.html">
                                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Payment</div>
                                                        </a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="flight" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Flight</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../apps/travel-agency/flight/homepage.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Homepage</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/travel-agency/flight/booking.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Booking</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../apps/travel-agency/flight/payment.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Payment</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item nav-link-disable" href="../coming-soon.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Trip</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="../apps/chat.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="message-square"></span>Chat</div>
                                </a></li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="email" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="mail"></span>Email</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/email/inbox.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Inbox</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/email/email-detail.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Email detail</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/email/compose.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Compose</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="events" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="bookmark"></span>Events</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/events/create-an-event.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create an event</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/events/event-detail.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Event detail</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="kanban" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="trello"></span>Kanban</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/kanban/kanban.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Kanban</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/kanban/boards.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Boards</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/kanban/create-kanban-board.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Create board</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="social" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="share-2"></span>Social</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../apps/social/profile.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Profile</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../apps/social/settings.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Settings</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="../apps/calendar.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="calendar"></span>Calendar</div>
                                </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span class="uil fs-8 me-2 uil-files-landscapes-alt"></span>Pages</a>
                        <ul class="dropdown-menu navbar-dropdown-caret">
                            <li><a class="dropdown-item" href="../pages/starter.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="compass"></span>Starter</div>
                                </a></li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="faq" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="help-circle"></span>Faq</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../pages/faq/faq-accordion.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Faq accordion</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../pages/faq/faq-tab.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Faq tab</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="landing" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="globe"></span>Landing</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../pages/landing/default.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Default</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../pages/landing/alternate.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Alternate</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="pricing" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="tag"></span>Pricing</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../pages/pricing/pricing-column.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Pricing column</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../pages/pricing/pricing-grid.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Pricing grid</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="../pages/notifications.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="bell"></span>Notifications</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../pages/members.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="users"></span>Members</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../pages/timeline.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="clock"></span>Timeline</div>
                                </a></li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="errors" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="alert-triangle"></span>Errors</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../pages/errors/404.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>404</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../pages/errors/403.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>403</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../pages/errors/500.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>500</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="authentication" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="lock"></span>Authentication</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="simple" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Simple</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/sign-in.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign in</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/sign-up.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign up</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/sign-out.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign out</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/forgot-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Forgot password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/reset-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reset password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/lock-screen.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Lock screen</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/simple/2FA.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="split" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Split</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../pages/authentication/split/sign-in.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign in</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/sign-up.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign up</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/sign-out.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign out</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/forgot-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Forgot password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/reset-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reset password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/lock-screen.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Lock screen</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/split/2FA.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="Card" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil"></span>Card</span></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../pages/authentication/card/sign-in.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign in</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/sign-up.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign up</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/sign-out.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sign out</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/forgot-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Forgot password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/reset-password.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Reset password</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/lock-screen.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Lock screen</div>
                                                </a></li>
                                            <li><a class="dropdown-item" href="../pages/authentication/card/2FA.html">
                                                    <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>2FA</div>
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-item dropdown-toggle" id="layouts" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="layout"></span>Layouts</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="vertical-sidenav.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Vertical sidenav</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="dark-mode.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dark mode</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="sidenav-collapse.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Sidenav collapse</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="darknav.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Darknav</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="topnav-slim.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Topnav slim</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="navbar-horizontal.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Navbar horizontal</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="horizontal-slim.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Horizontal slim</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="combo-nav.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo nav</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="combo-nav-slim.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo nav slim</div>
                                        </a></li>
                                    <li><a class="dropdown-item active" href="dual-nav.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dual nav</div>
                                        </a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span class="uil fs-8 me-2 uil-puzzle-piece"></span>Modules</a>
                        <ul class="dropdown-menu navbar-dropdown-caret dropdown-menu-card py-0">
                            <div class="border-0 scrollbar" style="max-height: 60vh;">
                                <div class="px-3 pt-4 pb-3 img-dropdown">
                                    <div class="row gx-4 gy-5">
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="dropdown-item-group"><span class="me-2" data-feather="file-text" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">Forms</h6>
                                            </div><a class="dropdown-link" href="../modules/forms/basic/form-control.html">Form control</a><a class="dropdown-link" href="../modules/forms/basic/input-group.html">Input group</a><a class="dropdown-link" href="../modules/forms/basic/select.html">Select</a><a class="dropdown-link" href="../modules/forms/basic/checks.html">Checks</a><a class="dropdown-link" href="../modules/forms/basic/range.html">Range</a><a class="dropdown-link" href="../modules/forms/basic/floating-labels.html">Floating labels</a><a class="dropdown-link" href="../modules/forms/basic/layout.html">Layout</a><a class="dropdown-link" href="../modules/forms/advance/advance-select.html">Advance select</a><a class="dropdown-link" href="../modules/forms/advance/date-picker.html">Date picker</a><a class="dropdown-link" href="../modules/forms/advance/editor.html">Editor</a><a class="dropdown-link" href="../modules/forms/advance/file-uploader.html">File uploader</a><a class="dropdown-link" href="../modules/forms/advance/range.html">Range</a><a class="dropdown-link" href="../modules/forms/advance/rating.html">Rating</a><a class="dropdown-link" href="../modules/forms/advance/emoji-button.html">Emoji button</a><a class="dropdown-link" href="../modules/forms/validation.html">Validation</a><a class="dropdown-link" href="../modules/forms/wizard.html">Wizard</a>
                                            <div class="dropdown-item-group mt-5"><span class="me-2" data-feather="grid" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">Icons</h6>
                                            </div><a class="dropdown-link" href="../modules/icons/feather.html">Feather</a><a class="dropdown-link" href="../modules/icons/font-awesome.html">Font awesome</a><a class="dropdown-link" href="../modules/icons/unicons.html">Unicons</a>
                                            <div class="dropdown-item-group mt-5"><span class="me-2" data-feather="bar-chart-2" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">ECharts</h6>
                                            </div><a class="dropdown-link" href="../modules/echarts/line-charts.html">Line charts</a><a class="dropdown-link" href="../modules/echarts/bar-charts.html">Bar charts</a><a class="dropdown-link" href="../modules/echarts/candlestick-charts.html">Candlestick charts</a><a class="dropdown-link" href="../modules/echarts/geo-map.html">Geo map</a><a class="dropdown-link" href="../modules/echarts/scatter-charts.html">Scatter charts</a><a class="dropdown-link" href="../modules/echarts/pie-charts.html">Pie charts</a><a class="dropdown-link" href="../modules/echarts/gauge-chart.html">Gauge chart</a><a class="dropdown-link" href="../modules/echarts/radar-charts.html">Radar charts</a><a class="dropdown-link" href="../modules/echarts/heatmap-charts.html">Heatmap charts</a><a class="dropdown-link" href="../modules/echarts/how-to-use.html">How to use</a>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="dropdown-item-group"><span class="me-2" data-feather="package" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">Components</h6>
                                            </div><a class="dropdown-link" href="../modules/components/accordion.html">Accordion</a><a class="dropdown-link" href="../modules/components/avatar.html">Avatar</a><a class="dropdown-link" href="../modules/components/alerts.html">Alerts</a><a class="dropdown-link" href="../modules/components/badge.html">Badge</a><a class="dropdown-link" href="../modules/components/breadcrumb.html">Breadcrumb</a><a class="dropdown-link" href="../modules/components/button.html">Buttons</a><a class="dropdown-link" href="../modules/components/calendar.html">Calendar</a><a class="dropdown-link" href="../modules/components/card.html">Card</a><a class="dropdown-link" href="../modules/components/carousel/bootstrap.html">Bootstrap</a><a class="dropdown-link" href="../modules/components/carousel/swiper.html">Swiper</a><a class="dropdown-link" href="../modules/components/collapse.html">Collapse</a><a class="dropdown-link" href="../modules/components/dropdown.html">Dropdown</a><a class="dropdown-link" href="../modules/components/list-group.html">List group</a><a class="dropdown-link" href="../modules/components/modal.html">Modals</a><a class="dropdown-link" href="../modules/components/navs-and-tabs/navs.html">Navs</a><a class="dropdown-link" href="../modules/components/navs-and-tabs/navbar.html">Navbar</a><a class="dropdown-link" href="../modules/components/navs-and-tabs/tabs.html">Tabs</a><a class="dropdown-link" href="../modules/components/offcanvas.html">Offcanvas</a><a class="dropdown-link" href="../modules/components/progress-bar.html">Progress bar</a><a class="dropdown-link" href="../modules/components/placeholder.html">Placeholder</a><a class="dropdown-link" href="../modules/components/pagination.html">Pagination</a><a class="dropdown-link" href="../modules/components/popovers.html">Popovers</a><a class="dropdown-link" href="../modules/components/scrollspy.html">Scrollspy</a><a class="dropdown-link" href="../modules/components/sortable.html">Sortable</a><a class="dropdown-link" href="../modules/components/spinners.html">Spinners</a><a class="dropdown-link" href="../modules/components/toast.html">Toast</a><a class="dropdown-link" href="../modules/components/tooltips.html">Tooltips</a><a class="dropdown-link" href="../modules/components/typed-text.html">Typed text</a><a class="dropdown-link" href="../modules/components/chat-widget.html">Chat widget</a>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <div class="dropdown-item-group"><span class="me-2" data-feather="columns" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">Tables</h6>
                                            </div><a class="dropdown-link" href="../modules/tables/basic-tables.html">Basic tables</a><a class="dropdown-link" href="../modules/tables/advance-tables.html">Advance tables</a><a class="dropdown-link" href="../modules/tables/bulk-select.html">Bulk Select</a>
                                            <div class="dropdown-item-group mt-5"><span class="me-2" data-feather="tool" style="stroke-width:2;"></span>
                                                <h6 class="dropdown-item-title">Utilities</h6>
                                            </div><a class="dropdown-link" href="../modules/utilities/background.html">Background</a><a class="dropdown-link" href="../modules/utilities/borders.html">Borders</a><a class="dropdown-link" href="../modules/utilities/colors.html">Colors</a><a class="dropdown-link" href="../modules/utilities/display.html">Display</a><a class="dropdown-link" href="../modules/utilities/flex.html">Flex</a><a class="dropdown-link" href="../modules/utilities/stacks.html">Stacks</a><a class="dropdown-link" href="../modules/utilities/float.html">Float</a><a class="dropdown-link" href="../modules/utilities/grid.html">Grid</a><a class="dropdown-link" href="../modules/utilities/interactions.html">Interactions</a><a class="dropdown-link" href="../modules/utilities/opacity.html">Opacity</a><a class="dropdown-link" href="../modules/utilities/overflow.html">Overflow</a><a class="dropdown-link" href="../modules/utilities/position.html">Position</a><a class="dropdown-link" href="../modules/utilities/shadows.html">Shadows</a><a class="dropdown-link" href="../modules/utilities/sizing.html">Sizing</a><a class="dropdown-link" href="../modules/utilities/spacing.html">Spacing</a><a class="dropdown-link" href="../modules/utilities/typography.html">Typography</a><a class="dropdown-link" href="../modules/utilities/vertical-align.html">Vertical align</a><a class="dropdown-link" href="../modules/utilities/visibility.html">Visibility</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span class="uil fs-8 me-2 uil-document-layout-right"></span>Documentation</a>
                        <ul class="dropdown-menu navbar-dropdown-caret">
                            <li><a class="dropdown-item" href="../documentation/getting-started.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="life-buoy"></span>Getting started</div>
                                </a></li>
                            <li class="dropdown dropdown-inside"><a class="dropdown-item dropdown-toggle" id="customization" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="settings"></span>Customization</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../documentation/customization/configuration.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Configuration</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/customization/styling.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Styling</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/customization/color.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Color</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/customization/dark-mode.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dark mode</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/customization/plugin.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Plugin</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-inside"><a class="dropdown-item dropdown-toggle" id="layouts-doc" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <div class="dropdown-item-wrapper"><span class="uil fs-8 uil-angle-right lh-1 dropdown-indicator-icon"></span><span><span class="me-2 uil" data-feather="table"></span>Layouts doc</span></div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../documentation/layouts/vertical-navbar.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Vertical navbar</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/layouts/horizontal-navbar.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Horizontal navbar</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/layouts/combo-navbar.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Combo navbar</div>
                                        </a></li>
                                    <li><a class="dropdown-item" href="../documentation/layouts/dual-nav.html">
                                            <div class="dropdown-item-wrapper"><span class="me-2 uil"></span>Dual nav</div>
                                        </a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="../documentation/gulp.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 fa-brands fa-gulp ms-1 me-1 fa-lg"></span>Gulp</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../documentation/design-file.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="figma"></span>Design file</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../changelog.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="git-merge"></span>Changelog</div>
                                </a></li>
                            <li><a class="dropdown-item" href="../showcase.html">
                                    <div class="dropdown-item-wrapper"><span class="me-2 uil" data-feather="monitor"></span>Showcase</div>
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        var navbarTopShape = window.config.config.phoenixNavbarTopShape;
        var navbarPosition = window.config.config.phoenixNavbarPosition;
        var body = document.querySelector('body');
        var navbarDefault = document.querySelector('#navbarDefault');
        var navbarTop = document.querySelector('#navbarTop');
        var topNavSlim = document.querySelector('#topNavSlim');
        var navbarTopSlim = document.querySelector('#navbarTopSlim');
        var navbarCombo = document.querySelector('#navbarCombo');
        var navbarComboSlim = document.querySelector('#navbarComboSlim');
        var dualNav = document.querySelector('#dualNav');

        var documentElement = document.documentElement;
        var navbarVertical = document.querySelector('.navbar-vertical');

        if (navbarPosition === 'dual-nav') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            navbarDefault?.remove();
            navbarVertical?.remove();
            dualNav.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'dual');

        } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
            navbarDefault?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            topNavSlim.style.display = 'block';
            navbarVertical.style.display = 'inline-block';
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');

        } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            navbarVertical?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTopSlim.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
        } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
            navbarDefault?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarTopSlim?.remove();
            dualNav?.remove();
            navbarComboSlim.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
        } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            topNavSlim?.remove();
            navbarVertical?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTop.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'horizontal');
        } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarDefault?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarCombo.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'combo');
        } else {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarDefault.removeAttribute('style');
            navbarVertical.removeAttribute('style');
        }

        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
        }
    </script>
    <div class="content">
        <div class="pb-5">
            <div class="row g-4">
                <div class="col-12 col-xxl-6">
                    <div class="mb-8">
                        <h2 class="mb-2">Ecommerce Dashboard</h2>
                        <h5 class="text-body-tertiary fw-semibold">Here’s what’s going on at your business right now</h5>
                    </div>
                    <div class="row align-items-center g-4">
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-success-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-success" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-star text-success " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">57 new orders</h4>
                                    <p class="text-body-secondary fs-9 mb-0">Awating processing</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-warning-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-warning" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-pause text-warning " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">5 orders</h4>
                                    <p class="text-body-secondary fs-9 mb-0">On hold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-danger-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-danger" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-xmark text-danger " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                                <div class="ms-3">
                                    <h4 class="mb-0">15 products</h4>
                                    <p class="text-body-secondary fs-9 mb-0">Out of stock</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-body-secondary mb-6 mt-4" />
                    <div class="row flex-between-center mb-4 g-3">
                        <div class="col-auto">
                            <h3>Total sells</h3>
                            <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                        </div>
                        <div class="col-8 col-sm-4"><select class="form-select form-select-sm" id="select-gross-revenue-month">
                                <option>Mar 1 - 31, 2022</option>
                                <option>April 1 - 30, 2022</option>
                                <option>May 1 - 31, 2022</option>
                            </select></div>
                    </div>
                    <div class="echart-total-sales-chart" style="min-height:320px;width:100%"></div>
                </div>
                <div class="col-12 col-xxl-6">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-1">Total orders<span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"><span class="badge-label">-6.8%</span></span></h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                        <h4>16,247</h4>
                                    </div>
                                    <div class="d-flex justify-content-center px-4 py-6">
                                        <div class="echart-total-orders" style="height:85px;width:115px"></div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet-item bg-primary me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                            <h6 class="text-body fw-semibold mb-0">52%</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bullet-item bg-primary-subtle me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                            <h6 class="text-body fw-semibold mb-0">48%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-1">New customers<span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"> <span class="badge-label">+26.5%</span></span></h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                        <h4>356</h4>
                                    </div>
                                    <div class="pb-0 pt-4">
                                        <div class="echarts-new-customers" style="height:180px;width:100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-2">Top coupons</h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                    </div>
                                    <div class="pb-4 pt-3">
                                        <div class="echart-top-coupons" style="height:115px;width:100%;"></div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet-item bg-primary me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Percentage discount</h6>
                                            <h6 class="text-body fw-semibold mb-0">72%</h6>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet-item bg-primary-lighter me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Fixed card discount</h6>
                                            <h6 class="text-body fw-semibold mb-0">18%</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bullet-item bg-info-dark me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Fixed product discount</h6>
                                            <h6 class="text-body fw-semibold mb-0">10%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-2">Paying vs non paying</h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center pt-3 flex-1">
                                        <div class="echarts-paying-customer-chart" style="height:100%;width:100%;"></div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet-item bg-primary me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Paying customer</h6>
                                            <h6 class="text-body fw-semibold mb-0">30%</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bullet-item bg-primary-subtle me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Non-paying customer</h6>
                                            <h6 class="text-body fw-semibold mb-0">70%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 border-y">
            <div data-list='{"valueNames":["product","customer","rating","review","time"],"page":6}'>
                <div class="row align-items-end justify-content-between pb-5 g-3">
                    <div class="col-auto">
                        <h3>Latest reviews</h3>
                        <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="row g-2 gy-3">
                            <div class="col-auto flex-1">
                                <div class="search-box">
                                    <form class="position-relative"><input class="form-control search-input search form-control-sm" type="search" placeholder="Search" aria-label="Search" />
                                        <span class="fas fa-search search-box-icon"></span>
                                    </form>
                                </div>
                            </div>
                            <div class="col-auto"><button class="btn btn-sm btn-phoenix-secondary bg-body-emphasis bg-body-hover me-2" type="button">All products</button><button class="btn btn-sm btn-phoenix-secondary bg-body-emphasis bg-body-hover action-btn" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h" data-fa-transform="shrink-2"></span></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mx-n1 px-1 scrollbar">
                    <table class="table fs-9 mb-0 border-top border-translucent">
                        <thead>
                        <tr>
                            <th class="white-space-nowrap fs-9 ps-0 align-middle">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-reviews-select" type="checkbox" data-bulk-select='{"body":"table-latest-review-body"}' /></div>
                            </th>
                            <th class="sort white-space-nowrap align-middle" scope="col"></th>
                            <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:360px;" data-sort="product">PRODUCT</th>
                            <th class="sort align-middle" scope="col" data-sort="customer" style="min-width:200px;">CUSTOMER</th>
                            <th class="sort align-middle" scope="col" data-sort="rating" style="min-width:110px;">RATING</th>
                            <th class="sort align-middle" scope="col" style="max-width:350px;" data-sort="review">REVIEW</th>
                            <th class="sort text-start ps-5 align-middle" scope="col" data-sort="status">STATUS</th>
                            <th class="sort text-end align-middle" scope="col" data-sort="time">TIME</th>
                            <th class="sort text-end pe-0 align-middle" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list" id="table-latest-review-body">
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management & Skin Temperature Trends, Carbon/Graphite, One Size (S & L Bands)","productImage":"/products/60x60/1.png","customer":{"name":"Richard Dawkins","avatar":""},"rating":5,"review":"This Fitbit is fantastic! I was trying to be in better shape and needed some motivation, so I decided to treat myself to a new Fitbit.","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Just now"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/1.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Fitbit Sense Advanced Smartwatch with Tools fo...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l">
                                        <div class="avatar-name rounded-circle"><span>R</span></div>
                                    </div>
                                    <h6 class="mb-0 ms-3 text-body">Richard Dawkins</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">This Fitbit is fantastic! I was trying to be in better shape and needed some motivation, so I decided to treat myself to a new Fitbit.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Just now</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"iPhone 13 pro max-Pacific Blue-128GB storage","productImage":"/products/60x60/2.png","customer":{"name":"Ashley Garrett","avatar":"/team/40x40/59.webp"},"rating":3,"review":"The order was delivered ahead of schedule. To give us additional time, you should leave the packaging sealed with plastic.","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Just now"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/2.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">iPhone 13 pro max-Pacific Blue-128GB storage</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/59.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Ashley Garrett</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">The order was delivered ahead of schedule. To give us additional time, you should leave the packaging sealed with plastic.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Just now</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Apple MacBook Pro 13 inch-M1-8/256GB-space","productImage":"/products/60x60/3.png","customer":{"name":"Woodrow Burton","avatar":"/team/40x40/58.webp"},"rating":4.5,"review":"It&#39;s a Mac, after all. Once you&#39;ve gone Mac, there&#39;s no going back. My first Mac lasted over nine years, and this is my second.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Just now"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/3.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Apple MacBook Pro 13 inch-M1-8/256GB-space</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/58.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Woodrow Burton</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">It's a Mac, after all. Once you've gone Mac, there's no going back. My first Mac lasted over nine years, and this is my second.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Just now</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Apple iMac 24\" 4K Retina Display M1 8 Core CPU, 7 Core GPU, 256GB SSD, Green (MJV83ZP/A) 2021","productImage":"/products/60x60/4.png","customer":{"name":"Eric McGee","avatar":"/team/40x40/avatar.webp","avatarPlaceholder":true},"rating":3,"review":"Personally, I like the minimalist style, but I wouldn&#39;t choose it if I were searching for a computer that I would use frequently. It&#39;s not horrible in terms of speed and power, but the","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 09, 3:23 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/4.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Apple iMac 24&quot; 4K Retina Display M1 8 Core CPU...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle avatar-placeholder" src="../assets/img/team/40x40/avatar.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Eric McGee</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">Personally, I like the minimalist style, but I wouldn't choose it if I were searching for a computer that I would use frequently. It's...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 09, 3:23 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Razer Kraken v3 x Wired 7.1 Surroung Sound Gaming headset","productImage":"/products/60x60/5.png","customer":{"name":"Kim Carroll","avatar":"/team/40x40/avatar.webp","avatarPlaceholder":true},"rating":4,"review":"It performs exactly as expected. There are three of these in the family.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 09, 2:15 PM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/5.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Razer Kraken v3 x Wired 7.1 Surroung Sound Gam...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle avatar-placeholder" src="../assets/img/team/40x40/avatar.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Kim Carroll</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">It performs exactly as expected. There are three of these in the family.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 09, 2:15 PM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"PlayStation 5 DualSense Wireless Controller","productImage":"/products/60x60/6.png","customer":{"name":"Barbara Lucas","avatar":"/team/40x40/57.webp"},"rating":4,"review":"The controller is quite comfy for me. Despite its increased size, the controller still fits well in my hands.","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Nov 08, 8:53 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/6.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">PlayStation 5 DualSense Wireless Controller</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="{{ asset('assets/img/team/40x40/57.webp') }}" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Barbara Lucas</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">The controller is quite comfy for me. Despite its increased size, the controller still fits well in my hands.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 08, 8:53 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"2021 Apple 12.9-inch iPad Pro (Wi‑Fi, 128GB) - Space Gray","productImage":"/products/60x60/7.png","customer":{"name":"Ansolo Lazinatov","avatar":"/team/40x40/3.webp"},"rating":4.5,"review":"The response time and service I received when contacted the designers were Phenomenal!","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 07, 9:00 PM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/7.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">2021 Apple 12.9-inch iPad Pro (Wi‑Fi, 128GB) -...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/3.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Ansolo Lazinatov</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">The response time and service I received when contacted the designers were Phenomenal!</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 07, 9:00 PM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Amazon Basics Matte Black Wired Keyboard - US Layout (QWERTY)","productImage":"/products/60x60/8.png","customer":{"name":"Emma watson","avatar":"/team/40x40/26.webp"},"rating":3,"review":"I have started using this theme in the last week and it has really impressed me very much, the support is second to none.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 07, 11:20 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/8.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Amazon Basics Matte Black Wired Keyboard - US ...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/26.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Emma watson</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">I have started using this theme in the last week and it has really impressed me very much, the support is second to none.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 07, 11:20 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Amazon Basics Mesh, Mid-Back, Swivel Office Desk Chair with Armrests, Black","productImage":"/products/60x60/9.png","customer":{"name":"Rowen Atkinson","avatar":"/team/40x40/29.webp"},"rating":5,"review":"The best experience we could hope for. Customer service team is amazing and the quality of their products is unsurpassed. Great theme too!","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Nov 07, 2:00 PM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/9.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Amazon Basics Mesh, Mid-Back, Swivel Office De...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/29.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Rowen Atkinson</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">The best experience we could hope for. Customer service team is amazing and the quality of their products is unsurpassed. Great theme ...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 07, 2:00 PM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Apple Magic Mouse (Wireless, Rechargable) - Silver","productImage":"/products/60x60/10.png","customer":{"name":"Anthony Hopkins","avatar":""},"rating":4,"review":"This template has allowed me to convert my existing web app into a great looking, easy to use UI in less than 2 weeks. Very easy to use and understand and has a wide range of ready to use elements. ","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Nov 06, 8:00 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/10.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Apple Magic Mouse (Wireless, Rechargable) - Si...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l">
                                        <div class="avatar-name rounded-circle"><span>A</span></div>
                                    </div>
                                    <h6 class="mb-0 ms-3 text-body">Anthony Hopkins</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">This template has allowed me to convert my existing web app into a great looking, easy to use UI in less than 2 weeks. Very easy to us...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 06, 8:00 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Echo Dot (4th Gen) _ Smart speaker with Alexa _ Glacier White","productImage":"/products/60x60/11.png","customer":{"name":"Jennifer Schramm","avatar":"/team/40x40/8.webp"},"rating":4.5,"review":"The theme is really beautiful and the support answer very quickly and is friendly. Buy it, you will not regret it.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 05, 4:00 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/11.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Echo Dot (4th Gen) _ Smart speaker with Alexa ...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/8.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Jennifer Schramm</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">The theme is really beautiful and the support answer very quickly and is friendly. Buy it, you will not regret it.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 05, 4:00 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"HORI Racing Wheel Apex for PlayStation 4_3, and PC","productImage":"/products/60x60/12.png","customer":{"name":"Raymond Mims","avatar":"/team/40x40/avatar.webp","avatarPlaceholder":true},"rating":4,"review":"As others mentioned, the team behind this theme is super responsive. I sent a message during the weekend, fully expecting a response after the weekend, but I got one within minutes, and I was unblocked.","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Nov 04, 6:53 PM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/12.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">HORI Racing Wheel Apex for PlayStation 4_3, an...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle avatar-placeholder" src="../assets/img/team/40x40/avatar.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Raymond Mims</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">As others mentioned, the team behind this theme is super responsive. I sent a message during the weekend, fully expecting a response a...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 04, 6:53 PM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Nintendo Switch with Neon Blue and Neon Red Joy‑Con - HAC-001(-01)","productImage":"/products/60x60/13.png","customer":{"name":"Michael Jenkins","avatar":"/team/40x40/9.webp"},"rating":5,"review":"I had a bit of a hard time at first but after I contacted the team they were able to help me set up the theme. It&#39;s really good and I highly recommend it to everyone.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 04, 12:00 PM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/13.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Nintendo Switch with Neon Blue and Neon Red Jo...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/9.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Michael Jenkins</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">I had a bit of a hard time at first but after I contacted the team they were able to help me set up the theme. It's really good and I ...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 04, 12:00 PM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Oculus Rift S PC-Powered VR Gaming Headset","productImage":"/products/60x60/14.png","customer":{"name":"Kristine Cadena","avatar":"/team/40x40/avatar.webp","avatarPlaceholder":true},"rating":5,"review":"Excellent. All my doubts were answered by the team quickly. I highly recommend it.","status":{"title":"Pending","badge":"warning","icon":"clock"},"time":"Nov 03, 8:53 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/14.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Oculus Rift S PC-Powered VR Gaming Headset</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle avatar-placeholder" src="../assets/img/team/40x40/avatar.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Kristine Cadena</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">Excellent. All my doubts were answered by the team quickly. I highly recommend it.</p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 03, 8:53 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle ps-0">
                                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Sony X85J 75 Inch Sony 4K Ultra HD LED Smart Google TV","productImage":"/products/60x60/15.png","customer":{"name":"Suzanne Martinez","avatar":"/team/40x40/24.webp"},"rating":3.5,"review":"This theme is great. Clean and easy to understand. Perfect for those who don&#39;t have time to start everything from scratch. The support is simply phenomenal! Highly recommended!","status":{"title":"Approved","badge":"success","icon":"check"},"time":"Nov 03, 10:43 AM"}' /></div>
                            </td>
                            <td class="align-middle product white-space-nowrap py-0"><a class="d-block rounded-2 border border-translucent" href="../apps/e-commerce/landing/product-details.html"><img src="../assets/img/products/60x60/15.png" alt="" width="53" /></a></td>
                            <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../apps/e-commerce/landing/product-details.html">Sony X85J 75 Inch Sony 4K Ultra HD LED Smart G...</a></td>
                            <td class="align-middle customer white-space-nowrap"><a class="d-flex align-items-center text-body" href="../apps/e-commerce/landing/profile.html">
                                    <div class="avatar avatar-l"><img class="rounded-circle" src="../assets/img/team/40x40/24.webp" alt="" /></div>
                                    <h6 class="mb-0 ms-3 text-body">Suzanne Martinez</h6>
                                </a></td>
                            <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span></td>
                            <td class="align-middle review" style="min-width:350px;">
                                <p class="fs-9 fw-semibold text-body-highlight mb-0">This theme is great. Clean and easy to understand. Perfect for those who don't have time to start everything from scratch. The support...<a href='#!'>See more</a></p>
                            </td>
                            <td class="align-middle text-start ps-5 status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Approved</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                            <td class="align-middle text-end time white-space-nowrap">
                                <div class="hover-hide">
                                    <h6 class="text-body-highlight mb-0">Nov 03, 10:43 AM</h6>
                                </div>
                            </td>
                            <td class="align-middle white-space-nowrap text-end pe-0">
                                <div class="position-relative">
                                    <div class="hover-actions"><button class="btn btn-sm btn-phoenix-secondary me-1 fs-10"><span class="fas fa-check"></span></button><button class="btn btn-sm btn-phoenix-secondary fs-10"><span class="fas fa-trash"></span></button></div>
                                </div>
                                <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row align-items-center py-1">
                    <div class="pagination d-none"></div>
                    <div class="col d-flex fs-9">
                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less</a>
                    </div>
                    <div class="col-auto d-flex">
                        <button class="btn btn-link px-1 me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left me-2"></span>Previous</button><button class="btn btn-link px-1 ms-1" type="button" title="Next" data-list-pagination="next">Next<span class="fas fa-chevron-right ms-2"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gx-6">
            <div class="col-12 col-xl-6">
                <div data-list='{"valueNames":["country","users","transactions","revenue","conv-rate"],"page":5}'>
                    <div class="mb-5 mt-7">
                        <h3>Top regions by revenue</h3>
                        <p class="text-body-tertiary">Where you generated most of the revenue</p>
                    </div>
                    <div class="table-responsive scrollbar">
                        <table class="table fs-10 mb-0">
                            <thead>
                            <tr>
                                <th class="sort border-top border-translucent ps-0 align-middle" scope="col" data-sort="country" style="width:32%">COUNTRY</th>
                                <th class="sort border-top border-translucent align-middle" scope="col" data-sort="users" style="width:17%">USERS</th>
                                <th class="sort border-top border-translucent text-end align-middle" scope="col" data-sort="transactions" style="width:16%">TRANSACTIONS</th>
                                <th class="sort border-top border-translucent text-end align-middle" scope="col" data-sort="revenue" style="width:20%">REVENUE</th>
                                <th class="sort border-top border-translucent text-end pe-0 align-middle" scope="col" data-sort="conv-rate" style="width:17%">CONV. RATE</th>
                            </tr>
                            </thead>
                            <tr>
                                <td></td>
                                <td class="align-middle py-4">
                                    <h4 class="mb-0 fw-normal">377,620</h4>
                                </td>
                                <td class="align-middle text-end py-4">
                                    <h4 class="mb-0 fw-normal">236</h4>
                                </td>
                                <td class="align-middle text-end py-4">
                                    <h4 class="mb-0 fw-normal">$15,758</h4>
                                </td>
                                <td class="align-middle text-end py-4 pe-0">
                                    <h4 class="mb-0 fw-normal">10.32%</h4>
                                </td>
                            </tr>
                            <tbody class="list" id="table-regions-by-revenue">
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">1. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/india.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">India</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">92896<span class="text-body-tertiary fw-semibold ms-2">(41.6%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">67<span class="text-body-tertiary fw-semibold ms-2">(34.3%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$7560<span class="text-body-tertiary fw-semibold ms-2">(36.9%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>14.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">2. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/china.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">China</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">50496<span class="text-body-tertiary fw-semibold ms-2">(32.8%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">54<span class="text-body-tertiary fw-semibold ms-2">(23.8%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$6532<span class="text-body-tertiary fw-semibold ms-2">(26.5%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>23.56%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">3. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/usa.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">USA</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">45679<span class="text-body-tertiary fw-semibold ms-2">(24.3%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">35<span class="text-body-tertiary fw-semibold ms-2">(19.7%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$5432<span class="text-body-tertiary fw-semibold ms-2">(16.9%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>10.23%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">4. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/south-korea.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">South Korea</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">36453<span class="text-body-tertiary fw-semibold ms-2">(19.7%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">22<span class="text-body-tertiary fw-semibold ms-2">(9.54%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$4673<span class="text-body-tertiary fw-semibold ms-2">(11.6%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>8.85%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">5. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/vietnam.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Vietnam</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">15007<span class="text-body-tertiary fw-semibold ms-2">(11.9%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">17<span class="text-body-tertiary fw-semibold ms-2">(6.91%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2456<span class="text-body-tertiary fw-semibold ms-2">(10.2%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>6.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">6. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/russia.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Russia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">54215<span class="text-body-tertiary fw-semibold ms-2">(32.9%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">38<span class="text-body-tertiary fw-semibold ms-2">(7.91%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$3254<span class="text-body-tertiary fw-semibold ms-2">(12.4%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>6.21%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">7. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/australia.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Australia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">54789<span class="text-body-tertiary fw-semibold ms-2">(12.7%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">32<span class="text-body-tertiary fw-semibold ms-2">(14.0%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$3215<span class="text-body-tertiary fw-semibold ms-2">(5.72%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>12.02%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">8. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/england.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">England</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">14785<span class="text-body-tertiary fw-semibold ms-2">(12.9%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">11<span class="text-body-tertiary fw-semibold ms-2">(32.91%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$4745<span class="text-body-tertiary fw-semibold ms-2">(10.2%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>8.01%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">9. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/indonesia.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Indonesia</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">32156<span class="text-body-tertiary fw-semibold ms-2">(32.2%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">89<span class="text-body-tertiary fw-semibold ms-2">(12.0%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2456<span class="text-body-tertiary fw-semibold ms-2">(23.2%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>9.07%</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="white-space-nowrap ps-0 country" style="width:32%">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-3">10. </h6><a href="#!">
                                            <div class="d-flex align-items-center"><img src="../assets/img/country/japan.png" alt="" width="24" />
                                                <p class="mb-0 ps-3 text-primary fw-bold fs-9">Japan</p>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle users" style="width:17%">
                                    <h6 class="mb-0">12547<span class="text-body-tertiary fw-semibold ms-2">(12.7%)</span></h6>
                                </td>
                                <td class="align-middle text-end transactions" style="width:17%">
                                    <h6 class="mb-0">21<span class="text-body-tertiary fw-semibold ms-2">(14.91%)</span></h6>
                                </td>
                                <td class="align-middle text-end revenue" style="width:17%">
                                    <h6 class="mb-0">$2541<span class="text-body-tertiary fw-semibold ms-2">(23.2%)</span></h6>
                                </td>
                                <td class="align-middle text-end pe-0 conv-rate" style="width:17%">
                                    <h6>20.01%</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center py-1">
                        <div class="pagination d-none"></div>
                        <div class="col d-flex fs-9">
                            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                        </div>
                        <div class="col-auto d-flex">
                            <button class="btn btn-link px-1 me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left me-2"></span>Previous</button><button class="btn btn-link px-1 ms-1" type="button" title="Next" data-list-pagination="next">Next<span class="fas fa-chevron-right ms-2"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="mx-n4 mx-lg-n6 ms-xl-0 h-100">
                    <div class="h-100 w-100">
                        <div class="h-100 bg-body-emphasis" id="map" style="min-height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-9 border-top">
            <div class="row g-6">
                <div class="col-12 col-xl-6">
                    <div class="me-xl-4">
                        <div>
                            <h3>Projection vs actual</h3>
                            <p class="mb-1 text-body-tertiary">Actual earnings vs projected earnings</p>
                        </div>
                        <div class="echart-projection-actual" style="height:300px; width:100%"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div>
                        <h3>Returning customer rate</h3>
                        <p class="mb-1 text-body-tertiary">Rate of customers returning to your shop over time</p>
                    </div>
                    <div class="echart-returning-customer" style="height:300px;"></div>
                </div>
            </div>
        </div>
        <footer class="footer position-absolute">
            <div class="row g-0 justify-content-between align-items-center h-100">
                <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 mt-2 mt-sm-0 text-body">Online IoT based power management system<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2024 &copy;<a class="mx-1" href="#">PowerEye</a></p>
                </div>
                <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 text-body-tertiary text-opacity-85">Version 1.1.0</p>
                </div>
            </div>
        </footer>
    </div>
    <div class="modal fade" id="searchBoxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true" data-phoenix-modal="data-phoenix-modal" style="--phoenix-backdrop-opacity: 1;">
        <div class="modal-dialog">
            <div class="modal-content mt-15 rounded-pill">
                <div class="modal-body p-0">
                    <div class="search-box navbar-top-search-box" data-list='{"valueNames":["title"]}' style="width: auto;">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input fuzzy-search rounded-pill form-control-lg" type="search" placeholder="Search..." aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                        <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none" data-bs-dismiss="search"><button class="btn btn-link p-0" aria-label="Close"></button></div>
                        <div class="dropdown-menu border start-0 py-0 overflow-hidden w-100">
                            <div class="scrollbar-overlay" style="max-height: 30rem;">
                                <div class="list pb-3">
                                    <h6 class="dropdown-header text-body-highlight fs-10 py-2">24 <span class="text-body-quaternary">results</span></h6>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Recently Searched </h6>
                                    <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-clock-rotate-left" data-fa-transform="shrink-2"></span> Store Macbook</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-clock-rotate-left" data-fa-transform="shrink-2"></span> MacBook Air - 13″</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Products</h6>
                                    <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="file-thumbnail me-2"><img class="h-100 w-100 fit-cover rounded-3" src="../assets/img/products/60x60/3.png" alt="" /></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">MacBook Air - 13″</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary"><span class="fw-medium text-body-tertiary text-opactity-85">8GB Memory - 1.6GHz - 128GB Storage</span></p>
                                            </div>
                                        </a>
                                        <a class="dropdown-item py-2 d-flex align-items-center" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="file-thumbnail me-2"><img class="img-fluid" src="../assets/img/products/60x60/3.png" alt="" /></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">MacBook Pro - 13″</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary"><span class="fw-medium text-body-tertiary text-opactity-85">30 Sep at 12:30 PM</span></p>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Quick Links</h6>
                                    <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-link text-body" data-fa-transform="shrink-2"></span> Support MacBook House</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-link text-body" data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Files</h6>
                                    <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span class="fa-solid fa-file-zipper text-body" data-fa-transform="shrink-2"></span> Library MacBook folder.rar</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-file-lines text-body" data-fa-transform="shrink-2"></span> Feature MacBook extensions.txt</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span class="fa-solid fa-image text-body" data-fa-transform="shrink-2"></span> MacBook Pro_13.jpg</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Members</h6>
                                    <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center" href="../pages/members.html">
                                            <div class="avatar avatar-l status-online  me-2 text-body">
                                                <img class="rounded-circle " src="../assets/img/team/40x40/10.webp" alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">Carry Anna</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary">anna@technext.it</p>
                                            </div>
                                        </a>
                                        <a class="dropdown-item py-2 d-flex align-items-center" href="../pages/members.html">
                                            <div class="avatar avatar-l  me-2 text-body">
                                                <img class="rounded-circle " src="../assets/img/team/40x40/12.webp" alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">John Smith</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary">smith@technext.it</p>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-bottom border-translucent py-2 lh-sm">Related Searches</h6>
                                    <div class="py-2"><a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span class="fa-brands fa-firefox-browser text-body" data-fa-transform="shrink-2"></span> Search in the Web MacBook</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span class="fa-brands fa-chrome text-body" data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="fallback fw-bold fs-7 d-none">No Result Found.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{ asset('assets/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('assets/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('assets/vendors/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/polyfill.min58be.js') }}?features=window.scroll"></script>
<script src="{{ asset('assets/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset('assets/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('assets/vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('assets/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}"></script>
<script src="{{ asset('assets/js/phoenix.js') }}"></script>
<script src="{{ asset('assets/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/js/ecommerce-dashboard.js') }}"></script>

</body>
</html>
