<?php
require_once $pathGet . "service.get.php";
require_once $pathGet . "photo.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Services'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>services.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>

<div class="space">
    <h3><?php echo $lang['Services'] ?></h3>
</div>
<div class="container">

    <?php for ($i = 0; $i < count($services); $i++): ?>

        <div class="serviceRight">
            <h2><?php if ($_SESSION['lang'] == 'en') {echo $services[$i]['titleen'];} else {echo $services[$i]['title'];}?></h2>
            <p><?php if ($_SESSION['lang'] == 'en') {echo $services[$i]['abouten'];} else {echo $services[$i]['about'];}?></p>
            <div class="photo">
                <div class="photoActive">
                    <img src="<?php echo $pathImages . servicePhotoLast($servicesPhotos, $services[$i]['id'])['name'] ?>" >
                    <?php foreach ($servicesPhotos as $servicePhoto): ?>
                        <?php if ($servicePhoto['locationId'] == $services[$i]['id']): ?>
                            <img src="<?php echo $pathImages . $servicePhoto['name'] ?>" >
                        <?php endif;?>
                    <?php endforeach;?>
                    <img src="<?php echo $pathImages . servicePhotoFirst($servicesPhotos, $services[$i]['id'])['name'] ?>" >
                </div>
            </div>
        </div>

        <?php $i++?>
        <?php if ($i < count($services)): ?>

        <div class="serviceLeft">
            <div class="photo">
                <div class="photoActive">
                    <img src="<?php echo $pathImages . servicePhotoLast($servicesPhotos, $services[$i]['id'])['name'] ?>" >
                    <?php foreach ($servicesPhotos as $servicePhoto): ?>
                        <?php if ($servicePhoto['locationId'] == $services[$i]['id']): ?>
                            <img src="<?php echo $pathImages . $servicePhoto['name'] ?>" >
                        <?php endif;?>
                    <?php endforeach;?>
                    <img src="<?php echo $pathImages . servicePhotoFirst($servicesPhotos, $services[$i]['id'])['name'] ?>" >
                </div>
            </div>
            <h2><?php if ($_SESSION['lang'] == 'en') {echo $services[$i]['titleen'];} else {echo $services[$i]['title'];}?></h2>
            <p><?php if ($_SESSION['lang'] == 'en') {echo $services[$i]['abouten'];} else {echo $services[$i]['about'];}?></p>
        </div>

        <?php endif;?>
    <?php endfor;?>
</div>
<script src="<?php echo $pathJs . "carouselImg.js" ?>"></script>
<?php include $pathIncludes . 'footer.php'?>
</body>
</html>