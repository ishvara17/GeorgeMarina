<?php session_start(); session_gc(); 

$active = (isset($_GET["content"])) ? $_GET["content"] : "";
?>


<img src="./img/logo.png" alt="" id="logoImage">

<a href="index.php?content=productenpage" id="homeButton1" class="btn btn-outline stretched-link"><b>Bestellen</b></a>
<a href="index.php?content=reservering" id="homeButton2" class="btn btn-outline stretched-link"><b>Reserveren</b></a>
<a href="index.php?content=homepage" id="homeButton4" class="btn btn-outline stretched-link"><b>Home</b></a>

<?php if (isset($_SESSION["id"])) {
    echo ($active == "logout")? "active" : ""; echo '
      <a href="index.php?content=logout" id="homeButton3-active" class="btn btn-outline stretched-link"><b>Uitloggen</b></a>
            </li>'; } else {
                echo '<a href="index.php?content=login" id="homeButton3" class="btn btn-outline stretched-link"><b>Aanmelden</b></a>';
            } ?> 





