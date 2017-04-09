<section style="width: 100%">

    <div style="display: flex; flex-direction: row; margin: 0 auto; width: 100%; align-items: center;">
    <?php
        echo '<div  class="contenten">';
        echo '<div class="contentop">';
        echo '<h2>'.$contentData['title'].'</h2></div>';
        if(empty($contentData['images'])) {
            echo '<p>Geen afbeelding</p>';
        } else {
            echo '<img src="data:image;base64,'.$contentData['images'].' ">';
        }
    echo '<p>'.$contentData['text_content'].'</p>';
    if ($contentData['content_category'] == 'Software') {
            echo '<h2 style="color: limegreen;">' . $contentData['content_category'] . '</h2>';
        } elseif ($contentData['content_category'] == 'Music') {
            echo '<h2 style="color: brown;">' . $contentData['content_category'] . '</h2>';
        } elseif ($contentData['content_category'] == 'Movies') {
            echo '<h2 style="color: skyblue;">' . $contentData['content_category'] . '</h2>';
        } elseif ($contentData['content_category'] == 'Sports') {
            echo '<h2 style="color: darkorange;">' . $contentData['content_category'] . '</h2>';
        }
        echo '<p>' . $contentData['guest_name'] . ' ' . $contentData['guest_lastnames'] . '</p></div>';
    ?>
        <?php echo $updatecontent; ?>

        <div  class="contenten">

            <div class="contentop">

            <form method="post" enctype="multipart/form-data">

                <input type="text" value="<?php echo $contentData['title'] ?>" placeholder="Title" name="title">
                <input value="<?php echo $contentData['images'] ?>" type="file" name="myimg">

                <textarea name="description" value="<?php echo $contentData['text_content'] ?>" rows="15" cols="70" placeholder="Voer hier uw content in"></textarea>

                <input type="text" value="<?php $contentData['media_content'] ?>" placeholder="Voeg een Youtube link toe" name="video">
                <select  value="<?php echo $contentData['content_category'] ?>" name="category" required>
                    <option value="">Kies een category</option>
                    <option value="Software">Software</option>
                    <option value="Music">Music</option>
                    <option value="Movies">Movies</option>
                    <option value="Sports">Sports</option>
                </select>
                <input type="submit" value="Update" name="updatecontent">

            </form>
        </div>
    </div>

    </div>

</section>