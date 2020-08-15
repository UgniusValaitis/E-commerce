<?php
require_once $pathGet . "photo.get.php";
require_once $pathGet . "filters.get.php";
require_once $pathGet . "course.get.php";
require_once $pathGet . "cart.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Course'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>course.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>
<div class="space">
    <a href="<?php echo $rootDir . "?url=courses"; ?>"><?php echo $lang['Courses'] ?></a>
    <i class="fas fa-angle-double-right"></i>
    <h3><?php echo $lang['Course'] ?></h3>
</div>

<div class="shopGrid container">
    <aside>
        <div class="top">
            <h3><?php echo $lang['Categories'] ?> </h3><i id="menuImage" class="fas fa-chevron-down"></i>
        </div>
        <div class="bottom">
            <?php foreach ($groupsC as $groupC): ?>
                <h4><?php if ($_SESSION['lang'] == 'en') {echo $groupC['titleen'];} else {echo $groupC['title'];}?></h4>
                <?php foreach ($filters as $filter): ?>
                    <?php if ($filter['groupid'] == $groupC['id']): ?>
                        <a href="index.php?url=courses&filter=<?php if ($_SESSION['lang'] == 'en') {echo $filter['titleen'];} else {echo $filter['title'];}?>"><?php if ($_SESSION['lang'] == 'en') {echo $filter['titleen'];} else {echo $filter['title'];}?></a>
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
        <form action="index.php?url=courses&search=true" method="POST">
            <input type="text" name="searchText" placeholder="<?php echo $lang['Search'] ?>">
            <button class="searchBtn" name="search" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="shop">
        <div class="product">
        <?php foreach ($coursesAll as $currentCourse): ?>
            <?php if ($currentCourse['id'] == $_GET['id']): ?>
            <h2><?php if ($_SESSION['lang'] == 'en') {echo $currentCourse['titleen'];} else {echo $currentCourse['title'];}?></h2>

            <div class="photo">
                <div class="photoActive">
                    <img src="<?php echo $pathImages . coursePhotoLast($coursePhotos, $currentCourse['id'])['name'] ?>" >
                    <?php foreach ($coursePhotos as $coursePhoto): ?>
                        <?php if ($coursePhoto['locationId'] == $currentCourse['id']): ?>
                            <img src="<?php echo $pathImages . $coursePhoto['name'] ?>" >
                        <?php endif;?>
                    <?php endforeach;?>
                    <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $currentCourse['id'])['name'] ?>" >
                </div>
            </div>
            <div class="info">
                <?php if (isset($_SESSION['id'])): ?>
                <h3><?php echo $currentCourse['price'] ?> &euro;</h3>
                <form action="<?php echo $pathController . "cart.controller.php" ?>" method="POST">
                    <input type="hidden" name='price' value="<?php echo $currentCourse['price'] ?>">
                    <input type="hidden" name='title' value="<?php echo $currentCourse['title'] ?>">
                    <input type="hidden" name='titleen' value="<?php echo $currentCourse['titleen'] ?>">
                    <input type="hidden" name='photo' value="<?php echo coursePhotoFirst($coursePhotos, $currentCourse['id'])['name'] ?>">
                    <input type="hidden" name='userid' value="<?php echo $_SESSION['id'] ?>">
                    <button type='submit' class='primaryBtn' name="addCartCourse" value="<?php echo $currentCourse['id'] ?>"><?php echo $lang['To Cart'] ?></button>
                </form>
                <?php else: ?>
                    <h6><?php echo $lang['Login or signup'] ?></h6>
                <?php endif;?>
            </div>
            <p><?php if ($_SESSION['lang'] == 'en') {echo $currentCourse['abouten'];} else {echo $currentCourse['about'];}?></p>
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