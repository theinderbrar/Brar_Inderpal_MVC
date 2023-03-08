<?php session_start() ?>
<div id="content" class="row">
<?php

echo 
			'<div class="col-12 med-col-2"><img id="empImage" alt="Employee Photo" src="images/'.$users[0]->photo.'"></div>
			<div id="empDetails" class="col-12 med-col-10"> <span class="centerDetails"><span class="label">Name:</span> '.$users[0]->lname.', '.$users[0]->fname.'<br>
			<span class="label">User ID:</span> '.$users[0]->id.'<br>
			<span class="label">Role:</span> '.$role[0]->name.'<br></span></div>'
		;
?>
<br><br>
<div id="content" class="row">
<?php	
echo '<a href="http://localhost:8888/index.php?task=delete&id='.$users[0]->id.'">delete user</a><br>';
echo '<a href="http://localhost:8888/index.php?task=update&id='.$users[0]->id.'">update user </a>';
?>
</div>