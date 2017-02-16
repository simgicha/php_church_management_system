 <?php 
    $link = mysqli_connect("localhost", "root", "") or die("Unable To Connect To Database Server");

    mysqli_select_db($link ,"church") or die("Unable To Connect To Church db");
	
?>