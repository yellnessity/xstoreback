<?

function connect_comments($host,$user,$pass,$db)
	{
		
		
		$conn=@(new mysqli($host,$user,$pass,$db));
		if (mysqli_connect_errno()){
			exit("Ошибка:".mysqli_connect_error());
		}
		$conn->query("SET CHARSET utf8");
		return $conn;
	}

function show_comments($conn)
	{
		$query="SELECT * FROM shchukin_comments ORDER by id ASC";
			$comm = $conn->query($query);
			while ($string = $comm->fetch_assoc())
			{
				$comments_array[]=$string;
			}
			return $comments_array;
	}


function add_comments($conn)
	{
		$uploadfile = NULL;
		if (is_uploaded_file($_FILES["file"]["tmp_name"]) && (($_FILES["file"]["type"]=="image/jpeg") || ($_FILES["file"]["type"]=="image/png") || ($_FILES["file"]["type"]=="image/gif")))
		{
			$uploaddir = 'img/uploads/';
			$ext = substr($_FILES['file']['name'], strpos($_FILES['file']['name'],'.'), strlen($_FILES['file']['name'])-1);
			$picname=uniqid('pic_');
			$uploadfile = $uploaddir . basename($picname);
			move_uploaded_file($_FILES["file"]["tmp_name"],$uploadfile);
		}
		$query="INSERT INTO shchukin_comments (name,email,comment,img) VALUES ('$_POST[name]','$_POST[email]','$_POST[comment]', '$uploadfile')";
		if ($conn->query($query)) {
			return TRUE;
		}
	}

function del_comments($conn)
	{
		
        foreach ($_POST['del'] as $key=>$value) {
			$query="SELECT img FROM shchukin_comments WHERE (shchukin_comments.id='$value')";
			$fb = $conn->query($query);
			while ($pic = $fb->fetch_assoc()) {
				if (isset($pic['img'])) {
					if (file_exists('img/uploads/$pic["img"].jpg') == TRUE) unlink ('img/uploads/$pic["img"].jpg'); 
					elseif (file_exists('img/uploads/$pic["img"].png') == TRUE) unlink ('img/uploads/$pic["img"png'); 
					elseif (file_exists('img/uploads/$pic["img"].gif') == TRUE) unlink ('img/uploads/$pic["img"].gif');
					elseif (file_exists($pic['img']) == TRUE) unlink ($pic['img']);
				}
				}
            $delete="DELETE FROM shchukin_comments WHERE (shchukin_comments.id='$value')";
			$conn->query($delete);
			}
    return TRUE;
    
	}
	
function pass($conn)
{ 

    if (($_POST['password'] == '') && ($_POST['login'] == '')) {
		echo "<p>Не надо тут нажимать кнопку, не введя данные.</p>";
		echo "<p><a href='http://ai-info.ru/RI-170018/shchukin-e/16/index.php?action=log_in#show'>Вернуться</a></p>";
	}
	elseif ($_POST['login'] == ''){
		echo"<p>Если ты не слеп, то увидел бы, что поле с логином пустое.</p>"; 
		echo "<p><a href='http://ai-info.ru/RI-170018/shchukin-e/16/index.php?action=log_in#show'>Вернуться</a></p>";
	}
    elseif ($_POST['password'] == ''){
		echo "<p>Если ты не слеп, то увидел бы, что поле с паролем пустое.</p>";
		echo "<p><a href='http://ai-info.ru/RI-170018/shchukin-e/16/index.php?action=log_in#show'>Вернуться</a></p>";	
	}
	
	elseif (isset($_POST['password']) && isset($_POST['login']))
	{   
		$login = $_POST['login'];
		$password = $_POST['password'];
		$user = mysqli_query($conn, "SELECT `id` FROM `shchukin_login` WHERE `login` = '$login' AND `password` = '$password'");
		if ($user == TRUE) $user_id = mysqli_fetch_array($user);        
			if (isset($user_id))
			{
				$_SESSION['password'] = $password; 
				$_SESSION['login'] = $login; 
				$_SESSION['id'] = $user_id['id']; 
				$_SESSION['authorized']=1;
				include ("tpl/menu.php");
				return TRUE;
			}  
			else
			{
				echo "<p>Так не пойдёт. Введи-ка правильные данные.</p>";
				echo "<p><a href='http://ai-info.ru/RI-170018/shchukin-e/16/index.php?action=log_in#show'>Вернуться</a></p>";	
			}
			   		
	}


}



function read_comments($fname)
{
	if (@$fname=fopen("comments.txt", "r"))
	{
		if ($comments=unserialize(fgets($fname)))
		{
			return $comments;
		}
		else 
			return FALSE;
		fclose($fname);
	}
	else
	{
		return FALSE;
	}
}
function added_comments($comments)
{
	array_push($comments, array($_POST['username'], $_POST['email'], $_POST['feed'], $_POST['body']));
    if (@$fcomment=fopen("comments.txt", "w+"))
	{
		fputs($fcomment, serialize($comments));
		fclose($fcomment);
		echo "Комментарий успешно добавлен";
	}
	else
	{
		return FALSE;
	}
}
function del_comment($comments)
{
	foreach(@$_POST['del'] as $d) {
		unset ($comments[$d]);
		}
		$comments=array_values($comments);
		

	if (@$fcomment=fopen("comments.txt", "w+"))
	{
	fputs($fcomment, serialize($comments));
	fclose($fcomment);
	echo "Комментарий удалён.";
	} 
	else
	{
		return FALSE;
	}
}
