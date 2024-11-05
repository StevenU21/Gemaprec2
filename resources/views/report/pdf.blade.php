<!DOCTYPE html>
<html>

<head>
    <title>Report PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Report Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $report->id }}</td>
        </tr>
        <tr>
            <th>Code</th>
            <td>{{ $report->code }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>
                <ul>
                    @foreach (explode("\n", $report->description) as $line)
                        <li>{{ $line }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <th>Client Name</th>
            <td>{{ $report->client->user->name }}</td>
        </tr>
        <tr>
            <th>Maintenance Code</th>
            <td>{{ $report->maintenance->code }}</td>
        </tr>
        <tr>
            <th>Maintenance Start Date</th>
            <td>{{ $report->maintenance->start_date }}</td>
        </tr>
        <tr>
            <th>Maintenance End Date</th>
            <td>{{ $report->maintenance->end_date }}</td>
        </tr>
        <tr>
            <th>Maintenance Status</th>
            <td>{{ $report->maintenance->status }}</td>
        </tr>
        <tr>
            <th>Maintenance Observations</th>
            <td>{{ $report->maintenance->observations }}</td>
        </tr>
        <tr>
            <th>Computer Name</th>
            <td>{{ $report->maintenance->computer->name }}</td>
        </tr>
        <tr>
            <th>Computer Brand</th>
            <td>{{ $report->maintenance->computer->brand->name }}</td>
        </tr>
    </table>
</body>

</html>
