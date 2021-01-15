<!-- セッション開始 -->
<?php session_start(); ?>
<!-- 定型文　読み込み -->
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<?php
// DB接続
$pdo=new PDO('mysql:host=localhost;dbname=gs_db;charset=utf8', 'root', 'root');
echo "DB接続";

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
		$sql=$pdo->prepare('update gs_user_table set name=?, lid=?, lpw=?, kanri_flg=?, life_flg=? where id=?');
		// 更新を実行
		$sql->execute([$_REQUEST['name'], $_REQUEST['lid'], $_REQUEST['lpw'],  $_REQUEST['kanri_flg'], $_REQUEST['life_flg'],$id]);
		// セッションも更新
		$_SESSION['customer']=['id'=>$id, 'name'=>$_REQUEST['name'],'lid'=>$_REQUEST['lid'],'lpw'=>$_REQUEST['lpw'],
			'kanri_flg'=>$_REQUEST['kanri_flg'],'life_flg'=>$_REQUEST['life_flg']];

		echo 'お客様情報を更新しました。';


	} else {
		$sql=$pdo->prepare('insert into gs_user_table values(null,?,?,?,?,?)');
		$sql->execute([$_REQUEST['name'], $_REQUEST['lid'], $_REQUEST['lpw'],$_REQUEST['kanri_flg'], $_REQUEST['life_flg']	]);
		echo 'お客様情報を登録しました。';
	}


} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
<?php require 'footer.php'; ?>
