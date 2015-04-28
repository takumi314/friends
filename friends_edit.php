<?php

//dデーターベース（オブジェクト）
$link = mysql_connect('localhost','root','324032azzurro');   // $linkの中にmyseqlオブジェクトを入力

//$sql = "SET NAMES UTF-8"; 			// MySQL上に"UTF-8"をセットする
//$result = mysql_query($sql);
if (!$link) {	die('データーベースに接続できません:'. mysql_error());  }


//データーベースを選択する。
mysql_select_db('friends_system', $link);   // 

$friend_id = $_GET['friend_id'];

//変更したい友達の情報を取得するために、SQLを作成
$sql_1 = "SELECT * FROM `friends_system`.`friends_list` WHERE friend_id=" .$friend_id. ";" ;
$person = mysql_fetch_assoc(mysql_query($sql_1, $link));
//変更したい友達の情報を変数に代入
$from_id = htmlspecialchars($person['from_id'], ENT_QUOTES, 'UTF-8');
$name = htmlspecialchars($person['name'], ENT_QUOTES, 'UTF-8');
$gender = htmlspecialchars($person['gender'], ENT_QUOTES, 'UTF-8');
$age = htmlspecialchars($person['age'], ENT_QUOTES, 'UTF-8');



//都道府県データを取得するために、SQlを作成して結果を取得
	$sql2 = "SELECT * FROM `friends_system`.`todo-huken_list` ORDER BY `todo-huken_id` ASC" ;
	$result = mysql_query($sql2, $link);
//変更したい友達の出身地名を変数を代入
//$area = htmlspecialchars($area_all['name'], ENT_QUOTES, 'UTF-8');

//var_dump($area);

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
	<meta charset="UTF-8">
	<meta name="おともだちの登録画面" content="text/html; charaset=UTF-8">
	<title>おともだちの登録画面</title>
	<link rel="shortcut icon" href="iconのリンク先をここに" href="">
</head>
<body>

<h1>おともだちの編集</h1>

<form action="edited.php" method="post" >
			 <input type="hidden" name="friend_id" value=" <?php echo $friend_id; ?> " /><br />
		名前: <input type="text" name="name" value="<?php echo $name ; ?>" />さん<br />
<?php	
		if ($gender == '女') {
	 		echo  '性別: <input type="radio" name="gender" value="女" checked="checked"/> 女 <input type="radio" name="gender" value="男"/> 男 <br />'; 
	 	} else{
	 		echo '性別: <input type="radio" name="gender" value="女" /> 女 <input type="radio" name="gender" value="男" checked="checked"/> 男 <br />';		
	 	}
?>
		年齢: <input type="text" name="age" size="3" value=" <?php echo $age ; ?> "/>歳<br />
		
		出身地：<select name="from_id" />
		<option value=0> --- お友達の都道府県を選択してください --- </option>
<?php    
				if ($result !== false && mysql_num_rows($result)){

						while ($post = mysql_fetch_assoc($result)){ 
							//　前のページで表示していた都道府県を初期表示させる。
					 		if (htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8') == $from_id) {
					 	    	 	echo '<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8'). '" selected >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
				 	   		} else{ echo '<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8'). '" >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
						}
					}
				}			
				// 取得結果を開放して接続を閉じる
				mysql_free_result($result);
				mysql_close($link);
	?>

		</select>


	<br /><br />
	<input type="button" onclick="history.back()" value="戻る" />
    <input type="submit" name="touroku" value="変更" size=120 />
    <input type="reset" value="クリア">
</form>

	<br />
	<a href="./areas.php">都道府県一覧</a> 
	<h3><a href="http://192.168.33.10/index.html"><font>Top</font></a></h3>

</body>
</html>








