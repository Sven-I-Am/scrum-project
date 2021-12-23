<?php
class UserLoader
{
    private Connection $db;

public function __construct(){
    $this->db = new Connection();
}
    public function getUser(): array {
        $users = [];
        $sql = "SELECT * FROM user";
        $result = $this->connect()->query($sql);
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            array_push($users, $row);
        }
        return $users;
    }


}