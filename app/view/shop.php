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
    <title>KaS || <?php echo $lang['Shop'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>shop.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>
<div class="space">
    <a href="<?php echo $rootDir . "?url=shop"; ?>"><?php echo $lang['Shop'] ?></a>
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
        <?php if (isset($_GET['search'])): ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($searchProducts)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $searchProducts[$startI]['titleen'];} else {echo $searchProducts[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $searchProducts[$startI]['descriptionen'];} else {echo $searchProducts[$startI]['description'];}?></p>
                        <h3><?php echo $searchProducts[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=product&id=" . $searchProducts[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $searchProducts[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($searchProducts)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $searchProducts[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $searchProducts[$startI]['titleen'];} else {echo $searchProducts[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $searchProducts[$startI]['descriptionen'];} else {echo $searchProducts[$startI]['description'];}?></p>
                            <h3><?php echo $searchProducts[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=product&id=" . $searchProducts[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?></a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if (isset($searchProductsPages) && $searchProductsPages > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $searchProductsPages; $i++): ?>
                            <li><a href="?url=shop&search=<?php echo $searchText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            <?php endif;?>
        <?php elseif (isset($_GET['filter'])): ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($filterProducts)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $filterProducts[$startI]['titleen'];} else {echo $filterProducts[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $filterProducts[$startI]['descriptionen'];} else {echo $filterProducts[$startI]['description'];}?></p>
                        <h3><?php echo $filterProducts[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=product&id=" . $filterProducts[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $filterProducts[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($filterProducts)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $filterProducts[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $filterProducts[$startI]['titleen'];} else {echo $filterProducts[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $filterProducts[$startI]['descriptionen'];} else {echo $filterProducts[$startI]['description'];}?></p>
                            <h3><?php echo $filterProducts[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=product&id=" . $filterProducts[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?></a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if (isset($filterProductsPages) && $filterProductsPages > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $filterProductsPages; $i++): ?>
                            <li><a href="?url=shop&filter=<?php echo $filterText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            <?php endif;?>
        <?php else: ?>
            <?php for ($startI; $startI <= $endI; $startI++): ?>
                <?php if ($startI < count($activeProducts)): ?>
                    <div class="product odd">
                        <h2><?php if ($_SESSION['lang'] == 'en') {echo $activeProducts[$startI]['titleen'];} else {echo $activeProducts[$startI]['title'];}?></h2>
                        <p><?php if ($_SESSION['lang'] == 'en') {echo $activeProducts[$startI]['descriptionen'];} else {echo $activeProducts[$startI]['description'];}?></p>
                        <h3><?php echo $activeProducts[$startI]['price'] ?> &euro;</h3>
                        <a href="<?php echo $rootDir . "?url=product&id=" . $activeProducts[$startI]['id']; ?>" class="primaryBtn"><?php echo $lang['More'] ?> <i class="fas fa-chevron-right"></i></a>
                        <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $activeProducts[$startI]['id'])['name'] ?>" >
                    </div>
                    <?php $startI++;if ($startI < count($activeProducts)): ?>
                        <div class="product even">
                            <img src="<?php echo $pathImages . productPhotoFirst($shopPhotos, $activeProducts[$startI]['id'])['name'] ?>" >
                            <h2><?php if ($_SESSION['lang'] == 'en') {echo $activeProducts[$startI]['titleen'];} else {echo $activeProducts[$startI]['title'];}?></h2>
                            <p><?php if ($_SESSION['lang'] == 'en') {echo $activeProducts[$startI]['descriptionen'];} else {echo $activeProducts[$startI]['description'];}?></p>
                            <h3><?php echo $activeProducts[$startI]['price'] ?> &euro;</h3>
                            <a href="<?php echo $rootDir . "?url=product&id=" . $activeProducts[$startI]['id']; ?>" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['More'] ?> </a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if ($activeProductsPages > 1): ?>
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $activeProductsPages; $i++): ?>
                            <li><a href="?url=shop&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
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