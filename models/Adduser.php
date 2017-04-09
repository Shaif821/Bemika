<?php
class Adduser extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function addNewuser(){
        if(isset($_POST['adduser'])){
            $name = $this->db->real_escape_string($_POST['name']);
            $lastname = $this->db->real_escape_string($_POST['lastname']);
            $email = $this->db->real_escape_string($_POST['email']);
            $category = $this->db->real_escape_string($_POST['category']);



            if(empty($name) OR empty($lastname) OR empty($category) OR empty($email)){
                header("Location: ?action=Adduser&Addmessage=empty");
            }
            else {
                $controle = $this->db->query("SELECT * FROM users WHERE firstname='$name'")
                    or die(mysqli_error($this->db));
                if($controle->num_rows == 0){
                    $username1 = substr($name, 4);
                    $username2 = substr($lastname, 4);
                    $username = $username1 . $username2;
                    $password = sha1($username);
                    $password3 = substr($password, 0, 8);
                    $password = sha1($password3);

                    $this->db->query("INSERT INTO users (firstname, lastnames, username, password, active, email, grade)
                    VALUES ('$name', '$lastname', '$username', '$password', 1, '$email', 'guest_user')") or die(mysqli_error($this->db));

                    header("Location: ?action=Adduser&Message=".$password3."&username=".$username);
                }
                else {
                    header("Location: ?action=Adduser&Addmessage=nameexist");
                }
            }
        }
    }

}