<?php

class Logbook extends Model {

    public function getAll(){
        $result = $this->db->query("SELECT users.firstname, users.grade, users.avatar,
        logbooks.contents_id, logbooks.activity, logbooks.category, logbooks.tags, logbooks.date, contents.tags_id, tags.tags_id, tags.tag_name FROM logbooks INNER JOIN users ON logbooks.users_id=users.id
          INNER JOIN contents ON logbooks.contents_id=contents.contents_id INNER JOIN tags ON logbooks.tags=tags.tags_id") or die(mysqli_error($this->db));

        $logbookList = array();

        while($data = $result->fetch_assoc()){
            $logbookList[] = $data;
        }
        return $logbookList;
    }

}