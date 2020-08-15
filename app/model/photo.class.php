<?php

class Photo extends Db
{

    public function createPhoto($name, $location, $locationId)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO photos (name, location, locationId) VALUES (?, ?, ?)');
        $stmt->execute([$name, $location, $locationId]);
        $stmt = null;
    }
    public function selectPhoto($location)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM photos WHERE location=?');
        $stmt->execute([$location]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectPhotoId($location, $locationId)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM photos WHERE location=? AND locationId=?');
        $stmt->execute([$location, $locationId]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }

    public function deletePhoto($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM photos WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }

    public function deleteAllPhoto($locationId)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM photos WHERE locationId=?');
        $stmt->execute([$locationId]);
        $stmt = null;
    }
}
