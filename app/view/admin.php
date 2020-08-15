<?php
$check = new Users;
$token = $check->checkToken("uid5f1aac6970142", $_COOKIE['PHPSESSID']);
if ($token == 0) {
    header("Location: index.php");
}
require_once $pathGet . "home.get.php";
require_once $pathGet . "service.get.php";
require_once $pathGet . "photo.get.php";
require_once $pathGet . "filters.get.php";
require_once $pathGet . "shop.get.php";
require_once $pathGet . "course.get.php";
require_once $pathGet . "contacts.get.php";
require_once $pathGet . "order.get.php";
require_once $pathGet . "subscription.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || Admin</title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>admin.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include $pathIncludes . 'header.php'?>
<div class="space">
    <h3><?php echo $lang['Profile'] ?></h3>
</div>

<div class="shopGrid container">
    <aside>
        <div class="top">
            <h3><?php echo $lang['Profile'] ?> </h3><i class="fas fa-chevron-down"></i>
        </div>
        <div class="bottom">
            <a href="<?php echo $rootDir . "?url=admin" ?>" class="cart">
                <?php echo $lang['Orders'] ?>
            </a>
            <a href="<?php echo $rootDir . "?url=admin&admin=home" ?>" class="cart">
                <?php echo $lang['Home'] ?>
            </a>
            <a href="<?php echo $rootDir . "?url=admin&admin=services" ?>" class="cart">
                <?php echo $lang['Services'] ?>
            </a>
            <a class="cart" href="<?php echo $rootDir . "?url=admin&admin=shop" ?>"><?php echo $lang['Shop'] ?></a>
            <a class="cart" href="<?php echo $rootDir . "?url=admin&admin=courses" ?>"><?php echo $lang['Courses'] ?></a>
            <a class="cart" href="<?php echo $rootDir . "?url=admin&admin=contacts" ?>"><?php echo $lang['Contacts'] ?></a>
            <a class="cart" href="<?php echo $rootDir . "?url=admin&admin=subscribe" ?>"><?php echo $lang['Subscription'] ?></a>
        </div>
    </aside>
    <div class="main">
<?php if (isset($_GET['admin'])): ?>
    <?php if ($_GET['admin'] == 'home'): ?>
        <!-- HOME PAGE -->
        <div class='content'>
            <h2>Kęstas</h2>
            <form action='<?php echo $pathController ?>home.controller.php' method='POST' enctype='multipart/form-data'>
                <div class='about'>
                    <label for='about'> Apie </label>
                    <textarea name='about'></textarea>
                </div>
                <div class='abouten'>
                    <label for='abouten'> Apie  angliškai</label>
                    <textarea name='abouten'></textarea>
                </div>
                <div class='photo'>
                    <label for='photo'> Profilio nuotrauka</label>
                    <input type='file' name='photo'>
                </div>
                <button class='primaryBtn' type='submit' name='kestas'>redaguoti <i class='fas fa-chevron-right'></i></button>
            </form>
            <h2>Darbai</h2>
            <a class='primaryBtn' href='?url=admin&admin=work&p=kestas'>Naujas <i class='fas fa-chevron-right'></i></a>
            <?php foreach ($works as $work): ?>
                <?php if ($work['location'] == 'kestas'): ?>
                    <div class='work'>
                        <h3><?php echo $work['title'] ?></h3>
                        <img src='<?php echo $pathImages . $work['photo'] ?>'>
                        <p><?php echo $work['about'] ?></p>
                        <a href='?url=admin&admin=work&p=<?php echo $work['id'] ?>' class='primaryBtn'>Redaguoti <i class='fas fa-chevron-right'></i></a>
                        <form action='<?php echo $pathController ?>home.controller.php' method='POST'>
                            <input type='hidden' name='img' value='<?php echo $work['photo'] ?>'>
                            <button class='primaryBtn' type='submit' name='deleteWork' value='<?php echo $work['id'] ?>'>x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <h2>Sonata</h2>
            <form action='<?php echo $pathController ?>home.controller.php' method='POST' enctype='multipart/form-data'>
                <div class='about'>
                    <label for='about'> Apie </label>
                    <textarea name='about'></textarea>
                </div>
                <div class='abouten'>
                    <label for='abouten'> Apie  angliškai</label>
                    <textarea name='abouten'></textarea>
                </div>
                <div class='photo'>
                    <label for='photo'> Profilio nuotrauka</label>
                    <input type='file' name='photo'>
                </div>
                <button class='primaryBtn' type='submit' name='sonata'>redaguoti <i class='fas fa-chevron-right'></i></button>
            </form>
            <h2>Darbai</h2>
            <a class='primaryBtn' href='?url=admin&admin=work&p=sonata'>Naujas <i class='fas fa-chevron-right'></i></a>
            <?php foreach ($works as $work): ?>
                <?php if ($work['location'] == 'sonata'): ?>
                    <div class='work'>
                        <h3><?php echo $work['title'] ?></h3>
                        <img src='<?php echo $pathImages . $work['photo'] ?>'>
                        <p><?php echo $work['about'] ?></p>
                        <a href='?url=admin&admin=work&p=<?php echo $work['id'] ?>' class='primaryBtn'>Redaguoti <i class='fas fa-chevron-right'></i></a>
                        <form action='<?php echo $pathController ?>home.controller.php' method='POST'>
                            <input type='hidden' name='img' value='<?php echo $work['photo'] ?>'>
                            <button class='primaryBtn' type='submit' name='deleteWork' value='<?php echo $work['id'] ?>'>x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
    <?php elseif ($_GET['admin'] == 'services'): ?>
        <!-- SERVICES PAGE -->
        <div class="content">
            <h2>Paslaugos</h2>
            <a href="?url=admin&admin=service" class="primaryBtn">Nauja <i class="fas fa-chevron-right"></i></a>
            <?php foreach ($services as $service): ?>
            <div class="service">
                <h3><?php echo $service['title'] ?></h3>
                <img src="<?php echo $pathImages ?><?php echo servicePhotoFirst($servicesPhotos, $service['id'])['name'] ?>" >
                <a href="?url=admin&admin=service&p=<?php echo $service['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                <form action='<?php echo $pathController ?>service.controller.php' method='POST'>
                    <button class='primaryBtn' type='submit' name='deleteService' value='<?php echo $service['id'] ?>'>x</button>
                </form>
            </div>
            <?php endforeach;?>
        </div>
    <?php elseif ($_GET['admin'] == 'service'): ?>
        <!-- SERVICE EDIT/CREATE PAGE -->
        <?php foreach ($services as $serviceFilter) {if (isset($_GET['p']) && $serviceFilter['id'] == $_GET['p']) {$service = $serviceFilter;}
    ;}?>
        <div class="content">
            <h2>Paslauga</h2>
            <form action='<?php echo $pathController ?>service.controller.php' method='POST' enctype='multipart/form-data' >
                <div class='name'>
                    <label for='name'>Pavadinimas</label>
                    <input type='text' name='title'<?php if (isset($service)) {echo "value='" . $service['title'] . "'";}?>>
                </div>
                <div class='nameen'>
                    <label for='name'>Pavadinimas EN </label>
                    <input type='text' name='titleen'<?php if (isset($service)) {echo "value='" . $service['titleen'] . "'";}?>>
                </div>
                <div class='about'>
                    <label for='about'>Aprašymas</label>
                    <textarea name='about'><?php if (isset($service)) {echo $service['about'];}?></textarea>
                </div>
                <div class='abouten'>
                    <label for='abouten'>Aprašymas EN</label>
                    <textarea name='abouten'><?php if (isset($service)) {echo $service['abouten'];}?></textarea>
                </div>
                <div class='photo'>
                    <label for='photo'>Nuotrauka</label>
                    <input type='file' name='photo'>
                </div>
                <button type='submit' name='service' value="<?php if (isset($_GET['p'])) {echo $_GET['p'];} else {echo "new";}?>" class='primaryBtn'>Sukurti <i class='fas fa-chevron-right'></i></button>
            </form>
            <?php if (isset($service)): ?>
                <?php foreach ($servicesPhotos as $servicePhotos): ?>
                    <?php if ($servicePhotos['locationId'] == $_GET['p']): ?>
                        <div class="servicePhoto">
                            <img src="<?php echo $pathImages . $servicePhotos['name'] ?>">
                            <form action="<?php echo $pathController ?>service.controller.php" method="POST">
                                <input type="hidden" name='serviceid' value='<?php echo $servicePhotos['locationId'] ?>'>
                                <input type="hidden" name="pname" value='<?php echo $servicePhotos['name'] ?>'>
                                <button type='submit' name='deletePhoto' value='<?php echo $servicePhotos['id'] ?>' class="primaryBtn">x</button>
                            </form>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    <?php elseif ($_GET['admin'] == 'shop'): ?>
        <!-- SHOP PAGE -->
        <div class="content">
            <h2>Parduotuvė</h2>
            <h3>Filtrai</h3>
            <a href="<?php echo $rootDir . "?url=admin&admin=filters&l=s" ?>" class="primaryBtn">Redaguoti <i class="fas fa-chevron-right"></i></a>
            <h3>Nauja prekė</h3>
            <a href="<?php echo $rootDir . "?url=admin&admin=product&id=new" ?>" class="primaryBtn">Sukurti <i class="fas fa-chevron-right"></i></a>
            <?php if (count($soldProducts) > 0): ?>
                <h3>Parduotos prekės</h3>
            <?php endif;?>
            <?php foreach ($soldProducts as $soldProduct): ?>
                <div class="product">
                    <h4 class="productTitle"><?php echo $soldProduct['title'] ?></h4>
                    <img src="<?php echo $pathImages ?><?php echo productPhotoFirst($shopPhotos, $soldProduct['id'])['name'] ?>" alt="">
                    <form action='<?php echo $pathController ?>shop.controller.php' method='POST'>
                        <button class='primaryBtn' type='submit' name='deleteProduct' value='<?php echo $soldProduct['id'] ?>'>x</button>
                    </form>
                    <h4 class="productUnits">( <?php echo $soldProduct['units'] ?> VNT )</h4>
                    <a href="?url=admin&admin=product&id=<?php echo $soldProduct['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                </div>
            <?php endforeach;?>
            <h3>Prekės</h3>
            <div class="search">
                <form action="index.php?url=admin&admin=shop&search=true" method="post">
                    <input type="text" name='searchText' placeholder="Paieška">
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <?php if (isset($_GET['search'])): ?>
                <?php for ($startI; $startI <= $endI; $startI++): ?>
                    <?php if ($startI < count($searchProducts)): ?>
                        <div class="product">
                            <h4 class="productTitle"><?php echo $searchProducts[$startI]['title'] ?></h4>
                            <img src="<?php echo $pathImages ?><?php echo productPhotoFirst($shopPhotos, $searchProducts[$startI]['id'])['name'] ?>" alt="">
                            <form action='<?php echo $pathController ?>shop.controller.php' method='POST'>
                                <input type="hidden" name='url' value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                <button class='primaryBtn' type='submit' name='deleteProduct' value='<?php echo $searchProducts[$startI]['id'] ?>'>x</button>
                            </form>
                            <h4 class="productUnits">( <?php echo $searchProducts[$startI]['units'] ?> VNT )</h4>
                            <a href="?url=admin&admin=product&id=<?php echo $searchProducts[$startI]['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                        </div>
                    <?php endif;?>
                <?php endfor;?>
                <?php if (isset($searchProductsPages) && $searchProductsPages > 1): ?>
                    <div class="pagination">
                        <ul>
                            <?php for ($i = 1; $i <= $searchProductsPages; $i++): ?>
                                <li><a href="?url=admin&admin=shop&search=<?php echo $searchText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                <?php endif;?>
            <?php else: ?>
                <?php for ($startI; $startI <= $endI; $startI++): ?>
                    <?php if ($startI < count($activeProducts)): ?>
                        <div class="product">
                            <h4 class="productTitle"><?php echo $activeProducts[$startI]['title'] ?></h4>
                            <img src="<?php echo $pathImages ?><?php echo productPhotoFirst($shopPhotos, $activeProducts[$startI]['id'])['name'] ?>" alt="">
                            <form action='<?php echo $pathController ?>shop.controller.php' method='POST'>
                                <input type="hidden" name='url' value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                <button class='primaryBtn' type='submit' name='deleteProduct' value='<?php echo $activeProducts[$startI]['id'] ?>'>x</button>
                            </form>
                            <h4 class="productUnits">( <?php echo $activeProducts[$startI]['units'] ?> VNT )</h4>
                            <a href="?url=admin&admin=product&id=<?php echo $activeProducts[$startI]['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                        </div>
                    <?php endif;?>
                <?php endfor;?>
                <?php if ($activeProductsPages > 1): ?>
                    <div class="pagination">
                        <ul>
                            <?php for ($i = 1; $i <= $activeProductsPages; $i++): ?>
                                <li><a href="?url=admin&admin=shop&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                <?php endif;?>
            <?php endif;?>
    <?php elseif ($_GET['admin'] == 'product'): ?>
        <!-- PRODUCT EDIT/CREATE -->
        <?php foreach ($shop as $products) {if ($products['id'] == $_GET['id']) {$product = $products;}}?>
        <div class="content">
            <form action="<?php echo $pathController ?>shop.controller.php" method="POST">
                <div class="title">
                    <label for="title">Pavadinimas</label>
                    <input type="text" name='title' <?php if (isset($product)) {echo "value='" . $product['title'] . "'";}?> >
                </div>
                <div class="titleen">
                    <label for="titleen">Pavadinimas EN</label>
                    <input type="text" name='titleen' <?php if (isset($product)) {echo "value='" . $product['titleen'] . "'";}?> >
                </div>
                <div class="description">
                    <label for="description">Trumpas aprašymas</label>
                    <textarea name="description"><?php if (isset($product)) {echo $product['description'];}?></textarea>
                </div>
                <div class="descriptionen">
                    <label for="descriptionen">Trumpas aprašymas EN</label>
                    <textarea name="descriptionen"><?php if (isset($product)) {echo $product['descriptionen'];}?></textarea>
                </div>
                <div class="about">
                    <label for="about">Aprašymas</label>
                    <textarea name="about"><?php if (isset($product)) {echo $product['about'];}?></textarea>
                </div>
                <div class="abouten">
                    <label for="abouten">Aprašymas EN</label>
                    <textarea name="abouten"><?php if (isset($product)) {echo $product['abouten'];}?></textarea>
                </div>
                <div class="units">
                    <label for="units">Vnt.</label>
                    <input type="number" name='units' <?php if (isset($product)) {echo "value='" . $product['units'] . "'";}?>>
                </div>
                <div class="price">
                    <label for="price">Kaina</label>
                    <input type="number" name='price' <?php if (isset($product)) {echo "value='" . $product['price'] . "'";}?>>
                </div>
                <button type='submit' class='primaryBtn' name='product' value='<?php echo $_GET['id'] ?>'><?php if (isset($product)) {echo "Redaguoti";} else {echo "Sukurti";}?> <i class="fas fa-chevron-right"></i></button>
            </form>
            <?php if (isset($product)): ?>
                <h3>Filtrai</h3>
                <?php $productFilters = explode(',', $product['filters'])?>
                <div class="filters">
                <?php for ($i = 0; $i < count($productFilters) - 1; $i++): ?>
                    <div class="filter">
                        <h4><?php echo $productFilters[$i] ?></h4>
                        <form action="<?php echo $pathController ?>shop.controller.php" method='POST'>
                            <input type="hidden" name='filters' value='<?php echo $product['filters'] ?>'>
                            <input type="hidden" name='filtersen' value='<?php echo $product['filtersen'] ?>'>
                            <input type="hidden" name='i' value='<?php echo $i ?>'>
                            <button class="primaryBtn" name='deleteFilter' value='<?php echo $product['id'] ?>'>x</button>
                        </form>
                    </div>
                <?php endfor;?>
                </div>
                <div class="productFilters">
                    <form action="<?php echo $pathController ?>shop.controller.php" method="POST">
                        <select name="selectedFilter" >
                            <?php foreach ($filters as $filter): ?>
                                <?php if ($filter['location'] == 's'): ?>
                                <option value="<?php echo $filter['title'] . "," . $filter['titleen'] ?>"><?php echo $filter['title'] ?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <input type="hidden" name="filters" value="<?php echo $product['filters'] ?>">
                        <input type="hidden" name="filtersen" value="<?php echo $product['filtersen'] ?>">
                        <button class="primaryBtn" type="submit" name="productFilter" value="<?php echo $product['id'] ?>">Pasirinkti <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <h3>Nuotraukos</h3>
                <div class="productPhoto">
                    <form action="<?php echo $pathController ?>shop.controller.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name='photo'>
                        <button class="primaryBtn" name="productPhoto" value="<?php echo $product['id'] ?>">Įkelti <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <?php foreach ($shopPhotos as $productsPhotos): ?>
                    <?php if ($productsPhotos['locationId'] == $_GET['id']): ?>
                        <div class="productPhotos">
                            <img src="<?php echo $pathImages . $productsPhotos['name'] ?>">
                            <form action="<?php echo $pathController ?>shop.controller.php" method="POST">
                                <input type="hidden" name='productid' value='<?php echo $productsPhotos['locationId'] ?>'>
                                <input type="hidden" name="pname" value='<?php echo $productsPhotos['name'] ?>'>
                                <button type='submit' name='deletePhoto' value='<?php echo $productsPhotos['id'] ?>' class="primaryBtn">x</button>
                            </form>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    <?php elseif ($_GET['admin'] == 'filters'): ?>
        <!-- FILTERS EDIT/CREATE -->
        <div class="content">
            <h2>Filtrai</h2>
            <h3>Sukurti naują grupę</h3>
            <form action="<?php echo $pathController ?>filters.controller.php" method='POST'>
                <div class='title'>
                    <label for='title'>Pavadinimas</label>
                    <input type='text' name='title'<?php if (isset($service)) {echo "value='" . $service['title'] . "'";}?>>
                </div>
                <div class='titleen'>
                    <label for='titleen'>Pavadinimas EN </label>
                    <input type='text' name='titleen'<?php if (isset($service)) {echo "value='" . $service['titleen'] . "'";}?>>
                </div>
                <button type='submit' name='group' value="<?php echo $_GET['l'] ?>" class='primaryBtn'>Sukurti <i class='fas fa-chevron-right'></i></button>
            </form>
            <?php if ($_GET['l'] == 's') {$groups = $groupsS;} elseif ($_GET['l'] == 'c') {$groups = $groupsC;}?>
            <?php foreach ($groups as $group): ?>
                <div class="group">
                    <h3><?php echo $group['title'] ?></h3>
                    <form action="<?php echo $pathController ?>filters.controller.php" method='POST'>
                        <input type="hidden" name='location' value='<?php echo $_GET['l'] ?>'>
                        <button class="primaryBtn" name='deleteGroup' value='<?php echo $group['id'] ?>'>x</button>
                    </form>
                </div>
                <div class="filters">
                    <?php foreach ($filters as $filter): ?>
                        <?php if ($filter['groupid'] == $group['id']): ?>
                            <div class="filter">
                                <h4><?php echo $filter['title'] ?></h4>
                                <form action="<?php echo $pathController ?>filters.controller.php" method='POST'>
                                    <input type="hidden" name='location' value='<?php echo $_GET['l'] ?>'>
                                    <button class="primaryBtn" name='deleteFilter' value='<?php echo $filter['id'] ?>'>x</button>
                                </form>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
                <form action="<?php echo $pathController ?>filters.controller.php" method="POST">
                    <div class='title'>
                        <label for='title'>Pavadinimas</label>
                        <input type='text' name='title'<?php if (isset($service)) {echo "value='" . $service['title'] . "'";}?>>
                    </div>
                    <div class='titleen'>
                        <label for='titleen'>Pavadinimas EN </label>
                        <input type='text' name='titleen'<?php if (isset($service)) {echo "value='" . $service['titleen'] . "'";}?>>
                    </div>
                    <input type="hidden" name='location' value='<?php echo $_GET['l'] ?>'>
                    <button type='submit' name='filter' value="<?php echo $group['id'] ?>" class='primaryBtn'>Filtras <i class='fas fa-chevron-right'></i></button>
                </form>
            <?php endforeach;?>
        </div>
    <?php elseif ($_GET['admin'] == 'courses'): ?>
        <!-- COURSES PAGE -->
        <div class="content">
            <h2>Kursai</h2>
            <h3>Filtrai</h3>
            <a href="<?php echo $rootDir . "?url=admin&admin=filters&l=c" ?>" class="primaryBtn">Redaguoti <i class="fas fa-chevron-right"></i></a>
            <h3>Naujas kursas</h3>
            <a href="<?php echo $rootDir . "?url=admin&admin=course&id=new" ?>" class="primaryBtn">Sukurti <i class="fas fa-chevron-right"></i></a>
            <br>
            <br>
            <div class="search">
                <form action="index.php?url=admin&admin=courses&search=true" method="post">
                    <input type="text" name='searchText' placeholder="Paieška">
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <?php if (isset($_GET['search'])): ?>
                <?php for ($startI; $startI <= $endI; $startI++): ?>
                    <?php if ($startI < count($searchCourses)): ?>
                        <div class="product">
                            <h4 class="productTitle"><?php echo $searchCourses[$startI]['title'] ?></h4>
                            <img src="<?php echo $pathImages ?><?php echo coursePhotoFirst($coursePhotos, $searchCourses[$startI]['id'])['name'] ?>" alt="">
                            <form action='<?php echo $pathController ?>course.controller.php' method='POST'>
                                <input type="hidden" name='url' value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                <input type="hidden" name="video" value="<?php echo $searchCourses[$startI]['video'] ?>">
                                <button class='primaryBtn' type='submit' name='deleteCourse' value='<?php echo $searchCourses[$startI]['id'] ?>'>x</button>
                            </form>
                            <h4 class="productUnits">( <?php echo $searchCourses[$startI]['price'] ?> &euro; )</h4>
                            <a href="?url=admin&admin=course&id=<?php echo $searchCourses[$startI]['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                        </div>
                    <?php endif;?>
                <?php endfor;?>
                <?php if (isset($searchCoursesPages) && $searchCoursesPages > 1): ?>
                    <div class="pagination">
                        <ul>
                            <?php for ($i = 1; $i <= $searchCoursesPages; $i++): ?>
                                <li><a href="?url=admin&admin=courses&search=<?php echo $searchText ?>&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                <?php endif;?>
            <?php else: ?>
                <?php for ($startI; $startI <= $endI; $startI++): ?>
                    <?php if ($startI < count($coursesAll)): ?>
                        <div class="product">
                            <h4 class="productTitle"><?php echo $coursesAll[$startI]['title'] ?></h4>
                            <img src="<?php echo $pathImages ?><?php echo coursePhotoFirst($coursePhotos, $coursesAll[$startI]['id'])['name'] ?>">
                            <form action='<?php echo $pathController ?>course.controller.php' method='POST'>
                                <input type="hidden" name='url' value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                <input type="hidden" name="video" value="<?php echo $coursesAll[$startI]['video'] ?>">
                                <button class='primaryBtn' type='submit' name='deleteCourse' value='<?php echo $coursesAll[$startI]['id'] ?>'>x</button>
                            </form>
                            <h4 class="productUnits">( <?php echo $coursesAll[$startI]['price'] ?> &euro; )</h4>
                            <a href="?url=admin&admin=course&id=<?php echo $coursesAll[$startI]['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                        </div>
                    <?php endif;?>
                <?php endfor;?>
                <?php if ($coursesPages > 1): ?>
                    <div class="pagination">
                        <ul>
                            <?php for ($i = 1; $i <= $coursesPages; $i++): ?>
                                <li><a href="?url=admin&admin=courses&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                <?php endif;?>
            <?php endif;?>
        </div>
    <?php elseif ($_GET['admin'] == 'course'): ?>
        <!-- COURSE EDIT/CREATE PAGE -->
        <?php foreach ($coursesAll as $coursesA) {if ($coursesA['id'] == $_GET['id']) {$course = $coursesA;}}?>
        <div class="content">
            <form action="<?php echo $pathController ?>course.controller.php" method="POST">
                <div class="title">
                    <label for="title">Pavadinimas</label>
                    <input type="text" name='title' <?php if (isset($course)) {echo "value='" . $course['title'] . "'";}?> >
                </div>
                <div class="titleen">
                    <label for="titleen">Pavadinimas EN</label>
                    <input type="text" name='titleen' <?php if (isset($course)) {echo "value='" . $course['titleen'] . "'";}?> >
                </div>
                <div class="description">
                    <label for="description">Trumpas aprašymas</label>
                    <textarea name="description"><?php if (isset($course)) {echo $course['description'];}?></textarea>
                </div>
                <div class="descriptionen">
                    <label for="descriptionen">Trumpas aprašymas EN</label>
                    <textarea name="descriptionen"><?php if (isset($course)) {echo $course['descriptionen'];}?></textarea>
                </div>
                <div class="about">
                    <label for="about">Aprašymas</label>
                    <textarea name="about"><?php if (isset($course)) {echo $course['about'];}?></textarea>
                </div>
                <div class="abouten">
                    <label for="abouten">Aprašymas EN</label>
                    <textarea name="abouten"><?php if (isset($course)) {echo $course['abouten'];}?></textarea>
                </div>
                <div class="instruction">
                    <label for="instruction">Instrukcijos</label>
                    <textarea name="instruction"><?php if (isset($course)) {echo $course['instruction'];}?></textarea>
                </div>
                <div class="instructionen">
                    <label for="instructionen">Instrukcijos EN</label>
                    <textarea name="instructionen"><?php if (isset($course)) {echo $course['instructionen'];}?></textarea>
                </div>
                <div class="price">
                    <label for="price">Kaina</label>
                    <input type="number" name='price' <?php if (isset($course)) {echo "value='" . $course['price'] . "'";}?>>
                </div>
                <div class="status">
                    <label for="status">Aktyvus</label>
                    <input type="checkbox" name="status" <?php if (isset($course) && $course['status'] == 1) {echo "checked";}?>>
                </div>
                <button type='submit' class='primaryBtn' name='course' value='<?php echo $_GET['id'] ?>'><?php if (isset($course)) {echo "Redaguoti";} else {echo "Sukurti";}?> <i class="fas fa-chevron-right"></i></button>
            </form>
            <?php if (isset($course)): ?>
                <h3>Filtrai</h3>
                <?php $courseFilters = explode(',', $course['filters'])?>
                <div class="filters">
                <?php for ($i = 0; $i < count($courseFilters) - 1; $i++): ?>
                    <div class="filter">
                        <h4><?php echo $courseFilters[$i] ?></h4>
                        <form action="<?php echo $pathController ?>course.controller.php" method='POST'>
                            <input type="hidden" name='filters' value='<?php echo $course['filters'] ?>'>
                            <input type="hidden" name='filtersen' value='<?php echo $course['filtersen'] ?>'>
                            <input type="hidden" name='i' value='<?php echo $i ?>'>
                            <button class="primaryBtn" name='deleteFilter' value='<?php echo $course['id'] ?>'>x</button>
                        </form>
                    </div>
                <?php endfor;?>
                </div>
                <div class="productFilters">
                    <form action="<?php echo $pathController ?>course.controller.php" method="POST">
                        <select name="selectedFilter" >
                            <?php foreach ($filters as $filter): ?>
                                <?php if ($filter['location'] == 'c'): ?>
                                <option value="<?php echo $filter['title'] . "," . $filter['titleen'] ?>"><?php echo $filter['title'] ?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <input type="hidden" name="filters" value="<?php echo $course['filters'] ?>">
                        <input type="hidden" name="filtersen" value="<?php echo $course['filtersen'] ?>">
                        <button class="primaryBtn" type="submit" name="courseFilter" value="<?php echo $course['id'] ?>">Pasirinkti <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <h3>Video</h3>
                <div class="productVideo">
                    <form action="<?php echo $pathController ?>course.controller.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name='video'>
                        <button class="primaryBtn" name="courseVideo" value="<?php echo $course['id'] ?>">Įkelti <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <?php if ($course['video'] != null): ?>
                <div class="displayVideo">
                    <video controls>
                        <source src="<?php echo $pathVideo . $course['video'] ?>" type="video/mp4">
                    </video>
                </div>
                <?php endif;?>
                <h3>Nuotraukos</h3>
                <div class="productPhoto">
                    <form action="<?php echo $pathController ?>course.controller.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name='photo'>
                        <button class="primaryBtn" name="coursePhoto" value="<?php echo $course['id'] ?>">Įkelti <i class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <?php foreach ($coursePhotos as $coursesPhotos): ?>
                    <?php if ($coursesPhotos['locationId'] == $_GET['id']): ?>
                        <div class="productPhotos">
                            <img src="<?php echo $pathImages . $coursesPhotos['name'] ?>">
                            <form action="<?php echo $pathController ?>course.controller.php" method="POST">
                                <input type="hidden" name='courseid' value='<?php echo $coursesPhotos['locationId'] ?>'>
                                <input type="hidden" name="pname" value='<?php echo $coursesPhotos['name'] ?>'>
                                <button type='submit' name='deletePhoto' value='<?php echo $coursesPhotos['id'] ?>' class="primaryBtn">x</button>
                            </form>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
    <?php elseif ($_GET['admin'] == 'contacts'): ?>
        <!-- CONTACTS PAGE -->
        <div class="content">
            <h2>Kontaktai</h2>
            <h4>Numeris</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'number' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='number'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
            <h4>E-paštas</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'email' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='email'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
            <h4>Instagram</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'instagram' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='instagram'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
            <h4>Facebook</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'facebook' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='facebook'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
            <h4>Adresas</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'address' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='address'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
            <h4>Kiti</h4>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['location'] == 'other' && $contact['title'] != ''): ?>
                    <div class="contact">
                        <h4><?php echo $contact['title'] ?></h4>
                        <form action="<?php echo $pathController ?>contacts.controller.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $contact['id'] ?>">
                            <button type="submit" name="delete" value="<?php echo $contact['location'] ?>" class="primaryBtn">x</button>
                        </form>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            <form class="contacts" action="<?php echo $pathController ?>contacts.controller.php" method="post">
                <input type="text" name='other'>
                <button type="submit" class="primaryBtn"><i class="fas fa-chevron-right"></i></button>
            </form>
        </div>
    <?php elseif ($_GET['admin'] == 'subscribe'): ?>
        <!-- SUBSCRIBE PAGE -->
        <div class="content">
            <h2>Prenumeratos</h2>
            <a href="?url=admin&admin=subscribers" class="primaryBtn subs">Prenumeratoriai <i class="fas fa-chevron-right"></i></a>
            <a href="?url=admin&admin=subscription&id=new" class='primaryBtn'>Nauja <i class="fas fa-chevron-right"></i></a>

            <?php foreach ($subscriptionsAll as $subsAll): ?>
                <div class="product">
                    <h4 class="productTitle"><?php echo $subsAll['title'] ?></h4>
                    <img src="<?php echo $pathImages ?><?php echo subsPhotoFirst($subscriptionPhotos, $subsAll['id'])['name'] ?>" alt="">
                    <form action='<?php echo $pathController ?>subscription.controller.php' method='POST'>
                        <button class='primaryBtn' type='submit' name='deleteSubs' value='<?php echo $subsAll['id'] ?>'>x</button>
                    </form>
                    <a href="?url=admin&admin=subscription&id=<?php echo $subsAll['id'] ?>" class="primaryBtn">Redaguoti <i class='fas fa-chevron-right'></i></a>
                </div>
            <?php endforeach;?>
        </div>
    <?php elseif ($_GET['admin'] == "subscribers"): ?>
        <div class="content">
            <?php foreach ($subscribers as $subscriber): ?>
                <div class="subscriber">
                    <h4 class="info"><?php echo $subscriber['fname'] . " " . $subscriber['lname'] . ", " . $subscriber['email'] ?></h4>
                    <h4 class="address"> <?php echo $subscriber['address'] ?></h4>
                    <h4 class="title"><?php echo $subscriber['substitle'] ?></h4>
                    <h4 class="date"><?php echo $subscriber['expdate'] ?></h4>
                </div>
            <?php endforeach;?>
        </div>
    <?php elseif ($_GET['admin'] == "subscription"): ?>
        <!-- SUBSCRIPTION EDIT/CREATE -->
        <div class="content">
        <?php foreach ($subscriptionsAll as $subscriptionAll) {if ($subscriptionAll['id'] == $_GET['id']) {$subscription = $subscriptionAll;}}?>
            <form action="<?php echo $pathController . "subscription.controller.php" ?>" method="POST">
                <div class="title">
                    <label for="tilte">Pavadinimas</label>
                    <input type="text" name="title" <?php if (isset($subscription)) {echo "value='" . $subscription['title'] . "'";}?>>
                </div>
                <div class="titleen">
                    <label for="titleen"> Pavadinimas EN</label>
                    <input type="text" name="titleen" <?php if (isset($subscription)) {echo "value='" . $subscription['titleen'] . "'";}?>>
                </div>
                <div class="description">
                    <label for="description">Trumpas aprašymas</label>
                    <textarea name="description"><?php if (isset($subscription)) {echo $subscription['description'];}?></textarea>
                </div>
                <div class="descriptionen">
                    <label for="descriptionen">Trumpas aprašymas EN</label>
                    <textarea name="descriptionen"><?php if (isset($subscription)) {echo $subscription['descriptionen'];}?></textarea>
                </div>
                <div class="about">
                    <label for="about">Aprašymas</label>
                    <textarea name="about"><?php if (isset($subscription)) {echo $subscription['about'];}?></textarea>
                </div>
                <div class="abouten">
                    <label for="abouten">Aprašymas EN</label>
                    <textarea name="abouten"><?php if (isset($subscription)) {echo $subscription['abouten'];}?></textarea>
                </div>
                <div class="pricem">
                    <label for="pricem"> Kaina &euro;/Mėnesį</label>
                    <input type="number" name="pricem" <?php if (isset($subscription)) {echo "value='" . $subscription['pricem'] . "'";}?>>
                </div>
                <div class="pricey">
                    <label for="pricey"> Kaina &euro;/Metus</label>
                    <input type="number" name="pricey" <?php if (isset($subscription)) {echo "value='" . $subscription['pricey'] . "'";}?>>
                </div>
                <div class="status">
                    <label for="status">Aktyvus</label>
                    <input type="checkbox" name="status" <?php if (isset($subscription) && $subscription['status'] == "on") {echo "checked";}?>>
                </div>
                <button class="primaryBtn" type="submit" name="subscription" value='<?php echo $_GET['id'] ?>'><?php if ($_GET['id'] == "new") {echo "Sukurti";} else {echo "Redaguoti";}?> <i class="fas fa-chevron-right"></i></button>
            </form>
            <?php if ($_GET['id'] != "new"): ?>
                <h3>Nuotraukos</h3>
                <div class="subsPhoto">
                <form action="<?php echo $pathController . "subscription.controller.php" ?>" method="POST" enctype="multipart/form-data">
                    <input type="file" name='photo'>
                    <button class="primaryBtn" name="subsPhoto" value="<?php echo $subscription['id'] ?>">Įkelti <i class="fas fa-chevron-right"></i></button>
                </form>
                </div>
                <?php foreach ($subscriptionPhotos as $subsPhoto): ?>
                    <?php if ($subsPhoto['locationId'] == $_GET['id']): ?>
                        <div class="productPhotos">
                            <img src="<?php echo $pathImages . $subsPhoto['name'] ?>">
                            <form action="<?php echo $pathController ?>subscription.controller.php" method="POST">
                                <input type="hidden" name='subsid' value='<?php echo $subsPhoto['locationId'] ?>'>
                                <input type="hidden" name="pname" value='<?php echo $subsPhoto['name'] ?>'>
                                <button type='submit' name='deletePhoto' value='<?php echo $subsPhoto['id'] ?>' class="primaryBtn">x</button>
                            </form>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    <?php elseif ($_GET['admin'] == 'work'): ?>
        <!--WORK EDIT/CREATE PAGE -->
        <?php foreach ($works as $work) {if ($work['id'] == $_GET['p']) {$selected = $work;}
    ;}?>
        <div class='content'>
            <h2>Darbai</h2>
            <form action='<?php echo $pathController ?>home.controller.php' method='POST' enctype='multipart/form-data' >
                <div class='name'>
                    <label for='name'>Pavadinimas</label>
                    <input type='text' name='name'<?php if (isset($selected)) {echo "value='" . $selected['title'] . "'";}?>>
                </div>
                <div class='nameen'>
                    <label for='name'>Pavadinimas EN </label>
                    <input type='text' name='nameen'<?php if (isset($selected)) {echo "value='" . $selected['titleen'] . "'";}?>>
                </div>
                <div class='about'>
                    <label for='about'>Aprašymas</label>
                    <textarea name='about'><?php if (isset($selected)) {echo $selected['about'];}?></textarea>
                </div>
                <div class='abouten'>
                    <label for='abouten'>Aprašymas EN</label>
                    <textarea name='abouten'><?php if (isset($selected)) {echo $selected['abouten'];}?></textarea>
                </div>
                <div class='photo'>
                    <label for='photo'>Nuotrauka</label>
                    <input type='file' name='photo'>
                </div>
                <button type='submit' name='work' value='<?php echo $_GET['p'] ?>' class='primaryBtn'>Sukurti <i class='fas fa-chevron-right'></i></button>
            </form>
        </div>
        <?php if (isset($selected)): ?>
            <div class='workPhoto'>
                <img src='<?php echo $pathImages . $selected['photo'] ?>'>
            </div>
        <?php endif;?>
    <?php elseif ($_GET['admin'] == 'order'): ?>
        <!-- ORDER PAGE -->
        <?php foreach ($ordersAll as $order): ?>
            <?php if ($order['id'] == $_GET['id']): ?>
            <div class="content">
                <h2>Užsakymas</h2>
                <h3>id: <?php echo $order['id'] ?></h3>
                <h4><?php echo $order['email'] ?></h4>
                <h4><?php echo $order['fname'] . " " . $order['lname'] ?></h4>
                <h4><?php echo $order['address'] ?></h4>
                <p><?php echo $order['message'] ?></p>
                <?php foreach ($orderItems as $orderItem): ?>
                    <div class="orderItem">
                        <div class="title">
                            <h4><?php echo $orderItem['productid'] ?></h4>
                            <h4><?php echo $orderItem['title'] ?></h4>
                        </div>
                        <h4>(<?php echo $orderItem['units'] ?> VNT)</h4>
                        <img src="<?php echo $pathImages . $orderItem['photo'] ?>">
                    </div>
                <?php endforeach;?>
                <a href="?url=admin" class="primaryBtn"><i class="fas fa-chevron-left"></i> Atgal</a>
                <?php if ($order['send'] == 'false'): ?>
                    <form id='send' action="<?php echo $pathController . "order.controller.php" ?>" method="POST">
                        <button type='submit' class='primaryBtn' name="send" value="<?php echo $order['id'] ?>">Išsiųsta <i class="fas fa-chevron-right"></i></button>
                    </form>
                <?php endif;?>
            </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
<?php else: ?>
    <!-- ORDERS PAGE -->
    <div class="content">
        <h2>Užsakymai</h2>
        <?php if (count($ordersNew) > 0): ?>
            <h3>Nauji užsakymai</h3>
            <?php foreach ($ordersNew as $orderNew): ?>
            <div class="orderNew">
                <h4> id: <?php echo $orderNew['id'] ?></h4>
                <h4><?php echo $orderNew['email'] ?></h4>
                <p><?php echo $orderNew['fname'] . " " . $orderNew['lname'] ?></p>
                <p><?php echo $orderNew['address'] ?></p>
                <a href="?url=admin&admin=order&id=<?php echo $orderNew['id'] ?>" class = "primaryBtn"><i class="fas fa-chevron-right"></i></a>

            </div>
            <?php endforeach;?>
        <?php endif;?>
        <h3>Išsiųsti užsakymai</h3>
        <?php for ($startI; $startI <= $endI; $startI++): ?>
            <?php if ($startI < count($ordersOld)): ?>
            <div class="orderOld">
                <h4> id: <?php echo $ordersOld[$startI]['id'] ?></h4>
                <h4><?php echo $ordersOld[$startI]['email'] ?></h4>
                <p><?php echo $ordersOld[$startI]['fname'] . " " . $ordersOld[$startI]['lname'] ?></p>
                <p><?php echo $ordersOld[$startI]['address'] ?></p>
                <form action="<?php echo $pathController . "order.controller.php" ?>" method="POST">
                    <button type="submit" class="primaryBtn" name="deleteOrder" value="<?php echo $ordersOld[$startI]['id'] ?>">X</button>
                </form>
                <a href="?url=admin&admin=order&id=<?php echo $ordersOld[$startI]['id'] ?>" class = "primaryBtn"><i class="fas fa-chevron-right"></i></a>
            </div>
            <?php endif;?>
        <?php endfor;?>
        <?php if ($ordersOldPages > 1): ?>
            <div class="pagination">
                <ul>
                    <?php for ($i = 1; $i <= $ordersOldPages; $i++): ?>
                        <li><a href="?url=admin&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                    <?php endfor;?>
                </ul>
            </div>
        <?php endif;?>
    </div>
<?php endif;?>
    </div>
</div>


<?php include $pathIncludes . 'footer.php'?>
<script src="<?php echo $pathJs . "categories.js" ?>"></script>
</body>
</html>