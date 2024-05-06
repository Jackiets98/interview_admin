<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Logistics System Admin Portal</title>
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="AV4fnA5fIGAwEMNyLiTwa2fUW3vpFVaLsrpPCVTq">
    <!-- Canonical SEO -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/images/logo.png')}}"/>


        <!-- Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
      (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
    </script>
    <!-- End Google Tag Manager -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">


  <!-- Page Styles -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/materialdesignicons-id=6dcb6840ed1b54e81c4279112d07827e.css')}}"/>
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/flag-icons-id=121bcc3078c6c2f608037fb9ca8bce8d.css')}}"/>

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/core-id=84e90b89d4346ba5b549f814933f56c1.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/theme-default-id=a5b74f63f911baabfa8b02a06ecfc64c.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('/assets/css/demo-id=b0748c2ad4338911d21615a7692027bd.css')}}" />


  <!-- Vendor Styles -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/node-waves/node-waves-id=aa72fb97dfa8e932ba88c8a3c04641bc.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar-id=e712540dc55d810eb04058a2c7adde74.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/typeahead-js/typeahead-id=9edd1831c1d7cdbc4ff9cca42bf26999.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/swiper/swiper.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead-id=9edd1831c1d7cdbc4ff9cca42bf26999.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />


  <!-- Page Styles -->
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/pages/cards-statistics.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/pages/cards-analytics.css')}}">

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
    <!-- laravel style -->
  <script src="{{asset('/assets/vendor/js/helpers.js')}}"></script>
  <!-- beautify ignore:start -->
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset('/assets/vendor/js/template-customizer.js')}}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/assets/js/config.js')}}"></script>

    <script>
      window.templateCustomizer = new TemplateCustomizer({
        cssPath: '',
        themesPath: '',
        defaultStyle: "light",
        defaultShowDropdownOnHover: "true", // true/false (for horizontal layout only)
        displayCustomizer: "true",
        lang: 'en',
        pathResolver: function(path) {
          var resolvedPaths = {
            // Core stylesheets
                        'core.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/core.css?id=84e90b89d4346ba5b549f814933f56c1',
            // Themes
                        'theme-default.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default.css?id=a5b74f63f911baabfa8b02a06ecfc64c',
                    }
          return resolvedPaths[path] || path;
        },
        'controls': ["rtl","style","headerType","contentLayout","layoutCollapsed","layoutNavbarOptions","themes"],
      });
    </script>
  </head>

  <style>
    .offcanvas, .offcanvas-lg, .offcanvas-md, .offcanvas-sm, .offcanvas-xl, .offcanvas-xxl{
      --bs-offcanvas-width: 50% !important;
    }

            /* Custom styling for the card title */
            .card-title {
            font-size: 1.25rem; /* Adjust font size as needed */
            font-weight: bold; /* Make the text bold */
            color: #333; /* Set text color to dark gray */
            margin-bottom: 10px; /* Add a small margin at the bottom */
            text-align: center; /* Center align the text */
            text-transform: uppercase; /* Convert text to uppercase */
            letter-spacing: 1px; /* Add some letter spacing for readability */
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1); /* Add a subtle text shadow */
        }
  </style>

  <body>

        <!-- Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <!-- Layout Content -->
    <div class="layout-wrapper layout-content-navbar ">
    <div class="layout-container">

          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
      <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo"><span>
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="width: 50px; height:50px">
  </span>
  </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">Logistics</span>
      </a>

    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">





        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
          <a href="/" class="menu-link" >
                      <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                      <div>Dashboard</div>
          </a>
        </li>

          <li class="menu-header fw-medium mt-4">
        <span class="menu-header-text">Managements</span>
          </li>


      <li class="menu-item ">
        <a href="javascript:void(0);" class="menu-link menu-toggle" >
          <i class="menu-icon tf-icons mdi mdi-truck-outline"></i>
          <div>Drivers</div>
        </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('driverList') ? 'active' : '' }}">
                  <a href="/driverList" class="menu-link" >
                      <div>List</div>
                  </a>
                </li>
              </ul>
      </li>

      <li class="menu-item ">
        <a href="javascript:void(0);" class="menu-link menu-toggle" >
          <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
          <div>Customers</div>
        </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('customerList') ? 'active' : '' }}">
                  <a href="/customerList" class="menu-link" >
                      <div>List</div>
                  </a>
                </li>
              </ul>
      </li>

      <li class="menu-header fw-medium mt-4">
        <span class="menu-header-text">Items</span>
          </li>

          <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle" >
              <i class="menu-icon tf-icons mdi mdi-warehouse"></i>
              <div>Stocks</div>
            </a>
                  <ul class="menu-sub">
                    <li class="menu-item {{ Request::is('itemList') ? 'active' : '' }}">
                      <a href="/itemList" class="menu-link" >
                          <div>List</div>
                      </a>
                    </li>
                  </ul>
          </li>

  </aside>


      <!-- Layout page -->
      <div class="layout-page">




        <!-- BEGIN: Navbar-->
              <!-- Navbar -->
  <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->

      <!-- ! Not required for layout-without-menu -->
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="mdi mdi-menu mdi-24px"></i>
        </a>
      </div>

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{asset('/assets/img/avatars/1.png')}}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="pages/profile-user.html">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{asset('/assets/img/avatars/1.png')}}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block">
                                              {{$userFirstName}} {{$userLastName}}
                                            </span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ url('/profile') }}">
                  <i class="mdi mdi-account-outline me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
                          <li>
                <a class="dropdown-item" href="{{ route('logout') }}">
                  <i class='mdi mdi-logout me-2'></i>
                  <span class="align-middle">Logout</span>
                </a>
              </li>
                        </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
        <i class="mdi mdi-close search-toggler cursor-pointer"></i>
      </div>
      </nav>
  <!-- / Navbar -->
              <!-- END: Navbar-->
