
<section>
<div id="settingsContainer">

    <div id="settingsRightSideBar">

        <div id="personalDataContainer">

            <img src="data:image;base64,<?php echo $user_data['avatar']; ?>" alt="" id="guestAvatar">

            <div id="personalData">

                <p class="data">Name: <?php echo $user_data['firstname'].' '.$user_data['lastnames']; ?></p>
                <p class="data">Email: <?php echo $user_data['email']; ?></p>
                <p class="data">Department: <?php echo $user_data['category']; ?></p>

            </div>

        </div>

        <p id="userUpdateError"><?php echo $settingsmessage; ?></p>


        <div id="editContainer">
            <form method="POST" enctype="multipart/form-data">

            <div class="inputsContainer">

                <p>Avatar</p>
                <input type="file" name="usersAvatar" accept="image/*" id="usersAvatar">

            </div>

            <div class="inputsContainer">

                <p>Username</p>
                <input type="text" value="<?php echo $user_data['username']; ?>" name="username" class="inputValues">

            </div>


            <div class="inputsContainer">

                <p>Email</p>
                <input type="email" value="<?php echo $user_data['email']; ?>" name="email" class="inputValues">

            </div>

            <div class="inputsContainer">

                <p>Password</p>
                <input type="password" name="password" class="inputValues">

            </div>

            <div class="inputsContainer">

                <p>Enter current Password</p>
                <input type="password" name="currentpassword" id="currentPass">

            </div>

            <input type="submit" name="updatesuper" value="Update" id="updateUserData">
            </form>
        </div>

    </div>

</div>
</section>