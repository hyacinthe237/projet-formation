@extends('front.templates.default')

@section('head')
    <title>questionnaire des besoins</title>
@endsection()

@section('body')
{!! Form::open(['method' => 'POST', 'route' => ['front.besoins.store'], 'class' => '_form bg-white' ]) !!}

    <section class="container">

        <div class="mt-20 mb-20">
          @include('errors.list')
        </div>

        {{ csrf_field() }}

        <div class="block">
            <div class="block-content form">
                <div class="row mt-20">
                  {{-- <div class="row"> --}}
                      <div class="col-sm-12 bg-primary text-center bold">
                        QUESTIONNAIRE EN VUE DE FAIRE LA CARTOGRAPHIE DES BESOINS EN FORMATION
                      </div>

                      <div class="col-sm-12 mt-40">
                        <fieldset>
                            <legend>IDENTIFICATION DU PERSONNEL</legend>
                            <div class="row">
                              <div class="col-xs-6">
                                <label>Communauté Urbaine de</label>
                                <select class="form-control input-lg" name="commune_id">
                                    @foreach ($communes as $item)
                                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-xs-6">
                                <label>Cible</label>
                                <select class="form-control input-lg" name="cible_id">
                                    @foreach ($cibles as $item)
                                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Nom(s) et prénom(s)</label>
                                      <input type="text" name="name" class="form-control input-lg" placeholder="Votre nom" required>
                                  </div>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" name="email" class="form-control input-lg" placeholder="Votre adresse email" required>
                                  </div>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Téléphone</label>
                                      <input type="text" name="phone" class="form-control input-lg" placeholder="Votre téléphone" required>
                                  </div>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Date de naissance</label>
                                      <input type="date" name="dob" class="form-control input-lg" placeholder="Date de naissance" required>
                                  </div>
                              </div>
                              <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Diplôme le plus élevé</label>
                                      <input type="text" name="dipl_elev" class="form-control input-lg" placeholder="Diplôme le plus élevé" required>
                                  </div>
                              </div>
                              <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Autres diplômes/formation</label>
                                      <textarea name="autre_dipl" class="form-control input-lg" rows="2" cols="40" placeholder="Autres diplômes/formation"></textarea>
                                  </div>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Date d’entrée à la CUD</label>
                                      <input type="date" name="date_cud" class="form-control input-lg" placeholder="Date d’entrée à la CUD" required>
                                  </div>
                              </div>
                              <div class="col-xs-6">
                                  <div class="form-group">
                                      <label>Direction / Service</label>
                                      <input type="text" name="direction_service" class="form-control input-lg" placeholder="Direction / Service" required>
                                  </div>
                              </div>
                              <div class="col-xs-8">
                                  <div class="form-group">
                                      <label>Ancien Poste</label>
                                      <input type="text" name="ancien_poste" class="form-control input-lg" placeholder="Ancien Poste" required>
                                  </div>
                              </div>
                              <div class="col-xs-4">
                                  <div class="form-group">
                                      <label>Durée</label>
                                      <input type="text" name="duree_ancien_poste" class="form-control input-lg" placeholder="Durée: 2ans" required>
                                  </div>
                              </div>
                              <div class="col-xs-8">
                                  <div class="form-group">
                                      <label>Poste occupé</label>
                                      <input type="text" name="nouveau_poste" class="form-control input-lg" placeholder="Poste occupé" required>
                                  </div>
                              </div>
                              <div class="col-xs-4">
                                  <div class="form-group">
                                      <label>Ancienneté</label>
                                      <input type="text" name="duree_nouveau_poste" class="form-control input-lg" placeholder="Ancienneté: 2ans" required>
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
                                  <textarea name="question_1" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>2.	Comment vous organisez-vous pour atteindre vos objectifs ?</label>
                                  <textarea name="question_2" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
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
                                  <textarea name="question_3" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>4.	Elaborez-vous un plan de travail annuel à votre poste ?  Si oui quels en sont les composantes ?</label>
                                  <textarea name="question_4" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>5.	Exécutez-vous intégralement votre plan de travail ? si oui comment ? sinon Pourquoi ?</label>
                                  <textarea name="question_5" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>6.	Combien de formations avez-vous déjà suivi étant à la CUD ? citez-les ?</label>
                                  <textarea name="question_6" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>7.	Utilisez-vous les outils des formations dans le cadre de votre travail ?</label>
                                  <textarea name="question_7" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>8. Les formations que vous avez déjà suivies correspondent-elles au niveau d’exigence assigné à votre poste ? justifiez votre réponse</label>
                                  <textarea name="question_8" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
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
                                  <textarea name="question_9" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>10. Que faites-vous pour lever ces difficultés ?</label>
                                  <textarea name="question_10" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>11. Existe-il un système d’évaluation de la performance RH ? si oui, présentez le process d’évaluation</label>
                                  <textarea name="question_11" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>12. Combien d’évaluation avez-vous déjà subi ? et quels sont les résultats obtenus ?</label>
                                  <textarea name="question_12" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>13. Quelles dispositions sont prises post évaluation de votre performance, en vue de l’améliorer ?</label>
                                  <textarea name="question_13" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
                              </div>
                            </div>
                            <div class="col-xs-12">
                              <div class="form-group">
                                  <label>14. Pourquoi pensez-vous que vous devez être formé ?</label>
                                  <textarea name="question_14" rows="3" cols="80" class="form-control input-lg" placeholder="Saisissez votre réponse"></textarea>
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
    </section>
{!! Form::close() !!}
@endsection
