<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Account Created</title>
    <style>
        /* Internal CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #007bff;
        }

        p {
            margin-bottom: 10px;
        }
        .account-details {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Account Created</h1>
    <p>Hello {{ $fullName }},</p>
    <p>We are delighted to inform you that your new account has been successfully created.</p>
    <div class="account-details">
        <p><strong>Account Name:</strong> {{ $fullName }}</p>
        <p><strong>Account Number:</strong> {{ $accountNumber }}</p>
        <p><strong>Account Type:</strong> {{ $accountType }}</p>
        <p><strong>Account Currency:</strong> {{ $accountCurrency }}</p>
    </div>
    <p>If you have any questions or concerns, feel free to contact our customer support team.</p>
    <p>Thank you for choosing our bank!</p>
</div>
</body>
</html>
