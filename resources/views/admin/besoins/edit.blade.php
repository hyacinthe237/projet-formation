@extends('admin.body')


@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('besoins.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Cancel
            </a>
        </div>

        <div class="title">
            QUESTIONNAIRE EN VUE DE FAIRE LA CARTOGRAPHIE DES BESOINS EN FORMATION
        </div>
    </div>
<section class="container-fluid mt-20">
    {!! Form::model($besoin, ['method' => 'PUT', 'route' => ['besoins.update', $besoin->number], 'class' => '_form' ]) !!}

            @include('errors.list')
            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">
                    <div class="row">
                      {{-- <div class="row"> --}}

                          <div class="col-sm-12 mt-10">
                            <fieldset>
                                <legend>IDENTIFICATION DU PERSONNEL</legend>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <label>Communauté Urbaine de</label>
                                    <select class="form-control input-lg" name="commune_id">
                                        @foreach ($communes as $item)
                                          <option value="{{ $item->id }}" {{ $item->id === $besoin->commune_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  <div class="col-xs-6">
                                    <label>Cible</label>
                                    <select class="form-control input-lg" name="cible_id">
                                        @foreach ($cibles as $item)
                                          <option value="{{ $item->id }}" {{ $item->id === $besoin->cible_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Nom(s) et prénom(s)</label>
                                          <input type="text" name="name" class="form-control input-lg" value="{{ $besoin->name }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input type="email" name="email" class="form-control input-lg" value="{{ $besoin->email }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Téléphone</label>
                                          <input type="text" name="phone" class="form-control input-lg" value="{{ $besoin->phone }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Date de naissance</label>
                                          <input type="date" name="dob" class="form-control input-lg" value="{{ $besoin->dob }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="form-group">
                                          <label>Diplôme le plus élevé</label>
                                          <input type="text" name="dipl_elev" class="form-control input-lg" value="{{ $besoin->dipl_elev }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="form-group">
                                          <label>Autres diplômes/formation</label>
                                          <textarea name="autre_dipl" class="form-control input-lg" rows="2" cols="40">{{ $besoin->autre_dipl }}</textarea>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Date d’entrée à la CUD</label>
                                          <input type="date" name="date_cud" class="form-control input-lg" value="{{ $besoin->date_cud }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>Direction / Service</label>
                                          <input type="text" name="direction_service" class="form-control input-lg" value="{{ $besoin->direction_service }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-8">
                                      <div class="form-group">
                                          <label>Ancien Poste</label>
                                          <input type="text" name="ancien_poste" class="form-control input-lg" value="{{ $besoin->ancien_poste }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                          <label>Durée</label>
                                          <input type="text" name="duree_ancien_poste" class="form-control input-lg" value="{{ $besoin->duree_ancien_poste }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-8">
                                      <div class="form-group">
                                          <label>Poste occupé</label>
                                          <input type="text" name="nouveau_poste" class="form-control input-lg" value="{{ $besoin->nouveau_poste }}" required>
                                      </div>
                                  </div>
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                          <label>Ancienneté</label>
                                          <input type="text" name="duree_nouveau_poste" class="form-control input-lg" value="{{ $besoin->duree_nouveau_poste }}" required>
                                      </div>
                                  </div>
                                </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>CONNAISSANCE DU POSTE</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>1.	Pouvez-vous nous faire la description de votre poste (missions, tâches, objectifs) ?</label>
                                      <textarea name="question_1" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_1 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>2.	Comment vous organisez-vous pour atteindre vos objectifs ?</label>
                                      <textarea name="question_2" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_2 }}</textarea>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>CONNAISSANCE DE L’ORGANISATION DU TRAVAIL DE LA RH</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>3.	Faites-vous des entretiens annuels avec votre supérieur hiérarchique sur votre rendement à l’année N-1 ?</label>
                                      <textarea name="question_3" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_3 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>4.	Elaborez-vous un plan de travail annuel à votre poste ?  Si oui quels en sont les composantes ?</label>
                                      <textarea name="question_4" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_4 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>5.	Exécutez-vous intégralement votre plan de travail ? si oui comment ? sinon Pourquoi ?</label>
                                      <textarea name="question_5" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_5 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>6.	Combien de formations avez-vous déjà suivi étant à la CUD ? citez-les ?</label>
                                      <textarea name="question_6" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_6 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>7.	Utilisez-vous les outils des formations dans le cadre de votre travail ?</label>
                                      <textarea name="question_7" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_7 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>8. Les formations que vous avez déjà suivies correspondent-elles au niveau d’exigence assigné à votre poste ? justifiez votre réponse</label>
                                      <textarea name="question_8" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_8 }}</textarea>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>PERFORMANCE DE LA RESSOURCE HUMAINE</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>9.	A quelles difficultés êtes-vous confronté dans l’exécution de vos fonctions ?</label>
                                      <textarea name="question_9" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_9 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>10. Que faites-vous pour lever ces difficultés ?</label>
                                      <textarea name="question_10" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_10 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>11. Existe-il un système d’évaluation de la performance RH ? si oui, présentez le process d’évaluation</label>
                                      <textarea name="question_11" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_11 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>12. Combien d’évaluation avez-vous déjà subi ? et quels sont les résultats obtenus ?</label>
                                      <textarea name="question_12" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_12 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>13. Quelles dispositions sont prises post évaluation de votre performance, en vue de l’améliorer ?</label>
                                      <textarea name="question_13" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_13 }}</textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>14. Pourquoi pensez-vous que vous devez être formé ?</label>
                                      <textarea name="question_14" rows="3" cols="80" class="form-control input-lg">{{ $besoin->question_14 }}</textarea>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>

                          {{-- </div> --}}
                          <div class="row">
                              <div class="col-xs-4"></div>
                              <div class="col-xs-4 mt-40">
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-lg btn-block btn-success bold">
                                          Je valide
                                      </button>
                                  </div>
                              </div>
                              <div class="col-xs-4"></div>
                          </div>
                    </div>
                </div>
            </div>
    {!! Form::close() !!}

@if (Auth::user()->role->name === 'admin')
<div class="row">
    <div class="col-sm-6 mb-40">
        <div class="row">
            <div class="col-sm-6 text-left">
                <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>
@endif

</section>

@include('admin.modals.confirm', [
    'route'    => 'besoins.destroy',
    'method'   => 'delete',
    'resource' => $besoin,
    'confirm'  => 'Oui, je supprime',
    'message'  => 'Voulez-vous de façon permanente supprimer ce besoin ?'
])
@endsection
