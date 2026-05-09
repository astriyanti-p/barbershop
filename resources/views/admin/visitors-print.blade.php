<!DOCTYPE html>
<html>
<head>

    <title>
        Laporan Pengunjung
    </title>

    <style>

        body{
            font-family: Arial, sans-serif;
            padding:20px;
            color:#000;
        }

        h2{
            margin-bottom:5px;
        }

        p{
            margin-top:0;
            color:#555;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:10px;
            font-size:13px;
        }

        table th{
            background:#f2f2f2;
        }

        .text-center{
            text-align:center;
        }

        .summary{
            margin-top:20px;
            font-weight:bold;
        }

    </style>

</head>

<body>

    <h2>
        Laporan Monitoring Pengunjung
    </h2>

    <p>
        Dicetak:
        {{ now()->timezone('Asia/Jakarta')->format('d M Y H:i') }}
    </p>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Barbershop</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>

        </thead>

        <tbody>

            @foreach($visitors as $v)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $v->customer->name ?? '-' }}
                    </td>

                    <td>
                        {{ optional($v->barber->barberProfile)->shop_name ?? '-' }}
                    </td>

                    <td>
                        {{ $v->service->name ?? '-' }}
                    </td>

                    <td>
                        {{ $v->booking_date }}
                    </td>

                    <td>
                        {{ $v->booking_time ?? '-' }}
                    </td>

                    <td>
                        Berhasil
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="summary">

        Total Pengunjung:
        {{ $totalVisitors }} Orang

    </div>

    <script>
        window.print();
    </script>

</body>
</html>