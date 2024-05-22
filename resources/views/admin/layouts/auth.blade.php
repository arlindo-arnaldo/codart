
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="pt-br">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="/admin-assets/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    @livewireStyles
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="/admin-assets/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="/admin-assets/static/logo.svg" height="36" alt=""></a>
        </div>
        @yield('content')
        
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/admin-assets/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="/admin-assets/dist/js/demo.min.js?1684106062" defer></script>
    @livewireScripts
  </body>
</html>