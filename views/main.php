<!--Titouan JAMET - GrTP6 - Navigateur utilisé: Opera-->
<!DOCTYPE html>
<html>
<head>
    <title>Ours</title>
    <meta charset="UTF-8"/>
    <html lang="en">
    <meta name="description" content="">
    <meta name="keywords" content="Un, Ours">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" href="views/css/style.css">
</head>
<body>
<header>
    <p id="name">Ursidés</p>
</header>

    <?php

        if(isset($_SESSION['username'])){
            echo "<nav>
                <table>
                    <tr>
                        <th id=\"home\"><a href=\"index.php\">Home</a></th>
                        <th id=\"about\"><a href=\"about.php\">About</a></th>
                        <th id=\"contact\"><a href=\"contact.php\">Contact us</a></th>
                        <th id=\"ChangePasswd\"><a href=\"#\">MDP Oublié</a></th>
                        <th id=\"connect\"><a href=\"/disconnect\">Logout</a></th>
                    </tr>
                </table>
            </nav>";
        }else{
            echo "<nav>
                <table>
                    <tr>
                        <th id=\"home\"><a href=\"index.php\">Home</a></th>
                        <th id=\"about\"><a href=\"about.php\">About</a></th>
                        <th id=\"contact\"><a href=\"contact.php\">Contact us</a></th>
                        <th id=\"connect\"><a href=\"#\" onclick=\"loginShowHide()\">Connect</a></th>
                    </tr>
                </table>
            </nav>";
        }
    ?>

<div id="form-background" onclick="loginShowHide()"></div>

<?php

if (isset($_SESSION['username'])) {
    echo "<p>Welcome back, {$_SESSION['username']}!</p>";
} else {
    echo "<form id=\"login\" class=\"connect-button-forms\" action=\"connect\" method=\"post\">
            <h1>Welcome back.</h1>
            <input id=\"log-login\" type=\"text\" name=\"username\" placeholder=\"Username\" required>
            <input id=\"log-pass\" type=\"password\" name=\"password\" placeholder=\"Password\" required>
            <p onclick=\"swapForms()\">Create an account.</p>
            <p onclick=\"displayChangePass()\">Change password.</p>
            <button type=\"submit\">Login</button>
          </form>

          <form id=\"register\" class=\"connect-button-forms\" action=\"createUser\" method=\"post\">
            <h1>Welcome.</h1>
            <input id=\"reg-email\" type=\"email\" name=\"email\" placeholder=\"Email\" required>
            <input id=\"reg-prenom\" type=\"text\" name=\"firstname\" placeholder=\"First name\" required>
            <input id=\"reg-nom\" type=\"text\" name=\"lastname\" placeholder=\"Last name\" required>
            <input id=\"reg-pass\" type=\"password\" name=\"password\" placeholder=\"Password\" required>
            <input id=\"reg-conf-pass\" type=\"password\" name=\"confirm_password\" placeholder=\"Confirm password\" required>
            <p onclick=\"swapForms()\">Already an account</p>
            <button type=\"submit\">Register</button>
          </form>;

          <form id=\"chgPass\" class=\"connect-button-forms\" action=\"connect\" method=\"post\">
            <h1>New password.</h1>
            <input id=\"reg-email\" type=\"email\" name=\"email\" placeholder=\"Enter your mail\" required>
            <input id=\"log-pass\" type=\"password\" name=\"password\" placeholder=\"New password\" required>
            <input id=\"reg-conf-pass\" type=\"password\" name=\"confirm_password\" placeholder=\"Confirm new password\" required>
            <button type=\"submit\">Validate</button>
          </form>";
}
?>

<img id="background" src="views/med/ours.jpg" alt="Background for the main display">

<main>
    <div id="text-main-display">
        <h2>Home</h3>
            <hr>
            <h1>Un ours.</h1>
            <hr>
            <h3>Deux ours?</h3>
    </div>
    <section id="membres">
        <h1>Rubrique</h1>
        <hr>
    </section>
    <section id="partenaires">
        <h1>Rubrique</h1>
        <hr>
    </section>
    <section id="next-event">
        <h1>Rubrique</h1>
    </section>
    <aside id="avis">
        <h1>Notes</h1>
    </aside>
</main>

<footer> </footer>

</body>
<script src="views/js/script.js"></script>
</html>
