<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partials.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{ $slot }}

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

    @livewireScripts

    <!-- toaster-->
    <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        //alert dismiss
    $('.alert').alert()

    //toaster sewttings
    $(document).ready(function(){
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
         //events for show-user
     window.addEventListener('hide-form', event=>{
        $('#form').modal('hide');
        toastr.success(event.detail.message,'success')
    })

      window.addEventListener('hide-delete-modal', event=>{
        $('#confirmationForm').modal('hide');
        toastr.success(event.detail.message,'success')
      })
    })

    //events for show-user
    window.addEventListener('show-form', event=>{
        $('#form').modal('show');
    })
    window.addEventListener('show-confirm-delete-form',event=>{
       $('#confirmationForm').modal('show');
       //console.log( $('confirmationForm'))
    })



    </script>
</body>

</html>
