<?php require './header.php'; ?>
<?php require './menu.php'; ?>

<?php 

session_start();

if (isset($_SESSION['customer'])) {

	if($_SESSION['customer']['kanri_flg']==1){
		echo '<div style="font-size:25px; font-weight:bold;">',$_SESSION['customer']['name'],'さんは管理者です</div>';

		echo '<div class="th0">番号</div>';
		echo '<div class="th1">氏名</div>';
		echo '<div class="th1">ログイン名</div>';
		echo '<div class="th1">パスワード</div>';
		echo '<div class="th1">管理者フラグ</div>';
		echo '<div class="th1">在籍フラグ</div><br>';



		$pdo=new PDO('mysql:host=localhost;dbname=gs_db;charset=utf8','root','root');


		if (isset($_REQUEST['command'])) {

			switch ($_REQUEST['command']) {
			case 'insert':
				if (empty($_REQUEST['name']) ) break;
				$sql=$pdo->prepare('insert into gs_user_table values(null,?,?,?,?,?)');
				$sql->execute(
					[ htmlspecialchars($_REQUEST['name']), $_REQUEST['lid'], $_REQUEST['lpw'], $_REQUEST['kanri_flg'], $_REQUEST['life_flg'] ]);
				break;
			case 'update':
				if ( empty($_REQUEST['name']) ) break;
				$sql=$pdo->prepare(
					'update gs_user_table set name=?, lid=?, lpw=?, kanri_flg=?, life_flg=? where id=?');
				$sql->execute(
					[htmlspecialchars($_REQUEST['name']), $_REQUEST['lid'], $_REQUEST['lpw'], $_REQUEST['kanri_flg'], $_REQUEST['life_flg'], 
					$_REQUEST['id']]);
				break;
			case 'delete':
				$sql=$pdo->prepare('delete from gs_user_table  where id=?');
				$sql->execute([$_REQUEST['id']]);
				break;
			}
		}


		// 管理者の場合
		foreach ($pdo->query('select * from gs_user_table') as $row) {
			// 更新
			echo '<form class="ib" action="kanri-syori.php" method="post">';
			echo '<input type="hidden" name="command" value="update">';
			echo '<input type="hidden" name="id" value="', $row['id'], '">';
			echo '<div class="td0">';
			echo $row['id'];
			echo '</div> ';
			echo '<div class="td1">';
			echo '<input type="text" name="name" value="', $row['name'], '">';
			echo '</div> ';
			echo '<div class="td1">';
			echo '<input type="text" name="lid" value="', $row['lid'], '">';
			echo '</div> ';
			echo '<div class="td1">';
			echo '<input type="password" name="lpw" value="', $row['lpw'], '">';
			echo '</div> ';

			echo '<span style="display:inline-block; width:356px; " class="td1">';
			// echo '<input type="number" name="kanri_flg" value="', $row['kanri_flg'], '">';
			echo '<select style="width: 177px;" name="kanri_flg">';
			if($row['kanri_flg']==1){
				echo '<option value=0>一般ユーザー</option>';
				echo '<option value=1 selected>管理者</option>';
			}else{
				echo '<option value=0 selected>一般ユーザー</option>';
				echo '<option value=1 >管理者</option>';
			}
			echo '</select >';
			// echo '</div>';

			// echo '<div class="td1">';
			// echo '<input type="number" name="life_flg" value="', $row['life_flg'], '">';

			echo '<select style="width: 177px;" name="life_flg">';
			if($row['life_flg']==1){
				echo '<option value=0>退社</option>';
				echo '<option value=1 selected>入社</option>';
			}else{
				echo '<option value=0 selected>退社</option>';
				echo '<option value=1 >入社</option>';
			}
			echo '</select >';

			// echo '</div> ';
			echo '</span>';

			echo '<div class="td2">';
			echo '<input type="submit" value="更新">';
			echo '</div> ';
			echo '</form> ';

			// 削除
			echo '<form class="ib" action="kanri-syori.php" method="post">';
			echo '<input type="hidden" name="command" value="delete">';
			echo '<input type="hidden" name="id" value="', $row['id'], '">';
			echo '<input type="submit" value="削除">';
			echo '</form>';
			echo '<br>';
		}

		// 追加
		echo '<div class="body"></div>';
		echo '<form class="ib" action="kanri-syori.php" method="post">';
		echo '<div><input type="hidden" name="command" value="insert"></div>';
		echo '<div class="addcss td0"></div>';
		echo '<div class="addcss td1"><input type="text" name="name"></div>';
		echo '<div class="addcss td1"><input type="text" name="lid"></div>';
		echo '<div class="addcss td1"><input type="password" name="lpw"></div>';
		// echo '<div class="addcss td1"><input type="number" name="kanri_flg"></div>';
		// echo '<div class="addcss td1"><input type="number" name="life_flg"></div>';

		echo '<span style="display:inline-block; width:356px; " class="td1">';
		echo '<select style="width: 177px;" name="kanri_flg">';
			if($row['kanri_flg']==1){
				echo '<option value="" >選んでください</option>';
				echo '<option value=0 >一般ユーザー</option>';
				echo '<option value=1 >管理者</option>';
			}else{
				echo '<option value="" >選んでください</option>';
				echo '<option value=0 >一般ユーザー</option>';
				echo '<option value=1 >管理者</option>';
			}
		echo '</select >';

		echo '<select style="width: 177px;" name="life_flg">';
			if($row['life_flg']==1){
				echo '<option value="" >選んでください</option>';
				echo '<option value=0 >退社</option>';
				echo '<option value=1 >入社</option>';
			}else{
				echo '<option value="" >選んでください</option>';
				echo '<option value=0 >退社</option>';
				echo '<option value=1 >入社</option>';
			}
		echo '</select >';
		echo '</span>';


		echo '<div class="addcss td2"><input type="submit" value="追加"></div>';
		echo '</form>';

	}else{
	// 一般の方の場合

		$id=$name=$lid=$lpw=$kanri_flg=$life_flg='';

		if (isset($_SESSION['customer'])) {
			// 登録済の方
			$id=$_SESSION['customer']['id'];
			$name=$_SESSION['customer']['name'];
			$lid=$_SESSION['customer']['lid'];
			$lpw=$_SESSION['customer']['lpw'];
			$kanri_flg=$_SESSION['customer']['kanri_flg'];
			$life_flg=$_SESSION['customer']['life_flg'];
		

		echo '<div style="font-size:25px; font-weight:bold;">',$_SESSION['customer']['name'],'さんは一般ユーザーです</div>';

		echo '<form action="user-fix.php" method="post">';
		echo '<table>';
		echo '<input type="hidden" name="command" value="update">';
		echo '<input type="hidden" name="id" value="', $id, '">';
		echo '<tr><td>お名前</td><td>';
		echo '<input type="text" name="name" value="', $name, '">';
		echo '</td></tr>';
		echo '<tr><td>ログイン名</td><td>';
		echo '<input type="text" name="lid" value="', $lid, '">';
		echo '</td></tr>';
		echo '<tr><td>パスワード</td><td>';
		echo '<input type="password" name="lpw" value="', $lpw, '">';
		echo '</td></tr>';
		echo '</table>';
		$kanri_flg=0;
		$life_flg=1;
		echo '<input type="submit" value="確定">';
		echo '</form>';

		}
	}



}else{
$id=$name=$lid=$lpw=$kanri_flg=$life_flg='';
echo '<div style="font-size:25px; font-weight:bold;">はじめて登録する一般ユーザーの方です</div>';
echo '<form action="user-fix.php" method="post">';
echo '<table>';
echo '<div><input type="hidden" name="command" value="insert"></div>';

echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="name" value="', $name, '">';
echo '</td></tr>';
echo '<tr><td>ログイン名</td><td>';
echo '<input type="text" name="lid" value="', $lid, '">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="lpw" value="', $lpw, '">';
echo '</td></tr>';
echo '</table>';
$kanri_flg=0;
$life_flg=1;
echo '<input type="submit" value="確定">';
echo '</form>';

}






?>

<br>
<a href="menu.php">メニューへ戻る</a>


<?php require 'footer.php'; ?>
