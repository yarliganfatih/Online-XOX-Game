<?php
$p1name = file_get_contents("p1name.txt");
$p2name = file_get_contents("p2name.txt");
$p1score = file_get_contents("score1.txt");
$p2score = file_get_contents("score2.txt");
$dosyam = fopen("leaderboard.json","a+");
//file_put_contents("leaderboard.json", $p1name.",".$p1score.",".$p2name.",".$p2score.";");
fwrite($dosyam,$p1name.",".$p1score.",".$p2name.",".$p2score.";");
fclose($dosyam);
$dosya1 = fopen('score1.txt','w');
fputs($dosya1,"");
fclose($dosya1);
$dosya2 = fopen('score2.txt','w');
fputs($dosya2,"");
fclose($dosya2);
$dosya = fopen('stop.txt','w');
fputs($dosya,"true");
fclose($dosya);
?>