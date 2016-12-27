<?php
require_once 'jsonRPCClient.php';
$myExample = new jsonRPCClient('http://192.168.10.110/sister/server.php');
?> 

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>JSON RPC - SISTER CHAT</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME  CSS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
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
        <div class="row pad-top pad-bottom">


            <div class=" col-lg-6 col-md-6 col-sm-6">
                <div class="chat-box-div">
                    <div class="chat-box-head">
                        SISTER CHAT HISTORY
                            <div class="btn-group pull-right">
                                
                            </div>
                    </div>
                    <div class="panel-body chat-box-main" id="pesan" name="pesan">
                    </div>
                    <div class="chat-box-footer">
                        <?php
                        
                        //if there's any user action
                        $action = isset($_POST['action']) ? $_POST['action'] : "";
                        if ($action == 'create') {
                            $nama = $myExample->nama('name');
                            $pesan = "".$nama. "".$_POST['pesan'];
                            $myExample->writeSomething($pesan);
                            $action= null;
                        } 
                        
                        ?>
                        <form action="#" method="POST" role="form">                    
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Text Here...">
                                <span class="input-group-btn">
                                    <button type="submit"  name='action' value='create'>Kirim Pesan</button>
                                </span>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            
            
        </div>
    </div>

    <!-- USING SCRIPTS BELOW TO REDUCE THE LOAD TIME -->
    <!-- CORE JQUERY SCRIPTS FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- CORE BOOTSTRAP SCRIPTS  FILE -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
