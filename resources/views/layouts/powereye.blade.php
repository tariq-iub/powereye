@include('layouts.partial.admin_head')

<main class="main" id="top">
    @include('layouts.partial.sidebar')
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
<script src="{{ asset('assets/vendors/choices/choices.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dhtmlx-gantt/dhtmlxgantt.js') }}"></script>
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/phoenix.js') }}"></script>
<script src="{{ asset('assets/vendors/echarts/echarts.min.js') }}"></script>
<script src="../assets/js/projectmanagement-dashboard.js"></script>

<!-- Stacking JavaScript -->
@stack('scripts')

</body>
</html>
