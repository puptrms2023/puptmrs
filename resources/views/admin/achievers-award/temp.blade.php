<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <style type="text/css">
        * {
            margin: 0;
            padding: 0
        }

        body {
            margin: 0;
            height: 8.27in;
            width: 11.69in;
            background-image: url('admin/img/cert_layout1.jpg');
            background-size: 11.69in 8.27in;
            /* Not sure whether it works with DOMPDF. So, using a background of actual size. */
            background-repeat: no-repeat;
        }

        .name {
            font-family: 'Times New Roman', Times, serif;
            font-size: .60in;
            line-height: .44in;
            font-weight: 700;
            color: #000000;
            margin-top: 4.12in;
            text-align: center;
        }

        .description {
            margin-top: 35px;
            text-align: center;
            font-weight: 500;
        }

        .date {
            margin-top: 10px;
            text-align: center;
            font-weight: 500;
        }

        table {
            width: 63%;
            border-collapse: collapse;
            margin: 50px auto;
            position: relative;
        }

        .table2 td,
        th {
            border: none;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 15px;
            right: 50px;
            height: 120px;
            font-family: "Arial", "sans-serif";
            font-size: 10px;
        }

        .scan {
            display: inline-block;
            color: white;
            margin-left: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .qr {
            width: 25%;
            float: left;
        }
    </style>
</head>

<body>
    <div class="name">
        @if ($students->users->middle_name == '')
            {{ $students->users->first_name . ' ' . $students->users->last_name }}
        @else
            {{ $students->users->first_name . ' ' . $students->users->middle_name . ' ' . $students->users->last_name }}
        @endif
    </div>
    <div class="description">for the remarkable academic performance as a student of this institution for obtaning<br>
        a General Weighted Average of {{ $students->gwa }} qualified for the Achiever's Award for the S.Y.
        {{ $students->school_year }}.
    </div>
    <div class="date">Given this day, 1st of September 2022 via Google Mail</div>
    <table class="table2">
        <tr>
            <td width="21%">
                <b>Mr. Mhel P. Garcia</b><br>
                Branch Registrar
            </td>
            <td width="21%">
                <b>Mr. Israel G. Ortega</b><br>
                Overall Chair-Recognition 2022
            </td>
            <td width="21%">
                <b>Ms. Bernadette I. Canlas</b><br>
                Head of Student Services
            </td>
        </tr>
    </table>
    <table class="table2">
        <tr>
            <td>
                <b>Marissa B. Ferrer, DEM, RPsy</b><br>
                Branch Director
            </td>
        </tr>
    </table>
    {{-- <img src="data:image/png;base64, {!! $qrcode !!}"> --}}
    <footer>
        <div class="qr">
            <img src="data:image/png;base64, {!! $qrcode !!}" width="25%" alt="">
            <span class="scan">
                Scan QR Code for verification<br>
                Date Generated: 09-01-22
            </span>
        </div>
    </footer>
</body>

</html>
