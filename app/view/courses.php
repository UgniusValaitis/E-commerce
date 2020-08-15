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
    <title>KaS || <?php echo $lang['Courses'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>shop.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>
<div class="space">
    <a href="<?php echo $rootDir . "?url=courses"; ?>"><?php echo $lang['Courses'] ?></a>
    <?php if (isset($_GET['search'])): ?>
        <i class="fas fa-angle-double-right"></i>
        <h3><?php echo $searchText ?></h3>
    <?php elseif (isset($_GET['filter'])): ?>
        <i class="fas fa-angle-double-right"></i>
        <h3><?php echo $filterText ?></h3>
    <?php endif;?>
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
    <?php if (isset($_GET['search'])): ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($searchCoursesShop)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $searchCoursesShop[$startI]['titleen'];} else {echo $searchCoursesShop[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $searchCoursesShop[$startI]['descriptionen'];} else {echo $searchCoursesShop[$startI]['description'];}?></p>
                        <h3><?php echo $searchCoursesShop[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=course&id=" . $searchCoursesShop[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $searchCoursesShop[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($searchCoursesShop)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $searchCoursesShop[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $searchCoursesShop[$startI]['titleen'];} else {echo $searchCoursesShop[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $searchCoursesShop[$startI]['descriptionen'];} else {echo $searchCoursesShop[$startI]['description'];}?></p>
                            <h3><?php echo $searchCoursesShop[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=course&id=" . $searchCoursesShop[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?></a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if (isset($searchCoursesShopPages) && $searchCoursesShopPages > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $searchCoursesShopPages; $i++): ?>
                            <li><a href="?url=courses&search=<?php echo $searchText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            <?php endif;?>
        <?php elseif (isset($_GET['filter'])): ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($filterCoursesShop)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $filterCoursesShop[$startI]['titleen'];} else {echo $filterCoursesShop[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $filterCoursesShop[$startI]['descriptionen'];} else {echo $filterCoursesShop[$startI]['description'];}?></p>
                        <h3><?php echo $filterCoursesShop[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=course&id=" . $filterCoursesShop[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $filterCoursesShop[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($filterCoursesShop)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $filterCoursesShop[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $filterCoursesShop[$startI]['titleen'];} else {echo $filterCoursesShop[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $filterCoursesShop[$startI]['descriptionen'];} else {echo $filterCoursesShop[$startI]['description'];}?></p>
                            <h3><?php echo $filterCoursesShop[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=course&id=" . $filterCoursesShop[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?></a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if (isset($filterCoursesShopPages) && $filterCoursesShopPages > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $filterCoursesShopPages; $i++): ?>
                            <li><a href="?url=courses&filter=<?php echo $filterText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            <?php endif;?>
        <?php else: ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($coursesAllShop)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $coursesAllShop[$startI]['titleen'];} else {echo $coursesAllShop[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $coursesAllShop[$startI]['descriptionen'];} else {echo $coursesAllShop[$startI]['description'];}?></p>
                        <h3><?php echo $coursesAllShop[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=course&id=" . $coursesAllShop[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $coursesAllShop[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($coursesAllShop)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $coursesAllShop[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $coursesAllShop[$startI]['titleen'];} else {echo $coursesAllShop[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $coursesAllShop[$startI]['descriptionen'];} else {echo $coursesAllShop[$startI]['description'];}?></p>
                            <h3><?php echo $coursesAllShop[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=course&id=" . $coursesAllShop[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?> </a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if ($coursesPagesShop > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $coursesPagesShop; $i++): ?>
                            <li><a href="?url=courses&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            <?php endif;?>
        <?php endif;?>

    </div>
</div>


<?php include $pathIncludes . 'footer.php'?>
<script src="<?php echo $pathJs . "categories.js" ?>"></script>
</body>
</html>