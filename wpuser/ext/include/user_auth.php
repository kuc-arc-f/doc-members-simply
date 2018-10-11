<?php
/**
 * @calling : 概要、ログイン処理
 * @purpose
 * @date
 * @argment
 * @return
 */

class User_auth {
	//
	function add($req){
		global $mConfig, $mRequest,  $mUser;
		$cls = new Lib_common();
		$msg =$this->user_add_check($req );
		if( $msg != null ){
//			$tpl['msg']=$msg;
			$tpl['error']=$msg;
//			$cls->write_sys_message($tpl, "user_msg.html");
			$tpl['temp_html'] = 'user_msg.html';
			$cls->write_sys_message($tpl, "user_wrap.html");
		}
//exit();
		$query="INSERT INTO ext_users
		SET email = '{$req['email']}' , passwd='{$req['passwd']}'
		,  utype='user'
		;
		";
		$res = mysql_query($query);
		if (!$res ) {
			die('INSERTクエリーが失敗しました。'.mysql_error());
		}
		$tpl['msg']='登録が完了しました。';
		$tpl['temp_html'] = 'user_msg.html';
//		$cls->write_sys_message($tpl, "user_msg.html");
		$cls->write_sys_message($tpl, "user_wrap.html");
	}
	//
	function user_add_check($req){
		$ret=null;
//var_dump($req);
		if(strlen($req['passwd']) < 1){ $ret ='passwd を入力下さい。'; }
		if(strlen($req['email'] ) < 1){ $ret ='email を入力下さい。'; }
		//db_check
		$query="select id from ext_users
		 where email ='{$req[email]}' LIMIT 1";
//var_dump($query);
		$res = mysql_query($query);
		if (!$res ) {  die('クエリーが失敗しました。'.mysql_error()); }
		if (mysql_num_rows($res) > 0) {
			$ret='登録済みの email が、存在します。';
		}
		if(!preg_match("/^([\w|\.|\-|_]+)@([\w||\-|_]+)\.([\w|\.|\-|_]+)$/i", $req['email'])){
			$ret = "メールアドレスの書式が不正です。";
		}
		return $ret;	
	}
	//
	function user_update($req){
		global $mConfig, $mRequest,  $mUser;
		$cls = new Lib_common();
//var_dump( 'user_update');
//var_dump( $req );
//exit();
		$msg= $this->user_update_check($req);
		if( strlen($msg) > 0 ){
			$tpl['error']=$msg;
//			$cls->write_sys_message($tpl, "admin_msg.html");
			$tpl['temp_html'] = 'user_msg.html';
			$cls->write_html($tpl, "user_wrap.html");
		}
		//
		$query="UPDATE ext_users
		SET passwd='{$req['passwd']}' 
		where id={$req['id']};
		";
//var_dump( $query );
		$res = mysql_query($query);
		if (!$res ) { die('クエリーが失敗しました。'.mysql_error()); }
		$tpl['msg']='登録が完了しました。';
//		$cls->write_sys_message($tpl, "user_msg.html");
		$tpl['temp_html'] = 'user_msg.html';
		$cls->write_html($tpl, "user_wrap.html");
	}
	//
	function user_update_check($req){
		$ret='';
//var_dump($req);
		if(strlen($req['passwd']) < 1){ $ret .='password を入力下さい。'; }
		return $ret;	
	}
	//
	function user_edit($req){
		global $mConfig, $mRequest,  $mUser;
		$cls = new Lib_common();
//var_dump( 'user_edit' );
//var_dump( $mUser);
//exit();
		if(isset($mUser['id'])==false){
//			$tpl['msg']='登録が完了しました。';
			$tpl['error']="ユーザー情報の取得に失敗しました。";
//			$cls->write_sys_message($tpl, "user_msg.html");
			$tpl['temp_html'] = 'user_msg.html';
			$cls->write_html($tpl, "user_wrap.html");
		}
		$query="select * from ext_users
			where id={$mUser['id']}
			LIMIT 1
			";
		$res = mysql_query($query);
		if (!$res ) {die('クエリーが失敗しました。'.mysql_error()); 	}
		$dat =array();
		while ($row = mysql_fetch_assoc($res)) {
			$dat =$row;
		}
// var_dump( $dat );
		$tpl['dat']=$dat;		
		$tpl['temp_html'] = 'user_edit.html';
//		$cls->write_html($tpl, "user_edit.html");
		$cls->write_html($tpl, "user_wrap.html");
	}
	//
	function login($req){
		global $mConfig, $mRequest,  $mUser;
		$query="select * from ext_users
		 where email ='{$req[email]}'
		 and  passwd='{$req[passwd]}' LIMIT 1";
		$res = mysql_query($query);
		if (!$res ) {
			die('クエリーが失敗しました。'.mysql_error());
		}
//var_dump(mysql_num_rows($res));
		$cls = new Lib_common();
		if (mysql_num_rows($res) == 0) {
			$tpl['msg']='認証に失敗しました。';
			$tpl['temp_html'] = 'user_login.html';
//			$cls->write_html($tpl, "user_login.html");
			$cls->write_html($tpl, "user_wrap.html");
		}
		session_start();
		while ($row = mysql_fetch_assoc($res)) {
			$_SESSION['user'] = $row;
		}
//var_dump('OK-auth');
		header("Location: {$mConfig['base_url']}");
		exit();
	}
	//
	function logout($req){
		global $mConfig, $mRequest,  $mUser;
//var_dump($mConfig['base_url'] );
//exit();
		session_start();
		$_SESSION['user'] = null;
		header("Location: {$mConfig['base_url']}");
		exit();
	}

}
