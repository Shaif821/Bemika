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

                    //mail gedoe:
                    $boundary = "-----=".md5(rand());
                    $headers =  'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'From: Bemika <Bemika@gmail.com>' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $header .= "Content-type: multipart/alternative;". "\r\n" ."boundary=\"$boundary\"". "\r\n";
                    $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";

                    $subject = "Registratie";
                    $body = "Beste , $name $lastname, <br> U bent aangemeld voor Bemika. <br> Uw gegevens: <br> Gebrukernsaam: $username<br>Wachtwoord: $password3<br> Met vriendeljke groet, <br> <br> Bemika<br> Let op: U kunt niet reageren op deze mail!";
                    $bericht = wordwrap($body, 70);

                    $stuur = mail($email, $subject, $bericht, $headers);

                    if(!stuur){
                        header("Location: ?action=Adduser&errormail");
                    }else {
                        header("Location: ?action=Adduser&succes");
                    }

                }
                else {
                    header("Location: ?action=Adduser&Addmessage=nameexist");
                }
            }
        }
    }

}