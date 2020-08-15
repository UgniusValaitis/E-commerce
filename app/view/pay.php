<?php
require_once $pathGet . "cart.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Pay'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>pay.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
<div class="space">
    <h3><?php echo $lang['Delivery info'] ?></h3>
</div>
<div class="container">
    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            <h3><?php echo $lang['Unsuccessful Payment'] ?></h3>
        </div>
    <?php endif;?>
    <form action="<?php echo $pathController . "order.controller.php" ?>" method="POST">
        <div class="fname">
            <label for="fname"><?php echo $lang['First Name'] ?></label>
            <input type="text" name="fname" value="<?php if (isset($_GET['fname'])) {echo $_GET['fname'];} else {echo $_SESSION['fname'];}?>">
        </div>
        <div class="lname">
            <label for="fname"><?php echo $lang['Last Name'] ?></label>
            <input type="text" name="lname" value="<?php if (isset($_GET['lname'])) {echo $_GET['lname'];} else {echo $_SESSION['lname'];}?>">
        </div>
        <div class="address">
            <label for="address"><?php echo $lang['Full Address'] ?></label>
            <textarea name="address"><?php if (isset($_GET['address'])) {echo $_GET['address'];} else {echo $_SESSION['address'];}?></textarea>
        </div>
        <div class="message">
            <label for="message"><?php echo $lang['Additional info'] ?></label>
            <textarea name="message" placeholder="<?php echo $lang['Message'] ?>"><?php if (isset($_GET['message'])) {echo $_GET['message'];}?></textarea>
        </div>
        <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>">
        <button class="primaryBtn" type="submit" name="pay" value="<?php echo $_SESSION['id'] ?>"><?php echo $lang['Pay'] ?> <i class="fas fa-chevron-right"></i></button>
    </form>
</div>
</section>
    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>