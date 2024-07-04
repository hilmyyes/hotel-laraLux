<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Receipt</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nowrap {
            white-space: nowrap;
        }

        .img-fluid {
            max-width: 150px;
        }

        .customer-details {
            padding: 15px;
            margin-bottom: 20px;
        }

        .customer-details .row div {
            margin-bottom: 10px;
        }

        .container {
            max-width: 1600px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container border p-4 mt-5">
        <div class="alert alert-success">
            {{ $status }} <a class="btn btn-outline-success" href="{{ route('laralux.index') }}">Continue
                Shopping</a>
        </div>
        <div class="table-responsive mb-4">
            <div class="customer-details">
                <div class="row">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-flex justify-content-center">
                    <div class="pl-5 ml-5">
                        <p>Your check must include:</p>
                        <ul>
                            <li>Payment amount: Rp
                                {{ number_format($total + ($total * 11) / 100 + ($total * 3) / 100, 2) }}
                            </li>
                            <li>Payable to the order of {{ $customer->name }}</li>
                            <li>Mail to {{ $customer->email }}</li>
                            <li>Do not forget to include your order reference {{ $transaction->id }}</li>
                        </ul>
                        <div class="status border p-3 pr-5 mt-5">
                            <h5><b>Order Status:</b> Confirmed </h5>
                            <h5><b>Order Reference:</b> {{ $transaction->id }} </h5>
                            <h5><b>Date: </b> {{ date('d M Y', strtotime($transaction->transaction_date)) }}</h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="customer-details border p-4 mt-5">
                <h5>Customer Details</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Room Image</th>
                        <th class="text-center">Hotel Name</th>
                        <th class="text-center">Room Description</th>
                        <th class="text-center">Check-in Date</th>
                        <th class="text-center">Check-out Date</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="img d-flex justify-content-center align-items-center">
                                    @if ($item['photo'] == null)
                                        <a href="#"><img src="{{ asset('images/blank.jpg') }}" alt="Image"
                                                class="img-fluid"></a>
                                    @else
                                        <a href="#"><img src="{{ asset('images/' . $item['photo']) }}"
                                                alt="Image" class="img-fluid"></a>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>{{ date('d/m/Y', strtotime($item['checkin_date'])) }}</td>
                            <td>{{ date('d/m/Y', strtotime($item['checkin_date'] . ' + ' . $item['duration'] . ' days')) }}
                            </td>
                            <td>{{ 'Rp ' . number_format($item['duration'] * $item['price'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No items in the cart</td>
                        </tr>
                    @endforelse
                    @if ($cart)
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" class="text-left"><strong>Total Rooms Cost (exc. Tax & Points)</strong></td>
                            <td><strong>{{ 'Rp ' . number_format($total, 2) }}</strong></td>
                        </tr>
                        @if ($points > 0)
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2" class="text-left"><strong>Value Points Redeemed</strong></td>
                                <td><strong>{{ '-' . number_format($points * 100000, 2) }}</strong></td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" class="text-left"><strong>Tax (11%)</strong>
                            </td>
                            <td><strong>{{ 'Rp ' . number_format((($total - $points * 100000) * 11) / 100, 2) }}</strong>
                            </td>
                        </tr>

                        @if (floor(($total - $points * 100000) / 300000) > 0)
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" class="text-left"><strong>Points Earned:</strong>
                            </td>
                            <td><strong>{{ '+' . floor(($total - $points * 100000) / 300000) }}</strong>
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2" class="text-left"><strong>Due Amount</strong></td>
                            <td>
                                <strong>{{ 'Rp ' . number_format($total - $points * 100000 + (($total - $points * 100000) * 11) / 100, 2) }}</strong>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <i>Your booking has been received successfully and we are looking forward to welcoming you.</i>
        </div>
    </div>

    <!-- Bootstrap and other JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
