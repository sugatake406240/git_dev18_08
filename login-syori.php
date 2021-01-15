<!-- セッション -->
<?php session_start(); ?>

<!-- 外部コード　読み込み -->
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>


<?php
// 前回セッション　クリア
unset($_SESSION['customer']);

// DB接続 gs_db
$pdo=new PDO('mysql:host=localhost;dbname=gs_db;charset=utf8', 
	'root', 'root');

// SQL文　セット gs_user_tableの検索をする文を生成
$sql=$pdo->prepare('select * from gs_user_table where lid=? and lpw=?');

$sql->execute([$_REQUEST['lid'], $_REQUEST['lpw']]);

foreach ($sql as $row) {
	$_SESSION['customer']=[
		'id'=>$row['id'], 'name'=>$row['name'], 
		'lid'=>$row['lid'],'lpw'=>$row['lpw'], 
		'kanri_flg'=>$row['kanri_flg'], 
		'life_flg'=>$row['life_flg']
	];
}
if (isset($_SESSION['customer'])) {
	echo 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん。';
} else {
	echo 'ログイン名またはパスワードが違います。';
}
?>
<?php require 'footer.php'; ?>
