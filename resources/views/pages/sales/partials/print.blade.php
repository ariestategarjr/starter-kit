<table class="tg tg-center">
    <thead>
        <tr>
            <th class="tg-baqh" colspan="3"><span style="font-weight:bold">Toko Tokoan</span></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="tg-baqh" colspan="3">Pasar Karanganyar, Kebumen</td>
        </tr>
        <tr>
            <td class="tg-baqh" colspan="3">080123456789</td>
        </tr>
        <tr>
            <td class="tg-baqh" colspan="3" style="padding: 5px 0px;"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="3">=============================================</td>
        </tr>

        @foreach ($result as $row)
            <tr>
                <td class="tg-0lax">{{ $row->name }}</td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax"></td>
            </tr>
            <tr>
                <td class="tg-0lax">{{ $row->amount }} x {{ number_format($row->selling_price, 0, ',', '.') }}</td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax">{{ number_format($row->sub_total, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        <tr>
            <td class="tg-0lax" colspan="3">=============================================</td>
        </tr>
        <tr>
            <td class="tg-0lax">Total</td>
            <td class="tg-0lax">Rp.</td>
            <td class="tg-0lax" id="print_total"></td>
        </tr>
        <tr>
            <td class="tg-0lax">Bayar</td>
            <td class="tg-0lax">Rp.</td>
            <td class="tg-0lax" id="print_payment">-</td>
        </tr>
        <tr>
            <td class="tg-0lax">Kembali</td>
            <td class="tg-0lax">Rp.</td>
            <td class="tg-0lax" id="print_change">-</td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="3"></td>
        </tr>
        <tr>
            <td class="tg-baqh" colspan="3" style="padding: 5px 0px;"></td>
        </tr>
        <tr>
            <td class="tg-wp8o" colspan="3" id="print_date">================= 2023/03/03 =================</td>
        </tr>
        <tr>
            <td class="tg-wp8o" colspan="3" id="print_time">================= 00:00 =================</td>
        </tr>
    </tbody>
</table>
