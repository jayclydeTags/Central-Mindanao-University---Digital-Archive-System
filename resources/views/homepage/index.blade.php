<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Its an archive system the provides access and keeping the university records.">
    <meta name="keywords" content="CMU, Archive, Digital Archive System, DAS, Archive System, Records Management, Central Mindanao University">
    <meta name="copyright" content="CMU Records Management Unit 2022">
    <meta name="title" content="CMU | Digital Archive System">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <meta name="robots" content="index, follow" />

    <title> CMU | Digital Archive System </title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <!-- Favicon -->
    <link href="{{asset('assets/img/cmulogo.png')}}" rel="icon" type="image/png">

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto+Mono:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

    <!-- Icons -->
    {{-- <link href="{{asset('assets/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('assets/css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" /> --}}

    <!-- Argon CSS -->

    {{-- <link type="text/css" href="{{asset('assets/css/argon.min.css')}}" rel="stylesheet"> --}}

    <!-- Landing CSS -->
    {{-- <link href="{{asset('landingpage/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('landingpage/css/nucleo-svg.css')}}" rel="stylesheet" />
    <link href="{{asset('landingpage/css/nucleo-svg.css')}}" rel="stylesheet" /> --}}
    {{-- <link href="{{asset('landingpage/css/argon-design-system.css?v=1.2.2')}}" rel="stylesheet" /> --}}

    <!-- PDF VIEWER -->
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js" crossorigin="anonymous"></script>
    <link href="https://mozilla.github.io/pdf.js/web/viewer.css" rel="stylesheet" type="text/css" />




    <!-- Fonts -->
    <!-- Styles -->
    {{-- <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-family: 'Poppins', sans-serif;
            font-family: 'Roboto Mono', monospace;
        }
    </style> --}}
</head>

<body class="antialiased landing-page">
    <div id="app">
        <app-component></app-component>
    </div>

    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!--   Optional JS   -->
    <script src="{{asset('assets/js/plugins/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
    <!--   Argon JS   -->
    {{-- <script src="{{asset('assets/js/argon-dashboard.min.js?v=1.1.2')}}"></script> --}}


    <script src="{{asset('landingpage/js/core/popper.min.js')}}">
    </script>
    <script src="{{asset('landingpage/js/plugins/perfect-scrollbar.jquery.min.js')}}">
    </script>
    <script src="{{asset('landingpage/js/plugins/bootstrap-switch.js')}}">
    </script>
    <script src="{{asset('landingpage/js/plugins/nouislider.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('landingpage/js/plugins/moment.min.js')}}">
    </script>
    <script src="{{asset('landingpage/js/plugins/datetimepicker.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('landingpage/js/plugins/bootstrap-datepicker.min.js')}}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js">
    </script>
    {{-- <script src="{{asset('landingpage/js/argon-design-system.js')}}" type="text/javascript"></script> --}}
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js">
    </script>


</body>


</html>
