<?php

namespace CRUD\Helper;

use CRUD\Model\Person;

class PersonHelper
{
    private $DBConnector;
    private $tableName = "person";

    /**
     * @throws \Exception
     */
    public function __construct($server, $username, $password, $dbName)
    {
        if ($this->DBConnector === null) {
            $this->DBConnector = new DBConnector($server, $username, $password, $dbName);
            $this->DBConnector->connect();
        }
        $this->createTable();
    }


    public function insert(Person $person)
    {
//        $query = "Insert into $this->tableName (firstName,lastName,username) values ( " . $person->getFirstName() . "," . $person->getLastName() . "," . $person->getUsername() . ")";
        $query = "Insert into $this->tableName (firstName,lastName,username) values ( '" . $person->getFirstName() . "','" . $person->getLastName() . "','" . $person->getUsername() . "')";
        $this->DBConnector->execQuery($query);
    }

    public function fetch(int $id)
    {
        $query = "Select * from " . $this->tableName . " where " . $this->tableName . ".id = " . $id;
        $result = $this->DBConnector->execQueryWithSol($query);
        echo '
        <table style="width: 100%; border: 1px solid black;">
            <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>LastName</th>
            <th>UserName</th>
            </tr>
            ';
        foreach ($result as $row) {
            echo '<tr>
                        <td>' . $row["id"] . '</td>   
                        <td>' . $row["firstname"] . '</td>   
                        <td>' . $row["lastname"] . '</td>   
                        <td>' . $row["username"] . '</td>   
                   </tr>
                 ';
        }
        echo '</table>';
    }


    public function fetchAll()
    {
        $query = "Select * from " . $this->tableName;
        $result = $this->DBConnector->execQueryWithSol($query);
        echo '
        <table style="width: 100%; border: 1px solid black; border-collapse: separate; border-spacing: 10px;">
            <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>LastName</th>
            <th>UserName</th>
            </tr>
            ';
        foreach ($result as $row) {
//            echo "<br>";
//            echo "id: " . $row['id'] . "\t firstname: " . $row['firstname'] . "\t lastname: " . $row['lastname'] . "\t username: " . $row['username'];
            echo '<tr>
                        <td style="border: 1px solid black;">' . $row["id"] . '</td>   
                        <td style="border: 1px solid black;">' . $row["firstname"] . '</td>   
                        <td style="border: 1px solid black;">' . $row["lastname"] . '</td>   
                        <td style="border: 1px solid black;">' . $row["username"] . '</td>   
                   </tr>
                 ';
        }
        echo '</table>';
    }

    public function update($person)
    {
        $this->delete($person->getUsername());
        $this->insert($person);
    }

    public function delete($username)
    {
        $query = "DELETE FROM " . $this->tableName . " where username like  '$username'";
        $this->DBConnector->execQuery($query);
    }

    private function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS  $this->tableName
            (id int AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            username VARCHAR(50));
        ";
        $this->DBConnector->execQuery($query);
    }


}