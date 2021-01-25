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

        <section class="container _form bg-white">

            <div class="block">
                <div class="block-content form">
                    <div class="row mt-20">
                      {{-- <div class="row"> --}}

                          <div class="col-sm-12 mt-40">
                            <fieldset>
                                <legend>Identification du stagiare</legend>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <label>Stagiaire</label>
                                      <input type="text" class="form-control input-lg" name="etudiant_id" value="{{ $evaluation->stagiaire->firstname }} {{ $evaluation->stagiaire->lastname }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Formation</label>
                                        <input type="text" class="form-control input-lg" name="commune_formation_id" value="{{ $evaluation->site->formation->title }} de {{ $evaluation->site->commune->name }}" readonly>
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
                                          <input type="radio" name="contenu" value="entierement" {{ $evaluation->contenu == 'entierement' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Entièrement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="moyennement" {{ $evaluation->contenu == 'moyennement' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Moyonnement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="faiblement" {{ $evaluation->contenu == 'faiblement' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Faiblement
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="contenu" value="pas du tout" {{ $evaluation->contenu == 'pas du tout' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Pas du tout
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <label>Justifiez votre réponse</label>
                                      <textarea name="desc_contenu" rows="3" cols="80" class="form-control input-lg" placeholder="Justifiez votre réponse">
                                        {{ $evaluation->desc_contenu }}
                                      </textarea>
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
                                          <input type="radio" name="mise_1" value="insuffisant" {{ $evaluation->mise_1 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="passable" {{ $evaluation->mise_1 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="assez-bien" {{ $evaluation->mise_1 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="bien" {{ $evaluation->mise_1 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_1" value="tres-bien" {{ $evaluation->mise_1 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="mise_2" value="insuffisant" {{ $evaluation->mise_2 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="passable" {{ $evaluation->mise_2 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="assez-bien" {{ $evaluation->mise_2 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="bien"{{ $evaluation->mise_2 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_2" value="tres-bien"{{ $evaluation->mise_2 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="mise_3" value="insuffisant" {{ $evaluation->mise_3 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="passable" {{ $evaluation->mise_3 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="assez-bien" {{ $evaluation->mise_3 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="bien" {{ $evaluation->mise_3 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_3" value="tres-bien" {{ $evaluation->mise_3 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="mise_4" value="insuffisant" {{ $evaluation->mise_4 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="passable" {{ $evaluation->mise_4 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="assez-bien" {{ $evaluation->mise_4 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="bien" {{ $evaluation->mise_4 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_4" value="tres-bien" {{ $evaluation->mise_4 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="mise_5" value="insuffisant" {{ $evaluation->mise_5 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="passable" {{ $evaluation->mise_5 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="assez-bien" {{ $evaluation->mise_5 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="bien" {{ $evaluation->mise_5 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="mise_5" value="tres-bien" {{ $evaluation->mise_5 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="utilite_1" value="insuffisant" {{ $evaluation->utilite_1 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="passable" {{ $evaluation->utilite_1 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="assez-bien" {{ $evaluation->utilite_1 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="bien" {{ $evaluation->utilite_1 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_1" value="tres-bien" {{ $evaluation->utilite_1 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="utilite_2" value="insuffisant" {{ $evaluation->utilite_2 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="passable" {{ $evaluation->utilite_2 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="assez-bien" {{ $evaluation->utilite_2 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="bien" {{ $evaluation->utilite_2 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="utilite_2" value="tres-bien" {{ $evaluation->utilite_2 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="statisfaction_1" value="insuffisant"{{ $evaluation->statisfaction_1 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="passable"{{ $evaluation->statisfaction_1 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="assez-bien"{{ $evaluation->statisfaction_1 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="bien"{{ $evaluation->statisfaction_1 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_1" value="tres-bien"{{ $evaluation->statisfaction_1 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="statisfaction_2" value="insuffisant" {{ $evaluation->statisfaction_2 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="passable" {{ $evaluation->statisfaction_2 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="assez-bien" {{ $evaluation->statisfaction_2 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="bien" {{ $evaluation->statisfaction_2 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_2" value="tres-bien" {{ $evaluation->statisfaction_2 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="statisfaction_3" value="insuffisant"{{ $evaluation->statisfaction_3 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="passable"{{ $evaluation->statisfaction_3 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="assez-bien"{{ $evaluation->statisfaction_3 == 'aassez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="bien"{{ $evaluation->statisfaction_3 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_3" value="tres-bien"{{ $evaluation->statisfaction_3 == 'tres-bien' ? 'checked' : '' }}>
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
                                          <input type="radio" name="statisfaction_4" value="insuffisant" {{ $evaluation->statisfaction_4 == 'insuffisant' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Insuffisant
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="passable" {{ $evaluation->statisfaction_4 == 'passable' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Passable
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="assez-bien" {{ $evaluation->statisfaction_4 == 'assez-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Assez-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="bien" {{ $evaluation->statisfaction_4 == 'bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                      <label class="css-input css-radio css-radio-primary mr-20">
                                          <input type="radio" name="statisfaction_4" value="tres-bien" {{ $evaluation->statisfaction_4 == 'tres-bien' ? 'checked' : '' }}>
                                          <span class="mr-10"></span> Très-Bien
                                      </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 mt-20">
                                  <div class="form-group">
                                      <label>Si vous deviez suivre à nouveau cette formation, que proposeriez-vous pour l'améliorer ?</label>
                                      <textarea name="amelioration" rows="3" cols="80" class="form-control input-lg" placeholder="Justifiez votre réponse">
                                        {{ $evaluation->amelioration }}
                                      </textarea>
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
                                            <option value="{{ $value }}" {{ $evaluation->avant_formation == $value ? 'selected' : '' }}>
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
                                            <option value="{{ $value }}" {{ $evaluation->apres_formation == $value ? 'selected' : '' }}>
                                              {{ $value }}</option>
                                          @endfor
                                      </select>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                          </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
