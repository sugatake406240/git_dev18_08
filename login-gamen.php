<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<form action="login-syori.php" method="post">
ログイン名<input type="text" name="lid"><br>
<!-- inputタグのtype属性でtype="password"を指定すると、パスワード入力欄が作成 -->
パスワード<input type="password" name="lpw"><br>
<input type="submit" value="ログイン">
</form>
<?php require 'footer.php'; ?>
