<?php session_start() ?>
<div id="content" class="row">
<form method="POST" action="employee.php?task=create">
  <label>First Name:</label>
  <input type="text" name="fname"><br><br>
  
  <label>Last Name:</label>
  <input type="text" name="lname"><br><br>

  <label>Position:</label>
  <input type="text" name="position"><br><br>

  <label>Photo:</label>
  <input type="file" name="photo"><br><br>

  <label>Thumbnail:</label>
  <input type="file" name="thumbnail"><br><br>

  <input type="submit" name="submit" value="Create Employee">
</form>
</div>
