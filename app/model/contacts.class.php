<?php

class Contacts extends Db
{
    public function updateContacts($location, $title)
    {
        $stmt = SELF::connect()->prepare('UPDATE contacts SET title=? WHERE location=?');
        $stmt->execute([$title, $location]);
        $stmt = null;
    }
    public function createContacts($title)
    {
        $location = 'other';
        $fa = "fas fa-info-circle";
        $stmt = SELF::connect()->prepare('INSERT INTO contacts (location, title, fa) VALUES (?, ?, ?)');
        $stmt->execute([$location, $title, $fa]);
        $stmt = null;
    }
    public function selectContacts()
    {
        $stmt = SELF::connect()->prepare('SELECT * FROM contacts');
        $stmt->execute();
        $data = $stmt->fetchAll();
        $stmt = null;
        return $data;
    }
    public function deleteContacts($location)
    {
        $stmt = SELF::connect()->prepare('UPDATE contacts SET title=? WHERE location=?');
        $stmt->execute(['', $location]);
        $stmt = null;
    }

    public function deleteContactsOther($id)
    {
        $stmt = SELF::connect()->prepare('DELETE FROM contacts WHERE id=?');
        $stmt->execute([$id]);
        $stmt = null;
    }
}
