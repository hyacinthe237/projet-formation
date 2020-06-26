@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('communes.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit commune
        </div>
    </div>



    <section class="container-fluid mt-20">
      {!! Form::model($commune, ['method' => 'PUT', 'route' => ['communes.update', $commune->id], 'class' => '_form' ]) !!}

        @include('errors.list')

        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ $commune->name }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" name="lon" class="form-control input-lg" value="{{ $commune->lon }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="lat" class="form-control input-lg" value="{{ $commune->lat }}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Région</label>
                            <div class="form-select grey">
                                <select name="departement_id" class="form-control input-lg" value="{{ old('departement_id') }}">
                                    @foreach($departements as $item)
                                        <option value="{{ $item->id }}" {{ $commune->departement_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group text-right mt-20">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ion-checkmark"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      {!! Form::close() !!}
@endsection
