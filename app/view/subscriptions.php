<?php
require_once $pathGet . "photo.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Subscriptions'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>subscriptions.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
    <div class="space">
        <h3><?php echo $lang['Subscriptions'] ?></h3>
    </div>
    <div class="container">
    <?php for ($i = 0; $i < count($subsActive); $i++): ?>
        <div class="subsRight">
            <h2><?php if ($_SESSION['lang'] == "en") {echo $subsActive[$i]['titleen'];} else {echo $subsActive[$i]['title'];}?></h2>
            <p><?php if ($_SESSION['lang'] == "en") {echo $subsActive[$i]['descriptionen'];} else {echo $subsActive[$i]['description'];}?></p>
            <img src="<?php echo $pathImages . subsPhotoFirst($subscriptionPhotos, $subsActive[$i]['id'])['name'] ?>" >
            <a href="<?php echo $rootDir . "?url=subscription&id=" . $subsActive[$i]['id'] ?>" class="primaryBtn"><?php echo $lang['More'] . " " ?> <i class="fas fa-chevron-right"></i></a>
        </div>
        <?php $i++;if ($i < count($subsActive)): ?>
            <div class="subsLeft">
                <img src="<?php echo $pathImages . subsPhotoFirst($subscriptionPhotos, $subsActive[$i]['id'])['name'] ?>" >
                <h2><?php if ($_SESSION['lang'] == "en") {echo $subsActive[$i]['titleen'];} else {echo $subsActive[$i]['title'];}?></h2>
                <p><?php if ($_SESSION['lang'] == "en") {echo $subsActive[$i]['descriptionen'];} else {echo $subsActive[$i]['description'];}?></p>
                <a href="<?php echo $rootDir . "?url=subscription&id=" . $subsActive[$i]['id'] ?>" class="primaryBtn"><i class="fas fa-chevron-left"> </i><?php echo " " . $lang['More'] ?></a>
            </div>
        <?php endif;?>
    <?php endfor;?>
    </div>
</section>

    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>
