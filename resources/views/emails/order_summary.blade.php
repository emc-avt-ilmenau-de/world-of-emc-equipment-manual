<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.order_summary') }}</title>
</head>

<body>
    <h1>{{ __('messages.order_summary') }}</h1>
    <h2>{{ __('messages.thank_you') }}, {{ $customer->OrderCustName }}</h2>
    <p>{{ __('messages.order_summary1') }}</p>
    <table border="1" cellspacing="0" cellpadding="8">
        <thead>
            <tr>
                <th>{{ __('messages.p_name') }}</th>
                <th>{{ __('messages.c_name') }}</th>
                <th>{{ __('messages.quantity') }}</th>
                <th>{{ __('messages.total_price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($basket as $item)
            <tr>
                <td>{{ $item['product_name'] ?? 'Unknown Product' }}</td>
                <td>
                    @if (!empty($item['components']))
                    <ul>
                        @foreach ($item['components'] as $component)
                        <li>
                            {{ $component['name'] ?? 'Unnamed Component' }}
                            ({{ $component['value'] ?? 'No Value' }})
                        </li>
                        @endforeach
                    </ul>
                    @else
                    No Components
                    @endif
                </td>
                <td>{{ $item['quantity'] ?? 0 }}</td>
                <td>{{ number_format($item['total_price'] ?? 0, 2) }} EUR</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>{{ __('messages.total_price1') }}</strong></td>
                <td><strong>{{ number_format($basket_total, 2) }} EUR</strong></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <p>
        Für weitere Informationen stehe ich Ihnen gern zur Verfügung./
        For further information please do not hesitate to contact me.
    </p>
    <br>
    <p>
        Mit freundlichen Grüßen/Best regards<br>
        <strong>AVT GmbH</strong><br>
        Automatisierungs- und Verfahrenstechnik<br>
        Am Hammergrund 1<br>
        98693 Ilmenau<br>
        Germany<br>
        Tel +49 (0)3677 647956<br>
        Mobil +49 (0)172 8902611<br>
        Web: <a href="http://www.avt-ilmenau.de">www.avt-ilmenau.de</a><br>
        Mail: <a href="mailto:emc@avt-ilmenau.de">emc@avt-ilmenau.de</a><br>
        Handelsregister: Jena HRB 300072<br>
        USt.-IdNr./VAT No.: DE171084388<br>
        Geschäftsführer/CEO: Dr. J. Pospiech
    </p>
</body>

</html>