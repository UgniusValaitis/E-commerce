<?php

class Filters extends Db
{
    public function createFilter($groupid, $location, $title, $titleen)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO filters (groupid, location, title, titleen) VALUES (?, ?, ?, ?)');
        $stmt->execute([$groupid, $location, $title, $titleen]);
        $stmt = null;
    }
    public function deleteFilter($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM filters WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function deleteAllFilter($groupid)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM filters WHERE groupid=?');
        $stmt->execute([$groupid]);
        $stmt = null;
    }
    public function selectAllFilter()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM filters');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
}
