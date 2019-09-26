
	<form action="index.php?action=deleted#show" method="POST">

	<?

	$i=1;

	$comments = show_comments ($conn);

	foreach ($comments as $key=>$value)

	{

		echo "

			<p> 

				<label><input type='checkbox' name='del[]' value=".$value['id'].">".$i.".".$value['name']."</br>".

				$value['email']."</br>"

				.$value['comment']."</br></label>

			</p>";

		$i++;

	}

	?>

	<input value="Удалить" type="submit" />

	</form>

