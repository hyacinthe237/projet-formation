@extends('admin.body')

@section('body')
    <div class="page-heading">
        <div class="buttons">
            <a href="{{ route('evaluation.index') }}" class="btn btn-lg btn-teal">
                <i class="ion-reply"></i> Annuler
            </a>
        </div>

        <div class="title">
          QUESTIONNAIRE POUR EVALUATION FINALE
        </div>
    </div>

    {!! Form::open(['method' => 'POST', 'route' => ['evaluations.store'], 'class' => '_form bg-white' ]) !!}

        <section class="container">

            <div class="mt-20 mb-20">
              @include('errors.list')
            </div>

            {{ csrf_field() }}

            <div class="block">
                <div class="block-content form">
                    <div class="row mt-20">
                      {{-- <div class="row"> --}}

                          <div class="col-sm-12 mt-40">
                            <fieldset>
                                <legend>Identification du stagiare</legend>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <label>Sélectionnez un stagiaire</label>
                                      <select class="form-control input-lg" name="etudiant_id" required>
                                          <option value="">Sélectionnez un stagiaire</option>
                                          @foreach ($stagiares as $item)
                                            <option value="{{ $item->id }}">{{ $item->firstname }} {{ $item->lastname }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Sélectionnez une formation</label>
                                        <select class="form-control input-lg" name="commune_formation_id" required>
                                            <option value="">Sélectionnez une formation</option>
                                            @foreach ($sites as $item)
                                              <option value="{{ $item->id }}">{{ $item->formation->title }} de "{{ $item->commune->name }}"</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>Contenu de la formation</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Le contenu me permet d'améliorer mes compétences dans ce domaine en milieu professionnel ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="entierement">
                                          <span class="mr-10"></span> Entièrement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="moyennement">
                                          <span class="mr-10"></span> Moyonnement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="faiblement">
                                          <span class="mr-10"></span> Faiblement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="pas du tout">
                                          <span class="mr-10"></span> Pas du tout
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Justifiez votre réponse</label>
                                      <textarea name="desc_contenu" rows="3" cols="80" class="form-control input-lg" placeholder="Justifiez votre réponse"></textarea>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>Mise en oeuvre technique de la formation</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Les supports utilisés étaient adaptés pour apprendre (documents, présentations,...) ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Les travaux pratiques sont pertinents et de qualité ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>L'approche globale d'animation de le formation est appropriée ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Le formateur sait transmettre les connaissances (maîtrise son sujet, donne des exemples pratiques...) ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>La qualité et la pertinence des échanges est jugée ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 mt-20">
                                  <div class="form-group">
                                      <label>En vue d'apporter des améliorations dans les actions de formation à venir à votre attention,
                                        avez-vous eu des difficultés particulièresà suivre cette formation sur les aspects techniques ? Lesquelles ?</label>
                                      <textarea name="mise_6" rows="3" cols="80" class="form-control input-lg" placeholder="Justifiez votre réponse"></textarea>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>Utilité et utilisation de la formation</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Je suis motivé(e) à l'idée d'utiliser ce que j'ai appris à cette formation ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>La visite de terrain m'a permis de mieux appréhender et renforcer les enseignements ?</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>

                          <div class="col-sm-12 mt-20">
                            <fieldset>
                              <legend>Satisfaction globale</legend>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>L'intérêt de la thématique abordée</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>L'apaisement des craintes est jugé</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Le comblement des attentes est jugé</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Le niveau de satisfaction pour cette formation est jugé</label>
                                  </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="insuffisant">
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="passable">
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="assez-bien">
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="bien">
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="tres-bien">
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 mt-20">
                                  <div class="form-group">
                                      <label>Si vous deviez suivre à nouveau cette formation, que proposeriez-vous pour l'améliorer ?</label>
                                      <textarea name="amelioration" rows="3" cols="80" class="form-control input-lg" placeholder="Justifiez votre réponse"></textarea>
                                  </div>
                                </div>
                                <div class="col-xs-12 mt-20">
                                  <div class="form-group">
                                      <label>Sur une échelle allant de 1 à 10, merci d'estimer la progression de votre niveau de compétence au terme
                                      de la formation en sélectionnant le chiffre correspondant</label>
                                  </div>
                                </div>

                                <div class="col-xs-4">
                                  <div class="form-group">
                                      <label>Avant la formation</label>
                                      <select class="form-control input-lg" name="avant_formation">
                                          @for($i=1; $i<= 10; $i++)
                                            <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                            <option value="{{ $value }}">
                                              {{ $value }}</option>
                                          @endfor
                                      </select>
                                  </div>
                                </div>
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4">
                                  <div class="form-group">
                                      <label>Après la formation</label>
                                      <select class="form-control input-lg" name="apres_formation">
                                          @for($i=1; $i<= 10; $i++)
                                            <?php $value = $i < 10 ? '0' . $i :$i ;?>
                                            <option value="{{ $value }}">
                                              {{ $value }}</option>
                                          @endfor
                                      </select>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>


                      {{-- </div> --}}
                      <div class="mt-60">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <button type="submit" class="btn btn-lg btn-block btn-success bold">
                                      Valider
                                  </button>
                              </div>
                          </div>
                          <div class="col-sm-4"></div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
    {!! Form::close() !!}
@endsection
