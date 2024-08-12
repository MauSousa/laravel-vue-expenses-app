<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div class="center">
        <h1>Single expense information</h1>
    </div>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('laraveldaily.png') }}" alt="expenses app logo" width="200" />
            </td>
            <td class="w-half">
                <div>{{ $data['email'] }}</div>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Payment Method</th>
                <th>Description</th>
                <th>Store</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <tr class="items">
                <td>
                    {{ $data['payment'] }}
                </td>
                <td class="list-item">
                    {{ $data['message'] }}
                </td>
                <td>
                    {{ $data['store'] }}
                </td>
                <td>
                    {{ $data['amount'] }}
                </td>
                <td>
                    {{ $data['date'] }}
                </td>
            </tr>
        </table>
    </div>

    <style>
        .center {
            text-align: center;
            font-weight: lighter;
            font-family: 'Times New Roman', Times, serif;
        }

        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding-bottom: 0.7rem;
            text-align: center;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .list-item {
            white-space: pre-line;
        }
    </style>
</body>

</html>
