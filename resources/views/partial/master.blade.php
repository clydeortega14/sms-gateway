<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/new-logo.png') }} ">
    <title>{{$page_title}}</title>
    <link href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my_css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet">  
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/data-table/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    <link href="{{ asset('css/lib/data-table/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/data-table/buttons.dataTables.min.css') }}" rel="stylesheet">
    {{-- SWEETALERT --}}
    <link rel="stylesheet" href="{{ asset('css/lib/sweetalert/sweetalert.css') }}">

</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
           @include('partial.header')
           @include('partial.sidebar')
           @yield('body')
       </div>

   <!-- All Jquery -->

   <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
   <!-- Bootstrap tether Core JavaScript -->
   <script src="{{ asset('js/lib/bootstrap/js/popper.min.js') }}"></script>
   <script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
   <!-- slimscrollbar scrollbar JavaScript -->
   <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
   <!--Menu sidebar -->
   <script src="{{ asset('js/sidebarmenu.js') }}"></script>


   <script src="{{ asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js')}} "></script>

   <!--Custom JavaScript -->
   <script src="{{ asset('js/custom.min.js') }}"></script>

    <!--Table Datatable-->

    <script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Custom Sweet Alert -->
    <script>
        function fireAlert(options)
        {
            return swal({

              title: "Are you sure?",
              text: "You want to update status?",
              icon: "warning",
              buttons: true,
              dangerMode: true,

            }).then((isConfirm) => {

              if(isConfirm){

                ajaxRequest(options).done(res => {
                  location.reload()
                  swal("Success", "successfully updated", "success")
                });
                
              }else{

                swal("Warning", "Aborted", "warning")
              }
            })
        }

        function ajaxRequest(options){

          return $.ajax({

            method: options.method,
            url: options.url,
            data: options.data,

          }).fail(error => console.log(error))

        }
    </script>
    {{-- <script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script> --}}
    {{-- <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script> --}}
    <script>
      
      $(document).ready(function(){

        $('#myTable').DataTable()
      })
    </script>


  @yield('script')
</body>

</html>