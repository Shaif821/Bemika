
<section>
<div id="settingsContainer">

    <div id="settingsRightSideBar">
        <div class="Beginavat">


        <div id="personalDataContainer">
            <div class="filleravatar"></div>
            <img class="ava" src="css/Icons/avatar.png" alt="" id="guestAvatar">

            <div id="personalData">

                <div class="inpersonaldata">
                <div class="settingstext"><p class="data">NAME</p><p>: <?php echo $user_data['firstname'].' '.$user_data['lastnames']; ?></p></div>
                <div class="settingstext"><p class="data">EMAIL</p><p>: <?php echo $user_data['email']; ?></p></div>
                <div class="settingstext"><p class="data">DEPARTMENT</p><p>: <?php echo $user_data['category']; ?></p></div>
                </div>

            </div>

        </div>
        </div>


        <p id="userUpdateError"><?php echo $settingsmessage; ?></p>
        <form method="POST" enctype="multipart/form-data">

        <div id="editContainer">


            <div class="inputsContainer">
                <p>Avatar</p>
                <p>Username</p>
                <p>Email</p>
                <p>Password</p>
                <p>Current Password</p>
            </div>

                <div class="inputsContainer blabla">
                <input type="file" name="usersAvatar" accept="image/*" id="usersAvatar">
                <input type="text" value="<?php echo $user_data['username']; ?>" name="username" class="inputValues">
                <input type="email" value="<?php echo $user_data['email']; ?>" name="email" class="inputValues">
                <input type="password" name="password" class="inputValues">
                    <input type="password" name="currentpassword" id="currentPass">
                </div>

            <div  id="updateUserData">
                <input type="submit" name="updatesuper" value="Update" >
                </div>

        </div>
        </form>
    </div>

</div>
</section>