<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cannot Create Reports</title>
    <style>
        body {
            background-color: #e8e9f3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            margin: 0 auto;
            max-width: 600px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #23254D;
            color: #ffffff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 30px;
            color: #23254D;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #23254D;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #0e1039;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">Cannot Create Report</div>
        <div class="card-body">
            <p>Hello,</p>
            <p>You cannot create reports yet because you do not have a registered account.</p>
            <p>Please follow <a href="{{$url }}">this link</a> to sign up.</p>
            <p><b>Note: <i>If you signup with this {{$email}}, the report will automatically be created for you.</i></b></p>
                @include('email.email-footer')
        </div>
    </div>
</div>
</body>
</html>
