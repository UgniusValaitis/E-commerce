    <header>
        <div id="nav">
            <div id="left">
                <div class="mainNavBtn" id="mainNavBtn">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <div id="lang">
                    <a id="lt" href="<?php echo $currentPage . 'lang=lt' ?>">LT</a>
                    <i class="fas fa-grip-lines-vertical"></i>
                    <a id="en" href="<?php echo $currentPage . 'lang=en' ?>">EN</a>
                </div>
                <input type="hidden" id="hiddenLang" value='<?php echo $_SESSION['lang'] ?>'>
            </div>
            <h1>KaS</h1>
            <div id="mainProfileBtn" <?php if (isset($_GET['login'])) {echo "class='login'";}?>>
                <i class="<?php if (isset($_GET['login'])) {echo "fas fa-user-times";} else {echo "fas fa-user";}?>"></i>
            </div>
        </div>

        <div id="mainNav">
            <a id="nav1" href="<?php echo $rootDir ?>"><?php echo $lang['Home'] ?></a>
            <a id="nav2" href="<?php echo $rootDir . "?url=services"; ?>"><?php echo $lang['Services'] ?></a>
            <a id="nav3" href="<?php echo $rootDir . "?url=shop"; ?>"><?php echo $lang['Shop'] ?></a>
            <a id="nav4" href="<?php echo $rootDir . "?url=courses"; ?>"><?php echo $lang['Courses'] ?></a>
            <a id="nav5" href="<?php echo $rootDir . "?url=contacts"; ?>"><?php echo $lang['Contacts'] ?></a>

        </div>

        <div id="mainProfile" <?php if (isset($_GET['login'])) {echo "class='login'";}?>>

<?php if (isset($_SESSION['id'])): ?>
    <?php if ($_SESSION['fname'] == 'admin'): ?>
        <a id='item1' href='<?php echo $rootDir ?>?url=admin'> Admin </a>
        <a id='item3' href='<?php echo $pathController ?>users.controller.php?logout=out'><?php echo $lang['Logout'] ?></a>
    <?php else: ?>
        <a id='item1' href='<?php echo $rootDir ?>?url=profile'><?php echo $lang['Profile'] ?></a>
        <a id='item2' href='<?php echo $rootDir ?>?url=cart'><?php echo $lang['Cart'] ?></a>
        <a id='item3' href='<?php echo $pathController ?>users.controller.php?logout=out'><?php echo $lang['Logout'] ?></a>
    <?php endif;?>
<?php else: ?>

    <?php if (isset($_GET['login'])): ?>
        <?php if ($_GET['login'] == "email"): ?>
        <div class='error'>
            <h4><?php echo $lang["Wrong Email"] ?></h4>
        </div>
        <?php elseif ($_GET['login'] == "pwd"): ?>
        <div class='error'>
            <h4><?php echo $lang["Wrong Password"] ?></h4>
        </div>
        <?php endif;?>
    <?php endif;?>
    <form action='<?php echo $pathController ?>users.controller.php' method='post'>
        <div id='login'>
            <input id='login1' type='text' placeholder='e-mail' name='email'>
            <input id='login2' type='password' placeholder='password' name='pwd'>
            <input type='hidden' name='page' value='<?php echo $_SERVER['REQUEST_URI'] ?>'>
        </div>
        <button type='submit' class='navBtn' name='login'><?php echo $lang['Login'] ?></button>
    </form>

    <a id='signup' href='<?php echo $rootDir ?>?url=signup'><?php echo $lang['Signup'] ?></a>
    <a id='pwdRedo' href='<?php echo $rootDir ?>?url=resetpassword'><?php echo $lang['ForgotPwd'] ?></a>
<?php endif;?>

        </div>
    </header>