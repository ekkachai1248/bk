<meta charset="utf-8">
<?php
	@session_start();

if($_GET['c']=='products'){
	unset($_SESSION['pid']) ;
	unset($_SESSION['pname']) ;
	unset($_SESSION['pprice']) ;
	unset($_SESSION['ppicture']) ;
	unset($_SESSION['pitem']) ;
}

if($_GET['c']=='foods'){
	unset($_SESSION['fid']) ;
	unset($_SESSION['fname']) ;
	unset($_SESSION['fprice']) ;
	unset($_SESSION['fpicture']) ;
	unset($_SESSION['fitem']) ;
	unset($_SESSION['fdate']) ;
	unset($_SESSION['fround']) ;
}

if($_GET['c']=='tours'){
	unset($_SESSION['tid']) ;
	unset($_SESSION['tname']) ;
	unset($_SESSION['tprice']) ;
	unset($_SESSION['tpicture']) ;
	unset($_SESSION['titem']) ;
	unset($_SESSION['tdate']) ;
	unset($_SESSION['tround']) ;
}

if($_GET['c']=='homestays'){
	unset($_SESSION['hid']) ;
	unset($_SESSION['hname']) ;
	unset($_SESSION['hprice']) ;
	unset($_SESSION['hpicture']) ;
	unset($_SESSION['qroom']) ;
	unset($_SESSION['datecheckin']) ;
	unset($_SESSION['datecheckout']) ;
	unset($_SESSION['qperson']) ;
	unset($_SESSION['qnight']) ;
}

	echo "<meta http-equiv=\"refresh\" content=\"0;URL=shopping_cart.php\">";

?>