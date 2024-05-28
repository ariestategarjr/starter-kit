<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->
    <div class="flex-wrap page-title d-flex flex-column justify-content-center me-3">
        <!--begin::Title-->
        <h1 class="my-0 text-gray-900 page-heading d-flex fw-bold fs-3 flex-column justify-content-center">
            {{ env('APP_NAME') }}</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="pt-1 my-0 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="/" class="text-muted text-hover-primary">Home</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bg-gray-500 bullet w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Dashboards</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
</div>
