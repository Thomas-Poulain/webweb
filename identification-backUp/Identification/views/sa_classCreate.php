<?php
include __ROOT__."/views/header.html";
?>

<body>    
    <!-- BODY -->
    <div class="container my-4">
        <div class="container-fluid ">
            <img src="../static/img/iconClass.png" class="d-inline-block img-fluid " width="50px" alt="profile">
            <label class="fs-4 align-middle">Créer une classe</label>
        </div>
        <form form action="/sa_classCreate" method="post" enctype="multipart/form-data">
            <!-- NOM DE LA CLASSE-->
            <div class="mb-3 my-5">
                <label for="newClassName" class="form-label">Nom de classe</label>
                <input type="text" class="form-control" id="newClassName" name="newClassName" aria-describedby="nom de la classe" required>
            </div>
            <!-- DEXRIPTION DE LA CLASSE-->
            <div class="mb-3">
                <label for="newClassSummary" class="form-label">Description</label>
                <textarea class="form-control" id="newClassSummary" name="newClassSummary"  rows="3" ></textarea>
            </div>
            <!-- FICHIER CSV -->
            <div class="mb-3 my-5">
                <label for="formFile" class="form-label">Selectionnez un fichier CSV</label>
                <input class="form-control" type="file" id="csvFile" name="csvFile" accept=".csv" required> 
            </div>
            <div class="text-center my-5">
                <button type="submit" class="btn btn-primary">Confirmer</button>
            </div>
        </form>
    </div>

</body>