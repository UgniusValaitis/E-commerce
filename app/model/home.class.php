<?php

class Home extends Db
{
    public function createWork($title, $titleen, $about, $abouten, $photo, $location)
    {
        $stmt = SELF::connect()->prepare('INSERT INTO works (title, titleen, about, abouten, photo, location) VALUES (?, ?, ?, ?, ?, ?);');
        $stmt->execute([$title, $titleen, $about, $abouten, $photo, $location]);
        $stmt = null;
    }
    public function getWorkId($title, $titleen, $about, $abouten, $location)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM works WHERE title=? AND titleen=? AND about=? AND abouten=? AND location=?');
        $stmt->execute([$title, $titleen, $about, $abouten, $location]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function updateWork($title, $titleen, $about, $abouten, $id)
    {
        $stmt = SELF::connect()->prepare('UPDATE works SET title=?, titleen=?, about=?, abouten=? WHERE id=?');
        $stmt->execute([$title, $titleen, $about, $abouten, $id]);
        $stmt = null;
    }
    public function updateWorkPhoto($photo, $id)
    {
        $stmt = SELF::connect()->prepare('UPDATE works SET photo=? WHERE id=?');
        $stmt->execute([$photo, $id]);
        $stmt = null;
    }
    public function deleteWork($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM works WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function getWork()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM works');
        $stmt->execute();
        $works = $stmt->fetchAll();
        $stmt = null;
        return $works;
    }

    public function updateAboutOne($id, $about, $abouten)
    {
        $stmt = SELF::connect()->prepare('UPDATE about SET about=?, abouten=? WHERE id=?;');
        $stmt->execute([$about, $abouten, $id]);
        $stmt = null;
    }
    public function updateAboutTwo($id, $photo)
    {
        $stmt = SELF::connect()->prepare('UPDATE about SET photo=? WHERE id=?;');
        $stmt->execute([$photo, $id]);
        $stmt = null;
    }
    public function getAbout()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM about');
        $stmt->execute();
        $about = $stmt->fetchAll();
        $stmt = null;
        return $about;
    }

}
