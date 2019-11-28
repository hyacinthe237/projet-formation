@extends('admin.body')

@section('body')
<div class="page-title">
    <h2>{{ $user->name() }}</h2>
    <h4>Balance: ${{ $user->convertedBalance() }}</h4>
</div>


<section class="container-fluid mt-20">

    @include('errors.list')

    <div class="block pb-20">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
            <li><a data-toggle="tab" href="#bids">Bids</a></li>
            <li><a data-toggle="tab" href="#transactions">Transactions</a></li>
            <li><a data-toggle="tab" href="#favs">Favourites</a></li>
            <li><a data-toggle="tab" href="#bookmarks">Bookmarks</a></li>
            <li><a data-toggle="tab" href="#docs">Documents</a></li>
            <li><a data-toggle="tab" href="#security">Security</a></li>
        </ul>

        <div class="block-content tab-content">
            <div id="profile" class="tab-pane fade in active">
                @include('admin.users.tabs.profile')
            </div>

            <div id="bids" class="tab-pane">
                @include('admin.users.tabs.bids')
            </div>

            <div id="transactions" class="tab-pane">
                @include('admin.users.tabs.transactions')
            </div>

            <div id="favs" class="tab-pane">
                @include('admin.users.tabs.favourites')
            </div>

            <div id="bookmarks" class="tab-pane">
                @include('admin.users.tabs.bookmarks')
            </div>

            <div id="docs" class="tab-pane">
                @include('admin.users.tabs.documents')
            </div>

            <div id="security" class="tab-pane">
                @include('admin.users.tabs.security')
            </div>
        </div>
    </div>
</section>



@include('admin.modals.topup')
@endsection
