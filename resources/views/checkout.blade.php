<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }
        .gateway-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .gateway-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.15);
        }
        .gateway-logo {
            height: 60px;
            object-fit: contain;
        }
        .btn-pay {
            border-radius: 30px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Choose a Payment Method</h2>
        <p class="text-muted mb-0">Select your preferred gateway to proceed with the payment.</p>
    </div>

    <div class="row justify-content-center g-4">

        <!-- bKash -->
        <div class="col-md-4">
            <div class="card gateway-card text-center p-4">
                <img src="{{ asset('images/gateways/bkash.png') }}" alt="bKash" class="gateway-logo mx-auto mb-3">
                <h5 class="fw-semibold">bKash</h5>
                <p class="text-muted small">Pay securely using your bKash account.</p>
                    <form action="{{route('payment.init')}}" method="post">
                        @csrf
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <input type="hidden" name="reference" value="{{$reference}}">
                        <button type="submit" class="btn btn-primary btn-pay px-4">Pay with bKash</button>
                    </form>

            </div>
        </div>

        <!-- Nagad -->
        <div class="col-md-4">
            <div class="card gateway-card text-center p-4">
                <img src="{{ asset('images/gateways/nagad.png') }}" alt="Nagad" class="gateway-logo mx-auto mb-3">
                <h5 class="fw-semibold">Nagad</h5>
                <p class="text-muted small">Fast and secure mobile banking with Nagad.</p>
                <a href="#" class="btn btn-danger btn-pay px-4">Pay with Nagad</a>
            </div>
        </div>

        <!-- Rocket -->
        <div class="col-md-4">
            <div class="card gateway-card text-center p-4">
                <img src="{{ asset('images/gateways/rocket.png') }}" alt="Rocket" class="gateway-logo mx-auto mb-3">
                <h5 class="fw-semibold">Rocket</h5>
                <p class="text-muted small">Pay using DBBL Rocket wallet.</p>
                <a href="#" class="btn btn-secondary btn-pay px-4">Pay with Rocket</a>
            </div>
        </div>

    </div>
</div>
</body>
</html>
