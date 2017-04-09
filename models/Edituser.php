<?php
class Edituser extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function updateSuperUserData($user_id, $username, $password){
        if(isset($_POST['updatesuper'])){
            $newusername = $this->db->real_escape_string($_POST['username']);
            $newemail = $this->db->real_escape_string($_POST['email']);
            $newpassword = $this->db->real_escape_string($_POST['password']);
//            $newpassword = sha1($newpassword);
            $current_password = $this->db->real_escape_string($_POST['currentpassword']);
            $current_password = sha1($current_password);
            $image = addslashes($_FILES['usersAvatar']['tmp_name']);
            $name = addslashes($_FILES['usersAvatar']['name']);


            if(!empty($current_password)) {
                $check_pass = $this->db->query("SELECT password FROM users WHERE password='$current_password' AND id='$user_id'");
                if ($check_pass->num_rows == 0) {
                    header("Location: ?action=Settings&Useredit=wrongpass");
                } else {
                    if(empty($newpassword)){
                        $newpassword = $current_password;
                    }else {
                        $newpassword = sha1($newpassword);
                    }
                    $usercontrole =$this->db->query("SELECT username FROM users WHERE username='$newusername'") or die (mysqli_error($this->db));

                    if(!empty($image) AND !empty($name) AND !empty($newpassword)){
                        $image = file_get_contents($image);
                        $image = base64_encode($image);
                        //checkt of de gebruiekrnsaam bestaat:

                        if($usercontrole->num_rows == 0){
                            $this->db->query("UPDATE users SET username='$newusername', password='$newpassword', email='$newemail', avatar='$image',
                        avatarname='$name' WHERE password='$current_password'") or die(mysqli_error($this->db));
                            header("Location: ?action=Logout");
                        }else {
                            header("Location: ?action=Settings&Useredit=usernameexist");

                        }


                    }
                    elseif(empty($image) AND empty($name) AND !empty($newpassword)){
//                    $image = file_get_contents($image);
//                    $image = base64_encode($image);
                        if($usercontrole->num_rows == 0) {
                            $this->db->query("UPDATE users SET username='$newusername', password='$newpassword', email='$newemail'
                            WHERE password='$current_password' AND id='$user_id'") or die(mysqli_error($this->db));
                            session_destroy();
                            header("Location: ?action=Login&Loginmessage=succes");
                        } else {
                            header("Location: ?action=Settings&Useredit=usernameexist");
                        }
                    }
                    elseif(empty($image) AND empty($name) AND !empty($newpassword)){
                        $image = file_get_contents($image);
                        $image = base64_encode($image);
                        if($usercontrole->num_rows == 0){
                            $this->db->query("UPDATE users SET username='$newusername', password='$newpassword', email='$newemail', avatar='$image', avatarname='$name'
                            WHERE password='$current_password' AND id='$user_id'") or die(mysqli_error($this->db));
                            session_destroy();
                            header("Location: ?action=Login&Loginmessage=succes");

                        } else {
                            header("Location: ?action=Settings&Useredit=usernameexist");

                        }

                    }
                }
            }
            else {
                header("Location: ?action=Settings&Useredit=nopass");
            }
        }
    }
}
