<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Created</title>
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
            color: black;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-primary {
            background-color: #8FABB8;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #8FABB8;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">Report Created</div>
        <div class="card-body">
            <p>Hello, {{$fullname}}</p>
            <p>Your report has been successfully created.</p>
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $reportId }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $reportTitle }}</td>
                </tr>
                <tr>
                    <th>Details</th>
                    <td>{{ $reportDetails ."...."}}</td>
                </tr>
                <tr>
                    <th>Creator</th>
                    <td>{{ $fullname }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $createdAt }}</td>
                </tr>

                <tr>
                    <th>Attachments</th>
                    <td>{{$attachments }}</td>
                </tr>
            </table>
            @include('email.email-footer')

        </div>
    </div>
</div>
</body>
</html>
