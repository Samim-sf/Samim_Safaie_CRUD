<?php

namespace CRUD\Controller;

use CRUD\Helper\PersonHelper;
use CRUD\Model\Actions;
use CRUD\Model\Person;

class PersonController
{
    private $server;
    private $username;
    private $password;
    private $dbName;

    /**
     * @param $server
     * @param $username
     * @param $password
     * @param $dbName
     */
    public function __construct($server, $username, $password, $dbName)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }


    public function switcher($uri, $request)
    {
        switch ($uri) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $helper = new PersonHelper($this->server, $this->username, $this->password, $this->dbName);
        $person = new Person();

        $person->setFirstName($request['firstName']);
        $person->setLastName($request['lastName']);
        $person->setUsername($request['username']);
        $helper->insert($person);
        echo "Person added";
        echo "<br />";

    }

    public function updateAction($request)
    {
        $helper = new PersonHelper($this->server, $this->username, $this->password, $this->dbName);
        $person = new Person();

        $person->setFirstName($request['firstName']);
        $person->setLastName($request['lastName']);
        $person->setUsername($request['username']);
        $helper->update($person);
        echo "Changes were recorded";
    }

    public function readAction($request)
    {
        $helper = new PersonHelper($this->server, $this->username, $this->password, $this->dbName);
        $person = new Person();

        $person->setId($request['id']);

        $helper->fetch($person->getId());
    }

    public function readAllAction($request)
    {
        $helper = new PersonHelper($this->server, $this->username, $this->password, $this->dbName);
        $helper->fetchAll();

    }

    public function deleteAction($request)
    {
        $helper = new PersonHelper($this->server, $this->username, $this->password, $this->dbName);
        $person = new Person();
        $person->setUsername($request['username']);
        $helper->delete($person->getUsername());
        echo "deleted successfully";
    }

}