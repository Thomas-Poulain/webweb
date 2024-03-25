<?php
include __ROOT__."/views/header.html";
?>

<body>
    <div class="container my-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Télécharger le PDF</h5>
                <a href="data:application/pdf;base64,<?php echo base64_encode($pdf_content); ?>" 
                    download="<?php echo $filename; ?>" 
                    class="btn btn-primary">
                    <i class="fas fa-download"></i> Télécharger
                </a>
                <a href="javascript:history.go(-1)" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</body>
