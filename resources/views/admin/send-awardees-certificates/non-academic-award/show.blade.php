<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $award_name }} Certificate</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0
        }

        body {
            margin: 0;
            height: 8.27in;
            width: 11.69in;
            background-image: url('admin/img/NA.jpg');
            background-size: 11.69in 8.27in;
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

        .img-sig {
            margin-top: -30px;
        }

        .highlight {
            font-size: 17px;
        }
    </style>
</head>

<body>
    <div class="name">
        @if ($mname == '')
            {{ $fname . ' ' . $lname }}
        @else
            {{ $fname . ' ' . $mname . ' ' . $lname }}
        @endif
    </div>
    <div class="description">
        @if ($award == '1' || $award == '2' || $award == '3' || $award == '4')
            for the remarkable performance in this institution, receiving the<br>
            <span class="highlight">{{ $award_name }}</span> in the S.Y. {{ $sy }}.
        @elseif ($award == '5' || $award == '6')
            for the remarkable service and performance<br>
            in the institution for the Academic Year {{ $sy }}.
        @elseif ($award == '7')
            for the representing the institution/organization on the Academic Year {{ $sy }}.
        @elseif ($award == '8' || $award == '9')
            for the remarkable performance and outstanding participation in<br>
            the <span class="highlight">{{ $award_name }}</span> for the <br> Academic Year {{ $sy }}.
        @endif

    </div>
    <div class="date"><span class="highlight">Given this
            {{ str_replace(Date::now()->format('jS'), Date::now()->format('jS') . ' day', Date::now()->format('jS \of F Y')) }}
        </span> via Google Mail</div>
    <table class="table2">
        <tr>
            <td width="21%">
                @if (name1Certificate()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name1Certificate()->signature) }}"
                            width="100" />
                    </div>
                @endif
                <b>{{ name1Certificate()->rep_name }}</b><br>
                {{ name1Certificate()->position }}
            </td>
            <td width="21%">
                @if (name1Certificate()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name2Certificate()->signature) }}"
                            width="100" />
                    </div>
                @endif
                <b>{{ name2Certificate()->rep_name }}</b><br>
                {{ name2Certificate()->position }}
            </td>
            <td width="21%">
                @if (name3Certificate()->signature != null)
                    <div class="img-sig">
                        <img src="{{ public_path('uploads/signature/' . name3Certificate()->signature) }}"
                            width="100" />
                    </div>
                @endif
                <b>{{ name3Certificate()->rep_name }}</b><br>
                {{ name3Certificate()->position }}
            </td>
        </tr>
    </table>
    <table class="table2">
        <tr>
            @if (!empty(name4Certificate()))
                <td>
                    @if (name4Certificate()->signature != null)
                        <div class="img-sig">
                            <img src="{{ public_path('uploads/signature/' . name4Certificate()->signature) }}"
                                width="100" />
                        </div>
                    @endif
                    <b>{{ name4Certificate()->rep_name }}</b><br>
                    {{ name4Certificate()->position }}
                </td>
            @endif
        </tr>
    </table>
    <footer>
        <div class="qr">
            <img src="data:image/png;base64, {!! $qrcode !!}" width="25%" alt="">
            <span class="scan">
                Scan QR Code for verification<br>
                Date Generated: {{ date('m-d-y') }}
            </span>
        </div>
    </footer>
</body>

</html>
