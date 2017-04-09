<?php
class Model {

    protected $db;

    public function __construct()
    {

        $this->db = Database::getInstance();
    }

    protected function Database(){
        $con = mysqli_connect('localhost', 'root', '', 'bemika');
        return $con;
        session_start();
    }
}