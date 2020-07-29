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
            width: 300px;
            border: none;
            padding: 0;
            text-align: left;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        th, td {
            text-align: center;
            border-bottom: 1px solid black;
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
            <div class="left">
                <p><h2>C<span><img src="images/coredevlogo.png" style="height: 20px; width: 20px;"></span> REDEV SOLUTIONS, INC.</h2>
                <u>SMS GATEWAY</u><br>
                96 J. Alcantara St., Sambag 1<br>
                Cebu City, Cebu<br>
                Philippines 6000<br></p>

            </div>

            @foreach($getUser_payment as $payment)
            <div class="right">
                <p><h2>INVOICE</h2>
                Invoice Number: {{ $payment->getInvoice->invoice_number }}<br>
                Invoice Date: {{ date('F j, Y', strtotime($payment->date_expire)) }}<br>
                {{ $users->email }}</p>
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

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive m-t">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Branch</th>
                                <th>Total SMS</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($get_branch as $br)
                                @foreach($getUser_credential as $cre)
                                    @if($br->credentials_id == $cre->id)
                                            <tr>
                                                <td>{{ date('F j, Y', strtotime($payment->created_at)) }}</td>
                                                <td>{{ date('F j, Y', strtotime($payment->date_expire)) }}</td>
                                                <td>{{ $br->branch_name }}</td>
                                                <td>{{ $br->count }}</td>
                                                <td>Php {{ number_format((float)$br->count * $cre->text_rate, 2) }}</td>
                                            </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                        <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>TOTAL (PHP):</strong></td>
                                        <td><strong>{{ $payment->getUsage->total_charge }}</strong></td>

                                    </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div class="notice">
            Please Pay By: {{ date('F j, Y', strtotime($payment->date_expire)) }}
        </div>

        <br>

        <div class="p_left">
            <p><b>Please send payment to:</b><br>
            coreDev Solutions Inc.<br>
            96 J. Alcantara St., Sambag 1<br>
            Cebu City, Cebu<br>
            Philippines 6000<br></p>
        </div>

        <div class="b_right">
            <p><b>Bill to:</b><br>
            {{ $users->name }}<br>
            {{ $users->informations->company }}<br>
            {{ $users->informations->address }}<br>
            {{ $users->informations->zip_code }}<br></p>
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
        <br>

        <div>
            <p><b>To make payment, view your billing history, or ask questions about your account, please login to: http://smsplus.coredev.ph.</b></p>
        </div>

        @endforeach


    <script src="/receiptjs/jquery-2.1.1.js"></script>
    <script src="/receiptjs/bootstrap.min.js"></script>
    <script src="/receiptjs/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/receiptjs/inspinia.js"></script>



</body>
</html>