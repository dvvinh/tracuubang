<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My View</title>
</head>

<body>

<h1>Tin tức</h1>
	<div id="news">
	<h2><?php echo $news['titre'] ?> - <?php echo $news['date'] ?></h2>
	<p><?php echo $news['texte_nouvelle'] ?> </p>
	<h3><?php echo $nbre_comment ?> Bình luận cho tin này</h3>
		<?php foreach ($comments AS $comment) {?>
			<h3><?php echo $comment['auteur'] ?> đã viết <?php echo $comment['date'] ?></h3>
			<p><?php echo $comment['texte'] ?></p>
		<?php } ?>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="ajoutcomment">
		<input type="hidden" name="news_id" value="<?php echo $news_id ?>">
		<input type="text" name="auteur" size="30" value="Tên bạn"><br />
		<textarea name="texte" rows="5" cols="30">Nội dung bình luận</textarea><br />
		<input type="submit" name="submit" value="Gởi bình luận">
	</form>
	</div>

</body>
</html>
