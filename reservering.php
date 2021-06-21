<!DOCTYPE html>
<html>
  <head>
    <title>
      
    </title>
    <link href="./CSS/reserveren.css" rel="stylesheet">
    </script>
  </head>
  <body>
    <?php
    // Reserveer proces-bericht
    if (isset($_POST['date'])) {
      require "reserveren.php";
      if ($_RSV->save(
        $_POST['date'], $_POST['slot'], $_POST['name'],
        $_POST['email'], $_POST['tel'], $_POST['notes'])) {
        echo "<div class='ok'>Reservering opgeslagen.</div>";
      } else { echo "<div class='err'>".$_RSV->error."</div>"; }
    }
    ?>

    <!-- Reserveer form -->
    <h1></h1>
    <form id="resForm" method="post" target="_self">
      <label for="res_name">Volledige naam</label>
      <input type="text" required name="name" value=""/>
      <label for="res_email">Email</label>
      <input type="email" required name="email" value=""/>
      <label for="res_tel">Telefoonnummer</label>
      <input type="text" required name="tel" value=""/>
      <label for="res_notes">Notities <i>(verjaardag etc.)</i></label>
      <input type="text" name="notes" value=""/>
      <label>Reserveer datum</label>
      <input type="date" required id="res_date" name="date" value="<?=date("Y-m-d")?>">
      <label>Lunch/Diner</label>
      <select name="slot">
        <option value="AM">Lunch</option>
        <option value="PM">Diner</option>
      </select>
      <input type="submit" value="Verstuur" id="submit"/>
    </form>
    <br>
  </body>
</html>