<?php
    $errors = [];
    $success_message = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $required_fields = [
            'card_number' => 'Student number',
            'name' => 'Name',
            'birthday' => 'Birthday',
            'sex' => 'Sex',
            'phone' => 'Phone number',
            'email' => 'Email',
            'primary_contact' => 'Primary contact',
            'college' => 'College',
            'course' => 'Course'
        ];

        foreach ($required_fields as $field => $label) {
            if (empty($_POST[$field])) {
                $errors[] = "$label is required.";
            }
        }

        if (!empty($_POST['cardnumber']) && !preg_match("/^\d{9}$/", $_POST['cardnumber'])) {
            $errors[] = "Student number must be 9 digits and in numeric form.";
        }
        
        if (!empty($_POST['birthday']) && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['birthday'])) {
            $errors[] = "Birthday must be in YYYY-MM-DD format.";
        }

        if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address.";
        }

        if (!empty($_POST['phone']) && !preg_match("/^\+?\d{11}$/", $_POST['phone'])) {
            $errors[] = "Phone number must be valid and have 11 digits.";
        }

        $valid_sexes = ['Male', 'Female', 'Other', 'Not Specified'];
        if (!in_array($_POST['sex'], $valid_sexes)){
            $error[] = "Please select a valid option for sex.";
        }

        if (empty($errors)) {
            $success_message = "Registration Successful!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patron Form Validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="lab1.css">
</head>

<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 form-container">
                <?php
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger" id ="danger" role="alert"><ul class="mb-0" style= "list-style: none;">';
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo '</ul></div>';
                }
                if (!empty($success_message)) {
                    echo "<div class='alert alert-success' id ='success' role='alert'>$success_message</div>";
                }
                ?>
                <h2 class="mb-4">Registration</h2>
                <form i id="userinfo" method="POST" action="http://10.10.139.82:8000/api/patrons">
                    <div class="row g-2 ">
                        <div class="col-md-6">
                            <label for="card_number" class="form-label">Student Number:</label>
                            <input class="form-control" type="text" id="card_number" name="card_number" required>
                        </div>

                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                        </div>

                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Middle Name:</label>
                            <input type="text" class="form-control" name="middle_name" id="middle_name">
                        </div>

                        <div class="col-md-6">
                            <label for="lasr_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" id="last_name">
                        </div>

                        <div class="col-md-6">
                            <label for="birthday" class="form-label">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>

                        <div class="col-md-6">
                            <label for="sex" class="form-label">Sex:</label>
                            <select class="form-select" id="sex" name="sex">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                                <option value="not specified">Not Specified</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="house_no" class="form-label">House Number:</label>
                            <input type="text" class="form-control" id="house_no" name="house_no"
                                placeholder="House Number" required>
                        </div>

                        <div class="col-md-6">
                            <label for="street" class="form-label">Street:</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="Street"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="barangay" class="form-label">Barangay:</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Barangay"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                        </div>

                        <div class="col-md-6">
                            <label for="province" class="form-label">Province:</label>
                            <input type="text" class="form-control" id="province" name="province"
                                placeholder="Provinnce" required>
                        </div>

                        <div class="col-md-6">
                            <label for="zip" class="form-label">Zip Code:</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code" required>
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="col-md-4">
                            <label for="secondary_phone" class="form-label">Secondary Phone:</label>
                            <input type="tel" class="form-control" id="secondary_phone" name="secondary_phone">
                        </div>

                        <div class="col-md-4">
                            <label for="other_phone" class="form-label">Other Phone:</label>
                            <input type="tel" class="form-control" id="other_phone" name="other_phone">
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="col-md-4">
                            <label for="secondary_email" class="form-label">Secondary Email:</label>
                            <input type="email" class="form-control" id="secondary_email" name="secondary_email">
                        </div>

                        <div class="col-md-4">
                            <label for="primary_contact" class="form-label">Primary Contact:</label>
                            <select class="form-select" id="primary_contact" name="primary_contact">
                                <option value="">Select</option>
                                <option value="phone">Phone Number</option>
                                <option value="email">Email Address</option>
                        </select>
                        </div>
                        
                        <hr>

                        <div class="col-md-6">
                            <label for="college" class="form-label">College:</label>
                            <input type="text" class="form-control" id="college" name="college" required>
                        </div>

                        <div class="col-md-6">
                            <label for="course" class="form-label">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>

                        <div class="col-md-6">
                            <label for="registration_date" class="form-label">Registration Date:</label>
                            <input type="date" class="form-control" id="registration_date" name="registration_date"
                                value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="expiry_date" class="form-label">Expiration Date:</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" readonly>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn w-50">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
 const form = document.getElementById('form');
const errorContainer = document.querySelector('.error-messages');

form.addEventListener('submit', async event => {
  event.preventDefault();

  const data = new FormData(form);


  errorContainer.innerHTML = '';

  try {
    const res = await fetch(
      'http://10.10.139.82:8000/api/patrons',
      {
        method: 'POST',
        body: data,
      }
    );

    const resData = await res.json();
    console.log(resData);

    if (!res.ok) {

      if (resData.errors && typeof resData.errors === 'object') {

        for (let field in resData.errors) {
          const fieldErrors = resData.errors[field];

          fieldErrors.forEach(errorMessage => {
            const errorMessageElement = document.createElement('div');
            errorMessageElement.classList.add('alert', 'alert-danger');
            errorMessageElement.textContent = `${field.charAt(0).toUpperCase() + field.slice(1)}: ${errorMessage}`;
            errorContainer.appendChild(errorMessageElement);
          });
        }
      }
    } else {
 
      alert("Registration successful!");
    }
  } catch (err) {
    console.log(err.message);
  }
});

</script>