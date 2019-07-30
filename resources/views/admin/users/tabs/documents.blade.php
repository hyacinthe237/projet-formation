<div class="mt-10">
    @if($documents->count())
        <table class="table table-striped">
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>
                            <a href="{{ route('admin.download', $document->id) }}">
                                <i class="flaticon-download mr-10"></i>
                            </a>
                            {{ $document->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4><strong>No document submitted yet</strong></h4>
    @endif
</div>
