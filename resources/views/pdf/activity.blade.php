<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            direction: rtl;
            font-family: "Vazirmatn", sans-serif;
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
</head>

<body style="font-family: nrt">
    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-end"> سیستمی بەڕێوەبردنی خەرجی </h2>
                </th>
               ڕیپۆرتی ئەکتیڤیتی بەکارهێنەران
            </tr>
        </thead>
    </table>


        <table>
            <thead>
                <tr>
                    <th class="no-border text-end heading" colspan="5">
                        مادەکان
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th> ناوی بەکارهێنەر</th>
                    <th>بەش </th>
                    <th>کردار </th>
                    <th> ڕۆژوو و بەروار</th>
             
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->user->name }}</td>
                    <td>{{ $activity->subject }}</td>
                    <td>{{ $activity->action }}</td>
                    <td>{{ $activity->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</body>

</html>
