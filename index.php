<? //generate token
	session_start();
	$_SESSION['token'] = md5(uniqid(rand(), true));
?>
<html>
<body>
<b>Example:</b>
<div>
5 5<br/>
1 2 N<br/>
LMLMLMLMM<br/>
3 3 E<br/>
MMRMMRMRRM<br/>
</div>
<form action="post.php" method="POST">
	<input type="hidden" name="token" value="<?=$_SESSION['token'];?>"/>
	<textarea name="input" rows="5"></textarea>
	<input type="submit" value="Send"/>
</form>

</body>
</html>