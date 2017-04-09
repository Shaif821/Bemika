<section style="width: 100%">
<?php
foreach ($usersList  as $userData){
    ?>
    <table>
        <tr>
            <th>Naam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Category</th>
        </tr>
        <tr>
            <th><?php echo $userData['first_names']; ?></th>
            <th><?php echo $userData['emails']; ?></th>
            <th><?php echo $userData['category']; } ?></th>
        </tr>
    </table>

</section>

