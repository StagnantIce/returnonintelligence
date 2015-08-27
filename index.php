<html>
<body>
<? //generate token
	session_start();
	$_SESSION['token'] = md5(uniqid(rand(), true));
?>
<form action="post.php" method="POST">
	<input type="hidden" name="token" value="<?=$_SESSION['token'];?>"/>
	<textarea name="input" rows="5"></textarea>
	<input type="submit" value="Send"/>
</form>

</body>
</html>