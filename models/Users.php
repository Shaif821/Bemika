<?php
class Users extends Model {

    public function getUserInfo($userid,  $grade)
    {
        $result_user = $this->db->query("SELECT firstname, lastnames, username, email, avatar, category FROM users
         WHERE  id='$userid'") or die(mysqli_error($this->db));
            $data = $result_user->fetch_assoc();
            return $data;
    }

    public function getAllInfo($userid,  $grade)
    {
        $result_user = $this->db->query("SELECT id, firstname, lastnames, username, email, avatar, category FROM users WHERE grade='guest_user'")
        or die(mysqli_error($this->db));

        $allUserData = array();

        while($datas = $result_user->fetch_assoc()){
            $allUserData[] = $datas;
        }
        return $allUserData;
    }

    public function getAllNames()
    {
        $result_user = $this->db->query("SELECT id, firstname, lastnames, username, email, avatar, category FROM users")
        or die(mysqli_error($this->db));

        $allNameData = array();

        while($dataname = $result_user->fetch_assoc()){
            $allNameData[] = $dataname;
        }
        return $allNameData;
    }

    public function deleteUser(){
        if(isset($_POST['deluser'])){
            $id = $this->db->real_escape_string($_POST['deluser']);
            $this->db->query("UPDATE contents SET users_id=9, grade='is_deleted' WHERE users_id='$id'")
                or die(mysqli_error($this->db));
            $this->db->query("UPDATE logbooks SET users_id=9 WHERE users_id='$id'");

            $this->db->query("DELETE FROM users WHERE id='$id'")
                or die (mysqli_error($this->db));
            header("Location: ?action=Adduser");

        }
    }



}

