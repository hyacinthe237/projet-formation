@include('pdfs.head', ['title' => "STATISTIQUE DE L'ACTION PEDAGOGIQUE EN ". $session->name  ])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

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
            <td class="td-20 bold">Stagiaires Inscris</td>
            <td class="td-10">{{ $totalPersonnesIncrites }}</td>
            <td class="td-20 bold">Stagiaires Formés</td>
            <td class="td-10">{{ $totalPersonnesFormees }}</td>
            <td class="td-20 bold">Communes touchées</td>
            <td class="td-10">{{ $communesToucher .' %' }}</td>
            <td class="td-20 bold">Formations exécutées</td>
            <td class="td-10">{{ $formationExecuter .' %' }}</td>
          </tr>
        </tbody>
      </table>

      {{-- Participation des communes par formations --}}

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                STATISTIQUE DE L'ACTION PEDAGOGIQUE EN {{ $session->name }}
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="bold">
              <td class="td-2">#</td>
              <td class="td-5 bold">Régions</td>
              <td class="td-3">Com munes</td>
              <td class="td-3">Pers. Ins crites</td>
              <td class="td-3">Pers. Form ées</td>
              <td class="td-3">Pers. CU</td>
              <td class="td-3">Pers. Mairie</td>
              <td class="td-3">SG</td>
              <td class="td-3">Cadre Com Tech</td>
              <td class="td-3">Pers. SDE</td>
              <td class="td-3">Pers. Scte Civil</td>
              <td class="td-3">Pers. FEI COM</td>
              <td class="td-3">Pers. Autres proj progr</td>
              <td class="td-3">Pers. Assoc Com</td>
              <td class="td-3">Pers. C2D</td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($regions as $region)
            <tr>
                <td class="td-2">{{ $region->id }}</td>
                <td class="td-5 bold">{{ $region->name }}</td>
                <td class="td-3">{{ count($region->commune_touchees) }}</td>
                <td class="td-3">{{ count($region->personnes_inscrite) }}</td>
                <td class="td-3">{{ count($region->personnes_formee) }}</td>
                <td class="td-3">{{ count($region->personnes_cu) }}</td>
                <td class="td-3">{{ count($region->personnes_mairie) }}</td>
                <td class="td-3">{{ count($region->personnes_sg) }}</td>
                <td class="td-3">{{ count($region->personnes_cct) }}</td>
                <td class="td-3">{{ count($region->personnes_sde) }}</td>
                <td class="td-3">{{ count($region->personnes_sc) }}</td>
                <td class="td-3">{{ count($region->personnes_feicom) }}</td>
                <td class="td-3">{{ count($region->personnes_autres) }}</td>
                <td class="td-3">{{ count($region->personnes_asscom) }}</td>
                <td class="td-3">{{ count($region->personnes_c2d) }}</td>
            </tr>
          @endforeach

          <tr>
            <td class="td-2"></td>
            <td class="td-5 bold">TOTAUX</td>
            <td class="td-3">{{ $totalCommunesToucher }}</td>
            <td class="td-3">{{ $totalPersonnesIncrites }}</td>
            <td class="td-3">{{ $totalPersonnesFormees }}</td>
            <td class="td-3">{{ $totalPersonnesCU }}</td>
            <td class="td-3">{{ $totalPersonnesMairie }}</td>
            <td class="td-3">{{ $totalPersonnesSG }}</td>
            <td class="td-3">{{ $totalPersonnesCadreComTech }}</td>
            <td class="td-3">{{ $totalPersonnesSDE }}</td>
            <td class="td-3">{{ $totalPersonnesScteCivil }}</td>
            <td class="td-3">{{ $totalPersonnesFEICOM }}</td>
            <td class="td-3">{{ $totalPersonnesAutresProjProg }}</td>
            <td class="td-3">{{ $totalPersonnesAssocCom }}</td>
            <td class="td-3">{{ $totalPersonnesC2D }}</td>
          </tr>
        </tbody>
      </table>
    </section>

    @if ($setting !== null)
      <section  style="margin:20px 40px;">
          <div class="">
              <img src="{{ $setting->stat_image }}" alt="" width="100%">
          </div>
      </section>
    @endif
    <table class="page-break" width="100%" cellspacing="0" cellpadding="0"></table>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                TABLEAU GLOBAL DES CTD TOUCHEES
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="bold">
            <td class="td-20">Régions</td>
            <td class="td-20">Nombres de CTD touchées</td>
            <td class="td-20">Nombre de CTD pas encore touchées</td>
            <td class="td-20">Taux de couverture (en %)</td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($regions as $region)
            <tr>
                <td class="bold td-5">{{ $region->name }}</td>
                <td class="td-5">{{ count($region->commune_touchees) }}</td>
                <td class="td-5">{{ $region->nontouchees }}</td>
                <td class="td-5">{{ number_format($region->couverture, 2) }} %</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                SYNTHESES DES CTD ATTEINTES EN {{ $session->name }}
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="bold td-5">Synthèses des CTD atteintes en {{ $session->name }}</td>
                <td class="td-5">{{ $stat_touchees . ' %' }}</td>
            </tr>
            <tr>
                <td class="bold td-5">CTD nouvellement atteintes en {{ $session->name }}</td>
                <td class="td-5">{{ $stat_new . ' %' }}</td>
            </tr>
            <tr>
                <td class="bold td-5">CTD touchés plus d'une fois en {{ $session->name }}</td>
                <td class="td-5">{{ $stat_plus . ' %' }}</td>
            </tr>
            <tr>
                <td class="bold td-5">CTD touchés depuis 2015</td>
                <td class="td-5">{{ $stat_2015 . ' %' }}</td>
            </tr>
            <tr>
                <td class="bold td-5">CTD restants à atteindre en {{ $session->name }}</td>
                <td class="td-5">{{ $stat_restantes . ' %' }}</td>
            </tr>
        </tbody>
      </table>
    </section>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                POURCENTAGE DES SG TOUCHES PAR REGION
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-5">Regions</td>
            <td class="td-5">Pourcentages</td>
          </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($regions as $item)
            <tr>
                <td class="td-5">{{ $item->name }}</td>
                <td class="td-5">{{ number_format((count($item->personnes_sg)/$totalPersonnesSG)*100,2) . '%' }}</td>
            </tr>
          @endforeach
        </tbody>
    </section>

    <table class="page-break" width="100%" cellspacing="0" cellpadding="0"></table>
    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                TABLEAU GLOBAL DES FORMATIONS
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-bold">
            <td class="td-5">Titre de la formation</td>
            <td class="td-5">Nombre de stagiaires prévus</td>
            <td class="td-5">Nombre de stagiaires effectif</td>
          </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($allFormations as $item)
            <tr>
                <td class="td-5">{{ $item->title }}</td>
                <td class="td-5">{{ $item->nb_prevus }}</td>
                <td class="td-5">{{ $item->nb_effectif }}</td>
            </tr>
          @endforeach
        </tbody>
    </section>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                TABLEAU DES PERSONNES PAR DIPLOME
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-bold">
            <td class="td-5">Diplomes</td>
            <td class="td-5">Effectifs</td>
            <td class="td-5">Pourcentages</td>
          </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @foreach($personnes_diplome as $item)
            <tr>
              <td class="bold td-5">{{ $item->diplome_elev ? $item->diplome_elev : 'Uncategorized'}}</td>
              <td class="td-5">{{ $item->total }}</td>
              <td class="td-5">{{ $item->pourcentage . '%' }}</td>
            </tr>
          @endforeach
        </tbody>
        </table>
    </section>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                TABLEAU DES PERSONNES PAR AGE
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-bold">
            <td class="td-5">Ages</td>
            <td class="td-5">Effectifs</td>
            <td class="td-5">Pourcentages</td>
          </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if (count($personnes_age['pers_20_30'])>0)
            <tr>
                <td class="bold td-5">De 20 à 30 ans</td>
                <td class="td-5">{{ count($personnes_age['pers_20_30']) }}</td>
                <td class="td-5">{{ number_format((count($personnes_age['pers_20_30'])/$personnes_age['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if (count($personnes_age['pers_31_40'])>0)
            <tr>
                <td class="bold td-5">De 31 à 40 ans</td>
                <td class="td-5">{{ count($personnes_age['pers_31_40']) }}</td>
                <td class="td-5">{{ number_format((count($personnes_age['pers_31_40'])/$personnes_age['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if (count($personnes_age['pers_41_50'])>0)
            <tr>
                <td class="bold td-5">De 41 à 50 ans</td>
                <td class="td-5">{{ count($personnes_age['pers_41_50']) }}</td>
                <td class="td-5">{{ number_format((count($personnes_age['pers_41_50'])/$personnes_age['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if (count($personnes_age['pers_51_60'])>0)
            <tr>
                <td class="bold td-5">De 51 à 60 ans</td>
                <td class="td-5">{{ count($personnes_age['pers_51_60']) }}</td>
                <td class="td-5">{{ number_format((count($personnes_age['pers_51_60'])/$personnes_age['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </section>

    <section style="margin:20px 40px;">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-section">
            <td class="td-100 text-center bold" style="text-transform:uppercase;">
                TABLEAU DES PERSONNES PAR AGE ET PAR SEXE
            </td>
          </tr>
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr class="tr-bold">
            <td class="td-5">Ages</td>
            <td class="td-5">Effectifs</td>
            <td class="td-5">Pourcentages</td>
          </tr>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if ((count($personnes_agesex['pers_20_30_male'])>0) || (count($personnes_agesex['pers_20_30_female'])>0))
            <tr>
                <td class="bold td-5" rowspan="2">De 20 à 30 ans</td>
                <td class="td-5">{{ count($personnes_agesex['pers_20_30_male']) .' Masculin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_20_30_male'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
            <tr>
                <td class="td-5">{{ count($personnes_agesex['pers_20_30_female']) .' Féminin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_20_30_female'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if ((count($personnes_agesex['pers_31_40_male'])>0) || (count($personnes_agesex['pers_31_40_female'])>0))
            <tr>
                <td class="bold td-5" rowspan="2">De 31 à 40 ans</td>
                <td class="td-5">{{ count($personnes_agesex['pers_31_40_male']) .' Masculin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_31_40_male'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
            <tr>
                <td class="td-5">{{ count($personnes_agesex['pers_31_40_female']) .' Féminin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_31_40_female'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if ((count($personnes_agesex['pers_41_50_male'])>0) || (count($personnes_agesex['pers_41_50_female'])>0))
            <tr>
                <td class="bold td-5" rowspan="2">De 41 à 50 ans</td>
                <td class="td-5">{{ count($personnes_agesex['pers_41_50_male']) .' Masculin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_41_50_male'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
            <tr>
                <td class="td-5">{{ count($personnes_agesex['pers_41_50_female']) .' Féminin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_41_50_female'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          @if ((count($personnes_agesex['pers_51_60_male'])>0) || (count($personnes_agesex['pers_51_60_female'])>0))
            <tr>
                <td class="bold td-5" rowspan="2">De 51 à 60 ans</td>
                <td class="td-5">{{ count($personnes_agesex['pers_51_60_male']) .' Masculin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_51_60_male'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
            <tr>
                <td class="td-5">{{ count($personnes_agesex['pers_51_60_female']) .' Féminin' }}</td>
                <td class="td-5">{{ number_format((count($personnes_agesex['pers_51_60_female'])/$personnes_agesex['personnes'])*100,2) . '%' }}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </section>
</body>
