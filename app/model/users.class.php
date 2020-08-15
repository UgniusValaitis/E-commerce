<?php

class Users extends Db
{

    protected function randomUserId()
    {
        $randomId = uniqid('uid');
        $stmt = SELF::connect()->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }

    public function checkEmail($email)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() < 1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function createUser($fname, $lname, $pnumber, $address, $email, $pwd)
    {
        $id = SELF::randomUserId();
        $dbpwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = SELF::connect()->prepare("INSERT INTO users (id, fname, lname, pnumber, address, email, pwd) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $fname, $lname, $pnumber, $address, $email, $dbpwd]);
        $stmt = null;
    }

    public function updateUser($id, $fname, $lname, $pnumber, $address, $email)
    {
        $stmt = SELF::connect()->prepare("UPDATE users SET fname=?, lname=?, pnumber=?, address=?, email=? WHERE id=?");
        $stmt->execute([$fname, $lname, $pnumber, $address, $email, $id]);
        $stmt = null;
        $stmt = SELF::connect()->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function updatePwd($id, $oldpwd, $newpwd, $repwd)
    {
        $stmt = SELF::connect()->prepare("SELECT pwd FROM users WHERE id=?");
        $stmt->execute([$id]);
        $test = $stmt->fetchAll();
        $stmt = null;
        if (password_verify($oldpwd, $test[0]['pwd']) == 1) {
            if ($newpwd == $repwd) {
                $dbpwd = password_hash($newpwd, PASSWORD_DEFAULT);
                $stmt = SELF::connect()->prepare("UPDATE users SET pwd=? WHERE id=?");
                $stmt->execute([$dbpwd, $id]);
                $stmt = null;
                return 2;
            } else {
                return 1;
            }

        } else {
            return 0;
        }

    }

    public function loginUser($email, $pwd, $token)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() < 1) {
            return $data = 0;
        } else {
            $user = $stmt->fetchAll();
            $dbpwd = $user[0]['pwd'];
            $stmt = null;
            if (password_verify($pwd, $dbpwd) == 1) {
                $update = SELF::connect()->prepare("UPDATE users SET token=? WHERE email=?");
                $update->execute([$token, $email]);
                $update = null;
                return $user;
            } else {
                return $data = 1;
            }
        }
    }

    public function checkToken($id, $cookie)
    {
        $stmt = SELF::connect()->prepare("SELECT token FROM users WHERE id=?");
        $stmt->execute([$id]);
        $token = $stmt->fetchAll();
        if ($token[0]['token'] == $cookie) {
            return 1;
        } else {
            return 0;
        };
    }
    public function logoutUser($email)
    {
        $stmt = SELF::connect()->prepare("UPDATE users SET token=? WHERE email=?");
        $stmt->execute([' ', $email]);
        $stmt = null;
    }
    public function resetPwd($email, $pwd)
    {
        $dbpwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt = SELF::connect()->prepare("UPDATE users SET pwd=? WHERE email=?");
        $stmt->execute([$dbpwd, $email]);
        $stmt = null;
    }
}
