<title>{{ env('APP_NAME') }} - @yield('title')</title>
<meta charset="utf-8" />
<meta name="description" content="IMM - {{ env('APP_NAME') }}" />
<meta name="keywords" content="IMM - {{ env('APP_NAME') }}" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="IMM - {{ env('APP_NAME') }}" />
<meta property="og:url" content="{{ env('APP_URL') }}" />
<meta property="og:site_name" content="IMM - {{ env('APP_NAME') }}" />
<meta name="robots" content="noindex" />
<meta name="robot" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="robot" content="noindex,nofollow" />
<link rel="canonical" href="{{ env('APP_URL') }}" />
<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
<!--begin::Fonts(mandatory for all pages)-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Vendor Stylesheets(used for this page only)-->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<script>
    // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
</script>
