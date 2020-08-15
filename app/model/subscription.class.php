<?php

class Subscription extends Db
{

    public function randomId()
    {
        $randomId = uniqid('sid');
        $stmt = SELF::connect()->prepare("SELECT * FROM subscription WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }
    public function createSubscription($title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status)
    {
        $id = SELF::randomId();
        $stmt = SELF::connect()->prepare('INSERT INTO subscription (id, title, titleen, description, descriptionen, about, abouten, pricem, pricey, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status]);
        $stmt = null;
        return $id;
    }

    public function updateSubscription($id, $title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status)
    {
        $stmt = SELF::connect()->prepare('UPDATE subscription SET title=?, titleen=?, description=?, descriptionen=?, about=?, abouten=?, pricem=?, pricey=?, status=? WHERE id=?;');
        $stmt->execute([$title, $titleen, $description, $descriptionen, $about, $abouten, $pricem, $pricey, $status, $id]);
        $stmt = null;
    }

    public function selectSubscription()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM subscription;');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectSubscribers()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM subscriptionuser ORDER BY substitle');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function deleteSubscriber($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM subscriptionuser WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function deleteSubscription($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM subscription WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
}
