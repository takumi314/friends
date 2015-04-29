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
	mysql_select_db('friends_system', $link);   // 

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

 		<table>
<?php   //データベースから取得した都道府県を順に表示する。
	if ($result !== false && mysql_num_rows($result)){
			while ($post = mysql_fetch_assoc($result)){

				$sql = "SELECT count(*) FROM `friends_system`.`friends_list` LEFT OUTER JOIN `friends_system`.`todo-huken_list` ";
   				$sql .= "ON `friends_system`.`friends_list`.`from_id` = `friends_system`.`todo-huken_list`.`todo-huken_id` "; 
   				$sql .= "WHERE `friends_system`.`todo-huken_list`.`todo-huken_id` =".htmlspecialchars($post['todo-huken_id']).";";	
				//$sql_2 = "SELECT * FROM `friends_list` ";

   				//var_dump($sql);
   				$population_area = mysql_query($sql,$link);
   				$num = mysql_fetch_assoc($population_area);
   				
   					//人数が１人以上のときにリンクを有効とする
   					if ($num['count(*)'] == 0) {
   						echo '<td>'. htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '（'.$num['count(*)'].'）</td><br/>' ;
   					} else{
	 	     			//echo '<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8').'" >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
	 	     			echo '<td><a href="./friends.php?from_id=' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8'). ' "> '. htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '（'.$num['count(*)'].'）</a></td><br/>' ;
					}

				//mysql_free_result($population_area);

			}
		}
	// 取得結果を開放して接続を閉じる
	mysql_free_result($result);	

	$result = mysql_query($sql, $link);
?>
		</table>
<!-- </ul> 
		</select>
    <input type="submit" value="検索" size=120 />
</form>
-->

	<h3><a href="http://192.168.33.20/new_friend.php"><font>おともだちの登録</font></a></h3>  <!--$_SERVER['   ']に書き換える。-->
	<h3><a href="http://192.168.33.20/index.html"><font>Top</font></a></h3>

</body>
</html>
