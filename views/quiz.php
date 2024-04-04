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
    <link rel="stylesheet" href="/views/css/style.css">
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
                        <th id=\"about\"><a href=\"about\">About</a></th>
                        <th id=\"contact\"><a href=\"contact\">Contact us</a></th>
                        <th id=\"connect\"><a href=\"disconnect\">Logout</a></th>
                    </tr>
                </table>
            </nav>";
        }else{
            echo "<nav>
                <table>
                    <tr>
                        <th id=\"home\"><a href=\"/\">Home</a></th>
                        <th id=\"about\"><a href=\"about\">About</a></th>
                        <th id=\"contact\"><a href=\"contact\">Contact us</a></th>
                        <th id=\"quiz\"><a href=\"quiz\">Quiz</a></th>
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

<img id="background" src="/views/med/ours.jpg" alt="Background for the main display">

<main class="container">
    <section id="quizArea">
        <form id="quizForm">
            <div>
                <h2>Question 1: Qu'est-ce que le phishing ?</h2>
                <label for="q1Option1"><input type="radio" id="q1Option1" name="q1" value="A">A. Un type de poisson</label><br>
                <label for="q1Option2"><input type="radio" id="q1Option2" name="q1" value="B">B. Une technique d'attaque utilisée pour obtenir des informations confidentielles</label><br>
                <label for="q1Option3"><input type="radio" id="q1Option3" name="q1" value="C">C. Un logiciel antivirus</label><br>
            </div>
            <div>
                <h2>Question 2: Quel est le meilleur moyen de sécuriser un mot de passe ?</h2>
                <label for="q2Option1"><input type="radio" id="q2Option1" name="q2" value="A">A. Utiliser un mot de passe simple et facile à retenir</label><br>
                <label for="q2Option2"><input type="radio" id="q2Option2" name="q2" value="B">B. Utiliser un mot de passe complexe et unique pour chaque compte</label><br>
                <label for="q2Option3"><input type="radio" id="q2Option3" name="q2" value="C">C. Ne pas utiliser de mot de passe du tout</label><br>
            </div>
            <div>
                <h2>Question 3: Qu'est-ce qu'un logiciel malveillant ?</h2>
                <label for="q3Option1"><input type="radio" id="q3Option1" name="q3" value="A">A. Un logiciel qui protège votre ordinateur</label><br>
                <label for="q3Option2"><input type="radio" id="q3Option2" name="q3" value="B">B. Un logiciel qui endommage ou compromet votre système</label><br>
                <label for="q3Option3"><input type="radio" id="q3Option3" name="q3" value="C">C. Un logiciel utilisé pour sauvegarder des fichiers</label><br>
            </div>
            <div>
                <h2>Question 4: Quelles sont les meilleures pratiques pour sécuriser un réseau Wi-Fi domestique ?</h2>
                <label for="q4Option1"><input type="checkbox" id="q1Option1" name="q1" value="A">A. Utiliser un mot de passe fort pour le réseau Wi-Fi</label><br>
                <label for="q4Option2"><input type="checkbox" id="q1Option2" name="q1" value="B">B. Activer le chiffrement WPA2 ou WPA3</label><br>
                <label for="q4Option3"><input type="checkbox" id="q1Option3" name="q1" value="C">C. Masquer le SSID du réseau</label><br>
                <label for="q4Option4"><input type="checkbox" id="q1Option4" name="q1" value="D">D. Activer le partage de fichiers publics sur tous les appareils connectés</label><br>
            </div>
            <div>
                <h2>Question 5: Quels sont les risques liés à l'utilisation de réseaux Wi-Fi publics non sécurisés ?</h2>
                <label for="q5Option1"><input type="checkbox" id="q2Option1" name="q2" value="A">A. Risque de vol d'informations personnelles</label><br>
                <label for="q5Option2"><input type="checkbox" id="q2Option2" name="q2" value="B">B. Risque de devenir un super-héros</label><br>
                <label for="q5Option3"><input type="checkbox" id="q2Option3" name="q2" value="C">C. Risque de trouver des trésors cachés</label><br>
                <label for="q5Option4"><input type="checkbox" id="q2Option4" name="q2" value="D">D. Risque de recevoir des cadeaux gratuits</label><br>
            </div>
            <div>
                <h2>Question 6: Quelles sont les mesures pour se protéger contre les attaques de phishing ?</h2>
                <label for="q6Option1"><input type="checkbox" id="q3Option1" name="q3" value="A">A. Ne jamais cliquer sur des liens suspects dans les e-mails</label><br>
                <label for="q6Option2"><input type="checkbox" id="q3Option2" name="q3" value="B">B. Donner toujours vos informations personnelles lorsque demandé par e-mail</label><br>
                <label for="q6Option3"><input type="checkbox" id="q3Option3" name="q3" value="C">C. Vérifier l'URL du site Web avant de fournir des informations</label><br>
                <label for="q6Option4"><input type="checkbox" id="q3Option4" name="q3" value="D">D. Répondre à toutes les questions posées dans l'e-mail sans vérification</label><br>
            </div>
            <button type="submit">Soumettre</button>
        </form>
    </section>
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
                    <img class="icon" src="/views/med/facebook.png">
                    <img class="icon" src="/views/med/discord.png">
                    <img class="icon" src="/views/med/linkedin.png">
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
<script src="/views/js/script.js"></script>
</html>
