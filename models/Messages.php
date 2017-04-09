<?php
class Messages extends Model
{

    public function getMessages(){
        if (isset($_GET['Message']) AND $_GET['Message'] == 'velden')
        {
            $messagecontent = '<p style="font-size: 11px;">The following fields are required: Title, Text, Category<br>
                               <span style="color:red;">Check if these has been filled in and try again</span></p>';
        }

        elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'vidimg'){
            $messagecontent = "Video's and images cant get uploaded at the same time";
        }elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'tag'){
            $messagecontent = 'You can only choose 1 category..';
        }elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'geencategory'){
            $messagecontent = 'You need to add a category';
        }elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'Languages'){
            $messagecontent = 'You need to add a category';
        }elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'same'){
            $messagecontent = 'You can only add one category!';
        }elseif
        (isset($_GET['Message']) AND $_GET['Message'] == 'yt'){
            $messagecontent = 'Your video link is not a YouTube link!';
        } else {
            $messagecontent = 'Add new message';
        }

        if (isset($_GET['Update']) AND $_GET['Update'] == 'velden') {
            $updatecontent = '<p style="font-size: 11px;">The following fields are required:   
               Check if these has been filled in and try again<br> Title, Text, Category<br>
                              </p>';
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'vidimg') {
            $updatecontent = "Video's and images cant get uploaded at the same time";
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'tag') {
            $updatecontent = 'You can only choose 1 category..';
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'geencategory') {
            $updatecontent = 'You need to add a category';
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'Languages') {
            $updatecontent = 'You need to add a category';
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'same') {
            $updatecontent = 'You can only add one category!';
        } elseif (isset($_GET['Update']) AND $_GET['Update'] == 'yt') {
            $updatecontent = 'Your video link is not a YouTube link!';
        } else {
            $updatecontent = 'Update this article';
        }

        if (isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'exists') {
            $catmessage = 'Bestaat al';
        } elseif (isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'succes') {
            $catmessage = 'Successfully added. Add a new category ';
        } elseif (isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'leeg') {
            $catmessage = 'Field cannot be empty. Try again';
        } else {
            $catmessage = 'Add a new category';
        }

        if (isset($_GET['Useredit']) AND $_GET['Useredit'] == 'nopass') {
            $settingsmessage = 'Password is required';
        } elseif (isset($_GET['Useredit']) AND $_GET['Useredit'] == 'wrongpass') {
            $settingsmessage = 'Wrong password';
        } elseif (isset($_GET['Useredit']) AND $_GET['Useredit'] == 'usernamesucces') {
            $settingsmessage = 'Username successfully updated';
        } elseif (isset($_GET['Useredit']) AND $_GET['Useredit'] == 'allsucces') {
            $settingsmessage = 'Updated everything successful';
        } elseif (isset($_GET['Useredit']) AND $_GET['Useredit'] == 'empty') {
            $settingsmessage = 'Fields are empty';
        } else {
            $settingsmessage = 'Update your personal data...';
        }


    }



}