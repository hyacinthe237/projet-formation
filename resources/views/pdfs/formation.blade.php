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
            <td class="td-5">#</td>
            <td class="bold td-15">Titre</td>
            <td class="td-5">Financeurs</td>
            <td class="td-5">Catégorie</td>
            <td class="td-5">Nbre. formateurs</td>
            <td class="td-5">Nbre. sites</td>
            <td class="td-5">Nbre. Inscris</td>
            <td class="td-5">Nbre. Formés</td>
          </tr>
        </tbody>
      </table>

          @foreach($formations as $formation)
            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr data-href="{{ route('formation.edit', $formation->number) }}">
                    <td class="td-5">{{ $formation->number }}</td>
                    <td class="bold td-15">{{ $formation->title }}</td>
                    <td class="td-5">@if (count($formation->financeurs)) @foreach ($formation->financeurs as $item) {{ $item->name }} @endforeach @endif</td>
                    <td class="td-5">{{ $formation->category ? $formation->category->name : '---' }}</td>
                    <td class="td-5">{{ count($formation->formateurs) }}</td>
                    <td class="td-5">{{ count($formation->sites) }}</td>
                    <td class="td-5">{{ count($formation->etudiants) }}</td>
                    <td class="td-5">{{ count($formation->formes) }}</td>
                </tr>
              </tbody>
            </table>
         @endforeach

    </section>

</body>
