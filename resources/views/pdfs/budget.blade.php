@include('pdfs.head', ['title' => 'Budget de la Formation'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold" style="text-transform:uppercase;">
                    Budget de la formation en "{{ $formation->title }}"
                  </td>
                </tr>
              </tbody>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold">
                    Site : {{ $formation->site }}
                  </td>
                </tr>
              </tbody>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="td-100 text-center bold">
                    Du {{ $formation->du }} au {{ $formation->au }}
                  </td>
                </tr>
              </tbody>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr style="border:1px solid #000;">
                  <td class="td-25 text-center bold">Experts: {{ count($formateurs->contains('type', 'Expert')) }}</td>
                  <td class="td-25 text-center bold">Personnel PNFMV: {{ count($formateurs->contains('type', 'Personnel PNFMV')) }}</td>
                  <td class="td-25 text-center bold">Stagiaires : {{ $formation->qte_requis }}</td>
                  <td class="td-25 text-center bold">Durée : {{ $formation->duree }}</td>
                </tr>
              </tbody>
            </table>

      <table width="100%" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td class="td-40 text-center bold">Désignation</td>
            <td class="td-15 text-center bold">Unité</td>
            <td class="td-10 text-center bold">Nbre U</td>
            <td class="td-15 text-center bold">Coût Unitaire</td>
            <td class="td-20 text-center bold">Coût Total</td>
          </tr>
        </tbody>
      </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr class="tr-section">
              <td class="td-100 text-center bold">
                @if ($types->contains('id', 1))
                  I. {{ $types->where('id', 1)->first()->name }}
                @endif
              </td>
            </tr>
          </tbody>
        </table>

        @foreach ($itemPedagogiques as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-40">{{ $item->designation }}</td>
                <td class="td-15 text-center">{{ $item->unite }}</td>
                <td class="td-10 text-center">{{ $item->nb_unite }}</td>
                <td class="td-15 text-center">{{ $item->cout_unite }}</td>
                <td class="td-20 text-center">{{ $item->total }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td class="td-80 bold">Sous total I</td>
              <td class="td-20 text-center bold">{{ $totalPedagogiques }}</td>
            </tr>
          </tbody>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr class="tr-section">
              <td class="td-100 text-center bold">
                @if ($types->contains('id', 2))
                  II. {{ $types->where('id', 2)->first()->name }}
                @endif
              </td>
            </tr>
          </tbody>
        </table>

        @foreach ($itemLogistiques as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-40">{{ $item->designation }}</td>
                <td class="td-15 text-center">{{ $item->unite }}</td>
                <td class="td-10 text-center">{{ $item->nb_unite }}</td>
                <td class="td-15 text-center">{{ $item->cout_unite }}</td>
                <td class="td-20 text-center">{{ $item->total }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach
        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td class="td-80 bold">Sous total II</td>
              <td class="td-20 text-center bold">{{ $totalLogistiques }}</td>
            </tr>
          </tbody>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr class="tr-section">
              <td class="td-100 text-center bold">
                @if ($types->contains('id', 3))
                  III. {{ $types->where('id', 3)->first()->name }}
                @endif
              </td>
            </tr>
          </tbody>
        </table>

        @foreach ($itemCommunications as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-40">{{ $item->designation }}</td>
                <td class="td-15 text-center">{{ $item->unite }}</td>
                <td class="td-10 text-center">{{ $item->nb_unite }}</td>
                <td class="td-15 text-center">{{ $item->cout_unite }}</td>
                <td class="td-20 text-center">{{ $item->total }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach
        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td class="td-80 bold">Sous total III</td>
              <td class="td-20 text-center bold">{{ $totalCommunications }}</td>
            </tr>
          </tbody>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr class="tr-section">
              <td class="td-100 text-center bold">
                @if ($types->contains('id', 4))
                  IV. {{ $types->where('id', 4)->first()->name }}
                @endif
              </td>
            </tr>
          </tbody>
        </table>

        @foreach ($itemPersonnels as $item)
          <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="td-40">{{ $item->designation }}</td>
                <td class="td-15 text-center">{{ $item->unite }}</td>
                <td class="td-10 text-center">{{ $item->nb_unite }}</td>
                <td class="td-15 text-center">{{ $item->cout_unite }}</td>
                <td class="td-20 text-center">{{ $item->total }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach
        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td class="td-80 bold">Sous total IV</td>
              <td class="td-20 text-center bold">{{ $totalPersonnels }}</td>
            </tr>
          </tbody>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <tr class="bg-teal">
              <td class="td-80 bold">TOTAL (Sous total I + Sous total II + Sous total III + Sous total IV)</td>
              <td class="td-20 text-center bold">{{ $totalBudgets }}</td>
            </tr>
          </tbody>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0">
          <tbody>
            <th>
              <td class="td-100 text-center bold" style="text-transform:uppercase;">
                arreter le present budget a la somme de {{ $budget->description }} Francs CFA</td>
            </th>
          </tbody>
        </table>
    </section>

</body>
