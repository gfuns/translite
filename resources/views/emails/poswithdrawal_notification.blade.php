<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Withdrawal Successful</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 150px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 13px;
        }

        th {
            background-color: #f5f5f5;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }

        .social-media {
            margin-top: 10px;
        }

        .social-media a {
            display: inline-block;
            margin-right: 10px;
            color: #555;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #33cc66;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="{{ $message->embed(public_path('images/logo.png')) }}"
                alt="{{ env('APP_NAME') }} Logo">
        </div>

        <p>Dear {{ $user->agentFirstName . ' ' . $user->agentLastName }},</p>

        <p>Your POS Withdrawal of &#8358;{{ number_format($transaction->amount, 2) }}
            @if ($transaction->status == 'successful')
                {{ 'is ' . ucwords($transaction->status) }}.
            @elseif($transaction->status == 'failed')
                {{ ucwords($transaction->status) }}.
            @elseif($transaction->status == 'reversed')
                {{ 'has been ' . ucwords($transaction->status) }}.
            @else
                {{ 'is ' . ucwords($transaction->status) }}.
            @endif
            Here are the transaction details:
        </p>

        <table>
            <tbody>
                <tr>
                    <th>Transaction Type</th>
                    <td>POS Withdrawal</td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td>{{ $transaction->bank }}</td>
                </tr>
                <tr>
                    <th>Masked PAN</th>
                    <td>{{ $transaction->masked_pan }}</td>
                </tr>
                <tr>
                    <th>STAN</th>
                    <td>{{ $transaction->stan }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>&#8358;{{ number_format($transaction->amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Transaction Fee</th>
                    <td>&#8358;{{ number_format($transaction->fee, 2) }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $transaction->description }}</td>
                </tr>
                <tr>
                    <th>Transaction Ref.</th>
                    <td>{{ $transaction->reference }}</td>
                </tr>
                <tr>
                    <th>Transaction Date</th>
                    <td>{{ date_format($transaction->created_at, 'jS M, Y H:i A') }}</td>
                </tr>
                <tr>
                    <th>Transaction Status</th>
                    <td>{{ ucwords($transaction->status) }}</td>
                </tr>
            </tbody>
        </table>

        <p>If you have any questions or need further assistance, please feel free to contact our support team.</p>

        <div class="">
            <p>Best regards,<br>{{ env('APP_NAME') }} Team</p>
        </div>


    </div>
</body>

</html>
