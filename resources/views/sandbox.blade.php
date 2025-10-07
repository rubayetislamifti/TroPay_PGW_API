<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandbox Checkout — TroPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        .checkout-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        .gateway-btn {
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .gateway-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(0,0,0,0.15);
        }
        .bkash { background: #e2136e; color: #fff; }
        .nagad { background: #ff7300; color: #fff; }
        .rocket { background: #4b0082; color: #fff; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">TroPay Sandbox Checkout</h2>
        <p class="text-muted small">Test your payment using sandbox environment</p>
    </div>

    <div class="checkout-card p-4 p-md-5 mx-auto" style="max-width: 600px;">
        <div class="text-center mb-4">
            <h4 class="fw-semibold mb-1">Amount: <span class="text-primary">{{ number_format($amount, 2) }}</span> BDT</h4>
            <p class="text-muted small">Reference: {{ $reference ?? 'N/A' }}</p>
        </div>

        <div class="border-top my-4"></div>

        <div class="text-center mb-3">
            <h5 class="fw-semibold">Select Payment Gateway</h5>
        </div>

        <div class="d-grid gap-3">
            <!-- bKash -->
            <form action="{{ route('payment.init') }}" method="POST">
                @csrf
                <input type="hidden" name="gateway" value="bkash">
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="reference" value="{{ $reference }}">
                <button type="submit" class="btn gateway-btn bkash w-100">
                    <i class="bi bi-phone"></i> Pay with bKash (Sandbox)
                </button>
            </form>

            <!-- Nagad -->
            <form action="#" method="POST">
                <button type="button" class="btn gateway-btn nagad w-100" disabled>
                    <i class="bi bi-wallet2"></i> Pay with Nagad (Coming Soon)
                </button>
            </form>

            <!-- Rocket -->
            <form action="#" method="POST">
                <button type="button" class="btn gateway-btn rocket w-100" disabled>
                    <i class="bi bi-bank"></i> Pay with Rocket (Coming Soon)
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
