<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();
// ログインしていなかったら、login画面へリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
// DBに接続する
$db = get_db_connect();
// セッションから取得したlogin中のユーザーIDを格納　user.php
$user = get_login_user($db);
// ユーザー毎のカート情報を取得
$carts = get_user_carts($db, $user['user_id']);
// カート内の合計金額を取得
$total_price = sum_carts($carts);
// viewファイル出力
include_once VIEW_PATH . 'cart_view.php';