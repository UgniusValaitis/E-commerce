<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Reset Password'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>resetpassword.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
    <div class="space">
        <h3><?php echo $lang["Reset Password"] ?></h3>
    </div>
    <div class="container">
        <p><?php echo $lang["Reset Password Instructions"] ?></p>
        <form action="<?php echo $pathController . "users.controller.php" ?>" method="POST">
            <input id="email" type="email" name="email" placeholder="<?php echo $lang['Email'] ?>">
            <button type="submit" name="recPwd" class="submit primaryBtn"><?php echo $lang["Send"] ?> <i class="fas fa-chevron-right"></i></button>
        </form>
    </div>
</section>

    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>
