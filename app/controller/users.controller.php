<?php
require "../PHPMailer/PHPMailer.php";
require "../PHPMailer/Exception.php";
require "../PHPMailer/SMTP.php";
require "../config/autoload.php";
$users = new Users;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();
// SIGN UP
if (isset($_POST["signup"])) {
    $checkEmail = $users->checkEmail($_POST['email']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pnumber = $_POST['pnumber'];
    $address = $_POST['address'];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    if ($email != "" && $fname != "" && $lname != "" && $address != "" && $pwd != "") {
        if ($checkEmail == 1) {
            if ($_POST['password'] == $_POST["rpassword"]) {
                $users->createUser($fname, $lname, $pnumber, $address, $email, $pwd);
                header("Location: ../../public");
            } else {
                header("Location: ../../public/index.php?url=signup&fname=" . $fname . "&lname=" . $lname . "&pnumber=" . $pnumber . "&address=" . $address . "&email=" . $email . "&error=pwd");
            }
        } else {
            header("Location: ../../public/index.php?url=signup&fname=" . $fname . "&lname=" . $lname . "&pnumber=" . $pnumber . "&address=" . $address . "&error=email");
        }
    } else {
        header("Location: ../../public/index.php?url=signup&fname=" . $fname . "&lname=" . $lname . "&pnumber=" . $pnumber . "&address=" . $address . "&email=" . $email . "&error=empty");
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST["pwd"];
    $token = $_COOKIE["PHPSESSID"];
    $pageFull = $_POST['page'];
    $pageCleanEmail = str_replace("?login=email", " ", $pageFull);
    $pageCleanPwd = str_replace("?login=pwd", " ", $pageCleanEmail);
    $pageCleanPagesEmail = str_replace("&login=email", " ", $pageCleanPwd);
    $pageCleanPagesPwd = str_replace("&login=pwd", " ", $pageCleanPagesEmail);
    $pageCleanLt = str_replace("&lang=lt", " ", $pageCleanPagesPwd);
    $pageCleanEn = str_replace("&lang=en", ' ', $pageCleanLt);
    $page = trim($pageCleanEn);
    if (strpos($page, '?') !== false) {
        $page = $page . '&';
    } else {
        $page = $page . '?';
    }
    $login = $users->loginUser($email, $pwd, $token);
    if ($login == 0) {
        header("Location: ../../../.." . $page . "login=email");
    } elseif ($login == 1) {
        header("Location: ../../../.." . $page . "login=pwd");
    } else {
        print_r($login);
        $_SESSION['id'] = $login[0]['id'];
        $_SESSION['fname'] = $login[0]['fname'];
        $_SESSION['lname'] = $login[0]['lname'];
        $_SESSION['pnumber'] = $login[0]['pnumber'];
        $_SESSION['address'] = $login[0]['address'];
        $_SESSION['email'] = $login[0]['email'];
        header("Location: ../../../.." . $page);
    }
}

// LOGOUT
if (isset($_GET['logout'])) {
    $users->logoutUser($_SESSION['email']);
    unset($_SESSION['id']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['pnumber']);
    unset($_SESSION['address']);
    unset($_SESSION['email']);
    header("Location: ../../public");
}

// UPDATE USER
if (isset($_POST['updateUser'])) {
    $newData = $users->updateUser($_SESSION['id'], $_POST['fname'], $_POST['lname'], $_POST['pnumber'], $_POST['address'], $_POST['email']);
    $_SESSION['fname'] = $newData[0]['fname'];
    $_SESSION['lname'] = $newData[0]['lname'];
    $_SESSION['pnumber'] = $newData[0]['pnumber'];
    $_SESSION['address'] = $newData[0]['address'];
    $_SESSION['email'] = $newData[0]['email'];
    header("Location: ../../public/?url=profile");
}

// UPDATE PASSWORD
if (isset($_POST['updatePwd'])) {
    $test = $users->updatePwd($_SESSION['id'], $_POST['oldpwd'], $_POST['newpwd'], $_POST['repwd']);
    if ($test == 0) {
        header("Location: ../../public/?url=profile&error=pwd");
    } elseif ($test == 1) {
        header("Location: ../../public/?url=profile&error=match");
    } elseif ($test == 2) {
        header("Location: ../../public/?url=profile&error=success");
    }
}

// RECOVER PASSWORD
if (isset($_POST['recPwd'])) {
    $random = uniqid('uid');
    $pwd = substr($random, 9, 6);
    $email = $_POST['email'];
    $users->resetPwd($email, $pwd);
    if ($_SESSION['lang'] == 'lt') {
        $subject = "kas.com naujas slaptazodis";
        $message = "<h1>Sveiki.</h1></br>
            <h3>Jūsų naujasis slaptažodis :  " . $pwd . "</h3></br>
            <p>Nepamirškite prisijunge pakeisti šį slaptažodį į naują kurį bus lengviau atsiminti.<p>";
    } elseif ($_SESSION['lang'] == "en") {
        $subject = "kas.com new password";
        $message = "<h1>Hello.</h1></br>
            <h3>Your new password:  " . $pwd . "</h3></br>
            <p>Do not forget to change password then you log in to something that will be easier to remember.</p>";
    }

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->isHTML();
    $mail->Username = "kestasandsonata@gmail.com";
    $mail->Password = "slaptas326";
    $mail->Subject = $subject;
    $mail->SetFrom("kestasandsonata@gmail.com");
    $mail->isHTML(true);
    $mail->Body = $message;
    $mail->addAddress($email);

    if ($mail->Send()) {
        echo "email sent";
    } else {
        echo "error";
    }
    ;
    $mail->smtpClose();
    header("Location: ../../public");
}

// CONTACT US
if (isset($_POST['mail'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['message'];
    $subject = "Zinute nuo: " . $name;
    $message = "<h3>" . $email . "</h3>
        <p>" . $text . "</p>";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->isHTML();
    $mail->Username = "kestasandsonata@gmail.com";
    $mail->Password = "slaptas326";
    $mail->Subject = $subject;
    $mail->SetFrom($email);
    $mail->isHTML(true);
    $mail->Body = $message;
    $mail->addAddress("kestasandsonata@gmail.com");

    if ($mail->Send()) {
        echo "email sent";
    } else {
        echo "error";
    }
    ;
    $mail->smtpClose();
    header("Location: ../../public");
}
