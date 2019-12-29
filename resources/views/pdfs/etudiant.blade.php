@include('pdfs.head', ['title' => 'liste des formations'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold" style="text-transform:uppercase;">
                      Liste des etudiants du pnfmv
                  </td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-5 bold text-center">#</td>
            <td class="td-30 bold text-center">Nom(s) et Prénom(s)</td>
            <td class="td-10 bold text-center">Structure</td>
            <td class="td-10 bold text-center">Fonction</td>
            <td class="td-10 bold text-center">Résident à</td>
            <td class="td-5 bold text-center">Nbre Form.</td>
          </tr>
        </tbody>
      </table>

        @foreach ($etudiants as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-5">{{ $item->number }}</td>
                <td class="td-30">{{ $item->name }}</td>
                <td class="td-10 text-center">{{ $item->structure }}</td>
                <td class="td-10 text-center">{{ $item->fonction }}</td>
                <td class="td-10 text-center">{{ $item->residence ? $item->residence->name : '...' }}</td>
                <td class="td-5 text-center">{{ count($item->formations) }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach

    </section>

</body>
