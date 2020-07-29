<!DOCTYPE html>
<html lang="en">

<head>



    <style type="text/css" style="display: none !important;">



        @page {
            margin: 0cm 0cm;
        }

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
            position: absolute;
            right: 0px;
            width: 300px;
            border: none;
            padding: 0;
            text-align: right;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }

        .date-right{
            position: absolute;
            right: 0px;
            width: 350px;
            border: none;
            padding: 0;
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
            width: 300px;
            border: none;
            padding: 0;
            text-align: left;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }

        .invoice-table{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        .invoice-table th, td {
            text-align: center;
            border-bottom: 1px solid black;
        }

        .usage-table{
            border-collapse: collapse;
            border: 1px solid black;
        }

        .usage-table th {
            border-bottom: 1px solid black;
            padding: 3px 15px;
        }

        .usage-table td {
            padding: 3px;
            text-align: right;
        }

        .notice{
            background-color: #ec7b13;
            color: white;
            text-align: center;
        }

    </style>

</head>




<body>
        <div class="header">
            <center><h2><b>Billing Statement</b></h2></center>
        </div>

        <div class="row">
            <div class="col-md-12">
            <p class="p_left"><b>Date:</b> {{ date('F j, Y', strtotime(Carbon\Carbon::now())) }}</p><br>
            <br>

            <p class="p_left" style="text-align:justify;">Dear {{ $user->name }},<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Good day! As of today {{ date('F j, Y', strtotime(Carbon\Carbon::now())) }} your current bill is <b>Php
                @if( $payment->amount < $payment->getUsage->total_charge )
                 {{ number_format((float)$payment->getUsage->total_charge,2) }}
                @else
                 {{ number_format((float)$payment->amount,2) }}
                @endif
            </b>.
             Please pay by <b>{{ date('F j, Y', strtotime(Carbon\Carbon::now()->addDays(3))) }}</b> to continue subscribing to our application. Log in to <a href="http://smsplus.coredev.ph">smsplus.coredev.ph</a> to see your current Bill information thank you, Have a nice day!
            </p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p class="p_left"><b>From:</b> coreDev Solution Inc.</p>
            </div>
        </div>


    <script src="/receiptjs/jquery-2.1.1.js"></script>
    <script src="/receiptjs/bootstrap.min.js"></script>
    <script src="/receiptjs/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/receiptjs/inspinia.js"></script>



</body>
</html>