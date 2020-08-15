<?php

class Groups extends Db
{

    public function createGroup($location, $title, $titleen)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO groups (location, title, titleen) VALUES (?, ?, ?)');
        $stmt->execute([$location, $title, $titleen]);
        $stmt = null;
    }
    public function deleteGroup($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM groups WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function selectGroup($location)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM groups WHERE location=?');
        $stmt->execute([$location]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
}
