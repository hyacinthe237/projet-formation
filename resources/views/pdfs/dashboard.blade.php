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

</body>
