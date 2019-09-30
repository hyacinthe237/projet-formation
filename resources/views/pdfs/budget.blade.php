@include('pdfs.head', ['title' => 'Budget de la Formation'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

        <div class="table" style="border:1px solid #000;">
            <div class="table-row">
                <div class="table-cell">
                    <h4 class="text-center" style="color:#000;font-weight:bold;text-align:center; text-transform:uppercase;">
                        {{ $formation->title }}
                    </h4>
                </div>
            </div>

            <div class="table-row">
                <div class="table-cell">
                    <h4 class="text-center" style="color:#000;font-weight:bold;text-align:center;border-top:1px solid #000;">
                        Site : {{ $formation->site }}
                    </h4>
                </div>
            </div>
        </div>
    </section>

</body>
