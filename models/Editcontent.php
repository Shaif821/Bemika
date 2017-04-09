<?php

class Editcontent extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function updateContent($userid)
    {
        if (isset($_POST['update'])) {
            $idpost = $_GET['postid'];
            $title = $this->db->real_escape_string($_POST['title']);
            $video = $this->db->real_escape_string($_POST['video']);
            $category = $_GET['category'];
            $video = substr($video, 17, 28);
            $text = $this->db->real_escape_string($_POST['description']);
            $image = addslashes($_FILES['myimg']['tmp_name']);
            $name = addslashes($_FILES['myimg']['name']);
            $languages = $this->db->real_escape_string($_POST['lang']);

            if (!empty($title)) {

            if (!empty($video) AND !empty($image)) {
                header("?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=vidimg");
            }
            elseif (!empty($_POST['cate']) AND !empty($_POST['soort'])) {
                header("Location: ?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=same");
            } elseif (empty($_POST['cate']) AND empty($_POST['soort'])) {
                header("Location: ?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=geencategory");
            }
            else {
                //dit is de category.....
                //Als soort niet leeg is en gezet is dan wordt daarvan en variable gemaakt
                if (!empty($_POST['soort']) AND empty($_POST['cate'])) {
                    $tag = $this->db->real_escape_string($_POST['soort']);
                } elseif (!empty($_POST['cate']) AND empty($_POST['soort'])) {
                    $tag = $this->db->real_escape_string($_POST['cate']);
                }

                if (!$image AND !$name AND !$video) {
                    //De query om te controleren of de category al bestaat

                    $this->db->query("UPDATE contents SET title='$title', text_content='$text', languages_id='$languages', 
                    content_category='$category', users_id='$userid', content_type='text'  WHERE contents_id='$idpost'") or die (mysqli_error($this->db));

                    //De tag gedoe:
                    //Controleert of de tag al bestaat
                    $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                    //De if statemetn/ als er niks gevonde is:
                    if ($controle->num_rows == 0) {
                        $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                        $tagid = mysqli_insert_id($this->db);
                        $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                    } else {
                        $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        while ($row = $result->fetch_assoc()) {
                            $tagid = $row['tags_id'];
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        }
                    }

                    $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('updated a text article to Pages', '$idpost', '$category','$tagid', '$userid')") or die($this->db->error);
                    header("Location: ?action=" . $category);

                } elseif ($image AND $name AND !$video) {
                    $image = file_get_contents($image);
                    $image = base64_encode($image);
                    $this->db->query("UPDATE contents SET title='$title', images='$image', img_names='$name', text_content='$text', languages_id='$languages', 
                    content_category='$category', users_id='$userid', content_type='imageText' WHERE contents_id='$idpost'");

                    //De tag gedoe:
                    //Controleert of de tag al bestaat
                    $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                    //De if statemetn/ als er niks gevonde is:
                    if ($controle->num_rows == 0) {
                        $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                        $tagid = mysqli_insert_id($this->db);
                        $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                    } else {
                        $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        while ($row = $result->fetch_assoc()) {
                            $tagid = $row['tags_id'];
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        }
                    }

                    $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id) VALUES ('updated an image in Pages', '$idpost', '$tag', '$category', $userid)") or die(mysqli_error($this->db));
                    header("Location: ?action=" . $category);

                } elseif ($video AND !$image AND !$name) {
                    $this->db->query("UPDATE contents SET title='$title', text_content='$text', media_content='$video', languages_id='$languages', 
                    content_category='$category', users_id='$userid', content_type='videoText'  WHERE contents_id='$idpost'") or die (mysqli_error($this->db));

                    //De tag gedoe:
                    //Controleert of de tag al bestaat
                    $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                    //De if statemetn/ als er niks gevonde is:
                    if ($controle->num_rows == 0) {
                        $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                        $tagid = mysqli_insert_id($this->db);
                        $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                    } else {
                        $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        while ($row = $result->fetch_assoc()) {
                            $tagid = $row['tags_id'];
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        }
                    }

                    $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('updated a text article to Pages', '$idpost', '$category','$tagid', '$userid')") or die($this->db->error);
                    header("Location: ?action=" . $category);

                }

            }
        }
        else {
                header("Location: ?action=Posts&postid=".$idpost."&userid=1&category=".$category."&Update=velden");
        }

        } elseif (isset($_POST['publish'])) {
            $idpost = $_GET['postid'];
            $title = $this->db->real_escape_string($_POST['title']);
            $video = $this->db->real_escape_string($_POST['video']);
            $category = $_GET['category'];
            $video = substr($video, 17, 28);
            $text = $this->db->real_escape_string($_POST['description']);
            $image = addslashes($_FILES['myimg']['tmp_name']);
            $name = addslashes($_FILES['myimg']['name']);
            $languages = $this->db->real_escape_string($_POST['lang']);

            if (!empty($title)) {

                if (!empty($video) AND !empty($image)) {
                    header("?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=vidimg");
                }
                elseif (!empty($_POST['cate']) AND !empty($_POST['soort'])) {
                    header("Location: ?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=same");
                } elseif (empty($_POST['cate']) AND empty($_POST['soort'])) {
                    header("Location: ?action=Posts&postid=" . $idpost . "&userid=1&category=" . $category . "&Update=geencategory");
                }

                else {
                    //dit is de category.....
                    //Als soort niet leeg is en gezet is dan wordt daarvan en variable gemaakt
                    if (!empty($_POST['soort']) AND empty($_POST['cate'])) {
                        $tag = $this->db->real_escape_string($_POST['soort']);
                    } elseif (!empty($_POST['cate']) AND empty($_POST['soort'])) {
                        $tag = $this->db->real_escape_string($_POST['cate']);
                    }

                    if (!$image AND !$name AND !$video) {
                        //De query om te controleren of de category al bestaat

                        $this->db->query("UPDATE contents SET title='$title', text_content='$text', languages_id='$languages', 
                    content_category='$category', users_id='$userid', active=1, content_type='text'  WHERE contents_id='$idpost'") or die (mysqli_error($this->db));

                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                            }
                        }

                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('published a text article to Pages', '$idpost', '$category','$tagid', '$userid')") or die($this->db->error);
                        header("Location: ?action=" . $category);

                    } elseif ($image AND $name AND !$video) {
                        $image = file_get_contents($image);
                        $image = base64_encode($image);
                        $this->db->query("UPDATE contents SET title='$title', images='$image', img_names='$name', text_content='$text', languages_id='$languages', 
                    content_category='$category', users_id='$userid', active=1, content_type='imageText' WHERE contents_id='$idpost'");

                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                            }
                        }

                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tag, users_id) VALUES ('published an image in Pages', '$idpost', '$tag', '$category', '$userid')") or die(mysqli_error($this->db));
                        header("Location: ?action=" . $category);

                    } elseif ($video AND !$image AND !$name) {
                        $this->db->query("UPDATE contents SET title='$title', text_content='$text', media_content='$video', languages_id='$languages', 
                    content_category='$category', users_id='$userid', active=1, content_type='videoText'  WHERE contents_id='$idpost'") or die (mysqli_error($this->db));

                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$idpost'") or die(mysqli_error($this->db));
                            }
                        }

                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('published a text article to Pages', '$idpost', '$category','$tagid', '$userid')") or die($this->db->error);
                        header("Location: ?action=" . $category);

                    }

                }
            }
            else {
                header("Location: ?action=Posts&postid=".$idpost."&userid=1&category=".$category."&Update=velden");
            }

        }
    }

    public function deleteContent()
    {
        if (isset($_POST['del'])) {
            $postid = $_GET['postid'];
            $category = $_GET['category'];
            $this->db->query("DELETE FROM contents WHERE contents_id='$postid'") or die(mysqli_error($this->db));
            $this->db->query("INSERT INTO logbooks (activity, category, users_id) VALUES 
            ('deleted an post in Pages', '$category', 'users_id='$userid',')") or die(mysqli_error($this->db));
            header("Location: ?action=" . $_GET['category']);
        }
        elseif (isset($_POST['dele'])) {
            $postid = $_POST['dele'];
            $category = $_POST['hid'];
            $this->db->query("DELETE FROM contents WHERE contents_id='$postid'") or die(mysqli_error($this->db));
            header("Location: ?action=".$category);
        }
    }

    public function addCategory(){
        if(isset($_POST['newcat'])){
            $tag = $this->db->real_escape_string($_POST['addcat']);
            if(!empty($tag)){
                $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                //De if statemetn/ als er niks gevonde is:
                if ($controle->num_rows == 0) {
                    $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                    header("Location: ?action=Category&cateMessage=succes");
                    $tagid = mysqli_insert_id($this->db);
                } else {
                    header("Location: ?action=Category&cateMessage=exists");
                }
            }
            else {
                header("Location: ?action=Category&cateMessage=leeg");
            }

            }
        }

    }

