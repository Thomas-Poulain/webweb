<head>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/assets/fontawesome/css/all.css">
    <title id="title">Erreur</title>
    <script src="../static/assets/bootstrap/js/bootstrap.bundle.js"></script>
    <meta charset="utf-8">
</head>

<nav class="navbar border-bottom justify-content-center">
    <div class="container-fluid">
        <img src="../static/img/logo_balabox.png" alt="Logo" height="30" class="d-inline-block align-text-top">
    </div>
</nav>


<body>

    <div class="container my-4">
        <?php if(strpos($data['message'], 'CSV') !== false || strpos($data['message'], 'POST') !== false || $data['message'] === 'Le nom du groupe existe déjà' || $data['message'] === 'ID') { ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $data['message']; ?>
            </div>
            <a href="javascript:history.go(-1)" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        <?php } elseif($data['message'] === 'Vous n\'avez pas de permission d\'entrer dans cette page') { ?>
            <div class="alert alert-warning">
                <i class="fas fa-lock"></i> <?php echo $data['message']; ?> <a href="/connect">Se connecter</a>
            </div>
        <?php } else { ?>
            <div class="alert alert-info">
                <?php echo $data['message']; ?>
            </div>
        <?php } ?>
    </div>

</body>
