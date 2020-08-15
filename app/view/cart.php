<?php
require_once $pathGet . "cart.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Cart'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>cart.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
<div class="space">
    <h3><?php echo $lang['Cart'] ?></h3>
</div>
<div class="container">
    <div class="cart">
        <h3 id="product"><?php echo $lang['Product'] ?> </h3>
        <h3 id="units"><?php echo $lang["Units"] ?></h3>
        <h3 id="price"><?php echo $lang["Price"] ?></h3>
        <h3 id="delete"><?php echo $lang["Delete"] ?> </h3>

        <?php foreach ($cartItems as $cartItem): ?>
        <div class="product">
            <h4 class='name'><?php if ($_SESSION['lang'] == 'en') {echo $cartItem['titleen'];} else {echo $cartItem['title'];}?></h4>
            <img class='img' src="<?php echo $pathImages . $cartItem['photo'] ?>" >

        </div>
        <h4 class="units"><?php echo $cartItem['units'] ?></h4>

        <h4 class="price"><?php echo $cartItem['price'] ?> &euro;</h4>
        <form action="<?php echo $pathController . 'cart.controller.php' ?>" method="POST">
            <button type="submit" class="delete primaryBtn" name="deleteCart" value="<?php echo $cartItem['id'] ?>"><i class="fas fa-times"></i></button>
        </form>
        <?php endforeach;?>
    </div>
    <div class="total">
        <h3><?php echo $lang['Total'] . " : " . $cartTotal ?> &euro;</h3>
        <a href="<?php echo $rootDir ?>?url=pay" class='pay primaryBtn'><?php echo $lang['Pay'] ?> <i class="fas fa-chevron-right"></i></a>
    </div>
</div>

</section>
    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>
