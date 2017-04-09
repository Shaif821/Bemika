<section>
    <div class="omdashtable">
<br><br><br>
        <div class="tableome">
            <div class="contable">
<table class="contenttable">
    <tr class="eentr">
        <th class="allth">Category</th>
    </tr>

    <?php

    foreach($tagList as $tagData){
        if($tagData['tags_id'] > 1){

            echo '<tr class="eentr">';
            echo '<td class="eentd"><div class="tagname">'.$tagData['tag_name'].'<form method="POST"><button style="border: none; background:none;" name="dele" value="'.$tagData['tags_id'].'" type="submit"><img class="usericon" src="css/Icons/del.png"></button><input type="hidden" name="hid" value="'.$tagData['tags_id'].'"></form></div></td>';
            echo '<tr class="eentr">';

        }else {
            $tagid = $tagData['tags_id'];
        }

    }
    ?>

</table>


            </div></div>
        <div class="omadd">
            <h2><?php echo $catmessage; ?></h2>
            <form method="post">
                <div class="catrow"><h2>Name</h2><input class="choosecat type="text" name="addcat"></div>
                <div class="fillerad"><button class="verzendencat" type="submit" name="newcat">Add category +</button></div>
            </form>
        </div>
    </div>
</section>