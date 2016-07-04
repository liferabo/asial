<?php

require_once("function.php");

init();

//このページ用の変数を初期化
$error_mes = "";
$checked1 = "checked";
$checked2 = "";
$keyword = "";
$type = "";

if(!isset($_POST["type"])){
	$_POST["type"] = "";
}

print("a");

//検索ボタンがクリックされたとき
if(isset($_POST["mode"]) && $_POST["mode"] == "search"){
	$keyword = $_POST["keyword"];
	$type = $_POST["type"];

	switch($_POST["type"]){
		case 1:
			$checked1 = "checked";
			break;
		case 2:
			$checked2 = "checked";
			break;
		default:
			$checked1 = "checked";
			break;
	}
	//データを検索する
	$data = bbs_search_view($keyword, $type);
var_dump($data);
	//キーワードをエスケープする
	$keyword = htmlspecialchars($keyword, ENT_QUOTES);

	//検索した結果が0件だったらメッセージを保持する
	if(count($data) == 0){

?>
<dl class="message"> 
        <dt class="msg-label">投稿日時</dt> 
        <dd class="msg-date"><?php print $data[$i]["date"]; print $data[$i]["del"]; ?></dd> 
        <dt class="msg-label">名前</dt> 
        <dd class="msg-name"><?php print $data[$i]["name"]; ?></dd> 
        <dt class="msg-label">タイトル</dt> 
        <dd class="msg-title"><?php print $data[$i]["title"]; ?></dd> 
        <dt class="msg-label">本文</dt> 
        <dd class="msg-body"><?php print $data[$i]["body"]; ?></dd> 
</dl>
<?php
	}else{
		$checked1 = "checked";
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>掲示板検索フォーム</title>
<style type="text/css">

    * { margin: 0px; padding: 0px; } 
    body { margin-left: 10%; margin-right: 10%;  
padding-bottom: 1em; color: #333333; background-color: #E0E0E0;} 
    h1 { padding: 10px; border: 1px solid #BDBDBD;  
font-size: 1.2em; color: #545454; background-color: #FFFFFF; } 
    hr { display: none; } 
    table { margin-bottom: 1em;  } 
    dt { clear: left; float: left; width: 5em; margin-bottom: 5px; } 
    dd { margin-bottom: 5px; } 
    form {margin-bottom: 1em; padding: 10px;  
border-left: 1px solid #BDBDBD; border-bottom: 1px solid #BDBDBD;  
border-right: 1px solid #BDBDBD; color: #333333;  
background-color: #EAEAEA; } 
    #keyword, #title { width: 15em; } 
    #submit { font-size: 1em; margin-left: 5em; } 
    .message { padding: 10px; margin-bottom: 1em;  
border: 1px solid #CBCBCB; color: #333333;  
background-color: #F9F9F9;} 
    .msg-label { color: #666666; background-color: transparent; } 
    .msg-body {margin-left: 5em; } 
    #navigation { text-align: right; } 
</style> 
</head>
<body> 
<h1>掲示板検索</h1>
<form action="search.php" method="post">
<dl>
	<dd><font color="#FF0000"><?php print $error_mes; ?></font></dd>
</dl>
<dl>
    <dt><label for="name">KeyWord</label></dt> 
    <dd><input type="text" id="keyword" name="keyword" value="<?php print $keyword; ?>"></dd>
    <dd><input type="radio" name="type" value="1" <?php print $checked1; ?>>AND
    	<input type="radio" name="type" value="2" <?php print $checked2; ?>>OR</dd>
</dl> 
<input type="hidden" name="mode" value="search"> 
<input type="submit" id="submit" value="検索"> 
</form> 
<a href="adminlogin.php">管理者ログイン</a> <a href="form.php">掲示板一覧</a>

<?php
if(!isset($i)){
	$i = "";
}
if(!isset($data[$i]["name"])){
	$data[$i]["name"] = "";
}
if(!isset($data[$i]["title"])){
	$data[$i]["title"] = "";
}
if(!isset($data[$i]["body"])){
	$data[$i]["body"] = "";
}

	$data[$i]["cnt"] = "";


if(isset($data)){
	for($i = 1; $i < count($data); $i++){
		$data[$i]["name"] = htmlspecialchars($data[$i]["name"], ENT_QUOTES);
		$data[$i]["title"] = htmlspecialchars($data[$i]["title"], ENT_QUOTES);
		$data[$i]["body"] = htmlspecialchars($data[$i]["body"], ENT_QUOTES);
		if(isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] == "1"){
			$data[$i]["del"] = "<a href=\"./form.php?mode=del&id={$data[$i]["cnt"]}\">削除</a>";
		}else{
			$data[$i]["del"] = "";
		}
	}
}

if(!isset($i)){
	$i = "";
}


if(!isset($data[$i]["date"])){
	$data[$i]["date"] = "";
}
if(!isset($data[$i]["del"])){
	$data[$i]["del"] = "";
}
if(!isset($data[$i]["name"])){
	$data[$i]["name"] = "";
}
if(!isset($data[$i]["title"])){
	$data[$i]["title"] = "";
}
if(!isset($data[$i]["body"])){
	$data[$i]["body"] = "";
}
?>
<hr>
<dl class="message"> 
        <dt class="msg-label">投稿日時</dt> 
        <dd class="msg-date"><?php print $data[$i]["date"]; print $data[$i]["del"]; ?></dd> 
        <dt class="msg-label">名前</dt> 
        <dd class="msg-name"><?php print $data[$i]["name"]; ?></dd> 
        <dt class="msg-label">タイトル</dt> 
        <dd class="msg-title"><?php print $data[$i]["title"]; ?></dd> 
        <dt class="msg-label">本文</dt> 
        <dd class="msg-body"><?php print $data[$i]["body"]; ?></dd> 
</dl>
<?php print "<hr>\n"; ?>
</body>
</html>