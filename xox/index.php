<?php
$dosya = fopen("bilgi.txt","a+");
date_default_timezone_set('Europe/Istanbul');
$IP_Adresi = $_SERVER["REMOTE_ADDR"]; //Ziyaretcinin Ip adresini verir.
$Tarayici = $_SERVER["HTTP_USER_AGENT"]; //Ziyaretcinin kullandigi Tarayiciyi verir.
$Tarih = time();
$bu = "";
if (stripos($Tarayici, "Instagram") !== false) {
   $bu = "INSTAGRAM"; 
}
$kaydet = "\n".date("Y-m-d",$Tarih)." - ".date('H:i:s')."\t".$IP_Adresi."\t".$bu."\t".$Tarayici."\n";
// echo ip_info(“Visitor”, “State”);
fwrite($dosya,$kaydet);
/* while ($oku = fgets($dosya)) {
  echo $oku."<br />";
  // code...
} */

?>
<!DOCTYPE html>
<html lang="tr" >
<head>
<?php
//function savepoint(){
if(isset($_POST['login1'])){
$filename = "p1name.txt";
$name = $_POST['name']; //isim
$scriptcode = "</script>";
	if (stripos($name, $scriptcode) !== false) {
		echo "<center><u>Access Denied!</u></center>";
	}else {
			$name2 = str_replace(",","",$name);
			$name3 = str_replace(";","",$name2);
			file_put_contents("p1name.txt", $name3);
			header("Location:player1.php");
	}
}
if(isset($_POST['login2'])){
$filename = "p2name.txt";
$name = $_POST['name']; //isim
$scriptcode = "</script>";
	if (stripos($name, $scriptcode) !== false) {
		echo "<center><u>Access Denied!</u></center>";
	}else {
			$name2 = str_replace(",","",$name);
			$name3 = str_replace(";","",$name2);
			file_put_contents("p2name.txt", $name3);
			header("Location:player2.php");
	}
}
?>
	<meta charset="UTF-8">
	<title>XOX Game - byAlpha</title>
	<link rel='shortcut icon' type='image/x-icon' href='../favicon.png' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link id="pagestyle" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		@font-face {
			font-family: 'myfont';
			src: url('font.ttf');
		}
		body{
			font-family: "myfont";
			font-size: 20px;
			background-color:black;
			color:white;
			background-image: url('div2.png');
			background-repeat: no-repeat;
			background-position: center center;
			background-size: 1000px;
		}
		.beplayer{
			float:left;
			width:200px;
			height:200px;
			background-color:#800000;
			opacity:1;
			border:#FFF solid 2px;
			margin: 4px;
			padding: 10px;
		}
		.button{
			font-family: 'myfont';
			font-size:25px;
			width:300px;
		}
	</style>
</head>
<body>
	<center><section>
	<h1>Online XOX Game</h1>
		<form id="form" method="post" action="">
			<input id="name" name="name" value="Your Name" style="width:288px;font-family: 'myfont';font-size:25px;border:none;border-bottom:5px solid rgba(0,0,0,1);outline:none;opacity:0.75;padding: 5px 6px 5px 6px;"/>
			<p><input id="log1" type="submit" class="button" name="login1" value="Start as Player 1" style="" onclick="beplayer(1)"/></p>
			<p><input id="log2" type="submit" class="button" name="login2" value="Start as Player 2" style="" onclick="beplayer(2)"/></p>
		</form>
	<?php 
		$tar = time();
		$txt1 = file_get_contents("player1.txt");
		$txt2 = file_get_contents("player2.txt");
		$tar1 = $tar - $txt1;
		$tar2 = $tar - $txt2;
		if($tar2<120 && $tar1<120){
			echo "Online Server is full, Please Try again after ".(120-$tar1)." seconds.";
			echo "<script>document.getElementById(\"log1\").style.display = \"none\";</script>";
			echo "<script>document.getElementById(\"log2\").style.display = \"none\";</script>";
			echo "<script>document.getElementById(\"name\").style.display = \"none\";</script>";
		}else if($tar1<120){
			echo "<a style=\"background-color:red\">Player 1 is ready for you.</a>";
			echo "<script>document.getElementById(\"log1\").style.display = \"none\";</script>";
		}else if($tar2<120){
			echo "<a style=\"background-color:blue\">Player 2 is ready for you.</a>";
			echo "<script>document.getElementById(\"log2\").style.display = \"none\";</script>";
		}
	?>
		<br>Machine learning soon for Player 2
		<br><button class="button" onclick="window.location.href='2player.php';">Offline 2 Players</button>
		<br>
		<h2><u>Leaderboard</u></h2><ol id="leaderboard" style="font-size:30px;width:300px;list-style-type:circle;"></ol>
	</section><footer style="opacity:0.75;font-family:Times New Roman;"><?php echo file_get_contents("footer.txt"); ?></footer></center>
	
	<div id="div1" style="display:none;">x</div>
	<script>
		function show(link,div){
		  $(document).ready(function(){
		  $.ajax({url: link, success: function(result){
		  $(div).html(result);
				}});
			});
		}
		show("getleaderboard.php","#div1");
		function beplayer(who){
			if(who==1){
				window.location.href='player1.php';
			}else{
				window.location.href='player2.php';
			}
		}
		window.addEventListener('resize', e => {
		  //width = canvas.width = window.innerWidth;
		  //height = canvas.height = window.innerHeight - 50;
		});
		function getleaderboard(){
			var datam = document.getElementById('div1').innerHTML;
			var data = datam.split(";");
			for(var i=0;i<data.length-1;i++){
				var datas = data[i].split(",");
				var str = datas[0] + " : " + datas[1] + " --- " + datas[2] + " : " + datas[3];
				var ul = document.getElementById("leaderboard");
				var li = document.createElement("li");
				// li.setAttribute('id',str);
				li.appendChild(document.createTextNode(str));
				ul.appendChild(li);
			}
		}
		window.setTimeout(getleaderboard, 1000);
	</script>
</body>
</html>
