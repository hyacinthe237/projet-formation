@include('pdfs.head', ['title' => 'liste des formations'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold" style="text-transform:uppercase;">
                      Liste des formations du pnfmv
                  </td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-5 text-center bold">#</td>
            <td class="td-35 text-center bold">Titre</td>
            <td class="td-5 text-center bold">Nbre Places</td>
            <td class="td-5 text-center bold">Nbre Sites</td>
          </tr>
        </tbody>
      </table>

        @foreach ($formations as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-5">{{ $item->number }}</td>
                <td class="td-35">{{ $item->title }}</td>
                <td class="td-5 text-center">{{ $item->qte_requis }}</td>
                <td class="td-5 text-center">{{ count($item->sites) }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach

    </section>

</body>
