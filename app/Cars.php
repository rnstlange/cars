<?php

class Cars
{
    private static $db;
    public function __construct()
    {
        self::$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

    private function createCar($brand, $model, $year, $owner_id = null) {
        $stmt = self::$db->prepare('INSERT INTO cars (owner, brand, model, year) VALUES (?, ?, ?, ?);');
        $stmt->bind_param('issi', $owner_id, $brand, $model, $year);
        $stmt->execute();
        return $stmt->insert_id;
    }

    private function createOwner($owner) {
        $stmt = self::$db->prepare('INSERT INTO owners (full_name) VALUE (?);');
        $stmt->bind_param('s', $owner);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function create($brand, $model, $year, $owner = false)
    {
        self::$db->begin_transaction();
        if ($owner) {
            $stmt = self::$db->prepare('SELECT id FROM owners WHERE full_name = ?;');
            $stmt->bind_param('s', $owner);
            $stmt->execute();
            $stmt->bind_result($owner_id);
            $stmt->fetch();
            $stmt->close();
            if ($owner_id) {
                $this->createCar($brand, $model, $year, $owner_id);
                self::$db->commit();
            } else {
                $owner_id = $this->createOwner($owner);
                $this->createCar($brand, $model, $year, $owner_id);
                self::$db->commit();
            }
        } else {
            $this->createCar($brand, $model, $year);
            self::$db->commit();
        }
    }

    public function getAll(){
        $result = self::$db->query('SELECT c.brand, c.model, c.year, o.full_name FROM cars c LEFT JOIN owners o on c.owner = o.id;', MYSQLI_USE_RESULT);
        $value = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        return $value;
    }
}