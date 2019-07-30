
<div class="mt-20">
    <a class="btn btn-lg btn-dark" data-toggle="modal" data-target="#topupModal">
        <i class="flaticon-plus"></i> Topup Balance
    </a>
</div>



<div class="mt-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Date</th>
                <th>By</th>
            </tr>
        </thead>

        <tbody>
            @foreach($topups as $topup)
                <tr>
                    <td class="bold">{{ $topup->convertedAmount() }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($topup->created_at)) }}</td>
                    <td>{{ $topup->admin->name() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- End of table -->
