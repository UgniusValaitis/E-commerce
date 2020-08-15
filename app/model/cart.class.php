<?php

class Cart extends Db
{
    public function uniqueId()
    {
        $randomId = uniqid('cid');
        $stmt = SELF::connect()->prepare("SELECT * FROM cart WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }
    public function createCartProduct($userId, $productId, $units, $price, $title, $titleen, $photo)
    {
        $id = SELF::uniqueId();
        try {
            $stmt = SELF::connect()->prepare('INSERT INTO cart (id, userid, productid, units, price, title, titleen, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$id, $userId, $productId, $units, $price, $title, $titleen, $photo]);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        $stmt = null;
    }

    public function createCartCourse($userId, $productId, $price, $title, $titleen, $photo)
    {
        $id = SELF::uniqueId();
        $stmt = SELF::connect()->prepare('INSERT INTO cart (id, userid, productid, price, title, titleen, photo) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $userId, $productId, $price, $title, $titleen, $photo]);
        $stmt = null;
    }

    public function createCartSubs($userId, $subsId, $units, $price, $title, $titleen, $photo, $subs)
    {
        $id = SELF::uniqueId();
        $stmt = SELF::connect()->prepare('INSERT INTO cart (id, userid, productid, units, price, title, titleen, photo, subs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $userId, $subsId, $units, $price, $title, $titleen, $photo, $subs]);
        $stmt = null;
    }
    public function deleteCart($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM cart WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function deleteCartAll($userId)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM cart WHERE userid=?');
        $stmt->execute([$userId]);
        $stmt = null;
    }
    public function selectCart($userId)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM cart WHERE userid=?');
        $stmt->execute([$userId]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
}
