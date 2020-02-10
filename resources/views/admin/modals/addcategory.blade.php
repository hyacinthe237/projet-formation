{{-- New project modal  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="addCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open([ 'method'  => 'post', 'route' => 'categories.store', 'class' => '_form' ]) !!}

                    <h4>Ajouter une catégorie</h4>

                    <hr>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Nom de la catégorie</label>
                            <input type="text" name="name" class="form-control input-lg" placeholder="Nom de la catégorie" required>
                        </div>
                    </div>

                    <div class="mt-20 pb-10 text-right">
                        <a class="btn btn-teal mr-10 btn-lg" data-dismiss="modal">
                            <i class="ion-reply"></i>
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ion-plus"></i>
                            Ajouter cette catégorie
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
