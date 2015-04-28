<?php

//dデーターベース（オブジェクト）
$link = mysql_connect('localhost','root','324032azzurro');   // $linkの中にmyseqlオブジェクトを入力

//$sql = "SET NAMES UTF-8"; 			// MySQL上に"UTF-8"をセットする
//$result = mysql_query($sql);
if (!$link) {	die('データーベースに接続できません:'. mysql_error());  }
//データーベースを選択する。
mysql_select_db('friends_system', $link); 

$friend_id = $_POST['friend_id'];      //$_POST['---ここにはnameを書くこと---']
//var_dump($_POST['friend_id']);
$from_id = $_POST['from_id'];
$name = $_POST['name']; 
$gender = $_POST['gender'];
$age = $_POST['age'];

$sql = "UPDATE `friends_list` SET `from_id`=" .$from_id. ",`name`='" .$name. "',`gender`='" .$gender. "',`age`=" .$age. " WHERE friend_id=" .$friend_id. ";";
var_dump($sql);

mysql_query($sql);

echo 'データを変更しました。';

//var_dump($sql);
//mysql_query($sql);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
	<meta charset="UTF-8">
	<meta name="おともだち情報の変更" content="text/html; charaset=UTF-8">
	<title>おともだち情報の変更</title>
	<link rel="shortcut icon" href="iconのリンク先をここに" href="">
</head>
<body>
	<h1><?php echo $name; ?>さんの情報を変更しました。</h1>




	<!--  <a href="./new_friend.php?from_id=<?php echo $area; ?>" >新規登録</a>   -->
	<!--  都道府県IDを持って、次のページに橋渡し 
	<form action="new_friend.php" method="post">
		<input name="area_id" type="hidden" value=<?php echo $area; ?> />   <!--  valueに代入するときは""を付けてはならない。（正）value = 4  
		<input type="button" onclick="history.back()" value="戻る" />
		<input type="submit" value="新規登録"/>
	</form>
-->
	<br />
	<a href="./friends.php?from_id=<?php echo $from_id; ?>"> 確認する </a> <br />
	<a href="./areas.php">都道府県一覧</a> 
	<h3><a href="http://192.168.33.10/index.html"><font>Top</font></a></h3>

	2312

</body>
</html>