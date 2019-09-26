<?
	foreach ($comments_array as $key=>$value)
	{
	?>
		<div>
		<?
		if(isset ($value['img']) && $value['img']!='')
			echo '<img src="'. $value['img']. '"height="100px" width="100px" border="1px" /';
		?>
		</div>
		<h3> <?=$value['name']?> </h3>
		 <?=$value['email']?>
		<p><?=$value['comment']?></p>
		
<?
	}
?>
