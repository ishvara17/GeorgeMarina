<?php
  if (empty($_POST["email"])) {
    header("Location: ./index.php?content=message&alert=no-email");
  } else {
    include("./connect_db.php");
    include("./functions.php");

    $email = sanitize($_POST["email"]);

    $sql = "SELECT * FROM `register` WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
      header("Location: ./index.php?content=message&alert=emailexists");
    } else {
      // De functie mk_password_hash_from_microtime() maakt een password hash,
      // haalt de tijd en datum op op basis van de php-functie microtime() 
      // en geeft dit terug in $array
      $array = mk_password_hash_from_microtime();      
      
      $sql = "INSERT INTO `register` (`id`,
                                      `email`,
                                      `password`,
                                      `userrole`,
                                      `activated`)
              VALUES                 (NULL,
                                      '$email',
                                      '{$array["password_hash"]}',
                                      'customer',
                                      0)";
      // echo $sql;exit();
      if (mysqli_query($conn, $sql)) {

        $id = mysqli_insert_id($conn);

        $to = $email;
        $subject = "Activatielink voor uw account van Georgehollywood.nl";
        // include("./email.php");
        include("./alt-email.php");
        
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: admin@Georgehollywood.nl\r\n";
        $headers .= "Cc: moderator@Georgehollywood.nl\r\n";
        $headers .= "Bcc: root@Georgehollywood.nl";
        
        mail($to, $subject, $message, $headers);

        header("Location: ./index.php?content=message&alert=register-success");
      } else {
        header("Location: ./index.php?content=message&alert=register-error");
      }
    }
  }
?>