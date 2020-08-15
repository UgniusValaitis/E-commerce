<?php
require_once $pathGet . "contacts.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Contacts'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>contacts.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
<div class="space">
    <h3><?php echo $lang['Contacts'] ?></h3>
</div>
<div class="contacts">
    <?php for ($i = 0; $i < count($contacts); $i++): ?>
        <div class="right">
            <i class="<?php echo $contacts[$i]['fa'] ?>"></i>
            <h3><?php echo $contacts[$i]['title'] ?></h3>
        </div>
        <?php $i++;if ($i < count($contacts)): ?>
        <div class="left">
            <h3><?php echo $contacts[$i]['title'] ?></h3>
            <i class="<?php echo $contacts[$i]['fa'] ?>"></i>
        </div>
        <?php endif;?>
    <?php endfor;?>
</div>
<div class="space">
    <h3><?php echo $lang['Contact Us'] ?></h3>
</div>
<div class="container">
    <form action="<?php echo $pathController . "users.controller.php" ?>" method="POST">
        <input id="name" name="name" type="text" placeholder="<?php echo $lang['Name'] ?>">
        <input id="email" name="email" type="email" placeholder="<?php echo $lang['Email'] ?>">
        <textarea name="message" id="message" cols="30" rows="10" placeholder="<?php echo $lang['Message'] ?>"></textarea>
        <button type="submit" name="mail" class="submit primaryBtn"><?php echo $lang['Send'] ?> <i class="fas fa-chevron-right"></i></button>
    </form>
</div>
</section>

    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>
