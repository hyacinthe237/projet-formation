<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
    var EtudiantSignature = document.getElementById('etudiantSignature');

    var EtudiantSignaturePad = {};

    if (EtudiantSignature) {
        EtudiantSignaturePad = new SignaturePad(EtudiantSignature, {
            clear : '.clearButton',
            backgroundColor: 'rgba(255, 255, 255, 0)',
            onEnd: function () {
                var etudiantData = EtudiantSignaturePad.toDataURL()
                document.getElementById('etudiantData').value = etudiantData;
            }
        })
    }

    var saveButton   = document.getElementById('save');
    var cancelEtudiant = document.getElementById('EtudiantClear');

    if (EtudiantSignature) {
        cancelEtudiant.addEventListener('click', function (event) {
            event.preventDefault();
            EtudiantSignaturePad.clear();
        });
    }
</script>
