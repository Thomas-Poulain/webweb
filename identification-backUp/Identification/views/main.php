<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../static/assets/bootstrap/css/bootstrap.css">
<meta charset="utf-8">
</head>

<body>
    <div class="container">

        <div class="row">

            <div class="col-md-6 offset-md-3">

                <div class="card my-5">

                    <form action="/connect" method="post" class="card-body p-lg-5">
                    <?php if(isset($message)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $message; ?>
                            </div>
                    <?php } ?>
                        <div class="text-center mb-5">
                            <img src="../static/img/logo_balabox.png" class="img-fluid" width="200px" alt="profile">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn px-5 mb-3 w-100  btn-primary">Connexion</button>
                        </div>
                    </form>
                </div>
             </div>
        </div>


    </div>
</body>
