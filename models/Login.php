<?php
class Login extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    //Het inlog gedeelte
    public function userLogin(){
        if(isset($_POST['login'])) {
            $superUser = $this->db->real_escape_string($_POST['superUser']);
            $pass = $this->db->real_escape_string($_POST['password']);
            $pass = sha1($pass);

            //Checkt of het wel is ingevoerd of niet
            if (empty($superUser) AND empty($pass)) {
                header("Location: ?action=Login&Loginmessage=empty");
            } //Als het ingevuld is
            else {
                //Controle of de username bestaat:
                $controle_username = $this->db->query("SELECT username FROM users 
                WHERE username='$superUser'") or die(mysqli_error($this->db));
                //Kijken of er resultaat is:
                if ($controle_username->num_rows == 1) {
                    //Als er resultaat is:
                    $row_user = $controle_username->fetch_assoc();
                    $username = $row_user['username'];

                    //Checkt of de ww overeen komt:
                    $controle_pass = $this->db->query("SELECT password FROM users 
                    WHERE username='$username' AND password='$pass'") or die(mysqli_error($this->db));

                    if ($controle_pass->num_rows == 1) {
                        $row_pass = $controle_pass->fetch_assoc();
                        $password = $row_pass['password'];

                        //Pakt de grade van de user
                        $guest_result = $this->db->query("SELECT grade from users
                        WHERE username='$username' AND password='$password'") or die(mysqli_errno($this->db));

                        $row_grade = $guest_result->fetch_assoc();
                        $grade = $row_grade['grade'];
                        $_SESSION['grade'] = $row_grade['grade'];

                        //Als het een super_user is:
                        if ($grade == 'super_user') {
                            $select_super = $this->db->query("SELECT * FROM users WHERE username='$username'
                            AND password='$password' AND grade='$grade' AND active=2") or die(mysqli_error($this->db));
                            while($row_super_user = $select_super->fetch_assoc()){
                                $_SESSION['id'] = $row_super_user['id'];
                                $_SESSION['username'] = $row_super_user['username'];
                                $_SESSION['password'] = $row_super_user['password'];
                                $_SESSION['grade'] = $row_super_user['grade'];
                            }
                            header("Location: ?action=Dashboard");
                        } //Als het een guest_user is:
                        else {

                            $select_super = $this->db->query("SELECT * FROM users WHERE username='$username'
                            AND password='$password' AND grade='$grade' AND active=1") or die(mysqli_error($this->db));
                            $row_super_user = $select_super->fetch_assoc();
                            $_SESSION['id_guest'] = $row_super_user['id'];
                            $_SESSION['username_guest'] = $row_super_user['username'];
                            $_SESSION['password_guest'] = $row_super_user['password'];
                            $_SESSION['grade_guest'] = $row_super_user['grade'];

                            echo mysqli_error($this->db);
                            header("Location: ?action=Dashboard");
                        }

                    }
                    else { //Als er geen resultaat is:
                        header("Location: ?action=Login&Loginmessage=error");

                    }

                } else {
                    header("Location: ?action=Login&Loginmessage=error");

                }
            }
        }
//        else {
//            $loginmessage = 'Welcome to the Bemika login page..';
//        }
    }
}
