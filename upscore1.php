<?php
$p2score = file_get_contents("score1.txt");
$p2score++;
$dosya1 = fopen('score1.txt','w');
fputs($dosya1,$p2score);
fclose($dosya1);
?>