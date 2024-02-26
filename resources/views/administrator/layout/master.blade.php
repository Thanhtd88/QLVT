<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('administrator/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 
  <!-- Daterange picker --> 
  <link rel="stylesheet" type="text/css" href="{{ asset('administrator/plugins/daterangepicker/daterangepicker.css')}}" />  
  <!-- Date picker --> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('administrator/dist/css/admin.min.css') }}">  
  <!-- Autocomplete -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1/dist/css/bootstrap-dark.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('administrator/plugins/autocomplete/css/autocomplete.css') }}">  
  <!-- Bootraps 5 css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs5/css/dataTables.bootstrap5.css') }}">
  <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs5/css/dataTables.reponsive.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
<div class="wrapper">

  
  @include('administrator.pages.header') <!-- Navbar -->

  @include('administrator.pages.sidebar') <!-- Main Sidebar Container -->
  
  @yield('content') <!-- Content Wrapper. Contains page content -->
  
  @include('administrator.pages.footer') <!-- Footer -->

</div> <!-- ./wrapper -->

<!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('administrator/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- AutoComplete (edit)-->
<script src="{{ asset('administrator/plugins/autocomplete/js/autocomplete.js')}}" type="module"></script>
<!-- Data table (edit)-->
<script src="{{ asset('administrator/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs5/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs5/js/dataTables.reponsive.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs5/js/reponsive.bootstrap5.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('administrator/dist/js/admin.min.js')}}"></script>
<!-- Google Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Daterange picker (edit)-->
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('administrator/plugins/daterangepicker/daterangepicker-new.js')}}"></script>
<!-- Date picker (edit)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Show-password (edit)-->
<script src="{{ asset('administrator/plugins/show-hide-password/show-hide-passord.js') }}"></script>
<!-- INPUT MASK (edit)-->
<script src="{{ asset('administrator/plugins/inputmask/inputmask.min.js') }}"></script>
@yield('js-custom')

</body>
</html>
