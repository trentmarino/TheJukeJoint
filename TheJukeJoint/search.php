<?php
include "db_connect.php";

$output=NULL;

    if(isset($_POST['submit'])){
        $nameq= $_POST['search'];
        $nameq= preg_replace("#[^0-9a-z]#i", "",$nameq);
        //-query  the database table
        $query = mysqli_query("SELECT * FROM songs WHERE song_title LIKE '%$nameq%' OR artist_name LIKE '%$nameq%'") or die("Cannot Search!");
        if ($count == 0) {
            $output = 'No Results!';
        }
        else{
            while($row=mysqli_fetch_array($query, MYSQL_ASSOC)){
            $sname = $row['song_title'];
            $aname = $row['artist_name'];
            $id = $row['ic'];

            $output .= '<div> '.$sname.' '.$aname. '</div>';
            }
        }
    }
?>
