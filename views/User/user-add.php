
<section>
    <div class="omdash">


<div id="addUserContainer">
    <div id="rightSideBar">

        <div id="boxes">

            <form id="deleteCheck" action="" method="">

                <span class="icon-cancel-circle"></span>
                <p id="deleteCheck_error">are you sure you want to delete this user? Gives the password to delete it</p>
                <input type="password" name="" placeholder="Password" id="deletePass">
                <input type="submit" name="" value="Delete" id="delete_user">
                <input type="submit" name="" value="" id="de_activate_user">

            </form>


            <div id="userRights">

                <span class="icon-cancel-circle" id="rightsFormCancel"></span>

                <p id="rightsError">Change the rights by clicking on the icons</p>

                <div id="changeUser_right">

                </div>


                <form class="" action="" method="">

                    <input type="password" name="" placeholder="Password" id="changeRights_pass">
                    <input type="submit" name="" value="Change rights" id="change_rights_sub">

                </form>


            </div>

        </div>


        <div id="guestAllData">

            <span class="icon-cancel-circle" id="userHistoryCloser"></span>

            <div id="guestDataRights">

                <div class="guestDataContainer">

                    <p class="guestPersonal">Name:</p>
                    <p class="guestPersonal">Username:</p>
                    <p class="guestPersonal">Email:</p>
                    <p class="guestPersonal">Department:</p>
                    <p class="guestPersonal">Status:</p>

                </div>

                <div class="guestRightsContainer">

                    <p class="guestRights">Can Update:</p>
                    <p class="guestRights">Can Upload:</p>
                    <p class="guestRights">Can Delete:</p>
                    <p class="guestRights">Need Permission:</p>

                </div>

            </div>

            <div class="dataRecovery">

                <div class="recoveries">

                    <p><span class="icon-spinner11"></span> Restore Username </p>
                    <p id="recoverUsername"></p>

                </div>

                <div class="recoveries">

                    <p><span class="icon-spinner11"></span> Restore Password </p>
                    <p id="recoverPassword"></p>

                </div>

                <div class="recoveries">

                    <p><span class="icon-spinner11"></span> Restore Username & Password </p>
                    <p class="recoverUsername_Password"></p>
                    <p class="recoverUsername_Password"></p>

                </div>

            </div>

            <form id="checkRestore" action="" method="">

                <input type="password" name="" id="restorPass" placeholder="Super user password">
                <input type="submit" name="" value="Restore" id="restoring">

            </form>

        </div>


        <div id="usersOption">

            <p id="currentGuestName">Guest Name:</p>

            <div class="optionsIcons" id="deleteCont">

                <span class="icon-bin"></span>
                <p>Delete</p>

            </div>


            <div class="optionsIcons" id="inactiveCont">

                <span class="icon-switch"></span>
                <p id="activeStatus"></p>

            </div>


            <div class="optionsIcons" id="historyCont">

                <span class="icon-history" id="userHistoryCaller"></span>
                <p>User History</p>

            </div>


            <div class="optionsIcons" id="rightsCont">

                <span class="icon-hammer"></span>
                <p>Change Rights</p>

            </div>


            <span class="icon-cancel-circle" id="cancelUsersOption"></span>

        </div>


        <div id="addUserForm">

            <form method="POST">

                <span class="icon-cancel-circle" id="addUserFormBack"></span>
                <!--<p id="addUserError">Add new users.</p>-->
                <input type="text" name="name" placeholder="Name" class="newUserData">
                <input type="text" name="lastname" placeholder="Lastname" class="newUserData">
                <input type="email" name="email" placeholder="email" class="newUserData">
                <!--<input type="number" name="telnr" placeholder="Tel.nr">-->
                <select id="catagory" name="category" required class="newUserData">

                    <option value="">Choose a catagory</option>
                    <option value="marketing">Marketing</option>

                </select>
                <div id="newCategoriesContainer">

                    <input type="text" name="categorynu" placeholder="Add a category if it doesn't exist" id="categoryValue">
                    <input type="submit" name="addcate" value="Add" id="newCategory">

                </div>

                <p id="rules">Determine the rights of the current guest user ....</p>

                <div id="rigthContainer">

                    <div class="rightsButt"><span class="icon-spinner11"></span>
                        <p class="rulesType">Update</p>
                        <p class="status">(No)</p></div>

                    <div class="rightsButt"><span class="icon-bin"></span>
                        <p class="rulesType">Delete</p>
                        <p class="status">(No)</p></div>

                    <div class="rightsButt"><span class="icon-upload"></span>
                        <p class="rulesType">Upload</p>
                        <p class="status">(No)</p></div>

                    <div class="rightsButt"><span class="icon-key2"></span>
                        <p class="rulesType">Need permission</p>
                        <p class="status" id="permis">(Yes)</p></div>

                </div>

                <input type="submit" name="adduser" value="Add Guest User" id="addNewUser">

            </form>

            <div id="explainBox">

                <p id="displayExplain">explaining</p>

            </div>

        </div>

        <div id="superUser">

            <div id="avatarName">

                <img  src="data:image;base64,<?php echo $userData['avatar']; ?>" alt="" id="superUserAvatar">
                <p id="superUserName"><?php echo $userData['firstname'].' '.$userData['lastnames']; ?></p>

            </div>

<!--            <span class="icon-plus" id="addUserFormCaller"></span>-->

        </div>


        <div id="guestUserContainer">


        </div>

    </div>



</div>
    </div>
    <div class="omadd">
        <h2 style="font-size: 200%;">Subadmins</h2>

        <form method="post">
            <?php
            foreach ($userAll as $allInfo){
                echo '<div class="catrow"><h2 class="choosecat">'.$allInfo['firstname'].'</h2>';
                echo '<button style="background:none; border:none;" type="submit" name="deluser" value="'.$allInfo['id'].'">';
                echo '<img class="usericon" src="css/Icons/del.png"></button></div>';
            }
            ?>
        </form>

            <div class="fillerad"><button class="verzendencat" class="icon-plus" id="addUserFormCaller" type="submit" id="addUserFormCaller" name="newcat">Add user +</button></div>


    </div>
</section>