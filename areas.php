<?php             
// 新規登録後の処理
//dデーターベース（オブジェクト）

$link = mysql_connect('localhost','root','324032azzurro');   // $linkの中にmyseqlオブジェクトを入力

//$sql = "SET NAMES UTF-8"; 			// MySQL上に"UTF-8"をセットする
//$result = mysql_query($sql);

if (!$link) {
	die('データーベースに接続できません:'. mysql_error());
}

	//データーベースを選択する。
	mysql_select_db('friends_sysmtem', $link);   // 

	//都道府県データを取得するために、SQlを作成して結果を取得
	$sql = "SELECT * FROM `friends_system`.`todo-huken_list` ORDER BY `todo-huken_id` ASC" ;
	$result = mysql_query($sql, $link);

	//メモリの節約のため、ここで接続を閉じる
	//mysql_close($link);
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
	<meta charset="UTF-8">
	<meta name="お友達システム" content="text/html; charaset=UTF-8">
	<title>お友達システム</title>
	<link rel="shortcut icon" href="iconのリンク先をここに" href="">
</head>
<body>
	<h1>おともだちシステム</h1>
<!--
<form action="friends.php" method="post" >
    <select name="from_id" onchange="dropsort()">
        <option value=0> --- 選択してください --- </option>
 <ul> -->
<?php   //データベースから取得した都道府県を順に表示する。

	if ($result !== false && mysql_num_rows($result)){
			while ($post = mysql_fetch_assoc($result)){

				$sql = "SELECT count(*) FROM `friends_list` LEFT OUTER JOIN `todo-huken_list` ON `friends_list`.`from_id` = `todo-huken_list`.`todo-huken_id` WHERE `todo-huken_list`.`todo-huken_id` =".htmlspecialchars($post['todo-huken_id']).";";
				//$sql = "SELECT count(*) FROM `todo-huken_list` INNER JOIN `friends_list` ON `todo-huken_list`.`todo-huken_id` = `friends_list`.`from_id` WHERE `todo-huken_list`.`todo-huken_id` = ".htmlspecialchars($post['todo-huken_id']).";";
   				var_dump($sql);
   				$population_area = mysql_query($sql,$link);
   				var_dump($population_area);
   					//人数が１人以上のときにリンクを有効とする
   					if ($population_area == 0) {
   						echo '<li>'. htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '（'.$population_area.'）</li>' ;
   					} else{
	 	     			//echo '<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8').'" >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
	 	     			echo '<li><a href="./friends.php?from_id=' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8'). ' "> '. htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '（'.$population_area.'）</a></li>' ;
						//var_dump(htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8'));
					}
			}
		}
	// 取得結果を開放して接続を閉じる
	mysql_free_result($result);	
?>

<!-- </ul> 
		</select>
    <input type="submit" value="検索" size=120 />
</form>
-->

	<h3><a href="http://192.168.33.10/new_friend.php"><font>おともだちの登録</font></a></h3>
	<h3><a href="http://192.168.33.10/index.html"><font>Top</font></a></h3>

</body>
</html>
