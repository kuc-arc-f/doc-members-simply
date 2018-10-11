<?php
/**
 * @calling : 概要、共通ライブラリ
 * @purpose
 * @date
 * @argment
 * @return
 */
//require_once('../include/user_login.php');


class Lib_common {
//	global $cfg;
	//
	function write_html($tpl, $tplfile){
		global $mConfig;
		//$tpl = tpl_htmlspecialchars($tpl);
		include("{$mConfig['temp_dir']}/{$tplfile}");
		if($con = @mysql_close()){
		}
		else{
			die("mysqlとの接続を解除できませんでした！<br>");
		}
		exit();
	}
	/*
	function write_sys_message_ng($tpl, $tplfile){
		global $mConfig;
		$tpl['temp_html'] = $tplfile;
		include("{$mConfig['temp_dir']}/admin_wrap.html" );
		if($con = @mysql_close()){
		}
		else{
			die("mysqlとの接続を解除できませんでした！<br>");
		}
		exit();
	}
	*/
	function write_sys_message($tpl, $tplfile){
		global $mConfig;
		//$tpl = tpl_htmlspecialchars($tpl);
		include("{$mConfig['temp_dir']}/{$tplfile}");
		if($con = @mysql_close()){
		}
		else{
			die("mysqlとの接続を解除できませんでした！<br>");
		}
		exit();
	}


}

	
