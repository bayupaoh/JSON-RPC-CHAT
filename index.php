<?php
    require_once 'jsonRPCClient.php';
    $myExample = new jsonRPCClient('http://24.10.13.8/sister/server.php');
    
    session_start();
    if(isset($_POST['user'])){
        $_SESSION['nama'] = $_POST['user'];
       
    }

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
        <script src="jquery-1.11.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script>
    function setName(){
        var nama = document.getElementById('nama').value;
        // document.cookie = "user="+nama+"; expires=86400*30";
        $.ajax({
        url: 'index.php',
        type: 'POST',
        data: {
            user : nama
        },
        success: function(data, textStatus, xhr) {
            $('#setNama').modal('hide')
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log(textStatus.reponseText);
        }
    });
        
    }
/*
    window.onload = function() {
       <?php if(!isset($_SESSION['nama'])){?>
            getName(); 
        <?php } ?>
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
    }*/
    function getName(){
        // document.getElementById('setNama').style='display:block';
        $('#setNama').modal('show')
    }

    function getName(){
        // document.getElementById('setNama').style='display:block';
        $('#setNama').modal('show')
    }

    
    function logout(){
        
        //document.location.href = 'index.php';
    }

window.onload = function() {
        <?php if(!isset($_SESSION['nama'])){?>
            getName(); 
        <?php } ?>
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
                    
    }
    
</script>

</head>
<body >
    <div class="container">
        <div class="row pad-top pad-bottom">
            <div class=" col-lg-6 col-md-6 col-sm-6">
                <div class="chat-box-div">
                    <div class="chat-box-head">
                        SISTER CHAT HISTORY
                    </div>
                    <div class="panel-body chat-box-main" id="tpesan" name="tpesan">    
                    </div>
                    <div class="chat-box-footer">
                        <?php
                        
                        //if there's any user action
                        $action = isset($_POST['action']) ? $_POST['action'] : "";
                        if ($action == 'create') {
                            
                            $pesan = $_POST['pesan'];
                            $nama = @$_SESSION['nama'];
                            
                            $txt = '<div class="chat-box-right">'.$pesan.'</div><div class="chat-box-name-right"><img src="assets/img/user.png" alt="bootstrap Chat box user image" class="img-circle" /> - '.$nama.'</div><hr class="hr-clas" />'."\n";
                            file_put_contents("storeData.txt", $txt, FILE_APPEND);
                            
                            $myExample->writeSomething($nama,$pesan);
                            $action= null;
                        } 
                        
                        ?>
                        <form action="#" method="POST" role="form">                    
                            <div class="input-group">
                                <input type="text" class="form-control" id="pesan" name="pesan" placeholder="Enter Text Here...">
                                <span class="input-group-btn">
                                    <button type='submit' class="btn btn-info" name='action' value='create'>Kirim Pesan</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>        
    <div class="modal fade" tabindex="-1" role="dialog" id="setNama" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nama User</h4>
      </div>
      <div class="modal-body">
           <input type="text" name="nama" placeholder="Your name.." id="nama" class="form-control"       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="setName()" id="test">Save</button>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- USING SCRIPTS BELOW TO REDUCE THE LOAD TIME -->
    <!-- CORE JQUERY SCRIPTS FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- CORE BOOTSTRAP SCRIPTS  FILE -->
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>
