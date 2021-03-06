<table>
    <thead>
        <tr><div class=text-center>
            <th colspan="7">Laporan Transaksi</th>
            </div>
        </tr>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Tanggal Sewa</th>
            <th>Pelanggan</th>
            <th>NIK</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transaction as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->invoice_no }}</td>
            <td>{{ Carbon\Carbon::parse($row->rent_date)->format('Y-m-d') }}</td>
            <td>{{ title_case($row->customer->name) }}</td>
            <td>{{ title_case($row->customer->nik) }}</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->amount + $row->compensation }}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="6"></td>
            <td>{{$transaction->sum('amount') + $transaction->sum('compensation')}}</td>
        </tr>
    </tbody>
</table>
