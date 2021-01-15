<?php session_start(); ?>
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

echo '<form action="customer-addfix.php" method="post">';
echo '<table>';
echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="name" value="', $name, '">';
echo '</td></tr>';
echo '<tr><td>ログイン名</td><td>';
echo '<input type="text" name="lid" value="', $lid, '">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="lpw" value="', $lpw, '">';
echo '<tr><td>管理者権限</td><td>';
echo '<input type="number" name="kanri_flg" value="', $kanri_flg, '">';
echo '<tr><td>在籍状態</td><td>';
echo '<input type="number" name="life_flg" value="', $life_flg, '">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="確定">';
echo '</form>';
?>
<?php require 'footer.php'; ?>
