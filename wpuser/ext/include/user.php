<?php
/**
 * @calling : 概要、ユーザー機能
 * @purpose
 * @date
 * @argment
 * @return
 */
require_once('../include/lib_inc.php');
require_once('../include/user_auth.php');

class User {
	//
	function init(){
		global $mRequest, $mConfig, $mUser;
//		$mConfig['temp_dir'] ='./ext/user/template';
		$mConfig['temp_dir'] ='./template';
		//
		session_start();
//var_dump($_SESSION['user'] );
		if(isset($_SESSION['user'])){
			if(isset($_SESSION['user']['id']) ){
				 $mUser= $_SESSION['user'];
			 }
		}
	}
	//
	function get_function( $req ){
	}
	//
	function exec_function( $req ){
		switch($req['fn']){
			case 'user_add'     : $this->user_add($req); break;
			case 'user_add_show': $this->user_add_show($req); break;
			case 'user_login'     : $this->user_login($req); break;
			case 'user_logout'    : $this->user_logout($req); break;
			case 'user_edit'      : $this->user_edit($req); break;
			case 'user_update'    : $this->user_update($req); break;
			// 
			default:
				return;
		}
	}
	//
	function user_update($req){
		$cls=new User_auth();
		$cls->user_update($req);	
	}
	//
	function user_edit($req){
		$cls=new User_auth();
		$cls->user_edit($req);	
	}
	//
	function user_logout($req){
		require_once('../include/user_auth.php');
		$cls=new User_auth();
		$cls->logout($req);
	}
	//
	function user_add( $req ){
		require_once('../include/user_auth.php');
//		var_dump( $req );
		$cls=new User_auth();
		$cls->add($req);
	}
	//
	function user_add_show( $req ){
		$cls = new Lib_common();
		$tpl['temp_html'] = 'user_add.html';
//		$cls->write_html($tpl, "user_add.html");
		$cls->write_html($tpl, "user_wrap.html");
	}
	//
	function user_login( $req ){
		require_once('../include/user_auth.php');
		$cls=new User_auth();
		$cls->login($req);
	}
	//
	function login_show(){
		$cls = new Lib_common();
//		$cls->write_html($tpl, "user_login.html");
		$tpl['temp_html'] = 'user_login.html';
		$cls->write_html($tpl, "user_wrap.html");
	}

}

//-------
// main
//-------
global $mConfig, $mRequest,  $mUser;
//var_dump($mConfig );
//exit();

$cls =new User();
$cls->init();
//$cls->get_function($mRequest);
// var_dump('user.php');	
if(isset($_REQUEST)){ $mRequest=$_REQUEST; }
if(isset($mRequest['fn'])){
//	$cls->exec_function($mRequest['fn']) ;
	$cls->exec_function($mRequest ) ;
	exit();
}
//
$cls->login_show();

