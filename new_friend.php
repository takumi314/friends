<?php

//dデーターベース（オブジェクト）
$link = mysql_connect('localhost','root','324032azzurro');   // $linkの中にmyseqlオブジェクトを入力

$sql = "SET NAMES UTF-8"; 			// MySQL上に"UTF-8"をセットする
$result = mysql_query($sql);

if (!$link) {	die('データーベースに接続できません:'. mysql_error());  }

//データーベースを選択する。
mysql_select_db('friends_system', $link);   // 

//都道府県データを取得するために、SQlを作成して結果を取得
$sql = "SELECT * FROM `friends_system`.`todo-huken_list` ORDER BY `todo-huken_id` ASC" ;
$result = mysql_query($sql, $link);


//新規登録データが正しく入力されているかチェック　
if ( strlen($_POST['todo-huken']) > 0 && strlen($_POST['name'])>0 && strlen($_POST['gender'])>0 && strlen($_POST['age'])>0 ) {

	$from_if = mysql_real_escape_string($_POST['todo-huken']);

	//保存するためのSQL文を作成
	$sql = " INSERT INTO `friends_list` (`from_id`,`name`, `gender`, `age`) VALUES ('"
		   . mysql_real_escape_string($_POST['todo-huken']) . "','"
		   . mysql_real_escape_string($_POST['name']) . "','"
		   . mysql_real_escape_string($_POST['gender']) . "','"
		   . mysql_real_escape_string($_POST['age']) . "') ;";


	//保存する
	mysql_query($sql, $link);

	// 取得結果を開放して接続を閉じる
	mysql_free_result($result);
	mysql_close($link);


	//header('Location: http://192.168.33.10/friends.php?from_id='.$from_id.'¥' ') 


} elseif (strlen($_POST['name']) == 0) {
	echo '名前が入力されてません。もう一度登録し直して下さい。';
} elseif (strlen($_POST['age']) == 0){
	echo '年齢が入力されていません。';
}
else{
	echo '登録できませんでした。';
}




		//mysql_close($link);  //メモリを節約するために、ここで接続を切る。SQLへの接続は大変メモリが必要といえる。
		//ar_dump('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		//header('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>





<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
	<meta charset="UTF-8">
	<meta name="おともだちの登録" content="text/html; charaset=UTF-8">
	<title>おともだちの登録</title>
	<link rel="shortcut icon" href="iconのリンク先をここに" href="">
</head>
<body>

<?php
$area_id = $_POST['area_id'];
	//$area_id = $_GET['from_id'];   //GETデータを受け取る場合
var_dump($_POST['area_id']);
	//var_dump($_GET['from_id']);
?>

	<h1>おともだちの登録</h1>


<form action="new_friend.php" method="post" >

		名前: <input type="text" name="name" /><br />
		性別: <input type="radio" name="gender" value="女" checked="checked"> 女 <input type="radio" name="gender" value="男">男 <br />
		
		年齢: <input type="text" name="age" size="5" />齢<br />
		出身: <select name="todo-huken" onchange="dropsort()" >
       			 <option value=0> --- お友達の都道府県を選択してください --- </option>

	<?php    //データベースから取得した都道府県を順に表示する。
//var_dump(mysql_num_rows($result));
				if ($result !== false && mysql_num_rows($result)){

						while ($post = mysql_fetch_assoc($result)){ 
							//　前のページで表示していた都道府県を初期表示させる。
					 		if (htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8') == $area_id) {
					 	    	 	echo '出身地：<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8').'" selected >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
				 	   		} else{ echo '出身地：<option value="' .htmlspecialchars($post['todo-huken_id'], ENT_QUOTES, 'UTF-8').'" >' .htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'). '</option>';
						}
					}
				}
				
				// 取得結果を開放して接続を閉じる
				mysql_free_result($result);
				mysql_close($link);
	?>

				</select>

	<br /><br />
	<input name="area_id" type="hidden" value=<?php echo $area_id; ?> />   <!--  valueに代入するときは""を付けてはならない。（正）value = 4  -->
    <input type="button" onclick="history.back()" value="戻る" />
    <input type="submit" name="touroku" value="登録" size=120 />
    <input type="reset" value="クリア">
</form>

	<br />
	<h3><a href="http://192.168.33.10/areas.php"><font>戻る</font></a>   </h3>
	<a href="./areas.php">都道府県一覧</a> 
	<h3><a href="http://192.168.33.10/index.html"><font>Top</font></a></h3>

</body>
</html>






