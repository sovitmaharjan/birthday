<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.meta')

    <title>Test</title>

    @include('layouts.style')

</head>

<body class="fixed-left">

    <div id="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="content-page">

            <div class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">@yield('group') </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    @hasSection('group')
                                        <li class="breadcrumb-item">
                                            @yield('group')
                                        </li>
                                    @endif
                                    <li class="breadcrumb-item active">
                                        @yield('page')
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    @yield('content')

                </div>

            </div>

            @include('layouts.footer')

        </div>
    </div>

    @include('layouts.script')

</body>

</html>
