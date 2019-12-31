@include('pdfs.head', ['title' => 'liste des formations'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
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
          <tr class="tr-section">
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

      {{-- Participation des communes par formations --}}
      <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                Participation des communes par formations
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-10 bold">#</td>
            <td class="td-20 bold">Formations</td>
            <td class="td-20 bold">Communes</td>
            <td class="td-10 bold">Pers. Formée</td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($allFormations as $formation)
            <tr>
                <td class="td-10">{{ $formation->number }}</td>
                <td class="td-20">{{ $formation->title }}</td>
                <td class="td-20">
                  @if ($formation->communes)
                      @foreach ($formation->communes as $item)
                        {{ $item->name . ', '}}
                      @endforeach
                  @endif
                </td>
                <td class="td-10">{{ count($formation->personnes_formee) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Participation des communes par régions debut --}}
      <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                Participation des communes par régions
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-10 bold">Régions</td>
            <td class="td-30 bold">(Nbre) Communes</td>
            <td class="td-10 bold">Pers. Inscrites</td>
            <td class="td-10 bold">Pers. Formées</td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($regions as $region)
              @if (count($region->commune_touchees))
                <tr>
                    <td class="td-10">{{ $region->name }}</td>
                    <td class="td-30">({{count($region->commune_touchees)}}) @foreach ($region->commune_touchees as $item){{ $communes->where('id', $item->commune_id)->first()->name . ', ' }}@endforeach</td>
                    <td class="td-10">{{count($region->personnes_inscrite)}}</td>
                    <td class="td-10">{{count($region->personnes_formee)}}</td>
                </tr>
              @endif
          @endforeach
        </tbody>
      </table>

      {{-- Participation des communes par départements --}}
      <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                Participation des communes par départements
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-10 bold">Départements</td>
            <td class="td-30 bold">(Nbre) Communes</td>
            <td class="td-10 bold">Pers. Inscrites</td>
            <td class="td-10 bold">Pers. Formées</td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($departements as $item)
              @if (count($item->commune_touchees))
                <tr>
                    <td class="td-10">{{ $item->name }}</td>
                    <td class="td-30">({{ count($item->commune_touchees)}}) @foreach ($item->commune_touchees as $itm){{ $communes->where('id', $itm->commune_id)->first()->name . ', ' }}@endforeach</td>
                    <td class="td-10">{{count($item->personnes_inscrite)}}</td>
                    <td class="td-10">{{count($item->personnes_formee)}}</td>
                </tr>
              @endif
          @endforeach
        </tbody>
      </table>

    </section>

</body>
