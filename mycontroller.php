<? ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Controller</title>
</head>

<body>
<?php 
	require ('mymodel.php'); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{ 
		insert_comment($_POST); 
		echo "<script language=javascript> window.location = 'mycontroller.php?news_id=".$_POST['news_id']."'; </script>";
		
	}
	else 
	{ 
		$news = get_news($_GET['news_id']); 
		$news_id = $news['news_id'];
		$comments = get_comments($_GET['news_id']);
		$nbre_comment=count($comments);
		require ('myview.php'); 
	} 
?>
</body>
</html>
<? ob_flush(); ?> 
