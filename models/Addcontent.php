<?php

class Addcontent extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function insertContent($user_id, $grade)
    {
        if (isset($_POST['content'])) {
            $title = $this->db->real_escape_string($_POST['title']);
            $video = $this->db->real_escape_string($_POST['video']);
            $category = $_GET['category'];
            $video = substr($video, 17, 28);
            $text = $this->db->real_escape_string($_POST['description']);
            $image = addslashes($_FILES['myimg']['tmp_name']);
            $name = addslashes($_FILES['myimg']['name']);
            $language = $this->db->real_escape_string($_POST['lang']);

            if (!empty($title)) {

                if (!empty($video) AND !empty($image)) {
                    header("Location: ?action=Add&category=" . $category . "&Message=vidimg");
                }
                 elseif (!empty($_POST['cate']) AND !empty($_POST['soort'])) {
                    header("Location: ?action=Add&category=" . $category . "&Message=same");
                } elseif (empty($_POST['cate']) AND empty($_POST['soort'])) {
                    header("Location: ?action=Add&category=" . $category . "&Message=geencategory");
                } elseif (!empty($video) AND !empty($image)) {
                    header("Location: ?action=Add&category=" . $category . "&Message=vidimg");
                }
                else {

                    if (!empty($_POST['soort']) AND empty($_POST['cate'])) {
                        $tag = $this->db->real_escape_string($_POST['soort']);
                    } elseif (!empty($_POST['cate']) AND empty($_POST['soort'])) {
                        $tag = $this->db->real_escape_string($_POST['cate']);
                    }
//                Als de concept knop is toegevoegd
                    //Als er geen afbeeldingen of video zijn toegevoegd: DUS ALLEEN TEKST
                    if (!$image AND !$name AND !$video) {
                        //Insert een artikel zonder afbeelding
                        $this->db->query("INSERT INTO contents (title, text_content, languages_id, content_category, users_id, active, content_type, grade)
                        VALUES ('$title', '$text', '$language', '$category', '$user_id', 1, 'text', '$grade')") or die(mysqli_error($this->db));
                        //De id van de content die zojuist is toegevoegd
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }

                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a text article to Pages', '$postid', '$category','$tagid', '$user_id')") or die($this->db->error);
                        header("Location: ?action=".$category);

                    } elseif ($video AND !$image AND !$name) {
                        //Insert een video
                        $this->db->query("INSERT INTO contents (title, text_content, media_content, languages_id, content_category, users_id, active, content_type, grade) 
                        VALUES ('$title', '$text', '$video', '$language', '$category', '$user_id', 1, 'videoText', '$grade')") or die(mysqli_error($this->db));
                        //De id van de content die zojuist is toegevoegd
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }
                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a video article to Pages', '$postid', '$category','$tagid', '$user_id')") or die($this->db->error);
                        header("Location: ?action=" . $category);
                    } elseif (!$video AND $image AND $name) {
                        //Insert een afbeelding
                        $image = file_get_contents($image);
                        $image = base64_encode($image);
                        $this->db->query("INSERT INTO contents (title, images, img_names, text_content, languages_id, content_category, users_id, active, content_type, grade) 
                           VALUES ('$title', '$image', '$name', '$text', '$language', '$category', '$user_id', 1, 'imageText', '$grade')") or die(mysqli_error($this->db));
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }
                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a image article to Pages', '$postid', '$category','$tagid', '$user_id')") or die($this->db->error);
                        header("Location: ?action=" . $category);
                    }
                }
            } else {
                header("Location: ?action=Add&category=" . $category . "&Message=velden");
            }

        } elseif (isset($_POST['concept'])) {
            $title = $this->db->real_escape_string($_POST['title']);
            $video = $this->db->real_escape_string($_POST['video']);
            $category = $_GET['category'];
            $video = substr($video, 17, 28);
            $text = $this->db->real_escape_string($_POST['description']);
            $image = addslashes($_FILES['myimg']['tmp_name']);
            $name = addslashes($_FILES['myimg']['name']);
            $language = $this->db->real_escape_string($_POST['lang']);

            if (!empty($title)) {

                if (!empty($video) AND !empty($image)) {
                    header("Location: ?action=Add&category=" . $category . "&Message=vidimg");
                }
                 elseif (!empty($_POST['cate']) AND !empty($_POST['soort'])) {
                    header("Location: ?action=Add&category=" . $category . "&Message=same");
                } elseif (empty($_POST['cate']) AND empty($_POST['soort'])) {
                    header("Location: ?action=Add&category=" . $category . "&Message=geencategory");
                } elseif (!empty($video) AND !empty($image)) {
                    header("Location: ?action=Add&category=" . $category . "&Message=vidimg");
                }
                else {

                if(!empty($_POST['soort']) AND empty($_POST['cate'])) {
                    $tag = $this->db->real_escape_string($_POST['soort']);
                } elseif (!empty($_POST['cate']) AND empty($_POST['soort'])) {
                    $tag = $this->db->real_escape_string($_POST['cate']);
                }

//                Als de concept knop is toegevoegd
                    //Als er geen afbeeldingen of video zijn toegevoegd: DUS ALLEEN TEKST
                    if (!$image AND !$name AND !$video) {
                        //Insert een artikel zonder afbeelding
                        $this->db->query("INSERT INTO contents (title, text_content, languages_id, content_category, users_id, active, content_type, grade)
                        VALUES ('$title', '$text', '$language', '$category', '$user_id', 0, 'text', '$grade')") or die(mysqli_error($this->db));
                        //De id van de content die zojuist is toegevoegd
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }

                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a concept text article to Pages', '$postid', '$category','$tagid', 1)") or die($this->db->error);
                        header("Location: ?action=" . $category);

                    } elseif ($video AND !$image AND !$name) {
                        //Insert een video
                        $this->db->query("INSERT INTO contents (title, text_content, media_content, languages_id, content_category, users_id, active, 
                        content_type, grade) VALUES ('$title', '$text', '$video', '$language', '$category', '$user_id', 0, 'videoText', '$grade')") or die(mysqli_error($this->db));
                        //De id van de content die zojuist is toegevoegd
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }
                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a concept video article to Pages', '$postid', '$category','$tagid', 1)") or die($this->db->error);
                        header("Location: ?action=" . $category);
                    } elseif (!$video AND $image AND $name) {
                        //Insert een afbeelding
                        $image = file_get_contents($image);
                        $image = base64_encode($image);
                        $this->db->query("INSERT INTO contents (title, images, img_names, text_content, languages_id, content_category, users_id, active, content_type, grade) VALUES 
                            ('$title', '$image', '$name', '$text', '$language', '$category', '$user_id', 0, 'imageText', '$grade')") or die(mysqli_error($this->db));
                        $postid = mysqli_insert_id($this->db);
                        //De tag gedoe:
                        //Controleert of de tag al bestaat
                        $controle = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                        //De if statemetn/ als er niks gevonde is:
                        if ($controle->num_rows == 0) {
                            $this->db->query("INSERT INTO tags (tag_name) VALUES('$tag')") or die(mysqli_error($this->db));
                            $tagid = mysqli_insert_id($this->db);
                            $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                        } else {
                            $result = $this->db->query("SELECT tags_id FROM tags WHERE tag_name='$tag'") or die(mysqli_error($this->db));
                            while ($row = $result->fetch_assoc()) {
                                $tagid = $row['tags_id'];
                                $this->db->query("UPDATE contents SET tags_id='$tagid' WHERE contents_id='$postid'") or die(mysqli_error($this->db));
                            }
                        }
                        $this->db->query("INSERT INTO logbooks (activity, contents_id, category, tags, users_id ) VALUES ('added a concept image article to Pages', '$postid', '$category','$tagid', 1)") or die($this->db->error);
                        header("Location: ?action=" . $category);
                    }
                }
            } else {
                header("Location: ?action=Add&category=" . $category . "&Message=velden");
            }

        }

    }

    /**
     * @return Database
     */

}