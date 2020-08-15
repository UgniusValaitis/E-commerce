<?php
require_once $pathGet . "photo.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Subscription'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>subscription.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
    <div class="space">
        <h3><?php echo $lang['Subscriptions'] ?></h3>
    </div>
    <div class="container">
        <?php foreach ($subsActive as $subs): ?>
            <?php if ($subs['id'] == $_GET['id']): ?>
                <div class="subs">
                    <h2><?php if ($_SESSION['lang'] == "en") {echo $subs['titleen'];} else {echo $subs['title'];}?></h2>
                    <div class="photo">
                        <div class="photoActive">
                            <img src="<?php echo $pathImages . subsPhotoFirst($subscriptionPhotos, $subs['id'])['name'] ?>" >
                            <?php foreach ($subscriptionPhotos as $subsPhoto): ?>
                                <?php if ($subsPhoto['locationId'] == $subs['id']): ?>
                                    <img src="<?php echo $pathImages . $subsPhoto['name'] ?>" >
                                <?php endif;?>
                            <?php endforeach;?>
                            <img src="<?php echo $pathImages . subsPhotoLast($subscriptionPhotos, $subs['id'])['name'] ?>" >
                        </div>
                    </div>
                    <p><?php if ($_SESSION['lang'] == "en") {echo $subs['abouten'];} else {echo $subs['about'];}?></p>
                    <?php if (isset($_SESSION['id'])): ?>
                    <div class="pricem">
                    <?php if ($subs['pricem'] > 0): ?>
                        <h3><?php echo $subs['pricem'] ?> &euro; / <?php echo $lang['Month'] ?></h3>
                        <form action="<?php echo $pathController . "cart.controller.php" ?>" method="POST">
                            <input type="number" name="units" value='1'>
                            <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="price" value="<?php echo $subs['pricem'] ?>">
                            <input type="hidden" name='title' value="<?php echo $subs['title'] ?>">
                            <input type="hidden" name="photo" value="<?php echo subsPhotoFirst($subscriptionPhotos, $subs['id'])['name'] ?>">
                            <input type="hidden" name='titleen' value="<?php echo $subs['titleen'] ?>">
                            <button class="primaryBtn" name="subsm" type="submit" value="<?php echo $subs['id'] ?>"><?php echo $lang['To Cart'] ?></button>
                        </form>
                        <?php endif;?>
                    </div>
                    <?php if ($subs['pricey'] > 0): ?>
                    <div class="pricey">
                        <h3><?php echo $subs['pricey'] ?> &euro; / <?php echo $lang['Year'] ?></h3>
                        <form action="<?php echo $pathController . "cart.controller.php" ?>" method="POST">
                            <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="price" value="<?php echo $subs['pricey'] ?>">
                            <input type="hidden" name='title' value="<?php echo $subs['title'] ?>">
                            <input type="hidden" name="photo" value="<?php echo subsPhotoFirst($subscriptionPhotos, $subs['id'])['name'] ?>">
                            <input type="hidden" name='titleen' value="<?php echo $subs['titleen'] ?>">
                            <button class="primaryBtn" name='subsy' type='submit' value="<?php echo $subs['id'] ?>"><?php echo $lang['To Cart'] ?></button>
                        </form>
                    </div>
                    <?php endif;?>
                <?php else: ?>
                    <h6><?php echo $lang['Login or signup'] ?></h6>
                <?php endif;?>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    </div>
</section>

    <?php include $pathIncludes . 'footer.php'?>
    <script src="<?php echo $pathJs . "carouselImg.js" ?>"></script>

</body>
</html>
