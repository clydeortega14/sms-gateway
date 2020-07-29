<!DOCTYPE html>
<html lang="en">

<head>

    <style type="text/css" style="display: none !important;">



       /* @page {
            margin: 0cm 0cm;
        }*/

        body {
            margin-top: 1.5cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 1.5cm;
            font-family: sans-serif;
            font-style: monospace;
        }


        .left{
            position: absolute;
            left: 0px;
            width: 500px;
            border: none;
            padding: 0;
            margin-left: 1.5cm;
            margin-right: 1.5cm;

        }

        .right{
            /*position: absolute;*/
            right: 0px;
            width: 1200px;
            border: none;
            padding: 0;
            text-align: right;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }

        .p_left{
            position: absolute;
            left: 0px;
            width: 700px;
            border: none;
            padding-left: 30px;
            text-align: left;
             margin-left: 1.5cm;
            margin-right: 1.5cm;
        }

        .b_right{
            position: absolute;
            right: 0px;
            width: 400px;
            border: none;
            padding: 0;
            text-align: left;
        }


        .notice{
            background-color: #ec7b13;
            color: white;
            text-align: center;
        }

        .header{
            position: absolute;
        }

    </style>

</head>

<body>

        <center><h2><b>Acknowledgement Receipt</b></h2></center>
        <p class="p_left"><b>Date:</b> {{ date('F j, Y', strtotime(Carbon\Carbon::now())) }}</p><br>
        <br>

        <p class="p_left" style="text-align:justify;">Dear {{ $user->name}}, <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You have successfully paid PHP {{number_format($receipt->amount, 2) }} to your current subscription with preference no. {{$receipt->remarks}}.<br> Please check or kindly log in to <a href="http://smsplus.coredev.ph">smsplus.coredev.ph</a> with your corresponding account. Thank you for using our application, have a nice day!<br>
        </p><br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p class="p_left"><b>From:</b> coreDev Solutions Inc.</p>


    <script src="/receiptjs/jquery-2.1.1.js"></script>
    <script src="/receiptjs/bootstrap.min.js"></script>
    <script src="/receiptjs/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/receiptjs/inspinia.js"></script>



</body>
</html>