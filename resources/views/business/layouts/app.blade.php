<!DOCTYPE html>
<html>
@include('business.layouts.header')


<body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">

        @yield('autopop')

        <div class="layout-w">

            @include('business.layouts.nav')

            @yield('content')

        </div>
        <div class="display-type"></div>

        <div class="floated-chat-btn" style="padding-right: 20px">
            <i class="os-icon os-icon-mail-07"></i><span>Contact Support</span>
        </div>
    </div>
    @include('business.layouts.footer')

    @yield('customjs')

</body>

</html>
