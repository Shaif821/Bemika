<?php
session_start();
require('includes/config.php');
require('includes/bootstrap.php');
date_default_timezone_set('Europe/Amsterdam');

if(isset($_GET['Message']) AND $_GET['Message'] == 'velden') {
    $messagecontent = '<p style="font-size: 11px;">The following fields are required: Title, Text, Category<br>
                               <span style="color:red;">Check if these has been filled in and try again</span></p>';
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'vidimg'){
    $messagecontent = "Video's and images cant get uploaded at the same time";
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'tag'){
    $messagecontent = 'You can only choose 1 category..';
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'geencategory'){
    $messagecontent = 'You need to add a category';
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'Languages'){
    $messagecontent = 'You need to add a category';
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'same'){
    $messagecontent = 'You can only add one category!';
}elseif(isset($_GET['Message']) AND $_GET['Message'] == 'yt'){
    $messagecontent = 'Your video link is not a YouTube link!';
} else {
    $messagecontent = 'Add new message';
}

if(isset($_GET['Update']) AND $_GET['Update'] == 'velden'){
    $updatecontent = '<p style="font-size: 11px;">The following fields are required:   
               Check if these has been filled in and try again<br> Title, Text, Category<br>
                              </p>';
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'vidimg'){
    $updatecontent = "Video's and images cant get uploaded at the same time";
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'tag'){
    $updatecontent = 'You can only choose 1 category..';
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'geencategory'){
    $updatecontent = 'You need to add a category';
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'Languages'){
    $updatecontent = 'You need to add a category';
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'same'){
    $updatecontent = 'You can only add one category!';
}elseif(isset($_GET['Update']) AND $_GET['Update'] == 'yt'){
    $updatecontent = 'Your video link is not a YouTube link!';
} else {
    $updatecontent = 'Update this article';
}

if(isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'exists'){
    $catmessage = 'Bestaat al';
}elseif(isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'succes'){
    $catmessage = 'Successfully added. Add a new category ';
}elseif(isset($_GET['cateMessage']) AND $_GET['cateMessage'] == 'leeg'){
    $catmessage = 'Field cannot be empty. Try again';
}else {
    $catmessage = 'Add a new category';
}

if(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'nopass'){
    $settingsmessage = 'Password is required';
}elseif(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'wrongpass'){
    $settingsmessage = 'Wrong password';
}elseif(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'usernamesucces'){
    $settingsmessage = 'Username successfully updated';
}elseif(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'allsucces'){
    $settingsmessage = 'Updated everything successful';
}elseif(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'empty'){
    $settingsmessage = 'Fields are empty';
}elseif(isset($_GET['Useredit']) AND $_GET['Useredit'] == 'usernameexist'){
    $settingsmessage = 'Username exist';
}else {
    $settingsmessage = 'Update your personal data...';
}

if(isset($_GET['Loginmessage']) AND $_GET['Loginmessage'] == 'succes'){
    $loginmessage = 'Successfully updated your data.. Log in';
}elseif(isset($_GET['Loginmessage']) AND $_GET['Loginmessage'] == 'empty'){
    $loginmessage = 'Fields are empty...';
}elseif(isset($_GET['Loginmessage']) AND $_GET['Loginmessage'] == 'error'){
    $loginmessage = 'Username/password combination doesnt exists.';
}else {
    $loginmessage = 'Welcome to the Bemika CMS page';
}


//De id van de user & posts | indivudueel
if(isset($_SESSION['id']) AND isset($_SESSION['username']) AND isset($_SESSION['password']) AND isset($_SESSION['grade'])){
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $grade = $_SESSION['grade'];
//    $sidebar = include 'views/Standaard/sideBar_super.php';
}elseif(isset($_SESSION['id_guest']) AND isset($_SESSION['username_guest']) AND isset($_SESSION['password_guest']) AND isset($_SESSION['grade_guest'])){
    $userid = $_SESSION['id_guest'];
    $username = $_SESSION['username_guest'];
    $password = $_SESSION['password_guest'];
    $grade = $_SESSION['grade_guest'];
//    $sidebar = include 'views/Standaard/sideBar.php';
}



//Declaraties:
// Lees de actie uit de URL


//Includes//
include 'views/Standaard/head.php';
if(isset($_SESSION['id']) || isset($_SESSION['id_guest'])){
    $user = new Users();
    $userData = $user->getUserInfo($userid, $username, $password, $grade);
    include 'views/Standaard/header.php';
    if(isset($_SESSION['grade_guest'])){
        include 'views/Standaard/sideBar.php';
    } elseif(isset($_SESSION['grade'])){
        include 'views/Standaard/sideBar_super.php';
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'Login';
switch ($action) {
    case 'Login':

        if(isset($userid)) {
            header("Location:?action=Login");
        }else {
            $log = new Login();
            $login = $log->userLogin();

            include 'views/Login/login.php';
        }

        break;

    case 'Dashboard':

        if(isset($userid)) {
            $logs = new Logbook();
            $logbookList = $logs->getAll();

            include 'views/Dashboard/Dashboard.php';
        }else {
            header("Location: ?action=Login");
        }
        break;

    case 'Pages':

        if(isset($userid)){
            include 'views/Pages/Pages.php';
        }else {
            header("Location: ?action=Login");
        }

        break;

    case 'Movies':

        if(isset($userid)){
            $category = 'Movies';

            $alluser = new Users();
            $userName = $alluser->getAllNames();


            $content = new Viewcontent();
            $contentList = $content->getContents($userid, $category);
            $deleteList = $content->deleteContent();

            $update = new Editcontent();
            $delete = $update->deleteContent();

            include 'views/Pages/contentlist.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Software':

        if(isset($userid)) {
            $category = 'Software';
            $content = new Viewcontent();
            $contentList = $content->getContents($userid, $category);
            $deleteList = $content->deleteContent();

            $update = new Editcontent();
            $delete = $update->deleteContent();

            include 'views/Pages/contentlist.php';
        } else {
            header("Location: ?action=Logout");
        }
        break;

    case 'Music':

        if(isset($userid)){
            $category = 'Music';
            $content = new Viewcontent();
            $contentList = $content->getContents($userid, $category);
            $deleteList = $content->deleteContent();

            $update = new Editcontent();
            $delete = $update->deleteContent();

            include 'views/Pages/contentlist.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Sports':

        if(isset($userid)){
            $category = 'Sports';
            $content = new Viewcontent();
            $contentList = $content->getContents($userid, $category);
            $deleteList = $content->deleteContent();

            $update = new Editcontent();
            $delete = $update->deleteContent();

            include 'views/Pages/contentlist.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Posts':

        if(isset($userid)){
            //Het kunnen zien van de content
            $content = new Viewcontent();
            $contentData = $content->getOne($userid, $grade);
            $tagList = $content->getCategory();
            $langList = $content->getLanguage();
            $logo  = $content->getLogo();

            $update = new Editcontent();
            $newUpdate = $update->updateContent($userid);
            $delete = $update->deleteContent($userid);
            //Het kunnen updaten van content
            include 'views/Pages/content-edit.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Add':

        if(isset($userid)){
            $add = new Addcontent();
            $newContent = $add->insertContent($userid, $grade);
            $content = new Viewcontent();
            $tagList = $content->getCategory();
            $langList = $content->getLanguage();
            $logo  = $content->getLogo();
            //Het kunnen updaten van content

            include 'views/Pages/content-add.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Category':

        if(isset($userid)){
            $tag = new Viewcontent();
            $tagList = $tag->getCategory();
            $del = $tag->delCategory();

            $add = new Editcontent();
            $addtag = $add->addCategory();

            include 'views/Pages/category.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;

    case 'Settings':

        if(isset($userid)){
            $user = new Users();
            $user_data = $user->getUserInfo($userid, $grade);

            $updateuser = new Edituser();
            $updatedate = $updateuser->updateSuperUserData($userid, $username, $password);

            include 'views/Standaard/settings.php';
        } else {
            header("Loccation: ?action=Logout");
        }

        break;

    case 'Adduser':

        if(isset($userid)){
            $user = new Users();
            $userAll = $user->getAllInfo($userid, $grade);

            $deluser = $user->deleteUser();

            $adduser = new Adduser();
            $usernew = $adduser->addNewuser();

            include 'views/User/user-add.php';
        } else {
            header("Location: ?action=Logout");
        }

        break;
    case 'Logout':
        session_destroy();
        header("Location: ?action=Login");
        break;

	default:

		break;
}
include 'views/Standaard/Footer.php';


