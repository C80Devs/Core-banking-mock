<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff !important;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff !important;
        }

        .btn-primary:hover {
            background-color: #0056b3 !important;
            border-color: #0056b3 !important;
        }

        p {
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Password Reset</div>
                <div class="card-body">
                    <p>Hello,</p>
                    <p>You are receiving this email because a password reset request was made for your account.</p>
                    <p>Please click the button below to reset your password:</p>
                    <p>
                        <a href="{{ $url }}" class="btn btn-primary">Reset Password</a>
                    </p>
                    @include('email.email-footer')

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
