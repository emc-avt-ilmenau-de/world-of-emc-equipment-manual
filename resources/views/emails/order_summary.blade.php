<h2>Order Summary</h2>
<p>Dear {{ $order->OrderCustName }},</p>
<p>Thank you for your order. Here are the details:</p>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Components</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($summary as $item)
            <tr>
                <td>{{ $item['Product'] }}</td>
                <td>{{ $item['Components'] }}</td>
                <td>{{ $item['Quantity'] }}</td>
                <td>{{ $item['Total Price'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<p>We appreciate your business!</p>
