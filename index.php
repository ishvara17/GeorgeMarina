
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css"> <link rel="stylesheet" href="./contact.css">
    <!-- favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- de google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Monoton|Ubuntu&display=swap" rel="stylesheet">
    <!-- Font Awesome 4 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <title>Fantastisch vuurwerk</title>


    <!-- Image and text -->
</head>


<body>
    <main class="container-fluid">
    <div class="row" id="navImage">
        <div class="col-12">
            <?php
                    include("./nav.php");
                    ?>
            </div>
        </div>
    <div class="row" id="navbar">
        <div class="col-12">
            <?php
                    include("./navbar.php");
                    ?>
            </div>
        </div>
    </div>
    
        <div class="row" id="content">
            <div class="col-12">
                <?php
                  if ( isset($_GET["content"]) ){
                    include("./" . $_GET["content"] . ".php");
                  }
                  else {
                    include("./homepage.php");
                  }
      
                ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <?php
                  include("./footer.php");
                  ?>
            </div>
        </div>
    </main>
</body>









<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="./js/app.js"></script>
</body>

</html>