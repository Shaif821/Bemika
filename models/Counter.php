<?php


class Counter extends Model{

    public function getCount(){
        if(file_exists("views/Rest/count_file.txt")){
            $fill = fopen ("views/Rest/count_file.txt", "r");
            $dat = fread($fill, filesize("views/Rest/count_file.txt"));
            echo $dat+1 . ' bezoekers hebben de site bezocht';
            fclose($fill);
            $fill = fopen("views/Rest/count_file.txt", "w");
            fwrite($fill, $dat+1);
        }
        else {
            $fill = fopen("views/Rest/count_file.txt", "w");
            fwrite($fill, 1);
            echo '1';
            fclose($fill);
        }
    }

}