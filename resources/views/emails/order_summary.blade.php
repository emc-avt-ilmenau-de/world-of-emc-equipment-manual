<!DOCTYPE html>
<html>
<head>
    <title>Order Summary</title>
</head>
<body>
    <h1>Order Summary</h1>
    <p>Thank you, {{ $customer['OrderCustName'] }}!</p>
    <p>Here is your order summary:</p>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Components</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($basket as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>
                        @foreach ($item['components'] as $component)
                            {{ $component['name'] }} ({{ $component['value'] }}) @if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['total_price'], 2) }} EUR</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
