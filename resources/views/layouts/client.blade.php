@include('layouts.partial.head')

<main class="main" id="top">
    @include('layouts.partial.topbar')
    <div class="content">
        @yield('content')
        @include('layouts.partial.footer')
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
<script src="{{ asset('assets/js/utils.js') }}"></script>
<script src="{{ asset('assets/js/charts.js') }}"></script>
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/choices/choices.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Stacking JavaScript -->
@stack('scripts')

</body>
</html>
