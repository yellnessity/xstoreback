
<?
settype ($comments, "array"); //array_push ругается
?>
<body>
<p> Оставьте отзыв о нашем магазине! </p>
<form action="index.php?action=added#show" method="POST" enctype="multipart/form-data"> </br>
Прикрепите ваш аватар</br>
<input type="file" name="file" /></br>
<label for="name">Ваше имя</label> </br>
<input type="text" name="name" /> </br>
<label for="email">Ваша почта</label></br>
<input type="email" name="email" /></br>
Понравился ли вам наш магазин?</br>
<input type="radio" name="feed" value="feed1"> Да</br>
<input type="radio" name="feed" value="feed2"> Нет</br>
<label for="comment">Напишите отзыв</label></br>
<textarea name="comment"></textarea></br>

<input type="submit" value="Оставьте отзыв" /></br>
</form>
 
<?
/* 
$fcomment=fopen ("comments.txt", "r");
$comments=unserialize(fgets($fcomment));
fclose($fcomment);

settype ($comments, "array");

array_push ($comments, array($_POST['username'], $_POST['email'], $_POST['feed'], $_POST['body']));

$fcomment=fopen ("comments.txt", "w+");
fputs ($fcomment, serialize($comments)); 
fclose($fcomment);

$fcomment=fopen ("comments.txt", "r");
$comments=unserialize(fgets($fcomment));
fclose($fcomment);

settype ($comments, "array");

foreach ($comments as $c){
	echo "<h2>". $c[0] ."</h2>";
	echo "<h3>". $c[1] ."</h3>";
	echo "<p>". $c[3] ."</p>";
}
?> */
