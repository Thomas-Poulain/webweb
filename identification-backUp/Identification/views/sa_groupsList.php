<?php
include __ROOT__."/views/header.html";
?>

<body>

<div class="container my-4">
    <h1>Liste des classes</h1>
    <?php if (count($groups) == 0) { ?>
        <p>Pas de classe</p>
    <?php } else { ?>
        <?php foreach($groups as $group) { ?>
            <div class="card my-3">
                <div class="card-header d-flex align-items-center justify-content-between"> 
                    <h2 class="mb-0"><i class="fas fa-users me-2"></i><?php echo $group['name']; ?></h2>
                    <div class="d-flex flex-wrap align-items-center justify-content-end">

                        <form method="post" class="me-3 mb-3 mb-md-0">
                            <input type="hidden" name="isDeleteGroup" value="<?php echo $group['name']; ?>" />
                            <button type="submit" class="btn btn-danger align-items-center" style="width: 40px; height: 40px;"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <button type="button" id="deleteMemberbtn" class="btn btn-danger d-flex align-items-center justify-content-center me-3 mb-3 mb-md-0" data-groupname="<?php echo $group['name']; ?>" data-bs-toggle="modal" data-bs-target="#delete-member-modal-<?php echo $group['id']; ?>" style="width: 40px; height: 40px;"><i class="fas fa-user-times"></i></button> 
                        <button type="button" id="updateGroupbtn" class="btn btn-primary d-flex align-items-center justify-content-center me-3 mb-3 mb-md-0" data-groupname="<?php echo $group['name']; ?>" data-bs-toggle="modal" data-bs-target="#update-group-modal-<?php echo $group['id']; ?>" style="width: 40px; height: 40px;"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center me-3 mb-3 mb-md-0" data-groupname="<?php echo $group['name']; ?>" data-bs-toggle="modal" data-bs-target="#add-member-modal-<?php echo $group['id']; ?>" style="width: 40px; height: 40px;"><i class="fas fa-user-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                <h3><i class="fas fa-users me-2"></i>
                    <?php if (count($group['members']) == 0) {
                        echo 'Aucun Membre';
                    } else {
                        echo count($group['members']) . ' Membre';
                        if (count($group['members']) > 1) {
                            echo 's';
                        }
                    } ?> :
                </h3>
                    <ul>
                        <?php foreach($group['members'] as $member) { ?>
                            <li><?php echo $member['lastname'] . ' ' . $member['firstname'] . ' (' . $member['username'] . ')'; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        <?php } ?>
    <?php } ?>    

        <!-- Add Member -->
        <div class="modal fade" id="add-member-modal-<?php echo $group['id']; ?>" tabindex="-1" aria-labelledby="add-member-modal-<?php echo $group['id']; ?>-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-center ed">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-member-modal-label">Ajouter un membre à la classe <span id="group-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher un utilisateur..." id="search-users-input">
                        <button class="btn btn-primary" type="button" id="search-users-button">Rechercher</button>
                    </div>
                    <div id="users-list">
                </div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn add btn-primary">Ajouter</button>
                        </div>
                    
                </div>
            </div>
        </div>

        <!-- Delete Member -->
        <div class="modal fade" id="delete-member-modal-<?php echo $group['id']; ?>" tabindex="-1" aria-labelledby="delete-member-modal-<?php echo $group['id']; ?>-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-member-modal-<?php echo $group['id']; ?>-label">Supprimer un membre du groupe  <span id="group-name-delete"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher un utilisateur..." id="search-users-input-delete">
                    <button class="btn btn-primary" type="button" id="search-users-button-delete">Rechercher</button>
                    </div>
                    <div id="users-list-delete"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn delete btn-danger" id="delete-member-button">Supprimer</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Update Group -->
        <div class="modal fade" id="update-group-modal-<?php echo $group['id']; ?>" tabindex="-1" aria-labelledby="update-group-modal-<?php echo $group['id']; ?>-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-group-modal-<?php echo $group['id']; ?>-label">Modifier le groupe <span id="group-name-update"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="name-group" class="form-label">Nom du groupe</label>
                            <input type="hidden" id="old-name" name="updateGroup" />
                            <input type="text" class="form-control" id="name-update" name="newName" placeholder="Entrez le nom du groupe" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-desc-group" class="form-label">Description du groupe</label>
                            <textarea class="form-control" id="group-desc-update" name="desc-group" rows="3" placeholder="Entrez une description du groupe"></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

    
</div>


<a href="sa_classCreate" class="btn btn-primary btn-lg position-fixed" style="bottom: 20px; right: 20px;" role="button">+</a>
        




<script>
    
    var groupName = "";
    document.addEventListener("DOMContentLoaded", function() {

        // Add Member
        var addMemberButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        var searchUsersButton = document.querySelector("#search-users-button");
        addMemberButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                groupName = this.getAttribute("data-groupname");
                document.getElementById('group-name').innerHTML = groupName;
            });
        });

        searchUsersButton.addEventListener("click", function() {
            var searchText = document.querySelector("#search-users-input").value.toLowerCase();
            var usersList = document.querySelector("#users-list");
            usersList.innerHTML = "";
            var count = 0; // variable pour compter le nombre de boutons
            <?php foreach($usersWithoutGroup as $username) { ?>
                if ("<?php echo $username; ?>".includes(searchText)) {
                    var div = document.createElement("div");
                    div.className = "my-2 d-flex justify-content-center";

                    var toggleBtn = document.createElement("input");
                    toggleBtn.setAttribute("type", "checkbox");
                    toggleBtn.setAttribute("class", "btn-check col-2");
                    toggleBtn.setAttribute("id", "<?php echo $username; ?>");
                    toggleBtn.setAttribute("autocomplete", "off");

                    var label = document.createElement("label");
                    label.setAttribute("class", "btn btn-outline-primary col-8 mx-3");
                    label.setAttribute("for", "<?php echo $username; ?>");

                    var labelText = document.createTextNode("<?php echo $username; ?>");
                    label.appendChild(labelText);

                    div.appendChild(toggleBtn);
                    div.appendChild(label);
                    usersList.appendChild(div);
                }
            <?php } ?>


            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener("click", function () {
                    var otherCheckboxes = document.querySelectorAll('input[type="checkbox"]:not(#' + checkbox.id + ')');
                    otherCheckboxes.forEach(function (otherCheckbox) {
                        otherCheckbox.parentNode.parentNode.removeChild(otherCheckbox.parentNode);
                    });
                    
                    if (!checkbox.checked) {
                        searchUsersButton.click();
                    }
                });
            });



            var addMemberModal = document.querySelector("#add-member-modal-");
            var addMemberButton = addMemberModal.querySelector(".add");
            addMemberButton.addEventListener("click", function() {
                var checkedCheckbox = document.querySelector('input[type="checkbox"]:checked');
                if (checkedCheckbox) {
                    var username = checkedCheckbox.id;
                    var formData = new FormData();
                    formData.append("addMember", groupName);
                    formData.append("member", username);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "/sa_groupsList");
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            window.location.reload();
                        }
                    };
                    xhr.send(formData);
                }
            });

        });

        // Delete Member
        var deleteMemberButton = document.querySelector("#delete-member-button");
        var searchUsersButtonDelete = document.querySelector("#search-users-button-delete");
        var usersListDelete = document.querySelector("#users-list-delete");
        var checkboxesDelete = [];
        var groups = <?php echo json_encode($groups); ?>;
        var listUsersOnGroup;
        var usersOnGroup;
        


        var deleteMemberButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        deleteMemberButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                groupName = this.getAttribute("data-groupname");
                document.getElementById('group-name-delete').innerHTML = groupName;

                groups.forEach(function (group) {
                    if (group["name"] == groupName) {
                        listUsersOnGroup = group["members"];
                        usersOnGroup = listUsersOnGroup.map(function (user) {
                            return user["username"];
                        });
                    }
                });
            });
        });

        searchUsersButtonDelete.addEventListener("click", function() {
            var searchTextDelete = document.querySelector("#search-users-input-delete").value.toLowerCase();
            usersListDelete.innerHTML = "";
            checkboxesDelete = [];
            var countDelete = 0;
            usersOnGroup.forEach(function(username) {
                if (username.includes(searchTextDelete)) {
                    var divDelete = document.createElement("div");
                    divDelete.className = "my-2 d-flex justify-content-center";

                    var toggleBtnDelete = document.createElement("input");
                    toggleBtnDelete.setAttribute("type", "checkbox");
                    toggleBtnDelete.setAttribute("class", "btn-check col-2");
                    toggleBtnDelete.setAttribute("id", username);
                    toggleBtnDelete.setAttribute("autocomplete", "off");

                    var labelDelete = document.createElement("label");
                    labelDelete.setAttribute("class", "btn btn-outline-danger col-8 mx-3");
                    labelDelete.setAttribute("for", username);

                    var labelTextDelete = document.createTextNode(username);
                    labelDelete.appendChild(labelTextDelete);

                    divDelete.appendChild(toggleBtnDelete);
                    divDelete.appendChild(labelDelete);
                    usersListDelete.appendChild(divDelete);
                }
            });

            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener("click", function () {
                    var otherCheckboxes = document.querySelectorAll('input[type="checkbox"]:not(#' + checkbox.id + ')');
                    otherCheckboxes.forEach(function (otherCheckbox) {
                        otherCheckbox.parentNode.parentNode.removeChild(otherCheckbox.parentNode);
                    });
                    
                    if (!checkbox.checked) {
                        searchUsersButtonDelete.click();
                    }
                });
            });


            var deleteMemberModal = document.querySelector("#delete-member-modal-");
            var deleteMemberButton = deleteMemberModal.querySelector(".delete");
            deleteMemberButton.addEventListener("click", function() {
                var checkedCheckbox = document.querySelector('input[type="checkbox"]:checked');
                if (checkedCheckbox) {
                    var username = checkedCheckbox.id;
                    var formData = new FormData();
                    formData.append("deleteMember", groupName);
                    formData.append("member", username);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "/sa_groupsList");
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            window.location.reload();
                        }
                    };
                    xhr.send(formData);
                }
            });
        });

        // Update Group
        var descGroup ;
        var updateGroupButton = document.querySelectorAll('[data-bs-toggle="modal"]');
        updateGroupButton.forEach(function (button) {
            button.addEventListener("click", function () {
                groupName = this.getAttribute("data-groupname");
                document.getElementById('group-name-update').innerHTML = groupName;


                groups.forEach(function (group) {
                    if (group["name"] == groupName) {
                        document.getElementById('name-update').value = groupName;
                        document.getElementById('old-name').value = groupName;
                        document.getElementById('group-desc-update').value = group["description"];
                    }
                });

            });
        });
    });
</script>

</body>