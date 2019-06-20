<!-- Sidebar/menu -->
<nav class="nav-bar">
    <img id="logo" src="./Images/SnapRecip2.png">
    <?php
    if (isset($_SESSION['email']))
    {
        echo "<a href='./deconnexion.php'><div class='element'>Déconnexion</div></a>";
    }
    else
    {
        echo "<a href='./inscription.php'><div class='element'>Inscription</div></a>
            <a href='./connexion.php'><div class='element'>Connexion</div></a>";
    }
    ?>
    <a href='home.php'><div class='element'>Accueil</div></a>
    <?php
    if (isset($_SESSION['email']))
    {
        echo "<a href='./panier.php'><div class='element'>Panier</div></a>";
    }
    ?>
</nav>
