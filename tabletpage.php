<head>
<link href="./CSS/tabletpage.css" rel="stylesheet">
<link href="./CSS/productenpage.css" rel="stylesheet">
</head>
<body>
<?php 

$product_ids = array();
//session_destroy();


if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        $count = count($_SESSION['shopping_cart']);
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
            $_SESSION['shopping_cart'][$count] = array
            (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
            );
        }
        else {
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
    }
    else { 
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}
//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>

<div class="card" id="blank" style="width: 18rem;">
  <div class="card-body">
  </div>
</div>

<div class="container">
    <div class="row">
<?php

define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASENAME", "georgemarina");

$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
$query = 'SELECT * FROM maaltijden ORDER by id ASC';

$result = mysqli_query($conn, $query);

if ($result){
    if(mysqli_num_rows($result)>0){
        while($product = mysqli_fetch_assoc($result)){
        ?>
        <div class="col-sm-4 col-md-4 Scard" id="tablet">
            <form method="post" action="index.php?content=productenpage&action=add&id=<?php echo $product['id'];?>">
                <div class="products" id="testproduct">
                    <img src="<?php echo $product['Image'];?>" class="img-responsive" id="imageProduct">
                    <h4 class="text-info"><?php echo $product['Naam']; ?></h4>
                    <p class="text-info"><?php echo $product['Beschrijving']; ?></p>
                    <h4>€ <?php echo $product['Prijs']; ?></h4>
                    <input type="text" name="quantity" class="form-control" value="1">
                    <input type="hidden" name="name" value="<?php echo $product['Categorie'];?>">
                    <input type="hidden" name="name" value="<?php echo $product['Naam'];?>"> 
                    <input type="hidden" name="price" value="<?php echo $product['Prijs'];?>">
                    <br>
                    <input id="btnproduct" type="submit" name="add_to_cart" class="btn btrn_info btn-dark" value="Add to Cart">
                </div>
            </form>
        </div>
        <?php
        }
    }
}
?>
    <div style="clear:both"></div>
    <br> 
    <div class="table-responsive" id="tablet">
    <table class="table">
    <tr id="ShoppingCard"><th colspan="5"><h3>Order Details</h3></th></tr>
    <tr id="ShoppingCard">
        <th width="25%">Maaltijd Naam</th>
        <th width="15%">Categorie</th>
        <th width="10%">Hoeveelheid</th>
        <th width="20%">Prijs</th>    
        <th width="15%">Totaal bedrag</th>    
    </tr>
    <?php
    if(!empty($_SESSION['shopping_cart'])):
        $total = 0;

        foreach($_SESSION['shopping_cart'] as $key => $product):
    ?>
    <tr id="ShoppingCard">
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
            <td> <a href="./index.php?content=productenpage&action=delete&id=<?php echo $product['id'];?>">
                    <div class="btn-dark">Verwijderen</div>                
                </a>
                
            </td>
    </tr>

    <?php 
            $total =  $total + ($product['quantity'] * $product['price']);
        endforeach;
    ?>
    <tr id="ShoppingCard">
        <td colspan="3" id="total" align="right">Totaal</td>
        <td align="right"><?php echo number_format($total, 2); ?></td>
        <td></td>
    </tr>


    </div>
    <?php 
    endif;
    ?>
    </table>
    </div>
    </div>
</div>
</body>
