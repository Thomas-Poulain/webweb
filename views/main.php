   <!--
    Jamet Titouan
    Poulain Thomas
    Hyeans Matthieu
    Testé sur Firefox
    -->
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
                        <th id=\"home\"><a href=\"/\">Home</a></th>
                        <th id=\"about\"><a href=\"/views/about.php\">About</a></th>
                        <th id=\"contact\"><a href=\"/views/contact.php\">Contact us</a></th>
                        <th id=\"connect\"><a href=\"/disconnect\">Logout</a></th>
                    </tr>
                </table>
            </nav>";
        }else{
            echo "<nav>
                <table>
                    <tr>
                        <th id=\"home\"><a href=\"/\">Home</a></th>
                        <th id=\"about\"><a href=\"/views/about.php\">About</a></th>
                        <th id=\"contact\"><a href=\"/views/contact.php\">Contact us</a></th>
                        <th id=\"quiz\"><a href=\"/quiz\">Quiz</a></th>
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
            <input id=\"log-login\" type=\"text\" name=\"username\" placeholder=\"email\" required>
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

          <form id=\"chgPass\" class=\"connect-button-forms\" action=\"resetPassword\" method=\"post\">
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

<footer>
        <aside id="footerTitle">
            <h1>Les Ours</h1>
            <h5 id="subtitle">Force de l'ours, douceur du cœur.</h5>
        </aside>

        <aside id="infos">
            <section class="footerSection">
                <h3>Navigation</h3>
                <ul class="ulFooter">
                    <li class="listFooter"><a href="#">Home</a></li>
                    <li class="listFooter"><a href="#">About</a></li>
                    <li class="listFooter"><a href="#">Contact us</a></li>
                    <li class="listFooter"><a href="#">Connect</a></li>
                </ul>
            </section>

            <section class="footerSection">
                <h3>Partenaires</h3>
                <ul class="ulFooter">
                    <li class="listFooter"><a href="#">Lien partenaire 1</a></li>
                    <li class="listFooter"><a href="#">Lien partenaire 2</a></li>
                    <li class="listFooter"><a href="#">Lien partenaire 3</a></li>
                </ul>
            </section>

            <section class="footerSection">
                <h3 id="contactTitle">Contact</h3>
                <p>00 Avenue road</p>
                <p>56000 Vannes</p>
                <p>France</p>
                <section id="icons">
                    <img class="icon" src="views/med/facebook.png">
                    <img class="icon" src="views/med/discord.png">
                    <img class="icon" src="views/med/linkedin.png">
                </section>
            </section>
        </aside>

        <hr id="hrFooter">
        <aside>
            <span id="end1">Created by Poulain Thomas / Jamet Titouan / HYEANS Matthieu. All rigth reserved</span>
            <span id="end2">Terms of service</span>
        </aside>
    </footer>

</body>
<script src="views/js/script.js"></script>
</html>
