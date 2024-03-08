<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ڕیپۆرتی وەسڵەکان</title>
</head>
<style>
    html,
    body {
        margin: 10px;
        padding: 10px;
        font-family: "vazirmatn", sans-serif;
        direction: rtl;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0px !important;
    }

    table thead th {
        height: 28px;
        text-align: center;
        font-size: 16px;

    }

    table,
    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
    }

    .heading {
        font-size: 24px;
        margin-top: 12px;
        margin-bottom: 12px;

    }

    .small-heading {
        font-size: 18px;
 
        text-align: right;
    }

    .total-heading {
        font-size: 18px;
        font-weight: 700;

    }

    .order-details tbody tr td:nth-child(1) {
        width: 20%;
    }

    .order-details tbody tr td:nth-child(3) {
        width: 20%;
    }

    .text-start {
        text-align: left;
    }

    .text-end {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .company-data span {
        margin-bottom: 4px;
        display: inline-block;

        font-size: 14px;
        font-weight: 400;
    }

    .no-border {
        border: 1px solid #fff !important;
    }

    .bg-blue {
        background-color: #414ab1;
        color: #fff;
    }
</style>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-end"> سیستمی بەڕێوەبردنی خەرجی </h2><br>
                    <p>ڕاپۆرتی وەسڵەکان</p>
                </th>
                <th width="50%" colspan="3" class="text-end company-data">
                    <h4>بەرواری : {{ now() }}</h4><br>
                    @if ($data['showNote'])
                        <p class="text-end small-heading" >تێبینی:</p><br>
                        <p  style="color: rgb(63, 59, 59);font-size: 14px;text-align: right;margin-top: 10px !importand;">{{ $data['message'] }}</p>
                    @endif
                </th>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <th class="no-border text-end heading" >
                    وەسڵەکان
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ناوی بەکارهێنەر</th>
                <th>ژمارەی وەسڵ</th>
                <th>بڕی گشتی پارە</th>
                <th>ڕۆژوو بەروار</th>
                <th>تێبینی </th>

            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp

            @foreach ($data['invoices'] as $invoice)
                <tr>
                    <td>{{ $invoice->user->name }}</td>
                    <td>{{ $invoice->invoiceNumber }}</td>
                    <td>{{ $invoice->totalAmount . ' د.ع' }} </td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->note }}</td>
                </tr>
                @php
                    $totalAmount += $invoice->totalAmount;
                @endphp
            @endforeach

            <tr>
                <td colspan="4" class="total-heading">کۆی گشتی </td>
                <td colspan="1" class="total-heading">{{ $totalAmount . ' د.ع' }}</td>
            </tr>
        </tbody>
    </table>
    @if ($data['withItems'])
        <table>
            <thead>
                <tr>
                    <th class="no-border text-end heading" >
                        مادەکان
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th>ژمارەی وەسڵ</th>
                    <th>کۆدی مادە</th>
                    <th>ناوی مادە</th>
                    <th>بڕ (دانە)</th>
                    <th>نرخی یەک دانە</th>
                    <th>بڕی گشتی</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['invoices'] as $invoice)
                    @foreach ($invoice->invoiceItems as $item)
                        <tr>
                            <td>{{ $item->invoice->invoiceNumber }}</td>
                            <td>{{ $item->material->code }}</td>
                            <td>{{ $item->material->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->unitPrice . ' د.ع' }} </td>
                            <td>{{ $item->unitPrice * $item->quantity . ' د.ع' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="total-heading">نرخی گشتی </td>
                        <td colspan="1" class="total-heading">{{ $invoice->totalAmount . ' د.ع' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
