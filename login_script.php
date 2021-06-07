<?php
    var_dump($_POST);

    include("./connect.php");
    include("./functions.php");

    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);

    if (empty($email) || empty($password)) {
        // check of alles is ingevult
        header("location: ./index.php?content=message&alert=loginform-empty");
    } else {

            $sql = "SELECT * FROM `register` WHERE `email` = '$email'";

            $result = mysqli_query($conn, $sql);

            // var_dump(mysqli_num_rows($result));

            if (!mysqli_num_rows($result)) {
                // emai onbekend
                header("location: ./index.php?content=message&alert=email-unknow");
            } else {

                
                
                $record = mysqli_fetch_assoc($result);
                // var_dump((bool) $record["activated"]);
                
                if (!$record["activated"]) {
                    header("location: ./index.php?content=message&alert=not-activated&email=$email");
                } elseif ( !password_verify($password, $record["password"])) {
                    // no pw match
                    header("location: ./index.php?content=message&alert=no-pw-match&email=$email");
                } else {
                    // password match


                                    $_SESSION["id"] = $record["id"];
                                    $_SESSION["userrole"] = $record["userrole"];
                    
                                   switch($record["userrole"]) {
                                    case 'customer':
                                    header("location: ./index.php?content=homepage");
                                    break;
                                    case 'admin':
                                    header("location: ./index.php?content=a-home");
                                    break;
                                    case 'root':
                                    header("location: ./index.php?content=r-home");
                                    break;
                                    case 'moderator':
                                    header("location: ./index.php?content=m-home");
                                    break;
                                    default:
                                    header("location: ./index.php?content=home");
                                    break;
                                   }



                                }
            }// emai onbekend


    }        // check of alles is ingevult
?>