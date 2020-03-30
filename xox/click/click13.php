<?php
$dosyam = fopen('../data.json','a+');
$text = fgets($dosyam);
$data = explode(",", $text); 
$data[3] = "X";
$new = "";
for($sayi = 0; $sayi < 9; $sayi++) {
   $new = $new.$data[$sayi].",";
}
fclose($dosyam);
$dosyan = fopen('../data.json','w');
fputs($dosyan,$new);
fclose($dosyan);
?>