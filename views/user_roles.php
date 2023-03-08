<?php session_start() ?>
<div id="content" class="row">
	<ul>
		<?php
		for($i = 0; $i < $rows; $i++) { 
			echo '<a class="col-12 med-col-6" href="index.php?task=rolechange&id='.$users[$i]->id.'"><li>'.$users[$i]->fname.' '.$users[$i]->lname.'</li></a>';
		}
		?>
	</ul>
</div>
<div id="content" class="row"><a href="http://localhost:8888/index.php?task=create"> create new employee</a></div>
<?php 
if($_SESSION['role'] === 3 ){
	echo '<div id="content" class="row"><a href="http://localhost:8888/index.php?task=rolechange"> Manage Roles</a></div>';
}
?>