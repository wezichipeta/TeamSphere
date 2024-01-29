<?php
    require_once('header.php');
    
    try {
        $departments = get_all_departments();
    }
    catch (Exception $e) {
        echo $e->getMessage();
        exit;
    }

    if ($_POST) {
        // If the form is submitted...
        // Validate form data
        $errors = [];
        if (!$_POST['fullnameInput']) {
            $errors[] = "Full name field is required";
        }
        if (!$_POST['birthdayInput']) {
            $errors[] = "Birthday field is required";
        }
        if (!$_POST['emailInput']) {
            $errors[] = "Email field is required";
        }
        if (!$_POST['locationInput']) {
            $errors[] = "Location field is required";
        }
        if (!$_POST['department']) {
            $errors[] = "Department field is required";
        }
        if (!$_POST['passwordInput']) {
            $errors[] = "Password field is required";
        }

        if (count($errors) == 0) {
            // Everything ok, create new user
            $birthday= new DateTime( $_POST['birthdayInput']);
            $user_data = [
                'fullname' => $_POST['fullnameInput'],
                'email' => $_POST['emailInput'],
                'location' => $_POST['locationInput'],
                'department' => $_POST['department'],
                'birthday' => $birthday->format('Y-m-d'),
                'password' => $_POST['passwordInput'],
            ];
            
            create_new_user($user_data);
        }
        else {
            echo "<div class='alert alert-danger'>";
            echo "<ul>";
            foreach ($errors as $current_error) {
                echo "<li>{$current_error}</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }
    ?>
<div class="row">
    <div class="col-md-6 offset-md-3 align-self-center mt-3">
        <h2>Sign Up</h2>
        <form action="signup.php" id="signup-form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fullnameInput" class="form-label">Name</label>
                <input type="text" name="fullnameInput" class="form-control" id="fullnameInput" aria-describedby="fullnameHelp" placeholder="Please enter your full name" required>
                <div id="fullnameHelp" class="form-text">Your full name</div>
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email address</label>
                <input type="email" name="emailInput" class="form-control" id="emailInput" aria-describedby="emailHelp" email required>
                <div id="emailHelp" class="form-text">This will be the email you will use to login</div>
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" name="passwordInput" class="form-control" id="passwordInput" minlength="8" required>
            </div>
            <div class="mb-3">
                <label for="password2Input" class="form-label">Confirm Password</label>
                <input type="password" name="password2Input" class="form-control" id="password2Input" equalTo="#passwordInput">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" name="department" aria-label="Department" id="department" required>
                    <option value="" selected>-- Select Department --</option>
                    <?php foreach ($departments as $current_department): ?>
                        <?= "<option value='{$current_department['id']}'>
                            {$current_department['departmentname']} ({$current_department['id']})
                        </option>"; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="birthdayInput" class="form-label">Birthday</label>
                <input type="date" max="2005-01-01" name="birthdayInput" class="form-control" id="birthdayInput" aria-describedby="birthdayHelp" required date>
                <div id="birthdayHelp" class="form-text">Please enter your date of birth.</div>
            </div>
            <div class="mb-3">
                <label for="locationInput" class="form-label">Location</label>
                <input type="text" name="locationInput" class="form-control" id="locationInput" aria-describedby="locationHelp" required>
                <div id="locationHelp" class="form-text">Your location, i.e.: Los Angeles, CA</div>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</div>
<script>
$(function() {
    $("#signup-form").validate();

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.coords.latitude},${position.coords.longitude}&key=`;

            fetch(url)
            .then((response) => response.json())
            .then((data) => {
                const city = data.results[0].address_components.find((component) =>
                    component.types.includes("locality")
                ).long_name;

                const state = data.results[0].address_components.find((component) =>
                    component.types.includes("administrative_area_level_1")
                ).short_name;

                $('input[name="locationInput"]').val(`${city}, ${state}`);
            })
            .catch((error) => console.log(error));
        });
    }
    else {
        console.log("Geolocation is not supported by this browser.");
    }
});
</script>
<?php require_once('footer.php'); ?>