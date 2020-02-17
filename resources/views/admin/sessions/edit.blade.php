@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('sessions.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            Edit session
        </div>
    </div>

{!! Form::model($session, ['method' => 'PATCH', 'route' => ['sessions.update', $session->id], 'class' => '_form' ]) !!}

    <section class="container-fluid mt-20">

        @include('errors.list')
        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                  <div class="row mt-20">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="name" class="form-control input-lg" value="{{ $session->name }}" required>
                        </div>
                    </div>

                    {{-- <div class="col-sm-4">
                        <div class="form-group">
                            <label>Période</label>
                            <div class="form-select grey">
                                <select name="period" class="form-control input-lg">
                                    <option value="trimestre" {{ $session->period == 'trimestre' ? 'selected' : '' }}>Trimestre</option>
                                    <option value="semestre" {{ $session->period == 'semestre' ? 'selected' : '' }}>Semestre</option>
                                    <option value="annuelle" {{ $session->period == 'annuelle' ? 'selected' : '' }}>Annuelle</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-select grey">
                                <select name="status" class="form-control input-lg">
                                    <option value="pending" {{ $session->status == 'pending' ? 'selected' : '' }}>En cours</option>
                                    <option value="passed" {{ $session->status == 'passed' ? 'selected' : '' }}>Passée</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group text-right mt-20">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="ion-checkmark"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
{!! Form::close() !!}
@endsection
