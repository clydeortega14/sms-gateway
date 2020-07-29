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
        }

        .right{
            position: absolute;
            right: 0px;
            width: 300px;
            border: none;
            padding: 0;
            text-align: right;
        }

        .p_left{
            position: absolute;
            left: 0px;
            width: 300px;
            border: none;
            padding-left: 30px;
            text-align: left;
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
        <div class="header">
            <div class="left">
                <p><h2>C<span><img src="images/coredevlogo.png" style="height: 20px; width: 20px;"></span>REDEV SOLUTIONS, INC.</h2>
                <u>SMS GATEWAY</u><br>
                96 J. Alcantara St., Sambag 1<br>
                Cebu City, Cebu<br>
                Philippines 6000<br></p>
            </div>

            @foreach($get_receipt as $receipt)
            <div class="right">
                <p><h2>Acknowledgement Payment</h2>
                Account: {{ $users->email }}<br>
                {{ $users->name }}<br>
                {{ $users->informations->company }}<br>
                {{ $users->informations->address }}<br>
                {{ $users->informations->barangay }}
                {{ $users->informations->zip_code }}<br>
                </p>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>


        <div class="notice">

        </div>

        <br>

        <div class="p_left">
            <p><b>Official Receipt:<br>
            Payment Amount:<br>
            Payment Date:<br>
            Payment Type:</b></p>
        </div>

        <div class="b_right">

            <p>{{ $receipt->or_number }}<br>
            PHP {{ number_format((float)($receipt->getPayment->amount), 2) }}<br>
            {{ date('F j, Y', strtotime($receipt->getPayment->created_at)) }}<br>
            {{ $receipt->getpayment->description }}</p>

        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      {{--   <div>
            <p>To access billing option, check your statement or for questions regarding this receipt, log in to your members area at http://smsplus.coredev.ph.</p>
        </div> --}}

        @endforeach


    <script src="/receiptjs/jquery-2.1.1.js"></script>
    <script src="/receiptjs/bootstrap.min.js"></script>
    <script src="/receiptjs/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/receiptjs/inspinia.js"></script>



</body>
</html>