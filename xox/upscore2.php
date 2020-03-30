<?php
$p2score = file_get_contents("score2.txt");
$p2score++;
$dosya1 = fopen('score2.txt','w');
fputs($dosya1,$p2score);
fclose($dosya1);
?>