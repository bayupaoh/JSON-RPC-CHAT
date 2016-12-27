<?php
require_once 'jsonRPCServer.php';
require 'example.php';

$myExample = new example();
jsonRPCServer::handle($myExample)
	or print 'no request';
?>