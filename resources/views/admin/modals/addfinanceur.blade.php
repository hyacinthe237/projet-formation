{{-- New project modal  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="addFinanceurModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open([ 'method'  => 'post', 'route' => 'financeurs.store', 'class' => '_form' ]) !!}

                    <h4>Ajouter un financeur</h4>

                    <hr>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nom du financeur</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Nom du financeur" required>
                        </div>
                    </div>

                    <div class="mt-20 pb-10 text-right">
                        <a class="btn btn-teal mr-10 btn-lg" data-dismiss="modal">
                            <i class="ion-reply"></i>
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ion-plus"></i>
                            Ajouter ce financeur
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
