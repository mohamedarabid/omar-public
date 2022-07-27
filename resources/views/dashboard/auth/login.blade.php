<!DOCTYPE html>



<html lang="en">

<!--begin::Head-->

<head>
    <base href="../../../../">

    <meta charset="utf-8" />

    <title>تطبيق عمر | تسجيل دخول</title>

    <meta name="description" content="Login page example" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="canonical" href="https://keenthemes.com/metronic" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('css/pages/login/classic/login-1.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />







</head>



<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <div class="d-flex flex-column flex-root">

        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
            id="kt_login">

            <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10"
                style="background-image: url(media/bg/bg-4.jpg);">

                <div class="d-flex flex-row-fluid flex-column justify-content-between">

                    <a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">

                        {{-- <img style="width: 200px;" src="{{ asset('media/logos/Artboard 1 (7).png') }}"
                            class="max-h-150px" alt="" /> --}}

                    </a>

                    <div class="flex-column-fluid d-flex flex-column justify-content-center">

                        {{-- <h3 class="font-size-h1 mb-5 text-white">مرحبا بك في تطبيق عمر</h3> --}}

                        <p class="font-weight-lighter text-white opacity-80"> </p>

                    </div>

                </div>

            </div>

            <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">

                {{-- <div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">

						<span class="font-weight-bold text-dark-50">Dont have an account yet?</span>

						<a href="javascript:;" class="font-weight-bold ml-2" id="kt_login_signup">Sign Up!</a>

					</div> --}}

                <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">

                    <div class="login-form login-signin">

                        <div class="text-center mb-10 mb-lg-20">
                            <a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">

                                <img src="{{ asset('media/logos/omar.png') }}" class="max-h-200px" alt="" />

                            </a>
                            <br><br>
                            <h3 class="font-size-h1">تسجيل دخول</h3>

                            <p class="text-muted font-weight-bold">ادخل البريد الالكتروني وكلمه السر</p>

                        </div>

                        <form class="form" novalidate="novalidate" id="kt_login_signin_form">

                            <div class="form-group">

                                <input class="form-control form-control-solid h-auto py-5 px-6" type="text"
                                    placeholder="email" id="email" required />

                            </div>

                            <div class="form-group">

                                <input class="form-control form-control-solid h-auto py-5 px-6" type="password"
                                    placeholder="Password" id="password" required />

                            </div>



                            <div class="row">

                                <div class="col-8">

                                    <div class="icheck-primary">

                                        <input type="checkbox" id="remember">

                                        <label for="remember">

                                            تذكرني

                                        </label>

                                    </div>

                                </div>

                                <div class="col-4">

                                    <button type="button" onclick="login()" class="btn btn-primary btn-block">تسجيل
                                        دخول</button>

                                </div>

                            </div>

                        </form>

                    </div>



                </div>



                <div
                    class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">

                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 2020 Metronic</div>

                    <div class="d-flex order-1 order-sm-2 my-2">

                        <a href="#" class="text-dark-75 text-hover-primary">Privacy</a>

                        <a href="#" class="text-dark-75 text-hover-primary ml-4">Legal</a>

                        <a href="#" class="text-dark-75 text-hover-primary ml-4">Contact</a>

                    </div>

                </div>

            </div>

        </div>

    </div>











    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>

    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>



    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>

    <script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>

    <script src="{{ asset('js/scripts.bundle.js') }}"></script>

    <script src="{{ asset('js/pages/custom/login/login-general.js') }}"></script>

    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('crudjs/crud.js') }}"></script>



    <script>
        function login() {

            var guard = '{{ request('guard') }}';

            axios.post('/dashboard/' + guard + '/login', {

                    email: document.getElementById('email').value,

                    password: document.getElementById('password').value,

                    remember_me: document.getElementById('remember').checked,

                    guard: guard

                })


                .then(function(response) {

                    window.location.href = '/dashboard/admin'

                })

                .catch(function(error) {



                    if (error.response.data.errors !== undefined) {

                        showErrorMessages(error.response.data.errors);

                    } else {

                        showMessage(error.response.data);

                    }

                });

        }
    </script>



</body>

</html>
