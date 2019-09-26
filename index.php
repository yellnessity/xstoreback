<?
session_start();
?>
<DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Apple-store</title>
<meta name:"description" content="Интернет-магазин Apple-техники" />
<meta name:"keywords" content="apple", "iphone", "айфон", "магазин", "эппл", "восьмёрка", "десятка" />
<meta lang="ru" />
<meta robots="index, follow" />
<meta property="og:title" content="Интернет-магазин Apple-Store">
<meta property="og:description" content="Самые выгодные цены на яблочную технику">
<meta property="og:image" content="http://ai-info.ru/RI-170018/shchukin-e/iphones.png">
<meta property="og:url" content="http://ai-info.ru/RI-170018/shchukin-e/index.php">
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
echo "<div class='s1'>apple</div>";
echo "<div class='s2'>store</div>";
echo "<div class='s3'>".'<image src="img/header.png" />'."</div>";


?>
</header>
<nav>
<ul class='s4'>
	<li class='s4'><a href="#1">iPhone</a></li>
	<li class='s4'><a href="#1">iPad</a></li>
	<li class='s4'><a href="#1">iWatch</a></li>
	<li class='s4'><a href="#1">Аксессуары</a></li>
</ul>
</nav>
<article>

</article>

<section>

<div class='itemX1'>
<p><strong>iPhone X</strong></p>
</div>
<div class='itemX'> <image src="img/iphonex.png" height="300" /></div>

<div class='item8pp'>
<p><strong>iPhone 8+</strong></p>
</div>
<div class='item8p'><image src="img/iphone8p.png" height="300" /></div>

 <div class='item81'>
 <p><strong>iPhone 8</strong></p>
</div>
<div class='item8'><image src="img/iphone8.png" height="300" /></div>
</section>
<marquee background='red'>"Что-нибудь прикольненькое" с hover и скрытыми элементами будет доработано. Но это неточно.</marquee>
<article>
<p class="bold" align="center"><a name='show'>Что пишут клиенты о нашем магазине:<p></a>
<fieldset>
<div class='flexbox'>
<?

	include 'model.php';
	$host = 'localhost';
	$user = 'u10278_new';
	$pass = 'WKq7mXgPPHRjPkH';
	$db = 'u10278_ai';
	$conn=connect_comments($host,$user,$pass,$db);

	if ((isset($_SESSION['login']) && isset($_SESSION['id'])) && isset($_GET['action']))
			{
				include ("tpl/menu.php");
			}	
	elseif (empty($_GET['action']) || ($_GET['action']!="log_in" && $_GET['action']!="logged_in"))
		{
			echo "<div class='authorize'>Чтобы получить доступ к комментариям, пожалуйста, <a href='index.php?action=log_in#show'>авторизуйтесь</a>.</div>";
			//include ("tpl/authorize.php");
		} 
		
	if (isset($_GET['action']) && $_GET['action']=="log_in")
                    include ("tpl/log_in.php");	
		
	elseif (isset($_GET['action']) && $_GET['action']=="logged_in"){
                    if (pass($conn) == TRUE) echo "Вы в системе.";//include ("tpl/menu.php");
	}	
		
	
			
	elseif (isset($_GET['action']) && $_GET['action']=="log_out"){
                    unset($_SESSION['password']);
                    unset($_SESSION['login']); 
                    unset($_SESSION['id']);
					unset($_SESSION['authorized']);
					include ("tpl/log_out.php");
	 }
	 
	
					
	if (isset ($_GET['action']) && $_GET['action']=='view' && isset($_SESSION['authorized']))
	{
		if ($comments_array = show_comments($conn))
		{	
			include 'tpl/show_comments.php';

		}
	
	}
	
	elseif (isset ($_GET['action']) && $_GET['action']=='del' && isset($_SESSION['authorized']))
	{
		if ($comments_array = show_comments($conn))
		{	
			include 'tpl/del_comment.php';
		}
	}
	
	elseif (isset ($_GET['action']) && $_GET['action']=='deleted')
	{
			del_comments($conn,$_POST['del']);
			
		if (del_comments($conn) == TRUE) echo "Комментарий удалён.</br>";
	}
	
	elseif (isset ($_GET['action']) && $_GET['action']=='add' && isset($_SESSION['authorized']))
	{
		include 'tpl/add_comment.php';
	}
	
	elseif (isset ($_GET['action']) && $_GET['action']=='added')
	{
		if (add_comments($conn) == TRUE) echo "Комментарий добавлен.</br>";
	}
  ?>
  <? /*
 // $rcomments=fopen("comments.txt", "r+");
// settype ($readcomments, "array");
// $readcomments=unserialize(fgets($rcomments));
// foreach ($readcomments as $rc) {
// 	echo "<h2>". $rc[0] ."</h2>";
// 	echo "<h3>". $rc[1] ."</h3>";
// 	echo "<p>". $rc[3] ."</p>";
// }
// fclose($rcomments);
// 
*/ 
?>
</div>
</fieldset>

</article>
<footer>
<p>Apple Store. 2018. All rights reserved. Вот так.</p>
</footer>
</body>
</html>