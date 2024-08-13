<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ public_path('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ public_path('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ public_path('favicon-16x16.png') }}">
    <link rel="manifest" href="/public/site.webmanifest">
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half" align="center">
                <img src="{{ public_path('images/cheems-samurai.svg') }}" alt="expenses app logo" width="150" height="150" class="b-border" />
            </td>
            <td class="w-full" align="center">
                <h2>{{ $date }} expense information</h2>
            </td>
            <td class="w-half">
                <div>{{ $email }}</div>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        @if ($data->count())
        <table class="products page-break">
            <tr>
                <th>Payment Method</th>
                <th>Description</th>
                <th>Store</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            @foreach ($data as $dataItem)
            <tr class="items">
                <td>
                    {{ $dataItem->payment->name }}
                </td>
                <td class="list-item">
                    {{ $dataItem->message }}
                </td>
                <td>
                    {{ $dataItem->store->name }}
                </td>
                <td>
                    {{ $dataItem->amount }}
                </td>
                <td>
                    {{ $dataItem->created_at }}
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p>No expenses yet!</p>
        @endif
    </div>

    <style>
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
            border-collapse: collapse;
        }

        table.products {
            border: solid 1px black;
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

        .b-solid {
            border: solid 1px black;
            width: 35%;
        }

        .b-border {
            border-radius: 5%;
        }
    </style>
</body>

</html>
