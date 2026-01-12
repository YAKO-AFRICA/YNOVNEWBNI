


<div class="container-sign my-2 w-100">
    <form action="{{ route('prospect.signaturePad') }}" method="POST" id="signFormId" class="submitForm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Veuillez signer ici <span class="text-danger">*</span></label>
            <div class="border rounded bg-light" style="width: 100%; height: 200px; position: relative;">
                <canvas id="signatureCanvas" style="width: 100%; height: 100%; touch-action: none;"></canvas>
            </div>
            
            <input type="hidden" name="prospect_uuid" id="prospect_uuid" value="{{ $prospect->uuid }}">
            <input type="hidden" name="prospect_code" id="prospect_code" value="{{ $prospect->code }}">
            <input type="hidden" name="signature" id="signatureData" >
        </div>

        <div class="d-flex justify-content-between mt-4 w-100">
            <button type="button" id="clearSignature" class="btn btn-outline-danger btn-sm">Effacer</button>
            <button type="submit" class="btn btn-success btn-sm">Valider la signature</button>
        </div>
    </form>
</div>

    



<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js" defer></script>

<script>
let signaturePad; // ➜ Variable globale

document.addEventListener('DOMContentLoaded', function() {

    const canvas = document.getElementById('signatureCanvas');

    // Initialisation globale
    signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)'
    });

    document.getElementById('clearSignature').addEventListener('click', () => signaturePad.clear());

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear();
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('signFormId');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Vérification
        if (signaturePad.isEmpty()) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Veuillez fournir votre signature',
            })
            // alert('Veuillez fournir votre signature');
            return;
        }

        // Base64 dans le champ hidden
        document.getElementById('signatureData').value = signaturePad.toDataURL();

        // Afficher loader
        document.getElementById('signatureLoader').classList.remove('d-none');

        // Préparer données
        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {

            // Cacher loader
            document.getElementById('signatureLoader').classList.add('d-none');

            if (data.type === 'success') {

                // Afficher modal
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();

            } else {
                alert("Erreur système !");
            }
        })
        .catch(() => {
            document.getElementById('signatureLoader').classList.add('d-none');
            alert("Erreur de communication !");
        });
    });

    // Redirection après OK
    document.getElementById('btnRedirect').addEventListener('click', function() {
        window.location.href = "https://yakoafricassur.com";
    });
});
</script>



        