<!-- セッション開始 -->
<?php session_start(); ?>
<!-- 定型文　読み込み -->
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<?php
$id=$name=$lid=$lpw=$kanri_flg=$life_flg='';

if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
	$name=$_SESSION['customer']['name'];
	$lid=$_SESSION['customer']['lid'];
	$lpw=$_SESSION['customer']['lpw'];
	$kanri_flg=$_SESSION['customer']['kanri_flg'];
	$life_flg=$_SESSION['customer']['life_flg'];
}

// DB接続
$pdo=new PDO('mysql:host=localhost;dbname=gs_db;charset=utf8', 'root', 'root');
// echo "DB接続";

if (isset($_SESSION['customer'])) {
	// セッションがあれば（すでにユーザー）
	$id=$_SESSION['customer']['id'];

	// PDOクラスprepareでSELECT文を設定
	$sql=$pdo->prepare('select * from gs_user_table where id!=? and lid=?');
	 // PDO Statementクラスのexecuteを同じidでなく（他のユーザー）、ログインid同じものがいるか？
	$sql->execute( [ $id, $_REQUEST['lid'] ] );

} else {
	// セッションがなければ（まだユーザーではない）
	// PDOクラスprepareを設定
	$sql=$pdo->prepare('select * from gs_user_table where lid=?');
	// PDO Statementクラスのexecuteをidとlidで実行
	$sql->execute([$_REQUEST['lid']]);
}


if ( empty( $sql->fetchAll() ) ) {
	// ログイン名の重複なし
	if (isset($_SESSION['customer'])) {
		// ユーザーデータはある
		// prepareでSQL文を設定
		$sql=$pdo->prepare('update gs_user_table set name=?, lid=?, lpw=? where id=?');
		// 更新を実行
		$sql->execute([$_REQUEST['name'], $_REQUEST['lid'], $_REQUEST['lpw'],$id]);
		// セッションも更新
		$_SESSION['customer']=['id'=>$id, 'name'=>$_REQUEST['name'],'lid'=>$_REQUEST['lid'],'lpw'=>$_REQUEST['lpw'],'kanri_flg'=>$kanri_flg,'life_flg'=>$life_flg];
		echo 'ユーザー情報を更新しました。';


	} else {
		$sql=$pdo->prepare('insert into gs_user_table values(null,?,?,?,?,?)');
		$sql->execute([$_REQUEST['name'], $_REQUEST['lid'], $_REQUEST['lpw'],0,1]);
		echo 'ユーザー情報を登録しました。';
	}


} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>

<br>
<a href="menu.php">メニューへ戻る</a>

<?php require 'footer.php'; ?>
