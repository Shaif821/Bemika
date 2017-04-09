<section>
    <div class="omdashtable">

        <div class="contentoptions">
            <div class="filterbuttons">
                <form method="post">
            <select class="filter een" name="users">
                <option value="all">All users</option>
                <?php
                foreach($userName as $user_name){
                    if($user_name['id'] != 9){
                        echo '<option value="'.$user_name['id'].'">'.$user_name['firstname'].'</option>';

                    }
                }

                ?>
            </select>

            <select class="filter twee" name="deleted">
                <option value="">All categories</option>
                <option value="Movies">Movies</option>
                <option value="Music">Music</option>
                <option value="Software">Software</option>
                <option value="Sports">Sports</option>
            </select>

            <input type="submit" class="filterbutton" name="Filter" value="Filter">
                </form>
            </div>

        </div>

        <div class="tableom">
            <div class="contable">
<table class="contenttable">
  <tr class="eentr">
    <th class="firsth">Title</th>
    <th class="allth">Author</th>
    <th class="allth">Site</th>
      <th class="allth">Category</th>
    <th class="allth">Date</th>
    <th class="allth"></th>
  </tr>

    <?php

    foreach($contentList as $contentData){
        $date = substr($contentData['content_date'], 0, 11);
        echo '<tr class="eentr">';
//        echo '<a style="text-decoration:none; display:block; color:black;" href="?action=Posts&postid='.$contentData['contents_id'].'&userid='.$contentData['id'].'&category='.$contentData['content_category'].'&update=update">';
        echo '<td class="eentd" >'.$contentData['title'].'</a></td>';
        if($contentData['grade'] == 'super_user'){
            echo '<td class="eentd"  style="color:dodgerblue;">'.$contentData['firstname'].'</td>';
        }elseif($contentData['grade'] == 'guest_user'){
            echo '<td class="eentd" >'.$contentData['firstname'].'</td>';
        }elseif($contentData['grade'] == 'is_deleted'){
            echo '<td style="color:red;" class="eentd" >'.$contentData['firstname'].'</td>';
        }
        echo '<td class="eentd" >'.$contentData['content_category'].'</td>';
        echo '<td class="eentd" >'.$contentData['tag_name'].'</td>';
        echo '<td class="eentd" ><div class="omdate">';
        if($contentData['active'] == 0){
            echo '<div style="color: red;">Concept</div>';
        }elseif($contentData['active'] == 1){
            echo '<div style="color: green;">Published</div>';
        }
         echo '<div class="date">'.$date.'</div></div></td>';
        echo  '<td class="eentd" ><div class="iconsed">';
        echo '<a style="text-decoration:none; color:black;" href="?action=Posts&postid='.$contentData['contents_id'].'&userid='.$contentData['id'].'&category='.$contentData['content_category'].'&update=update"><img class="usericon" src="css/Icons/edit (3) copy.png"></a>';
        echo '<form method="POST"><button style="border: none; background:none;" name="dele" value="'.$contentData['contents_id'].'" type="submit"><img class="usericon" src="css/Icons/del.png"></button><input type="hidden" name="hid" value="'.$contentData['content_category'].'"></form></div></td>';
         echo '</tr>';

    }
    ?>

</table>
            </div>
        </div>

    </div>
</section>














