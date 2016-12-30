<?php
require_once 'jsonRPCClient.php';
    $myExample = new jsonRPCClient('http://24.10.13.8/sister/server.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Articles Submission Accordion - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .form-inline .form-group { margin-right:10px; }
.well-primary {
color: rgb(255, 255, 255);
background-color: rgb(66, 139, 202);
border-color: rgb(53, 126, 189);
}
.glyphicon { margin-right:5px; }
    </style>
    <script src="jquery-1.11.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
	<script src="rabbit.js"></script>
	
	<script>
	window.onload = function() {
		function loadDoc() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					document.getElementById("tpesan").innerHTML = xhttp.responseText;
					}
					};
					xhttp.open("GET", "storeData.txt", true);
					xhttp.send();
					}
					setInterval(loadDoc, 1000);
					
			function encrypt() {
		
		var decrypted = CryptoJS.AES.decrypt(encrypted, "Secret Passphrase");
		document.getElementById("pesan").innerHTML = decrypted;
		alert(encrypted);
	}		
	}
	
	function doCrypt(isDecrypt) {
	var shiftText = 2;
	if (!/^-?\d+$/.test(shiftText)) {
		alert("Shift is not an integer");
		return;
	}
	var shift = parseInt(shiftText, 10);
	if (shift < 0 || shift >= 26) {
		alert("Shift is out of range");
		return;
	}
	if (isDecrypt)
		shift = (26 - shift) % 26;
	var textElem = document.getElementById("pesan");
	textElem.value = caesarShift(textElem.value, shift);
}



function caesarShift(text, shift) {
	var result = "";
	for (var i = 0; i < text.length; i++) {
		var c = text.charCodeAt(i);
		if      (c >= 65 && c <=  90) result += String.fromCharCode((c - 65 + shift) % 26 + 65);  // Uppercase
		else if (c >= 97 && c <= 122) result += String.fromCharCode((c - 97 + shift) % 26 + 97);  // Lowercase
		else                          result += text.charAt(i);  // Copy
	}
	return result;
}
	
	function decrypt() {
		var z = document.getElementById("pesan").value;
		var decrypted = CryptoJS.Rabbit.decrypt(z, "ada");
		$("#pesan").val(decrypted);
	}
	
</script>

	
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
		<div class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project JSON-RPC</a>
          </div>
        </div>
      </div>
            <div class="panel-group" id="accordion">
						<?php
						
                        //if there's any user action
                        $action = isset($_POST['action']) ? $_POST['action'] : "";
                        if ($action == 'create') {
							$nama = $myExample->nama('name');
							$pesan = "".$nama. "".$_POST['pesan'];
							$myExample->writeSomething($nama,$pesan);
							$action= null;
						} 
						
                        ?>
                <form action="#" method="POST" role="form">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Communication</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
									<input type="text" id="test" class="form-control" value="<?php echo $myExample->nama('name');?>" style="margin-bottom:10px;" id="usr">
									<textarea style="margin-bottom:10px;" class="form-control" rows="15" id="tpesan" name="tpesan"><?php //$myfile = fopen("storeData.txt", "r") or die("Unable to open file!"); print fread($myfile,filesize("storeData.txt")); fclose($myfile); ?></textarea> 
									<textarea class="form-control" rows="2" id="pesan" name="pesan"></textarea>
									</div>
									 <button type="submit" class="btn btn-lg btn-default" name='action' value='create'>Kirim Pesan</button>
									 <a href="refresh.php"><button type="button" class="btn btn-lg btn-default bersihkan" value="clear">Bersihkan Pesan</button></a>
									 <button type="button" class="btn btn-lg btn-default" onclick="doCrypt(false);">Encrypt Pesan</button>
									 <button type="button" class="btn btn-lg btn-default" onclick="doCrypt(true);">Decrypt Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>
</body>
</html>
