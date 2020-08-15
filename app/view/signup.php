<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KaS || <?php echo $lang['Signup'] ?></title>
    <link rel="stylesheet" href="<?php echo $pathStyles ?>fa/css/all.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>header.css">
    <link rel="stylesheet" href="<?php echo $pathStyles ?>signup.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include $pathIncludes . 'header.php'?>

<section >
    <div class="space">
        <h3><?php echo $lang['Sign Up'] ?></h3>
    </div>
<?php if (isset($_GET['error'])) {
    if ($_GET['error'] == 'pwd') {
        echo "<div class='error'>
        <h4>" . $lang['Password does not match'] . "</h4>
        </div>";
    } elseif ($_GET['error'] == "email") {
        echo "<div class='error'>
        <h4>" . $lang['Email already exists'] . "</h4>
        </div>";
    } elseif ($_GET['error'] == "empty") {
        echo "<div class='error'>
        <h4>" . $lang['Fill all fields'] . "</h4>
        </div>";
    }
}?>
    <div class="container">
        <form action="<?php echo $pathController . "users.controller.php" ?>" method="POST">
            <div>
                <input id="fname" type="text" name="fname" placeholder="<?php echo $lang['First Name'] ?>" <?php if (isset($_GET['fname'])) {echo "value='" . $_GET["fname"] . "'";}?>>
                <input id="lname" type="text" name="lname" placeholder="<?php echo $lang['Last Name'] ?>" <?php if (isset($_GET['lname'])) {echo "value='" . $_GET["lname"] . "'";}?>>
            </div>
            <div>
                <input id="email" type="email" name="email" placeholder="<?php echo $lang['Email'] ?>" <?php if (isset($_GET['email'])) {echo "value='" . $_GET["email"] . "'";}?>>
                <input id="pnumber" type="text" name="pnumber" placeholder="<?php echo $lang['Phone Number'] ?>" <?php if (isset($_GET['pnumber'])) {echo "value='" . $_GET["pnumber"] . "'";}?>>
            </div>
            <textarea name="address" id="address" cols="30" rows="10" placeholder="<?php echo $lang['Full Address'] ?>"><?php if (isset($_GET['address'])) {echo $_GET["address"];}?></textarea>
            <div>
                <input id="password" type="password" name="password" placeholder="<?php echo $lang['Password'] ?>">
                <input id="rpassword" type="password" name="rpassword" placeholder="<?php echo $lang['Repeat Password'] ?>">
            </div>
            <button value="submit" class="submit primaryBtn" name="signup"><?php echo $lang['Signup'] ?> <i class="fas fa-chevron-right"></i></button>
        </form>
    </div>
</section>

    <?php include $pathIncludes . 'footer.php'?>

</body>
</html>
