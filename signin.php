<?php
    require_once('header.php');
    

    if ($_POST) {
        // If the form is submitted...
        // Validate form data
        $errors = [];
     
        if (!$_POST['emailInput']) {
            $errors[] = "Email field is required";
        }
        
        if (!$_POST['passwordInput']) {
            $errors[] = "Password field is required";
        }

        if (!count($errors)) {
            // Authenticate user
            $user = authenticate_user($_POST['emailInput'], $_POST['passwordInput']);
            if (!$user) {
                $errors[] = "Invalid email or password";
            }
        }

        if (count($errors) == 0) {
            // Logged in successfully
            $_SESSION['user'] = $user;
            header('Location: index.php');
        }
    }
?>
<div class="row">
    <div class="col-md-6 offset-md-3 align-self-center mt-3 pb-3">
        <h2>Sign In</h2>
        <form action="signin.php" id="signin-form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email address</label>
                <input type="email" name="emailInput" class="form-control" id="emailInput" email required>
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="passwordInput" class="form-control" id="passwordInput" minlength="8" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>
</div>
<script>
$(function() {
    $("#signin-form").validate();
});
</script>
<?php require_once('footer.php'); ?>