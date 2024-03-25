<!--Titouan JAMET - GrTP6 - Navigateur utilisé: Opera-->
<!DOCTYPE html>
<html>
<head>
    <title>OUUUUUUUUUUUURS</title>
    <meta charset="UTF-8"/>
    <html lang="en">
    <meta name="description" content="">
    <meta name="keywords" content="Un, Ours">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <p id="name">Ursidés</p>
</header>

<nav>
    <table>
        <tr>
            <th id="home"><a href="index.php">Home</a></th>
            <th id="about"><a href="about.php">About</a></th>
            <th id="contact"><a href="contact.php">Contact us</a></th>
            <th id="connect"><?php echo isset($_SESSION['username']) ? '<a href="logout.php">Logout</a>' : '<a href="#" onclick="loginShowHide()">Connect</a>'; ?></th>
        </tr>
    </table>
</nav>

<div id="form-background" onclick="loginShowHide()"></div>

<?php
session_start();

if (isset($_SESSION['username'])) {
    echo "<p>Welcome back, {$_SESSION['username']}!</p>";
} else {
    echo "<form id=\"login\" class=\"connect-button-forms\" action=\"login.php\" method=\"post\">
            <h1>Welcome back.</h1>
            <input id=\"log-login\" type=\"text\" name=\"username\" placeholder=\"Username\">
            <input id=\"log-pass\" type=\"password\" name=\"password\" placeholder=\"Password\">
            <p onclick=\"swapForms()\">Become Un ours.</p>
            <button type=\"submit\">Login</button>
          </form>

          <form id=\"register\" class=\"connect-button-forms\" action=\"register.php\" method=\"post\">
            <h1>Welcome.</h1>
            <input id=\"reg-prenom\" type=\"text\" name=\"firstname\" placeholder=\"First name\">
            <input id=\"reg-nom\" type=\"text\" name=\"lastname\" placeholder=\"Last name\">
            <input id=\"reg-login\" type=\"text\" name=\"username\" placeholder=\"Username\">
            <input id=\"reg-pass\" type=\"password\" name=\"password\" placeholder=\"Password\">
            <input id=\"reg-conf-pass\" type=\"password\" name=\"confirm_password\" placeholder=\"Confirm password\">
            <p onclick=\"swapForms()\">Already Un ours ??</p>
            <button type=\"submit\">Register</button>
          </form>";
}
?>

<img id="background" src="med/ours.jpg" alt="Background for the main display">

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
<script src="../controller/script.js"></script>
</html>
