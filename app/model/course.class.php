<?php

class Course extends Db
{
    public function getRandomId()
    {
        $randomId = uniqid('cid');
        $stmt = SELF::connect()->prepare("SELECT * FROM courses WHERE id=?");
        $stmt->execute([$randomId]);
        if ($stmt->rowCount() < 1) {
            $stmt = null;
            return $randomId;
        } else {
            SELF::randomUserId();
        }
    }
    public function createCourse($price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status)
    {
        $id = SELF::getRandomId();
        $stmt = SELF::connect()->prepare('INSERT INTO courses (id, price, title, titleen, description, descriptionen, about, abouten, instruction, instructionen, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status]);
        $stmt = null;
        return $id;
    }
    public function updateCourse($id, $price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status)
    {
        $stmt = SELF::connect()->prepare('UPDATE courses SET price=?, title=?, titleen=?, description=?, descriptionen=?, about=?, abouten=?, instruction=?, instructionen=?, status=? WHERE id=?');
        $stmt->execute([$price, $title, $titleen, $description, $descriptionen, $about, $abouten, $instruction, $instructionen, $status, $id]);
        $stmt = null;
    }
    public function deleteCourse($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM courses WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
    public function deleteCourseUser($courseId)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM courseuser WHERE coursesid = ?');
        $stmt->execute([$courseId]);
        $stmt = null;

    }
    public function selectCourseUser($userId)
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM courses WHERE id IN (SELECT coursesid from courseuser WHERE userid=?)');
        $stmt->execute([$userId]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectCourse()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM courses');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function updateCourseFilters($id, $filter, $filteren)
    {
        $stmt = SELF::connect()->prepare('UPDATE courses SET filters=?, filtersen=? WHERE id=?');
        $stmt->execute([$filter, $filteren, $id]);
        $stmt = null;
    }
    public function updateCourseVideo($id, $video)
    {
        $stmt = SELF::connect()->prepare("UPDATE courses SET video=? WHERE id=?");
        $stmt->execute([$video, $id]);
        $stmt = null;
    }
    public function selectCourseSearch($searchText)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM courses WHERE title LIKE ? OR titleen LIKE ? OR description LIKE ? OR descriptionen LIKE ? OR filters LIKE ? OR  filtersen LIKE ?");
        $stmt->execute(["%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%", "%" . $searchText . "%"]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function selectCourseFilter($filterText)
    {
        $stmt = SELF::connect()->prepare("SELECT * FROM courses WHERE filters LIKE ? OR  filtersen LIKE ?");
        $stmt->execute(["%" . $filterText . "%", "%" . $filterText . "%"]);
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
}
