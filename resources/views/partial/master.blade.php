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
    <link rel="icon" type="image/png" sizes="16x16" href="images/new-logo.png">
    <title>{{$page_title}}</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/my_css/style.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">  
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

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

   <script src="js/lib/jquery/jquery.min.js"></script>
   <!-- Bootstrap tether Core JavaScript -->
   <script src="js/lib/bootstrap/js/popper.min.js"></script>
   <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
   <!-- slimscrollbar scrollbar JavaScript -->
   <script src="js/jquery.slimscroll.js"></script>
   <!--Menu sidebar -->
   <script src="js/sidebarmenu.js"></script>


   <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

   <!--Custom JavaScript -->
   <script src="js/custom.min.js"></script>

    <!--Table Datatable-->

    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>



  @yield('script')
</body>

</html>