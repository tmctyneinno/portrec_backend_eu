<!DOCTYPE html>
<html>
<head>
    <title>Subscription Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #073c75;
            color: #ffffff;
            padding: 5px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-footer {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .details {
            margin: 20px 0;
            border-collapse: collapse;
            width: 100%;
        }
        .details th, .details td {
            text-align: left;
            padding: 8px;
        }
        .details th {
            background-color: #f4f4f4;
        }
        .details tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Thank You for Your Payment!</h1>
        </div>
        <div class="email-body">
            <p>Hi {{$data['name']}},</p>
            <p>Your payment for the <strong>{{$data['subscription']}}</strong> subscription has been successfully processed.</p>
            
            <table class="details">
                <tr>
                    <th>Subscription Plan</th>
                    <td>{{$data['subscription']}}</td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td>{{$data['currency']}}{{$data['amount']}}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>{{$data['payment_method']}}</td>
                </tr>
                <tr>
                    <th>Billing Period</th>
                    <td>{{$data['start_date']}} - {{$data['end_date']}}</td>
                </tr>
            </table>

            <a href="https://portrec.ng/user/billings" style="color:#fff" class="button">Manage My Subscription</a>
            
            <p>If you have any questions, feel free to <a href="portrec.ng">contact our support team</a>.</p>
        </div>
        <div class="email-footer">
            <p style="font-size: 12px;margin: 0;padding: 0;">Copyright © {{date('Y')}} Portrec.ng. All rights reserved. <br> 1, Adeola Adeoye Street, Off Toyin Street, Ikeja, Lagos State.</p>
            <ul style="list-style: none;  text-align:center; display:inline"> 
              <li style="display:inline-block;"> <a href="https://portrec.ng/" > Home </a></li>
              <li  style="display:inline-block;"> <a href="https://portrec.ng/about-us" >  About Us </a></li>
              <li style="display:inline-block;"> <a href="https://portrec.ng/contact" > Contact Us </a></li>
            </ul>
        </div>
    </div>
</body>
</html>
