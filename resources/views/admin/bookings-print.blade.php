    <!DOCTYPE html>
    <html>
    <head>
        <title>Cetak Booking</title>

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

            .total{
                margin-top:20px;
                font-weight:bold;
            }
        </style>

    </head>
    <body>

        <h2>Laporan Booking</h2>

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
                    <th>Status</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

                @foreach($bookings as $b)

                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $b->customer->name ?? '-' }}
                        </td>

                        <td>
                            {{ $b->barber->barberProfile->shop_name ?? '-' }}
                        </td>

                        <td>
                            {{ $b->service->name ?? '-' }}
                        </td>

                        <td>
                            {{ $b->booking_date }}
                        </td>

                        <td>
                            {{ ucfirst($b->status) }}
                        </td>

                        <td>
                            Rp {{ number_format($b->total_amount,0,',','.') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <div class="total">
            Total Booking:
            {{ $bookings->count() }}
        </div>

        <script>
            window.print();
        </script>

    </body>
    </html>