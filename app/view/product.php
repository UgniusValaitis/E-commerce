<?php
require_once $pathGet . "photo.get.php";
require_once $pathGet . "filters.get.php";
require_once $pathGet . "shop.get.php";
require_once $pathGet . "cart.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Product'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>product.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>
<div class="space">
    <a href="<?php echo $rootDir . "?url=shop"; ?>"><?php echo $lang['Shop'] ?></a>
    <i class="fas fa-angle-double-right"></i>
    <h3><?php echo $lang['Product'] ?></h3>
</div>

<div class="shopGrid container">
    <aside>
        <div class="top">
            <h3><?php echo $lang['Categories'] ?> </h3><i id='menuImage' class="fas fa-chevron-down"></i>
        </div>
        <div class="bottom">
            <?php foreach ($groupsS as $groupS): ?>
                <h4><?php if ($_SESSION['lang'] == 'en') {echo $groupS['titleen'];} else {echo $groupS['title'];}?></h4>
                <?php foreach ($filters as $filter): ?>
                    <?php if ($filter['groupid'] == $groupS['id']): ?>
                        <a href="index.php?url=shop&filter=<?php if ($_SESSION['lang'] == 'en') {echo $filter['titleen'];} else {echo $filter['title'];}?>"><?php if ($_SESSION['lang'] == 'en') {echo $filter['titleen'];} else {echo $filter['title'];}?></a>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endforeach;?>
            <?php if (isset($_SESSION['id'])): ?>
            <a class="cart" href="<?php echo $rootDir . "?url=cart"; ?>"><i class="fas fa-shopping-bag"></i> (<?php echo $cartCount ?>)</a>
            <?php else: ?>
            <a href="<?php echo $rootDir . "?url=signup"; ?>" class="cart"><?php echo $lang['Signup'] ?></a>
            <?php endif;?>
        </div>
    </aside>
    <div class="search">
        <form action="index.php?url=shop&search=true" method="POST">
            <input type="text" name='searchText' placeholder="<?php echo $lang['Search'] ?>">
            <button class="searchBtn" type="submit" name='search'><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="shop">
        <div class="product">
        <?php foreach ($activeProducts as $currentProduct): ?>
            <?php if ($currentProduct['id'] == $_GET['id']): ?>
            <h2><?php if ($_SESSION['lang'] == 'en') {echo $currentProduct['titleen'];} else {echo $currentProduct['title'];}?></h2>

            <div class="photo">
                <div class="photoActive">
                    <img src="<?php echo $pathImages . productPhotoLast($shopPhotos, $currentProduct['id'])['name'] ?>" >
                    <?php foreach ($shopPhotos as $shopPhoto): ?>
                        <?php if ($shopPhoto['locationId'] == $currentProduct['id']): ?>
                            <img src="<?php echo $pathImages . $shopPhoto['name'] ?>" >
                        <?php endif;?>
                    <?php endforeach;?>
                    <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $currentProduct['id'])['name'] ?>" >
                </div>
            </div>
            <div class="info">
                <h3><?php echo $currentProduct['units'] ?> <?php echo $lang['Units'] ?></h3>
                <h3><?php echo $currentProduct['price'] ?> &euro;</h3>
            </div>
            <?php if (isset($_SESSION['id'])): ?>
            <form action="<?php echo $pathController . "cart.controller.php" ?>" method="POST">
                <input type="number" name="units" placeholder='<?php echo $lang['Units'] ?>'>
                <input type="hidden" name="price" value="<?php echo $currentProduct['price'] ?>">
                <input type="hidden" name="title" value="<?php echo $currentProduct['title'] ?>">
                <input type="hidden" name="titleen" value="<?php echo $currentProduct['titleen'] ?>">
                <input type="hidden" name="photo" value="<?php echo productPhotoFirst($shopPhotos, $currentProduct['id'])['name'] ?>">
                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?>">
                <button type='submit' class='primaryBtn' name="addCartProduct" value="<?php echo $currentProduct['id'] ?>"><?php echo $lang['To Cart'] ?></button>
            </form>
            <?php else: ?>
                <h6><?php echo $lang['Login or signup'] ?></h6>
            <?php endif;?>
            <p><?php if ($_SESSION['lang'] == 'en') {echo $currentProduct['abouten'];} else {echo $currentProduct['about'];}?></p>
            <?php endif;?>
        <?php endforeach;?>
        </div>
    </div>
</div>


<?php include $pathIncludes . 'footer.php'?>
<script src="<?php echo $pathJs . "categories.js" ?>"></script>
<script src="<?php echo $pathJs . "carouselImg.js" ?>"></script>
</body>
</html>