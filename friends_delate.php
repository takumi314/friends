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
	//名前が正しく入力されているかチェック

		if (isset($_GET['friend_id'])) {

			//削除するためのSQL文を作成
			$sql = 'DELETE FROM `friends_list` WHERE friend_id=' .$_GET['friend_id']. ';';	
	
			//$result = mysql_query($sql, $link);

		echo '削除が完了しました。';


			mysql_close($link);  //メモリを節約するために、ここで接続を切る。SQLへの接続は大変メモリが必要といえる。
		//var_dump('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		//	header('Location: http://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

		}

//	}


?>

