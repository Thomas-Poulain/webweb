<?php
include __ROOT__."/views/header.html";
?>

<body>

    <!-- BODY -->
    <div class="container my-4">
        <div class="container-fluid ">
            <img src="../static/img/iconUser.png" class="d-inline-block img-fluid " width="50px" alt="profile">
            <label class="fs-4 align-middle">Créer un utilisateur</label>
        </div>

        <div class="container-fluid">
            <div class="row flex-column flex-sm-row">
                <div class="col mx-auto d-flex align-items-center order-last order-sm-first">
                    <!-- CSV -->
                    <div class="col mx-3 card my-5 shadow-sm p-3 mb-5 bg-body rounded">
                        <form form action="/sa_userCreate" method="post" enctype="multipart/form-data">
                                <!-- ATTRIBUT CACHE PERMETTANT DE DIFFERENCIER LES DEUX FORMULAIRES -->
                                <input type="hidden" name="csvForm" value="1">

                                <p class="fs-5 text-center">Un ou plusieurs utilisateurs avec un fichier CSV</p>
                                <div class="form-group my-5">
                                    <label for="formFile" class="form-label">Selectionnez un fichier CSV</label>
                                    <input class="form-control" type="file" id="csvFile" name="csvFile" accept=".csv" required>
                                </div>
                                <div class="text-center my-5">
                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- MANUEL -->
                    <div class="col mx-auto card my-5 shadow-sm p-3 mb-5 bg-body rounded order-first order-sm-last">
                        <form form action="/sa_userCreate" method="post" enctype="multipart/form-data">
                            <!-- DIFFERENCIER LE FORMULAIRE DE L'AUTRE AVEC UN ATTRIBUT CACHE  -->
                            <input type="hidden" name="oneUserForm" value="1">
                            
                            <p class="fs-5 text-center">Un seul utilisateur</p>

                            <!-- NOM -->
                            <div class="mb-3 my-5">
                                <label for="newUserNom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="newUserNom" name="newUserNom" aria-describedby="nom" required>
                            </div>
                        
                            <!-- PRENOM -->
                            <div class="mb-3">
                                <label for="newUserPrenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="newUserPrenom" name="newUserPrenom" aria-describedby="prénom" required>
                            </div>

                            <!-- ROLE -->
                            <div class="mb-3">
                                <label for="newUserRole" class="form-label">Rôle</label>
                                <select class="form-select" aria-label="rôle de l'utilisateur" name="newUserRole">
                                    <option selected value="Eleve">Elève</option>
                                    <option value="Professeur">Professeur</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="userGroup" class="form-label">Classe</label>
                                <select class="form-select" aria-label="groupe de l'utilisateur" name="userGroup">
                                    <option selected value="Aucune">Aucune</option>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group['name']; ?>"><?php echo $group['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="text-center my-5">
                                <button type="submit" class="btn btn-primary">Confirmer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>