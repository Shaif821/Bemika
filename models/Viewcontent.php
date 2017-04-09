<?php


class Viewcontent extends Model {

    public function getContents($userid, $category){
        if(isset($_POST['Filter'])){
            $category = $this->db->real_escape_string($_POST['deleted']);
            if(empty($category)){
                $result = $this->db->query("SELECT contents.contents_id, contents.content_category, contents.title, contents.grade, users.id, 
                                         users.firstname, contents.media_content, contents.active, contents.content_date, contents.content_type,  tags.tag_name
                                         FROM contents, users, tags WHERE contents.users_id=users.id AND contents.content_category='$category' AND tags.tags_id=contents.tags_id 
                                         ORDER BY contents.content_date DESC") or die(mysqli_error($this->db));

                $contentList = array();

                while($data = $result->fetch_assoc()){
                    $contentList[] = $data;
                }
                return $contentList;
            }
            elseif(!empty($category)){
                header("Location: ?action=".$category);
            }
        }
        $result = $this->db->query("SELECT contents.contents_id, contents.content_category, contents.title, contents.grade, users.id, 
                                         users.firstname, contents.media_content, contents.active, contents.content_date, contents.content_type,  tags.tag_name
                                         FROM contents, users, tags WHERE contents.users_id=users.id AND contents.content_category='$category' AND tags.tags_id=contents.tags_id 
                                         ORDER BY contents.content_date DESC") or die(mysqli_error($this->db));

        $contentList = array();

        while($data = $result->fetch_assoc()){
            $contentList[] = $data;
        }
        return $contentList;

}


    public function getOne($userid, $grade){
        if(isset($_GET['postid']) AND isset($_GET['userid'])){
            $idpost = $_GET['postid'];
            $category = $_GET['category'];
            $result = $this->db->query("SELECT contents.contents_id, contents.title, contents.text_content, contents.media_content,
                                        contents.content_category, contents.users_id, contents.active
                                        FROM contents INNER JOIN users een ON contents.contents_id='$idpost'
                                        INNER JOIN users drie ON contents.content_category='$category'") or die(mysqli_error($this->db));
            $data = $result->fetch_assoc();
            return $data;
        }

        else {
            header("Location: ?action=Pages");
        }
    }

    public function getCategory() {
        $result = $this->db->query("SELECT tag_name, tags_id FROM tags ORDER BY tags_id DESC") or die (mysqli_error($this->db));
        $tagList = array();

        while($data = $result->fetch_assoc()){
            $tagList[] = $data;
        }
        return $tagList;
    }

    public function delCategory(){
        if(isset($_POST['dele'])) {
            $tagid = $_POST['dele'];
            $this->db->query("UPDATE contents SET tags_id='1' WHERE tags_id='$tagid'") or die (mysqli_error($this->db));
            $this->db->query("DELETE FROM tags WHERE tags_id='$tagid'") or die(mysqli_error($this->db));
            $this->db->query("INSERT INTO logbooks (activity, users_id) VALUES ('deleted a category', 1)");
            header("Location: ?action=Category");
        }
    }

    public function getLanguage() {
        $result = $this->db->query("SELECT language_name, id FROM languages") or die (mysqli_error($this->db));
        $langList = array();

        while($data = $result->fetch_assoc()){
            $langList[] = $data;
        }
        return $langList;
    }

    public function getLogo(){
        if(isset($_GET['category'])){
            if(isset($_GET['category']) AND $_GET['category'] == 'Movies'){
                ?>
                <script type="text/javascript">
                    window.addEventListener('load', function(){
                        var img = document.getElementById('loggo');
                        img.src='css/images/movies.png';
                    })
                </script>
                <?php
            }
            elseif(isset($_GET['category']) AND $_GET['category'] == 'Music'){
                ?>
                <script type="text/javascript">
                    window.addEventListener('load', function(){
                        var img = document.getElementById('loggo');
                        img.src='css/images/music.png';
                    })
                </script>
                <?php
            }
            elseif(isset($_GET['category']) AND $_GET['category'] == 'Software'){
                ?>
                <script type="text/javascript">
                    window.addEventListener('load', function(){
                        var img = document.getElementById('loggo');
                        img.src='css/images/software.png';
                    })
                </script>
                <?php
            }
            elseif(isset($_GET['category']) AND $_GET['category'] == 'Sports'){
                ?>
                <script type="text/javascript">
                    window.addEventListener('load', function(){
                        var img = document.getElementById('loggo');
                        img.src='css/images/sports.png';
                    })
                </script>
                <?php
            }

        }
    }

    public function deleteContent(){
        if(isset($_GET['del'])){
//            $count=count($_POST['check_list']);
//            $id = $_POST['check_list'];
//            for($i=0;$i<$count;$i++){
//                $this->db->query("DELETE FROM contents WHERE contents_id='".$id['$i']."'");
                header("Location: ?action=Dashboard");

//            }
        }
    }


}