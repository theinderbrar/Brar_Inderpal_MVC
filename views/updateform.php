<?php session_start() ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>Personnel Database</title>
</head>

<?php 
// Check if a file was uploaded
if(isset($_FILES['image'])) {
  $image = $_FILES['image'];

  // Check for errors in the uploaded file
  if($image['error'] === 0) {
    // Create a unique file name
    $filename = uniqid() . '-' . $image['name'];

    // Move the uploaded file to the images folder
    move_uploaded_file($image['tmp_name'], 'images/' . $filename);

  } else {
    // Handle error uploading file
    echo "Error uploading try again";
  }
}
?>

<div id="content" class="row">
    <form method="POST" enctype = "multipart/form-data" action="employee.php?task=update&id=<?php echo $employee[0]->id; ?>">
        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $employee[0]->emp_lname; ?>"><br>

        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $employee[0]->emp_fname; ?>"><br>

        <label>Position:</label>
        <input type="text" name="position" value="<?php echo $employee[0]->emp_job; ?>"><br>

        <label>Photo:</label>
        <input type="file" name="photo"><br>
        <!-- <div class="col-5 med-col-2">
          <img id= "empImage" src="images/<?php echo $employee[0]->emp_image; ?>" alt="Employee image">
        </div> <br> -->

        <!-- <div class="col-12 med-col-2">
          <img id= "empImage" src="<?php echo $employee[0]->emp_thumb; ?>" alt="Employee Thumbnail" >
        </div> <br> -->
        <label>Thumbnail:</label>
        <input type="file" name="thumbnail"><br>

        <button  class="col-8 med-col-2" id= "updatebtn" type="submit" name="update" value="Update Employee">Update Employee</button>
    </form>

</div>
