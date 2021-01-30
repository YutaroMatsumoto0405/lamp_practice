<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();
// ログインしてたらホームにリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

$name = get_post('name');
$password = get_post('password');
// DBに接続する
$db = get_db_connect();

// ログイン処理
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  // ログインに失敗したらログイン画面に戻る
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
redirect_to(HOME_URL);