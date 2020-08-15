<?php
$check = new Users;
$token = $check->checkToken($_SESSION['id'], $_COOKIE['PHPSESSID']);
if ($token == 0) {
    header("Location: index.php");
}
require_once $pathGet . "order.get.php";
require_once $pathGet . "course.get.php";
require_once $pathGet . "photo.get.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Profile'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>profile.css">
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
            <a href="<?php echo $rootDir . "?url=profile" ?>" class="cart">
                <?php echo $lang['Personal Information'] ?>
            </a>
            <a href="<?php echo $rootDir . "?url=profile&profile=orders" ?>" class="cart">
                <?php echo $lang['Orders'] ?>
            </a>
            <a href="<?php echo $rootDir . "?url=profile&profile=courses" ?>" class="cart">
                <?php echo $lang['Courses'] ?>
            </a>
            <a class="cart" href="<?php echo $rootDir . "?url=cart"; ?>"><?php echo $lang['Cart'] ?></a>
        </div>
    </aside>
    <div class="main">
        <?php if (isset($_GET['profile'])): ?>
            <?php if ($_GET['profile'] == "orders"): ?>
                <!-- ORDERS PAGE -->
                <div class="content">
                    <h2><?php echo $lang['Orders'] ?></h2>
                    <?php if (count($ordersUserNew) > 0): ?>
                        <h3><?php echo $lang['New Orders'] ?></h3>
                        <?php foreach ($ordersUserNew as $orderUserNew): ?>
                        <div class="orderNew">
                            <h4> id: <?php echo $orderUserNew['id'] ?></h4>
                            <h4><?php echo $orderUserNew['email'] ?></h4>
                            <p><?php echo $orderUserNew['fname'] . " " . $orderUserNew['lname'] ?></p>
                            <p><?php echo $orderUserNew['address'] ?></p>
                            <a href="?url=profile&profile=order&id=<?php echo $orderUserNew['id'] ?>" class = "primaryBtn"><i class="fas fa-chevron-right"></i></a>

                        </div>
                        <?php endforeach;?>
                    <?php endif;?>
                    <h3><?php echo $lang['Sent Orders'] ?></h3>
                    <?php for ($startI; $startI <= $endI; $startI++): ?>
                        <?php if ($startI < count($ordersUserOld)): ?>
                        <div class="orderOld">
                            <h4> id: <?php echo $ordersUserOld[$startI]['id'] ?></h4>
                            <h4><?php echo $ordersUserOld[$startI]['email'] ?></h4>
                            <p><?php echo $ordersUserOld[$startI]['fname'] . " " . $ordersUserOld[$startI]['lname'] ?></p>
                            <p><?php echo $ordersUserOld[$startI]['address'] ?></p>
                            <form action="<?php echo $pathController . "order.controller.php" ?>" method="POST">
                                <button type="submit" class="primaryBtn" name="deleteOrder" value="<?php echo $ordersUserOld[$startI]['id'] ?>">X</button>
                            </form>
                            <a href="?url=profile&profile=order&id=<?php echo $ordersUserOld[$startI]['id'] ?>" class = "primaryBtn"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        <?php endif;?>
                    <?php endfor;?>
                    <?php if ($ordersUserPages > 1): ?>
                        <div class="pagination">
                            <ul>
                                <?php for ($i = 1; $i <= $ordersUserPages; $i++): ?>
                                    <li><a href="?url=profile&profile=orders&page=<?php echo $i ?>" class="<?php if (isset($_GET['page']) && $_GET['page'] == $i) {echo "active";}?>"><?php echo $i ?></a></li>
                                <?php endfor;?>
                            </ul>
                        </div>
                    <?php endif;?>
                </div>
            <?php elseif ($_GET['profile'] == "order"): ?>
                <!-- ORDER ACTIVE PAGE -->
                <?php foreach ($ordersAll as $order): ?>
                <?php if ($order['id'] == $_GET['id']): ?>
                <div class="content">
                    <h2><?php echo $lang['Orders'] ?></h2>
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
                            <h4>(<?php echo $orderItem['units'] . " " . $lang['Units'] ?> )</h4>
                            <img src="<?php echo $pathImages . $orderItem['photo'] ?>">
                        </div>
                    <?php endforeach;?>
                    <a href="?url=profile&profile=orders" class="primaryBtn"><i class="fas fa-chevron-left"></i> <?php echo $lang['Back'] ?></a>
                </div>
                <?php endif;?>
                <?php endforeach;?>
            <?php elseif ($_GET['profile'] == 'courses'): ?>
                <!-- COURSES PAGE -->
                <div class="content">
                <?php if (count($userCourses) > 0): ?>
                    <h2><?php echo $lang['Courses'] ?></h2>
                <?php foreach ($userCourses as $userCourse): ?>
                    <div class="course">
                        <div class="text">
                            <h3><?php if ($_SESSION['lang'] == "en") {echo $userCourse['titleen'];} else {echo $userCourse['title'];}?></h3>
                            <p><?php if ($_SESSION['lang'] == "en") {echo $userCourse['descriptionen'];} else {echo $userCourse['description'];}?></p>
                        </div>
                        <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $userCourse['id'])['name'] ?>">
                        <a href="?url=profile&profile=course&id=<?php echo $userCourse['id'] ?>" class="primaryBtn"><?php echo $lang['Open'] ?> <i class="fas fa-chevron-right"></i></a>
                    </div>
                <?php endforeach;?>
                <?php else: ?>
                    <h3><?php echo $lang['Currently you do not have any course'] ?></h3>
                <?php endif;?>
                </div>
            <?php elseif ($_GET['profile'] == 'course'): ?>
                <!-- COURSE ACTIVE PAGE -->
                <div class="content">
                    <?php foreach ($userCourses as $userCourse): ?>
                    <?php if ($_GET['id'] == $userCourse['id']): ?>
                        <h2><?php if ($_SESSION['lang'] == "en") {echo $userCourse['titleen'];} else {echo $userCourse['title'];}?></h2>
                        <div class="courseContent">
                            <p id="about"><?php if ($_SESSION['lang'] == "en") {echo $userCourse['abouten'];} else {echo $userCourse['about'];}?></p>
                            <div class="photo">
                                <div class="photoActive">
                                    <img src="<?php echo $pathImages . coursePhotoLast($coursePhotos, $userCourse['id'])['name'] ?>" >
                                    <?php foreach ($coursePhotos as $coursePhoto): ?>
                                        <?php if ($coursePhoto['locationId'] == $userCourse['id']): ?>
                                            <img src="<?php echo $pathImages . $coursePhoto['name'] ?>" >
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <img src="<?php echo $pathImages . coursePhotoFirst($coursePhotos, $userCourse['id'])['name'] ?>" >
                                </div>
                            </div>
                            <p id="instruction"><?php if ($_SESSION['lang'] == "en") {echo $userCourse['instructionen'];} else {echo $userCourse['instruction'];}?></p>
                            <?php if ($userCourse['video'] != ""): ?>
                                <video controls>
                                    <source src="<?php echo $pathVideo . $userCourse['video'] ?>" type="video/mp4">
                                </video>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
        <?php else: ?>
        <form class='contacts' action='<?php echo $pathController ?>users.controller.php'  method='POST'>
            <div class='fname'>
                <label for='fname'><?php echo $lang['First Name'] ?></label>
                <input type='text' name='fname' value='<?php echo $_SESSION['fname'] ?>'>
            </div>
            <div class='lname'>
                <label for='lname'><?php echo $lang['Last Name'] ?></label>
                <input type='text' name='lname' value='<?php echo $_SESSION['lname'] ?>'>
            </div>
            <div class='email'>
                <label for='email'><?php echo $lang['Email'] ?></label>
                <input type='email' name='email' value='<?php echo $_SESSION['email'] ?>'>
            </div>
            <div class='pnumber'>
                <label for='pnumber'><?php echo $lang['Phone Number'] ?></label>
                <input type='text' name='pnumber' value='<?php echo $_SESSION['pnumber'] ?>'>
            </div>

            <div class='address'>
                <label for='address'><?php echo $lang['Full Address'] ?></label>
                <textarea name='address'><?php echo $_SESSION['address'] ?></textarea>
            </div>
            <button type='submit' class='primaryBtn' name='updateUser'><?php echo $lang['Edit'] ?></button>
        </form>
        <h2><?php echo $lang['Change Password'] ?></h2>
        <?php if (isset($_GET['error'])): ?>
            <?php if ($_GET['error'] == 'pwd'): ?>
                <div class='error'>
                    <h4><?php echo $lang['Wrong password'] ?></h4>
                </div>
            <?php elseif ($_GET['error'] == 'match'): ?>
                <div class='error'>
                    <h4><?php echo $lang['Password does not match'] ?></h4>
                </div>
            <?php elseif ($_GET['error'] == "success"): ?>
                <div class='error'>
                    <h4><?php $lang['Successfully changed']?></h4>
                </div>
            <?php endif;?>
        <?php endif;?>
        <form action='<?php echo $pathController ?>users.controller.php' method='POST' class='password'>
            <div class='oldpwd'>
                <label for='oldpwd'><?php echo $lang['Current Password'] ?></label>
                <input type='password' name='oldpwd'>
            </div>
            <div class='newpwd'>
                <label for='newpwd'><?php echo $lang['New Password'] ?></label>
                <input type='password' name='newpwd'>
            </div>
            <div class='repwd'>
                <label for='repwd'><?php echo $lang['Repeat Password'] ?></label>
                <input type='password' name='repwd'>
            </div>
            <button class='primaryBtn' type='submit' name='updatePwd'><?php echo $lang['Change'] ?></button>
        </form>
        <?php endif;?>
    </div>
</div>


<?php include $pathIncludes . 'footer.php'?>
<script src="<?php echo $pathJs . "categories.js" ?>"></script>
<script src="<?php echo $pathJs . "carouselImg.js" ?>"></script>
</body>
</html>