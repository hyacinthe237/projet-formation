@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="title">
            Settings
        </div>
    </div>

    <section class="page page-white">
        <div class="container-fluid">

            @include('errors.list')

            <form class="_form" action="" method="post">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Car Hold Duration</label>
                            <select class="form-control input-lg" name="car_hold_on_duration">
                                @for ($i=1; $i < 60; $i++)
                                    <option value="{{ $i }}" {{ $set->car_hold_on_duration == $i ? 'selected' : ''}}>{{ $i }} Minutes</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Pay Later Duration</label>
                            <select class="form-control input-lg" name="pay_later_duration">
                                @for ($i=1; $i < 49; $i++)
                                    <option value="{{ $i }}" {{ $set->pay_later_duration == $i ? 'selected' : ''}}>{{ $i }} Hours</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <h4 class="mt-20">Application Details</h4>
                <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Application name</label>
                            <input type="text" name="app_name" value="{{ $set->app_name }}" class="form-control input-lg" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Admin email</label>
                            <input type="email" name="admin_email" value="{{ $set->admin_email }}" class="form-control input-lg" required>
                        </div>
                    </div>
                </div>





                <h4 class="mt-20">Business Details</h4>

                <div class="row mt-20">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Business Contact Person</label>
                            <input type="text" name="business_to_name" value="{{ $set->business_to_name }}" class="form-control input-lg ">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Business Contact Email</label>
                            <input type="email" name="business_to_email" value="{{ $set->business_to_email }}" class="form-control input-lg ">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Business Phone</label>
                            <input type="text" name="phone" value="{{ $set->phone }}" class="form-control input-lg " required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Business Phone 2</label>
                            <input type="text" name="phone2" value="{{ $set->phone2 }}" class="form-control input-lg " required>
                        </div>
                    </div>
                </div>
                {{-- End of row  --}}


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address_street" value="{{ $set->address_street }}" class="form-control input-lg ">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Suburb</label>
                            <input type="text" name="address_suburb" value="{{ $set->address_suburb }}" class="form-control input-lg ">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Postcode</label>
                            <input type="text" name="address_postcode" value="{{ $set->address_postcode }}" class="form-control input-lg ">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="address_state" value="{{ $set->address_state }}" class="form-control input-lg ">
                        </div>
                    </div>
                </div>


                <div class="mt-20 text-right">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="ion-checkmark"></i>
                        Update Settings
                    </button>
                </div>

            </form>
        </div>
    </section>


@endsection
