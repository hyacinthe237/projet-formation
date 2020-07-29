{{-- New project modal  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="{{ $modalId }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open([ 'method'  => 'POST', 'route' => $route, 'class' => '_form' ]) !!}

                    <h4>{{ $title }}</h4>

                    <hr>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{ $label }}</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="{{ $placeholder }}" required>
                        </div>
                    </div>

                    <div class="mt-20 pb-10 text-right">
                        <a class="btn btn-teal mr-10 btn-lg" data-dismiss="modal">
                            <i class="ion-reply"></i>
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ion-plus"></i>
                            Ajouter
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
