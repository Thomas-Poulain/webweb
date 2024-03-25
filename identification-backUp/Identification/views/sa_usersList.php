<?php
include __ROOT__."/views/header.html";
?>

<body>

<div class="container my-4">
    <h1>Liste des utilisateurs</h1>
    <input type="text" id="search" class="form-control my-3" placeholder="Rechercher un utilisateur...">
    <?php if (count($users) == 0) { ?>
        <p>Pas d'utilisateur</p>
    <?php } else { ?>
        <div class="row justify-content-center" id="user-cards">
            <?php foreach ($users as $user) { ?>
                <div class="col-sm-6 col-md-6 col-lg-4 px-3">
                    <div class="card my-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-user fa-3x me-3"></i>
                                <h5 class="card-title"><?php echo $user['username']; ?></h5>
                            </div>
                            <p class="card-text"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?> <i class="fas fa-id-badge ms-2"></i></p>
                            <p class="card-text"><?php echo $user['role']; ?> <i class="fas fa-user-tag ms-2"></i></p>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" id="deleteUserbtn-<?php echo $user['id']; ?>" class="btn btn-danger me-3" data-bs-toggle="modal" data-groupname="<?php echo $user['username']; ?>" data-bs-target="#delete-user-modal-<?php echo $user['id']; ?>">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                                <button type="button" class="btn btn-primary" id="updateUserbtn" data-bs-toggle="modal" data-groupname="<?php echo $user['username']; ?>" data-bs-target="#update-user-modal-<?php echo $user['id']; ?>">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>


        

            <!-- Delete User -->
            <div class="modal fade" id="delete-user-modal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="delete-user-modal-<?php echo $user['id']; ?>-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-user-modal-<?php echo $group['id']; ?>-label">Supprimer l'utilisateur <span id="user-name-delete"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post">
                                <input type="hidden" name="isDeleteUser" value="" id="user-delete-id">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Update User -->
        <div class="modal fade" id="update-user-modal-<?php echo $group['id']; ?>" tabindex="-1" aria-labelledby="update-user-modal-<?php echo $group['id']; ?>-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-user-modal-<?php echo $group['id']; ?>-label">Modifier l'utilisateur <span id="user-name-update"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="surname-user" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastname-update" name="newLastName" placeholder="Dupont" required>
                        </div>
                        <div class="mb-3">
                            <label for="name-user" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="name-update" name="newName" placeholder="Xavier" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="hidden" id="user" name="isUpdateUser" />
                            <input type="text"  id="username" class="form-control" value="xdupont" disabled>
                        </div>
                        <div class="mb-3">
                                <label for="newUserRole" class="form-label">Rôle</label>
                                <select class="form-select" aria-label="rôle de l'utilisateur" name="newUserRole">
                                    <option selected value="Eleve">Elève</option>
                                    <option value="Professeur">Professeur</option>
                                </select>
                            </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Voulez-vous changer le mot de passe ?</label>
                            <select class="form-select" aria-label="Modifier le mot de passe" name="newPassword">
                                        <option selected value="false">Non</option>
                                        <option value="true">Oui</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

</div>

<a href="sa_userCreate" class="btn btn-primary btn-lg position-fixed" style="bottom: 20px; right: 20px;" role="button">+</a>

<script>
    const searchInput = document.getElementById('search');
    const userCards = document.querySelectorAll('#user-cards .card');
    var users = <?php echo json_encode($users); ?>;


    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.trim().toLowerCase();

        userCards.forEach(card => {
            const username = card.querySelector('.card-title').textContent.trim().toLowerCase();
            const fullName = card.querySelector('.card-text').textContent.trim().toLowerCase();

            if (username.includes(searchValue) || fullName.includes(searchValue)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });


        // Update user
        var updateUserButton = document.querySelectorAll('[data-bs-toggle="modal"]');
        
        updateUserButton.forEach(function (button) {
            button.addEventListener("click", function () {
                username = this.getAttribute("data-groupname");
                document.getElementById('user-name-update').innerHTML = username;

                Object.keys(users).forEach(function (key) {
                    var user = users[key];
                    if (user["username"] == username) {
                        document.getElementById('name-update').value = user["firstname"];
                        document.getElementById('lastname-update').value = user["lastname"];
                        document.getElementById('username').value = username;
                        document.getElementById('user').value = username;
                    }
                });
            });
        });

        var deleteUserButton = document.querySelectorAll('[data-bs-toggle="modal"]');

        deleteUserButton.forEach(function (button) {
            button.addEventListener("click", function () {
                username = this.getAttribute("data-groupname");
                document.getElementById('user-name-delete').innerHTML = username;

                Object.keys(users).forEach(function (key) {
                    var user = users[key];
                    if (user["username"] == username) {
                        document.getElementById('user-delete-id').value = user["username"];
                    }
                });
            });
        });

</script>

</body>