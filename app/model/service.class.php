<?php

class Service extends Db
{

    public function createService($title, $titleen, $about, $abouten)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO services (title, titleen, about, abouten) VALUES (?, ?, ?, ?)');
        $stmt->execute([$title, $titleen, $about, $abouten]);
        $stmt = null;
    }
    public function updateService($title, $titleen, $about, $abouten, $id)
    {
        $stmt = SELF::connect()->prepare('UPDATE services SET title=?, titleen=?, about=?, abouten=? WHERE id=?');
        $stmt->execute([$title, $titleen, $about, $abouten, $id]);
        $stmt = null;
    }
    public function selectServiceId($title, $titleen, $about, $abouten)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM services WHERE title=? AND titleen=? AND about=? AND abouten=?');
        $stmt->execute([$title, $titleen, $about, $abouten]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectService()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM services');
        $stmt->execute();
        $data = $stmt->fetchALL();
        $stmt = null;
        return $data;
    }
    public function deleteService($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM services WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
}
