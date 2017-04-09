
<header>

    <div class="username">
        <div class="dropdown">
            <button class="dropbtn"><span><?php
                    echo $userData['firstname'].' '.$userData['lastnames'];

            ?></span><img class="usericon" src="css/Icons/avatar.png"><img class="arrow" src="css/Icons/arrow.png"></button>
            <div class="dropdown-content">
                <a href="?action=Logout">Uitloggen</a>
            </div>
        </div>
        </div>
</header>

<!--<div class="inner">-->

