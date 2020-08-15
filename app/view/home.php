<?php
require_once $pathGet . "home.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <title>KaS || <?php echo $lang['Home'] ?></title>
    <meta charset="UTF-8">
    <meta rel="canonical" href="?lang=en">
    <meta rel="alternate" hreflang="lt" href="?lang=lt" title="Accept-Language">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $lang['description'] ?>">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>home.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
    <div class="space">
        <h3><?php echo $lang['About us'] ?></h3>
    </div>
    <div id="kestas" class="container">
        <h1>KĘSTAS</h1>
        <img src="<?php echo $pathImages . $kestas['photo'] ?>">
        <p><?php if ($_SESSION['lang'] == 'en') {echo $kestas['abouten'];} else {echo $kestas['about'];}?></p>
    </div>
    <div class="overflow">
        <div id="worksK" class="container">
            <?php $i = 0;foreach ($kestasWorks as $kestasWork): ?>
                <?php if ($kestasWork['location'] == 'kestas'): ?>
                    <div <?php echo ($i == 0) ? "id='first'" : "" ?> <?php echo ($i == 0) ? "class='work active'" : "class='work pre'" ?>>
                        <i id="prew" class="fas fa-chevron-left"></i>
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $kestasWork['titleen'];} else {echo $kestasWork['title'];}?></h2>
                        <img src="<?php echo $pathImages . $kestasWork['photo'] ?>" >
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $kestasWork['abouten'];} else {echo $kestasWork['about'];}?></p>
                        <i id="next" class="fas fa-chevron-right"></i>
                    </div>
                <?php endif;?>
            <?php $i++;endforeach;?>
        </div>
    </div>
    <div class="space">
        <h3>AND</h3>
    </div>
    <div id="sonata" class="container">
        <p><?php if ($_SESSION['lang'] == 'en') {echo $sonata['abouten'];} else {echo $sonata['about'];}?></p>
        <img src="<?php echo $pathImages . $sonata['photo'] ?>">
        <h1>SONATA</h1>
    </div>
    <div class="overflow">
        <div id="worksS" class="container">
            <?php $q = 0;foreach ($sonataWorks as $sonataWork): ?>
                <?php if ($sonataWork['location'] == 'sonata'): ?>
                    <div <?php echo $q ?> <?php echo ($q == 0) ? "id='first'" : "" ?> <?php echo ($q == 0) ? "class='work active'" : "class='work pre'" ?>>
                        <i id="prew" class="fas fa-chevron-left"></i>
                        <img src="<?php echo $pathImages . $sonataWork['photo'] ?>" >
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $sonataWork['titleen'];} else {echo $sonataWork['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $sonataWork['abouten'];} else {echo $sonataWork['about'];}?></p>
                        <i id="next" class="fas fa-chevron-right"></i>
                    </div>
                <?php endif;?>
            <?php $q++;endforeach;?>
        </div>
    </div>
</section>

    <?php include $pathIncludes . 'footer.php'?>
    <script src="<?php echo $pathJs ?>carousel.js"></script>
</body>
</html>
