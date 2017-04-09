<section>

    <div class="omim">
        <div class="imrow">
            <img id="loggo">
        </div>
    </div>
    <div class="omalles">

        <div class="col inputtext">
            <div class="omform">
                <div class="omwrap">
                    <div class="wrap outform">
                        <form method="post" enctype="multipart/form-data">
                            <h2 class="message"><?php echo $messagecontent; ?></h2>
                            <input class="title" type="text" name="title" placeholder="Insert title here">
                            <div class="fillerondertitle"></div>
                            <div class="addimg">
                                <input type="file" id="file" class="inputfile" accept="image/*" name="myimg" data-multiple-caption="{count} files selected" multiple>
                                <label for="file"><img  class="paperclip" src="css/Icons/paperclip.png"><span><p>Add media</p></span></label>
                            </div>
                            <div class="edittext"></div>
                            <div class="optionstext"><div class="omoptions"><bold>B</bold><i>i</i></div><div class="fillertext"></div></div>
                            <textarea onkeyup="count();" id="counttext" name="description" class="textarea" rows="15" cols="90" placeholder="Voer hier uw content in"></textarea>
                            <div class="optionswords"><div id="total" class="omoptionstext">Words :</div><div class="fillertext"></div></div>
                            <br>
                            <div class="fillerondertitle"></div>
                    </div>
                    <div class="YTlink"><div class="fillerlink"></div>
                        <input id="YTLinkje"  name="video" placeholder="Rechter muisklik op youtube link en dan op url Kopiëren">
                        <div id="linkyt"  class="linkje">Add YouTube link</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col pubb">
            <div class="wrap publish">
                <div class="pub">
                    <div class="omtextpub">
                        <h3>Publish</h3>
                    </div>
                    <div class="pubtons">
                        <div class="bla">
                        <input type="submit" class="chooselan" name="concept" value="Save as concept">

                        <select class="chooselan" name="lang">
                            <?php
                            foreach ($langList as $langData){
                                echo '<option value="'.$langData['id'].'">'.$langData['language_name'].'</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <br>
                        <div class="bla">
                            <select  class="chooselan" name="soort">
                                <option value="">Choose a category</option>
                                <?php
                                foreach ($tagList as $tagData){
                                    if($tagData['tags_id'] > 1){
                                        echo '<option value="'.$tagData['tag_name'].'">'.$tagData['tag_name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <input class="chooselan" type="text" name="cate" placeholder="Or add one yourself">
                        </div>
                    </div>
                    <br>

                    <div class="edittexts"></div>
                </div>
                <input class="verzenden" type="submit" name="content" value="Publish">
                </form>
            </div>
        </div>


    </div>
</section>








































