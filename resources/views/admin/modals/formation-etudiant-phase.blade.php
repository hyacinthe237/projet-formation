{{-- New project modal  --}}
<div class="modal fade" tabindex="-1" role="dialog" id="formationEtudiantPhaseModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open([ 'method'  => $method ? $method : 'delete', 'route' => [ $route, $resource->id ] ]) !!}

                    <h4>modification de la phase</h4>

                    {{-- <h5 class="mt-20">{{ $message }}</h5> --}}

                    <div class="row">
                      <div class="col-sm-12">
                          <label>Sélectionnez la phase</label>
                          <div class="row">
                              @foreach ($resource->phases as $phase)
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          @if ($resource->phases->contains('id', $phase->id))
                                              <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                  <input type="checkbox" name="phases[]" value="{{ $phase->id }}" checked>
                                                  <span class="mr-10"></span> {{ $phase->title }}
                                              </label>
                                          @else
                                              <label class="css-input css-checkbox css-checkbox-primary mr-20">
                                                  <input type="checkbox" name="phases[]" value="{{ $phase->id }}">
                                                  <span class="mr-10"></span> {{ $phase->title }}
                                              </label>
                                          @endif
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                    </div>

                    <div class="mt-20 pb-10 text-right">
                        <a class="btn btn-teal mr-10 btn-lg" data-dismiss="modal">
                            <i class="ion-reply "></i>
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="ion-trash-b"></i>
                            {{ isset($confirm) ? $confirm : 'Confirmer' }}
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
