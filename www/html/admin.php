<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();
// ログインしていなかったら、login画面へリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
// DBに接続する
$db = get_db_connect();
// セッションから取得したlogin中のユーザーIDを格納　user.php
$user = get_login_user($db);
// ログインしていなかったら、login画面へリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
// select文で取得した全商品データを格納
$items = get_all_items($db);
// viewファイル出力
include_once VIEW_PATH . '/admin_view.php';
