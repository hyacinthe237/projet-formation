<div class="mt-10">
    @if($favs->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Auction ID</th>
                    <th>Auction Date</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Car</th>
                </tr>
            </thead>

            <tbody>
                @foreach($favs as $fav)
                    <tr>
                        <td class="bold">
                            @if ($fav->isOver())
                                <a href="{{ route('past-auction', $fav->auction_id)}}" target="_blank">
                            @else
                                <a href="{{ route('auction', $fav->auction_id)}}" target="_blank">
                            @endif
                                {{ $fav->auction_id }}
                            </a>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($fav->start)) }}</td>
                        <td>${{ $fav->amount }}</td>
                        <td>${{ $fav->total }}</td>
                        <td>{{ $fav->toString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4><strong>No favourite auction</strong></h4>
    @endif
</div>
