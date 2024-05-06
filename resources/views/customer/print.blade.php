<!DOCTYPE html>

<html lang="fr" class="light-style   layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="blank-menu-theme-default-light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title> (Print version) - Pages |
    Logistics</title>
  <meta name="description" content="Materialize – is the most developer friendly &amp; highly customizable Admin Dashboard Template." />
  <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="AV4fnA5fIGAwEMNyLiTwa2fUW3vpFVaLsrpPCVTq">
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://1.envato.market/materialize_admin">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('/images/logo.png')}}" />

  
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
    

  <!-- Include Styles -->
  <!-- $isFront is used to append the front layout styles only on the front layout otherwise the variable will be blank -->
  <!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="{{asset('assets/vendor/fonts/materialdesignicons-id=6dcb6840ed1b54e81c4279112d07827e.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons-id=121bcc3078c6c2f608037fb9ca8bce8d.css')}}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core-id=84e90b89d4346ba5b549f814933f56c1.css" class="template-customizer-core-css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default-id=a5b74f63f911baabfa8b02a06ecfc64c.css" class="template-customizer-theme-css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/demo-id=b0748c2ad4338911d21615a7692027bd.css')}}" />


<!-- Vendor Styles -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves-id=aa72fb97dfa8e932ba88c8a3c04641bc.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar-id=e712540dc55d810eb04058a2c7adde74.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead-id=9edd1831c1d7cdbc4ff9cca42bf26999.css')}}" />


<!-- Page Styles -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-invoice-print.css')}}" />

  <!-- Include Scripts for customizer, helper, analytics, config -->
  <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
  <!-- laravel style -->
<script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
<!-- beautify ignore:start -->
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{asset('assets/js/config.js')}}"></script>

  <script>
    window.templateCustomizer = new TemplateCustomizer({
      cssPath: '',
      themesPath: '',
      defaultStyle: "light",
      defaultShowDropdownOnHover: "true", // true/false (for horizontal layout only)
      displayCustomizer: "true",
      lang: 'fr',
      pathResolver: function(path) {
        var resolvedPaths = {
          // Core stylesheets
                      'core.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/core.css?id=84e90b89d4346ba5b549f814933f56c1',
            'core-dark.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/core-dark.css?id=56393a9e9ca3b3c80a47e4bc59b03832',
          
          // Themes
                      'theme-default.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default.css?id=a5b74f63f911baabfa8b02a06ecfc64c',
            'theme-default-dark.css':
            'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default-dark.css?id=8b5937608e22a4a15f291494ec107064',
                      'theme-bordered.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered.css?id=aecb8491d176004d9f3b3f8d93641879',
            'theme-bordered-dark.css':
            'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered-dark.css?id=73dc67574b56c6dae3cb9f628c0ebd4a',
                      'theme-semi-dark.css': 'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark.css?id=3d719b360981903a81b1808c59cbaf26',
            'theme-semi-dark-dark.css':
            'https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark-dark.css?id=32e2e9b755bdf097142e4f239af82dc0',
                  }
        return resolvedPaths[path] || path;
      },
      'controls': ["rtl","style","headerType","contentLayout","layoutCollapsed","layoutNavbarOptions","themes"],
    });
  </script>
</head>

<body>
  
      <!-- Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
    

  <!-- Layout Content -->
  
<!-- Content -->
<div class="invoice-print p-4">
  <div class="d-flex justify-content-between flex-row">
    <div class="mb-4">
      <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
        <span class="app-brand-logo demo"><span>
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="width: 50px; height:50px">
</span>
</span>
        <span class="h4 mb-0 app-brand-text fw-bold">Logistics</span>
      </div>
      <p class="mb-1">123, Jalan Street 123</p>
      <p class="mb-1">Kuala Lumpur, Malaysia</p>
      <p class="mb-0">+601 01234657</p>
    </div>
    <div>
      <h4>INVOICE #{{ $deliveryInvoice }}</h4>
      <div class="mb-2">
        <span>Date Issues:</span>
        <span>April 25, 2021</span>
      </div>
      <div>
        <span>Date Due:</span>
        <span>May 25, 2021</span>
      </div>
    </div>
  </div>

  <hr />

  <div class="d-flex justify-content-between mb-4">
    <div class="my-2">
      <h6>Invoice To:</h6>
      @foreach ($customerInfo as $item)
      <p class="mb-1">{{ $item->first_name }} {{ $item->last_name }}</p>  
      <p class="mb-1">{{ $item->location }}</p> 
      <p class="mb-1">+60{{ $item->contact }}</p> 
      @endforeach
    </div>
  </div>

  <div class="table-responsive">
    <table class="table m-0">
      <thead class="table-light border-top">
        <tr>
          <th>Item</th>
          <th>Description</th>
          <th>Cost</th>
          <th>Qty</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-nowrap text-heading">{{ $deliveryDetails->item_code }}</td>
          <td>{{ $deliveryDetails->name }}</td>
          <td>RM {{ number_format($deliveryDetails->price, 2) }}</td>
          <td>{{ $deliveryDetails->quantity }}</td>
          <td>RM {{ number_format($finalDeliveryPrice, 2) }}</td>
        </tr>
        @if($addOnList != [])
        @foreach ($addOnList as $addOn)
        <tr>
            <td class="text-nowrap text-heading">{{$addOn->item_code}}</td>
            <td class>{{$addOn->name}}</td>
            <td class>RM {{ number_format($addOn->price, 2) }}</td>
            <td class>{{$addOn->a_quantity}}</td>
            <td class>RM {{ number_format($addOn->final_price, 2) }}</td>
          </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 mb-md-0 mb-3">
      </div>
      <div class="col-md-6 d-flex justify-content-md-end mt-2">
        <div class="invoice-calculations">
          <div class="d-flex justify-content-between">
            <span class="w-px-150">Total:</span>
            <h6 class="mb-0 pt-1">RM {{ number_format($totalPrice, 2) }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Content -->

  <!--/ Layout Content -->
  

  <!-- Include Scripts -->
  <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
  <!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/vendor/libs/jquery/jquery-id=0f7eb1f3a93e3e19e8505fd8c175925a.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper-id=baf82d96b7771efbcc05c3b77135d24c.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap-id=b6c06656efc82e323d7fd0162235c958.js')}}"></script>
<script src="{{asset('assets/vendor/libs/node-waves/node-waves-id=4fae469a3ded69fb59fce3dcc14cd638.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar-id=44b8e955848dc0c56597c09f6aebf89a.js')}}"></script>
<script src="{{asset('assets/vendor/libs/hammer/hammer-id=0a520e103384b609e3c9eb3b732d1be8.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead-id=f6bda588c16867a6cc4158cb4ed37ec6.js')}}"></script>
<script src="{{asset('assets/vendor/js/menu-id=c6ce30ded4234d0c4ca0fb5f2a2990d8.js')}}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/js/main-id=e46da52cc43e079943fb6810bf346c25.js')}}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('assets/js/app-invoice-print.js')}}"></script>
<!-- END: Page JS-->

</body>

</html>
