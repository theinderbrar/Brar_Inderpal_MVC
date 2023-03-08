<?php session_start() ?>

<div id="content" class="row">
    <form method="POST" enctype = "multipart/form-data" action="index.php?task=update&id=<?php echo $user[0]->id; ?>">
        <div class="col-5 med-col-2">
          <img id= "empImage" src="images/<?php echo $user[0]->photo; ?>" alt="User image">
        </div> <br>
        <label>Last Name:</label>
        <input type="text" name="lname" disabled="disabled" value="<?php echo $user[0]->lname; ?>"><br>

        <label>First Name:</label>
        <input type="text" name="fname" disabled="disabled" value="<?php echo $user[0]->fname; ?>"><br>

        <label>Role:</label>
        <select name="role" id="role" value=<?php $user[0]->role ?>>
        <?php 
        for($i = 0; $i < count($userRoles); $i++) { 
			echo '<option class="col-12 med-col-6" name="role" value='.$userRoles[$i]->id.'> '.$userRoles[$i]->name.'</option>';
		}
        ?>
        </select><br>
        <button  id= "updatebtn" type="submit" name="update" value="Update Role">Update Role</button>

    </form>

</div>