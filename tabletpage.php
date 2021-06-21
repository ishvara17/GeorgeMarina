<?php
require_once("config.php");

if (!isset($_SESSION["id"])){
	header("location: ./index.php?content=message&alert=auth-error");
}

//cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	//product aan cart toevoegen
	case "add":
		if(!empty($_POST["quantity"])) {
			$pid=$_GET["pid"];
			$result=mysqli_query($con,"SELECT * FROM gerechten WHERE id='$pid'");
	          while($productByCode=mysqli_fetch_array($result)){
			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'category'=>$productByCode["category"], 'description'=>$productByCode["description"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			}  else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	}
	break;

	// product uit cart verwijderen
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	// cart is leeg
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<link href="style.css" type="text/css" rel="stylesheet" />
<head>
<link href="./CSS/tabletpage.css" rel="stylesheet">
</head>
</HEAD>
<BODY>



<!-- Cart ---->
<div id="shopping-cart">
<div class="txt-heading">Bestelling</div>

<a id="btnEmpty" href="index.php?content=tabletpage&action=empty">Alles verwijderen</a>

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	



<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Naam</th>
<th style="text-align:center;" width="5%">Code</th>
<th style="text-align:center;" width="10%">categorie</th>
<th style="text-align:center;" width="30%">Beschrijving</th>
<th style="text-align:right;" width="5%">Hoeveelheid</th>
<th style="text-align:right;" width="10%">Totaal</th>
<th style="text-align:right;" width="10%">Prijs</th>
<th style="text-align:center;" width="5%">Verwijderen</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
                <td><?php echo $item["category"]; ?></td>
                <td><?php echo $item["description"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?content=tabletpage&action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="./img/icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
				
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
<a id="btnEmpty" href="index.php?content=verzonden" class="btn btn-lg active" role="button" aria-pressed="true">Checkout</a>
</tr>
</tbody>
</table>		
  <?php
  
} else {
?>
<div class="no-records">Uw lijst is leeg</div>
<?php 
}
?>
</div>




<div id="product-grid">
	<div class="txt-heading">Gerechten</div>
	<?php
	$product= mysqli_query($con,"SELECT * FROM gerechten ORDER BY id ASC");
	if (!empty($product)) { 
		while ($row=mysqli_fetch_array($product)) {
		
	?>
		<div class="product-item" id="imageproduct">
			<form method="post" action="index.php?content=tabletpage&action=add&pid=<?php echo $row["id"]; ?>">
			<div class="product-image"><img src="<?php echo $row["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $row["name"]; ?></div>
            <div class="product-description"><i><?php echo $row["description"]; ?></i></div>
            <div class="product-category"><b><?php echo $row["category"]; ?></b></div>
			<div class="product-price"><?php echo "$".$row["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Toevoegen" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}  else {
 echo "No Records.";

	}
	?>
</div>



</BODY>
</HTML>