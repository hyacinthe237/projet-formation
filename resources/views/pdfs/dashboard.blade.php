@include('pdfs.head', ['title' => 'liste des formations'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold" style="text-transform:uppercase;">
                      Statistiques
                  </td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-20 bold">Stagiaires</td>
            <td class="td-10">{{ count($etudiants) }}</td>
            <td class="td-20 bold">Formations</td>
            <td class="td-10">{{ count($formations) }}</td>
            <td class="td-20 bold">Formateurs</td>
            <td class="td-10">{{ count($formateurs) }}</td>
          </tr>
        </tbody>
      </table>

            <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold" style="text-transform:uppercase;">
                      Taux de couverture
                  </td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-20 bold">Personnes formées</td>
            <td class="td-10">{{ $totalPersonnePrevuFormer .' %' }}</td>
            <td class="td-20 bold">Communes touchées</td>
            <td class="td-10">{{ $communesToucher .' %' }}</td>
            <td class="td-20 bold">Formations exécutées</td>
            <td class="td-10">{{ $formationExecuter .' %' }}</td>
          </tr>
        </tbody>
      </table>

            <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-50 text-center bold" style="text-transform:uppercase;">
                      Couverture régionale
                  </td>
                  <td class="td-50 text-center bold" style="text-transform:uppercase;">
                      Couverture départementale
                  </td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-50">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td class="td-50">Nom de la région</td>
                    <td class="td-50">Commune touchées</td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td class="td-50">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td class="td-50">Nom du département</td>
                    <td class="td-50">Commune touchées</td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-50">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  @foreach($regions as $region)
                      @if (count($region->commune_touchees))
                        <tr>
                            <td class="td-50">{{ $region->name }}</td>
                            <td class="td-50">{{ count($region->commune_touchees)}}</td>
                        </tr>
                      @endif
                  @endforeach
                </tbody>
              </table>
            </td>
            <td class="td-50">
              <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  @foreach($departements as $item)
                      @if (count($item->commune_touchees))
                        <tr>
                            <td class="td-50">{{ $item->name }}</td>
                            <td class="td-50">{{ count($item->commune_touchees)}}</td>
                        </tr>
                      @endif
                  @endforeach
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>


    </section>

</body>
