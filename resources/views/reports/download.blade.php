<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
        }

        .user-info, .report-details {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
        }

        h3 {
            margin-top: 0;
            color: #333;
        }

        .report-data {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }

        @media (max-width: 600px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="header">

    <?php
        $imagePath = public_path('assets/img/icons/logo.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $src = 'data:image/png;base64,' . $imageData;
    ?>
    <img src="{{ $src }}" alt="{{ config('app.name', 'PowerEye') }}" width="25"/>

    <h3>Sensor Data Report</h3>
    <p>{{ date('F d, Y') }}</p>
</div>

<div class="user-info">
    <h3>User Information</h3>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>{{ strtoupper($type) }}:</strong> {{ $entity->title }}</p>
</div>

<div class="report-details">
    <h3>Report Details</h3>
    <p><strong>Report Period:</strong> {{ $reportPeriod }}</p>
</div>

<div class="report-data">
    @if (isset($reportData))
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Timestamp</th>
                <th>Total Power (kW)</th>
                <th>Total Energy (kWh)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->timestamp }}</td>
                    <td>{{ $data->total_power }}</td>
                    <td>{{ $data->total_energy }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No Data to Show...</p>
    @endif
</div>

<div class="footer">
    <p>Contact: support@example.com</p>
    <p>Confidentiality Statement</p>
</div>

</body>
</html>
