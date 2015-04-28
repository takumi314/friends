<?php
	//dデーターベース（オブジェクト）
	$link = mysql_connect('localhost','root','324032azzurro');   // $linkの中にmyseqlオブジェクトを入力

	$sql = "SET NAMES UTF-8"; 			// MySQL上に"UTF-8"をセットする
	mysql_query($sql);

	if (!$link) {	die('データーベースに接続できません:'. mysql_error()); }

	//データーベースを選択する。
	mysql_select_db('friends_system', $link);            // 注意：データベース名にテーブル名を入れてはいけない！

	//POSTなら保存処理実行
//	if ($_SERVER['REQUEST_METHOD'] === 'POST') {		// $_SERVWR WEBサーバーの情報やプログラム実行時の環境設定などが格納されている連想配列（ホスト名、IP、プロトコルなど）  
	

		//friends_idがGETなら削除処理を行う
		if (isset($_GET['friend_id'])) {

			$frind_id = $_GET['friend_id'];

			$sql = 'SELECT * FROM `friends_list` WHERE friend_id='.$frind_id. ';';	
			$result = mysql_query($sql, $link);

			//削除するためのSQL文を作成
			$sql_delate = 'DELETE FROM `friends_list` WHERE friend_id=' .$frind_id. ';';	
			mysql_query($sql_delate, $link);

			//削除完了を知らせる
			$post = mysql_fetch_assoc($result);	
			echo '『' .htmlspecialchars($post['name']). ' さん』がデータベースから削除されました。';


			//mysql_close($link);  //メモリを節約するために、ここで接続を切る。SQLへの接続は大変メモリが必要といえる。
		//var_dump('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		//	header('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

		}
//	}
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
	<h1>結果</h1>


<?php

	//前のページから送られたPOST(都道府県)を$areaに代入
	if (isset($_POST['from_id']) || isset($_GET['from_id'])) {
		
		$area = $_GET['from_id'];

		if (isset($_POST['from_id]'])) {
			$area = $_POST['from_id'];
				var_dump($_POST['from_id']);
		}
		
		//var_dump($area);

		if ($area == 0) {
			echo '<h4>都道府県名が選択されていません。</h4><br />';
			echo '<h4>どれかを選択しましょう。</h4>';
		} else{
			//投稿された内容を取得するSQlを作成して結果を取得
			$sql = "SELECT * FROM `friends_list` WHERE from_id=".$area.";";	
			$result = mysql_query($sql, $link);

			if ($result !== false && mysql_num_rows($result)){
				echo '<ul>';	
					while ($post = mysql_fetch_assoc($result)){
							
							echo 	htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($post['gender'], ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($post['age'], ENT_QUOTES, 'UTF-8') ;      
							//変更ボタンの生成
					//		echo 	'<form action="friends_edit.php" method="post">';
					//		echo 	'<input type="hidden" name="friend_id" value="'.htmlspecialchars($post['friend_id'], ENT_QUOTES, 'UTF-8').'" />';
					//		echo 	'<input type="submit" name="edit" value="変更"/>';
					//		echo    '</form>';
						
							echo '<a href="./friends_edit.php?friend_id=' .htmlspecialchars($post['friend_id'], ENT_QUOTES, 'UTF-8'). ' ">変更</a>  ';
						
							//削除ボタンの生成
							//echo '<form action="friends.php" mothod="post">';
							//echo '<input type="hidden" name="friend_id" value="'.htmlspecialchars($post['friend_id'], ENT_QUOTES, 'UTF-8').'" />';
							//echo '<input name="from_if" type="hidden" value='.$post['from_id'].'/>';
							//echo '<input type="submit" name="delate" value="削除"/>';
							//echo '</form>';

							echo '<a href="./friends.php?friend_id=' .htmlspecialchars($post['friend_id'], ENT_QUOTES, 'UTF-8'). ' ">削除</a><br />';
							
  
					} 
			echo '</ul>';
			//取得結果を開放する。
			mysql_free_result($result);

		} else{	echo '<h3> 該当するおともだちはいません。</h3>';	}
	}

	// 接続を閉じる
	mysql_close($link);

	}


?>

	<!--  <a href="./new_friend.php?from_id=<?php echo $area; ?>" >新規登録</a>   -->
	<!--  都道府県IDを持って、次のページに橋渡し -->
	<form action="new_friend.php" method="post">
		<input name="area_id" type="hidden" value=<?php echo $area; ?> />   <!--  valueに代入するときは""を付けてはならない。（正）value = 4  -->
		<input type="button" onclick="history.back()" value="戻る" />
		<input type="submit" value="新規登録"/>
	</form>

	<br />
	<a href="./areas.php">都道府県一覧</a> 
	<h3><a href="http://192.168.33.10/index.html"><font>Top</font></a></h3>

	

</body>
</html>