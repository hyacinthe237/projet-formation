<div class="mt-10">
    @if($bookmarks->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Chassis</th>
                    <th>Year</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Added</th>
                </tr>
            </thead>

            <tbody>
                @foreach($bookmarks as $bookmark)
                    <tr>
                        <td class="bold">
                            <a target="_blank" href="/auctions?make={{ $bookmark->make }}&model={{ $bookmark->model }}&year={{ $bookmark->year }}&chassis={{ $bookmark->chassis }}">
                                {{ $bookmark->chassis }}
                            </a>
                        </td>
                        <td>{{ $bookmark->year }}</td>
                        <td>{{ $bookmark->make }}</td>
                        <td>{{ $bookmark->model }}</td>
                        <td>{{ date('d/m/Y', strtotime($bookmark->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4><strong>No bookmarks</strong></h4>
    @endif
</div>
