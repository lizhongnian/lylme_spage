<?php
include("common.php");
session_start(); //设置session
if($_POST['exit']=='exit'){
    $_SESSION['pass'] = 0;
     $_SESSION['list'] = array();
    header("Location: ../pwd");
    exit();
}
if($_SESSION['pass'] != 1){
    //未登录
    if(!empty($_POST['pass'])){
        //用户提交登录
        $show = array();
        $pwds = $DB->query("SELECT `pwd_id`, `pwd_key` FROM `lylme_pwd` WHERE `pwd_key` LIKE '".$_POST['pass']."';"); 
    	while ($pwd = $DB->fetch($pwds)) {
    	    array_push($show,$pwd[pwd_id]);
    	}
	if(empty($show)){
	    //无数据
	   exit('<script>alert("密码错误！");window.location.href="../pwd";</script>');
	}
	else{
	    //有数据
	    $_SESSION['list'] = $show;
        $_SESSION['pass'] = 1;
    }
    }
}
else {
    //已登录
    if(!empty($_POST['pass'])){
        $show = array();
        $pwds = $DB->query("SELECT `pwd_id`, `pwd_key` FROM `lylme_pwd` WHERE `pwd_key` LIKE '".$_POST['pass']."';"); 
    	while ($pwd = $DB->fetch($pwds)) {
    	    array_push($show,$pwd['pwd_id']);
    	}
	    if(empty($show)){
    	    $_SESSION['pass'] = 0;
            $_SESSION['list'] = array();
    	}
    }
}
if(basename($_SERVER['PHP_SELF']) != basename(__FILE__)) return;
    header("Location: ../");
?>