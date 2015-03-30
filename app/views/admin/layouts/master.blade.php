@include('admin.layouts.static')
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title>@yield('title','中国最大的精品鹦鹉繁殖基地') - 鹦鹉吧</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="鹦鹉吧，中国最大的精品鹦鹉繁殖基地">
    <meta name="keywords" content="鹦鹉，鹦鹉吧，大头鹦鹉">
    <meta name="author" content="迁迁">
    @yield('meta_header')
    <!-- The fav icon -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <!-- The styles -->
    @yield('css')
    @yield('js_header')
    @yield('common_header')
</head>

<body>
    @section('header')
        @include('admin.common.header')
    @show
    <div class="ch-container">
        <div class="row">
            @section('leftMenu')
               @include('admin.common.leftMenu')
            @show
            <noscript>
                        <div class="alert alert-block col-md-12">
                            <h4 class="alert-heading">Warning!</h4>

                            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                                enabled to use this site.</p>
                        </div>
            </noscript>

            <div id="content" class="col-lg-10 col-sm-10">
                @yield('content')
            </div>
        </div>
        @section('footer')
            @include('admin.common.footer')
        @show
    </div>
@yield('js_footer')
@yield('common_footer')
</body>
</html>