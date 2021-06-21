<?php
class Reservation {
  // Properties
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message

  // Verbind met database
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );
    } catch (Exception $ex) { die($ex->getMessage()); }
  }

  // Stop verbinding van database
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }

  // Reservering opslaan
  function save ($date, $slot, $name, $email, $tel, $notes="") {


    // Database input
    try {
      $this->stmt = $this->pdo->prepare(
        "INSERT INTO `reservations` (`res_date`, `res_slot`, `res_name`, `res_email`, `res_tel`, `res_notes`) VALUES (?,?,?,?,?,?)"
      );
      $this->stmt->execute([$date, $slot, $name, $email, $tel, $notes]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }

    // Email

    $subject = "Reservering opgeslagen";
    $message = "Uw bestelling zal zo spoedig mogelijk worden afgeleverd";
    @mail($email, $subject, $message);
    return true;
  }
  
  // Haal reserveringen op
  function getDay ($day="") {
    
    if ($day=="") { $day = date("Y-m-d"); }
    
    
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `reservations` WHERE `res_date`=?"
    );
    $this->stmt->execute([$day]);
    return $this->stmt->fetchAll(PDO::FETCH_NAMED);
  }
}

// Database instellingen
define('DB_HOST', 'localhost');
define('DB_NAME', 'georgemarina');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Nieuwe reservering-object
$_RSV = new Reservation();