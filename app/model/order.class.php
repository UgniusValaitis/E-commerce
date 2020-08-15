<?php

class Order extends db
{

    public function generateIdItems()
    {
        $randomId = uniqid('oid');
        $stmt = SELF::connect()->prepare("SELECT * FROM orderitems WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }
    public function generateIdOrder()
    {
        $randomId = uniqid('oid');
        $stmt = SELF::connect()->prepare("SELECT * FROM orders WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }

    public function createOrder($userId, $fname, $lname, $address, $message, $deleteDate, $send, $email)
    {
        $id = SELF::generateIdOrder();
        $stmt = SELF::connect()->prepare('INSERT INTO orders (id, userid, fname, lname, address, message, deletedate, send, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');
        $stmt->execute([$id, $userId, $fname, $lname, $address, $message, $deleteDate, $send, $email]);
        $stmt = null;
        return $id;
    }
    public function createOrderItems($orderId, $productId, $units, $title, $titleen, $photo)
    {
        $id = SELF::generateIdItems();
        $stmt = SELF::connect()->prepare('INSERT INTO orderitems (id, orderid, productid, units, title, titleen, photo) VALUES (?, ?, ?, ?, ?, ?, ?);');
        $stmt->execute([$id, $orderId, $productId, $units, $title, $titleen, $photo]);
        $stmt = null;
    }
    public function addCourseUser($userId, $coursesId)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO courseuser (userid, coursesid) VALUES (?, ?);');
        $stmt->execute([$userId, $coursesId]);
        $stmt = null;
    }
    public function addSubsUser($email, $address, $fname, $lname, $expdate, $substitle)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO subscriptionuser (email, address, fname, lname, expdate, substitle) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$email, $address, $fname, $lname, $expdate, $substitle]);
        $stmt = null;
    }
    public function updateShopUnits($units, $productId)
    {
        $stmt = SELF::connect()->prepare('UPDATE shop SET units = units - ? WHERE id=?');
        $stmt->execute([$units, $productId]);
        $stmt = null;
    }
    public function selectOrder()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM orders;');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectOrderItems($orderId)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM orderitems WHERE orderid=?');
        $stmt->execute([$orderId]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectCourseUser()
    {
        $stmt = SELF::connect()->prepare('SELECT * from courseuser');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function deleteOrder($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM orders WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function deleteOrderItems($orderId)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM orderitems WHERE orderid=?');
        $stmt->execute([$orderId]);
        $stmt = null;
    }
    public function deleteCourseUser($coursesId)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM courseuser WHERE coursesid=?');
        $stmt->execute([$coursesId]);
        $stmt = null;
    }
    public function updateSend($courseId)
    {
        $stmt = SELF::connect()->prepare('UPDATE orders SET send=? WHERE id=?');
        $stmt->execute(["true", $courseId]);
        $stmt = null;
    }
}
