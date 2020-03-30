<?php
$dosyan = fopen('player1.txt','w');
$Tarih = time();
fputs($dosyan,$Tarih);
fclose($dosyan);
/* while ($oku = fgets($dosya)) {
  echo $oku."<br />";
  // code...
} */
?> 
<!DOCTYPE html>
<html lang="tr" >
<head>
	<meta charset="UTF-8">
	<title>XOX Game - byAlpha</title>
	<link rel='shortcut icon' type='image/x-icon' href='../favicon.png' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link id="pagestyle" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()))
		if(mobile){
		document.location="player1m.php";
	}</script>
	<style>
		@font-face {
			font-family: 'myfont';
			src: url('font.ttf');
		}
		body{
			font-family: "myfont";
			font-size: 30px;
			background-color:black;
			color:white;
			background-image: url('div.png');
			background-repeat: no-repeat;
			background-position: center center;
			background-size: 1000px;
		}
		.btn{
			float:left;
			width:125px;
			height:125px;
			opacity: 0.75;
			margin: 4px;
			padding: 10px;
			font-size:100px;
			font-weight: bold;
		}
		.divs{
			float:left;
		}
		.plyr{
			width:175px;
			position:relative;
			top:50px;
			opacity:0.75;
		}
		.xline{
			position:absolute;
			top:0px;
			left:40px;
			width:400px;
			height:5px;
			background-color:white;
			z-index:-1;
			opacity:0.5;
		}
		.yline{
			position:absolute;
			top:40px;
			left:0px;
			width:5px;
			height:400px;
			background-color:white;
			z-index:-1;
			opacity:0.5;
		}
	</style>
	<script type="text/javascript">
		// develped by Fatih Yarlıgan
		function clickb(who){
			alert(who);
		}
	</script>
</head>
<body>
	<center><div style="width:850px;float:none;">
	<div class="divs plyr">
		<h3><a id="name1">Player 1</a><br><a style="color:red">( X )</a></h3>
		<h2 id="score1">0</h2>
		<a id="turn1">Your Turn : 5</a>
	</div>
	<div class="divs" style="width:460px;">
		<div class="btn" onclick="clickm(0)">_</div>         <!--  CLİCK FONKSİYONUNU ALGILAMIYOR-->
		<div class="btn" onclick="clickm(1)">_</div>
		<div class="btn" onclick="clickm(2)">_</div>
		<div class="btn" onclick="clickm(3)">_</div>
		<div class="btn" onclick="clickm(4)">_</div>
		<div class="btn" onclick="clickm(5)">_</div>
		<div class="btn" onclick="clickm(6)">_</div>
		<div class="btn" onclick="clickm(7)">_</div>
		<div class="btn" onclick="clickm(8)">_</div>
		<div class="xline" id="xline1" style="top:160px;"></div>
		<div class="xline" id="xline2" style="top:310px;"></div>
		<div class="yline" id="yline1" style="left:75px;"></div>
		<div class="yline" id="yline2" style="left:225px;"></div>
	</div>
	<div class="divs plyr">
		<h3><a id="name2">Player 2</a><br><a style="color:blue">( O )</a></h3>
		<h2 id="score2">0</h2>
		<a id="turn2">His Turn : 5</a>
	</div>
	</div>
	</center><center><div style="width:500px;"><a id="save" onclick="save()" style="">Save Challange</a> | <a id="leaderboard" onclick="leaderboard()" style="">Leaderboard</a><br>
	<footer><a style="opacity:0.75;font-family:Times New Roman;font-size:20px;"><?php echo file_get_contents("footer.txt"); ?></a></footer></div></center>
	
	<div id="div1" style="display:none;">x</div>
	<div id="div2" style="display:none;">_,_,_,_,_,_,_,_,_</div>
	<div id="div3" style="display:none;">z</div>
	<div id="div4" style="display:none;">Player 1</div>
	<div id="div5" style="display:none;">Player 2</div>
	<div id="div6" style="display:none;">y</div>
	<div id="div7" style="display:none;">a</div>
	
	<script type="text/javascript">
		var player = 1;
		var loop = 0;
		var turn = 1;
		var timer;
		var wins = 0;
		var score1 = 0;
		var score2 = 0;
		var tut = 0;
		var hak = 1;
		var name1 = "Player 1";
		var name2 = "Player 2";
		var stop = false;
		function show(link,div){
		  $(document).ready(function(){
		  $.ajax({url: link, success: function(result){
		  $(div).html(result);
				}});
			});
		}
		function clickm(who){
			//alert(who);
			var datam = document.getElementById('div2').innerHTML;
			var data = datam.split(",");
			if(turn==1 && hak==1 && data[who]=='_'){
				show("click/click"+player+who+".php","#div1");
				document.getElementsByClassName('btn')[who].innerHTML = 'X';
				var datam = document.getElementById('div2').innerHTML;
				var data = datam.split(",");
				data[who] = 'X';
				var newdata = "";
				for(var i=0;i<9;i++){
					newdata = newdata + data[i] + ",";
				}
				document.getElementById('div2').innerHTML = newdata;
				hak = 0;
			}
		}
		
		function read(){
			var datam = document.getElementById('div2').innerHTML;
			var data = datam.split(",");
			for(var i=0;i<9;i++){
				if(data[i]=='_'){
					document.getElementsByClassName('btn')[i].innerHTML = "";
				}else{
					document.getElementsByClassName('btn')[i].innerHTML = data[i];
				}
			}
			whowin();
			//kontrol
		}
		
		var winner;
		function winn(x){
			if(tut%10==1){
				loop=5;
				if(x=='X'){
					show("upscore1.php","#div7");
					score1++;
					document.getElementById('score1').innerHTML = score1;
					document.getElementById('score1').style.color = 'red';
					wins = 1;
					turn = 2;
				}else{
					show("upscore2.php","#div7");
					score2++;
					document.getElementById('score2').innerHTML = score2;
					document.getElementById('score2').style.color = 'blue';
					wins = 2;
					turn = 1;
				}
				if(score1>4 || score2>4){
					save();
				}else{
					window.setTimeout(reset, 5000);
				}
			}
		}
		function whowin(){
			var datam = document.getElementById('div2').innerHTML;
			var data = datam.split(",");
			if(data[0]==data[4] && data[0]==data[8]){
				if(data[0]!='_' && data[4]!='_' && data[8]!='_'){
					for(var j=0;j<9;j+=4){
						var color = "";
						if(data[0]=='X'){
							color = "red";
							winner = 1;
						}else if(data[0]=='O'){
							color = "blue";
							winner = 2;
						}
						document.getElementsByClassName('btn')[j].style.color = color;
					}
					tut++;
					winn(data[0]);
					console.log(data[0]);
				}
			}
			if(data[2]==data[4] && data[2]==data[6]){
				if(data[2]!='_' && data[4]!='_' && data[6]!='_'){
					for(var j=2;j<7;j+=2){
						var color = "";
						if(data[2]=='X'){
							color = "red";
							winner = 1;
						}else if(data[2]=='O'){
							color = "blue";
							winner = 2;
						}
						document.getElementsByClassName('btn')[j].style.color = color;
					}
					tut++;
					winn(data[2]);
					console.log(data[2]);
				}
			}
			for(var i=0;i<7;i+=3){
				if(data[i]==data[i+1] && data[i]==data[i+2]){
					if(data[i]!='_' && data[i+1]!='_' && data[i+2]!='_'){
						for(var j=0;j<3;j++){
							var color = "";
							if(data[i]=='X'){
								color = "red";
								winner = 1;
							}else if(data[i]=='O'){
								color = "blue";
								winner = 2;
							}
							document.getElementsByClassName('btn')[i+j].style.color = color;
						}
						tut++;
						winn(data[i]);
						console.log(data[i]);
					}
				}
			}
			for(var i=0;i<3;i++){
				if(data[i]==data[i+3] && data[i]==data[i+6]){
					if(data[i]!='_' && data[i+3]!='_' && data[i+6]!='_'){
						for(var j=0;j<3;j++){
							var color = "";
							if(data[i]=='X'){
								color = "red";
								winner = 1;
							}else if(data[i]=='O'){
								color = "blue";
								winner = 2;
							}
							document.getElementsByClassName('btn')[i+3*j].style.color = color;
						}
						tut++;
						winn(data[i]);
						console.log(data[i]);
					}
				}
			}
			if(datam.includes('_')==false){
				loop = 3;
				wins = 0;
				turn = 1;
				hak = 1;
				window.setTimeout(reset, 2000);
			}
		}
		
		function resize(){
			//var xlinetop = document.getElementById('xline1').style.left();
			var ylineleft = window.innerWidth/2 - 95;
			var xlineleft = window.innerWidth/2 - 215;
			document.getElementById('xline1').style.left = (xlineleft)+"px";
			document.getElementById('xline2').style.left = (xlineleft)+"px";
			document.getElementById('yline1').style.left = (ylineleft-4)+"px";
			document.getElementById('yline2').style.left = (ylineleft+150)+"px";
		}
		
		window.addEventListener('resize', e => {
		  //width = canvas.width = window.innerWidth;
		  //height = canvas.height = window.innerHeight - 50;
		  resize();
		});
		
		function save(){
			show("save.php","#div3");
			document.getElementById('save').innerHTML = "Saved Challange";
			document.getElementById('save').style.color = 'green';
			stop = true;
		}
		
		function saved(){
			document.getElementById('save').innerHTML = "Saved Challange";
			document.getElementById('save').style.color = 'green';
			stop = true;
		}
		
		function leaderboard(){
			window.location.href='index.php';
		}
		
		//start
		function reset(){
			show("reset.php","#div3");
			resize();
			clearTimeout(timer);
			loop = 0;
			wins = 0;
			hak = 1;
			floop();
			for(var j=0;j<9;j++){
				document.getElementsByClassName('btn')[j].style.color = 'white';
			}
			document.getElementById('score1').style.color = 'white';
			document.getElementById('score2').style.color = 'white';
			//whowin();
		}
		
		function floop(){
			show("getdata.php","#div2");
			show("getstop.php","#div6");
			show("getpname1.php","#div4");
			show("getpname2.php","#div5");
			read();
			console.log(hak);
			if(loop%5==0 && loop!=0){
				var nturn = 1;
				if(turn==1){
					nturn=2;
				}
				turn = nturn;
			}
			var sayac = 5-(loop%5);
			if(wins==0){
				if(turn==1){
					document.getElementById('turn2').innerHTML = "";
					document.getElementById('turn1').innerHTML = "Your Turn : " + sayac;
				}else{
					document.getElementById('turn1').innerHTML = "";
					document.getElementById('turn2').innerHTML = "His Turn : " + sayac;
					hak = 1;
				}
			}else if(wins==1){
				document.getElementById('turn2').innerHTML = "";
				document.getElementById('turn1').innerHTML = "YOU WON : " + sayac;
			}else if(wins==2){
				document.getElementById('turn1').innerHTML = "";
				document.getElementById('turn2').innerHTML = "HE WON : " + sayac;
			}
			loop++;
			document.getElementById('name1').innerHTML = document.getElementById('div4').innerHTML;
			document.getElementById('name2').innerHTML = document.getElementById('div5').innerHTML;
			if(document.getElementById('div6').innerHTML == true){
				saved();
				hak = 0;
				turn = 0;
			}
			if(stop==false){
				timer = setTimeout(floop, 1000);
			}
		}
		function start(){
			show("getpname1.php","#div4");
			show("getpname2.php","#div5");
			show("fullreset.php","#div6");
			reset();
			name1 = document.getElementById('div4').innerHTML;
			name2 = document.getElementById('div5').innerHTML;
		}
		start();
	</script>
</body>
</html>
