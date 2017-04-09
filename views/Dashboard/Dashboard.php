


<!--De main gedeelte van de dashboard/ Dus de linker gedeelte.-->
<section>
<!--De drie knopjes-->
    <div class="omdash">

    <div class="datum">
        <div class="datas">
            <div class="datumfiller">
            </div>
            <div class="datumblock">
                <h1><?php echo date('l') ?>, <br> <?php echo date('j').' '.date('F'); ?></h1>
            </div>
        </div>
    </div>

        <div class="omtwee">
        <div class="omtweeoptie">
        <div class="tweeopties">
            <div class="overzicht intweeoptie">
                <h2>Activities</h2><hr class="intweestreep">
                <div class="activitylog">
                <table class="omtabel">
                    <?php
                    foreach ($logbookList as $logData) {
                        echo '<tr><th class="datekolom">'.$logData['date'].'</th>';
                        echo '<th class="binnenkolom"><div class="omlog"><div class="omlogimg">';
                        echo '</div><div class="omlogtekst"><p>' . $logData['firstname'] . ' ' . $logData['activity'] . ' -> ' . $logData['tag_name'] .' -> '. $logData['category'] . '</p>';
                        echo '</div></div></th</tr>';
                    }
                    ?>
                </table>
                </div>
            </div>
        </div>
        </div>

            <div class="knop">
                <div class="knopinhoud">
                    <div class="omimgknop">
                    <img src="css/Icons/statistics.png">
                    <h2>Statistics</h2>
                    </div>
                </div>
            </div>
        </div>
        </div>



</section>
</div>