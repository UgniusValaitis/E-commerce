<?php

class Shop extends Db
{

    public function getRandomId()
    {
        $randomId = uniqid('pid');
        $stmt = SELF::connect()->prepare("SELECT * FROM shop WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }
    public function createShop($units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten)
    {
        $id = SELF::getRandomId();
        $stmt = SELF::connect()->prepare('INSERT INTO shop (id, units, price, title, titleen,description, descriptionen, about, abouten) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten]);
        $stmt = null;
        return $id;
    }

    public function updateShop($id, $units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten)
    {
        $stmt = SELF::connect()->prepare('UPDATE shop SET units=?, price=?, title=?, titleen=?, description=?, descriptionen=?, about=?, abouten=? WHERE id=?');
        $stmt->execute([$units, $price, $title, $titleen, $description, $descriptionen, $about, $abouten, $id]);
        $stmt = null;
    }
    public function updateShopFilters($id, $filters, $filtersen)
    {
        $stmt = SELF::connect()->prepare('UPDATE shop SET filters=?, filtersen=? WHERE id=?');
        $stmt->execute([$filters, $filtersen, $id]);
        $stmt = null;
    }
    public function selectShop()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM shop');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectShopSearch($searchText)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM shop WHERE title LIKE ? OR titleen LIKE ? OR description LIKE ? OR descriptionen LIKE ? OR filters LIKE ? OR  filtersen LIKE ?");
        $stmt->execute(["%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%"]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectShopFilter($filterText)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM shop WHERE filters LIKE ? OR  filtersen LIKE ?");
        $stmt->execute(["%" . $filterText . "%", "%" . $filterText . "%"]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function deleteProduct($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM shop WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
}
