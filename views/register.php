<?php session_start() ?>
    <div id="content" class="row">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="index.php?pg=register" method="post">
            <label>First Name:</label>
            <input type="text" name="fname"><br>
            
            <label>Last Name:</label>
            <input type="text" name="lname"><br>

            <label>Role:</label>
            <input type="text" name="role" value="Guest" disabled="disabled"><br>

            <label>Photo:</label>
            <input type="file" name="photo"><br>

            <label>Username</label>
            <input type="text" name="username"> <br>

            <label>Password</label>
            <input type="password" name="password"> <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="register" name="register">
            </div>
            <p>Already have an account? <a href="index.php?pg=login">Login here</a>.</p>
        </form>
    </div>    