<div class="mt-10">
    @if($bids->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Auction ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Total</th>
                    <th>Deposit</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($bids as $item)
                    <tr data-href="/admin/bids/{{ $item->id }}">
                        <td>{{ $item->auction_id }}</td>
                        <td>{{ $item->make }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->deposit }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End of table -->
    @else
        <h4><strong>No bid</strong></h4>
    @endif
</div>
