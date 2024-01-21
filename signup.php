<?php
    require_once('header.php');
    
    try {
        $departments = get_all_departments();
    }
    catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }
    ?>
<div class="row">
    <div class="col-md-6 offset-md-3 align-self-center mt-3">
        <h2>Sign Up</h2>
        <form action="handle_signup.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullnameInput" class="form-label">Name</label>
                <input type="text" name="fullnameInput" class="form-control" id="fullnameInput" aria-describedby="fullnameHelp" placeholder="Please enter your full name">
                <div id="fullnameHelp" class="form-text">Your full name</div>
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email address</label>
                <input type="text" name="emailInput" class="form-control" id="emailInput" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">This will be the email you will use to login</div>
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="passwordInput" class="form-control" id="passwordInput">
            </div>
            <div class="mb-3">
                <label for="password2Input" class="form-label">Confirm Password</label>
                <input type="password" name="password2Input" class="form-control" id="password2Input">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" name="department" aria-label="Department" id="department">
                    <option selected>-- Select Department --</option>
                    <?php foreach ($departments as $current_department): ?>
                        <?= "<option value='{$current_department['id']}'>
                            {$current_department['departmentname']} ({$current_department['id']})
                        </option>"; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="locationInput" class="form-label">Location</label>
                <input type="text" class="form-control" id="locationInput" aria-describedby="locationHelp">
                <div id="locationHelp" class="form-text">Your location, i.e.: Los Angeles, CA</div>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</div>
<?php require_once('footer.php'); ?>