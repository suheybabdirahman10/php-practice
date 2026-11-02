<?php
$success= false;
$errMsg = "";
$fullNameError = "";
$emailError = "";
$phoneError = "";
$customerTypeError = "";
$addressError = "";
$notesError="";


if(isset($_POST['submit'])){
    $success = true;

    // Validate full name
    if(empty($_POST['fullName'])){
        $fullNameError = "please enter your full name.";
        $success = false;
    }

    // Validate email
    if(empty($_POST['email'])){
        $emailError = "please enter your email.";
        $success = false;
    } 

    // Validate phone number
    if(empty($_POST['phone'])){
        $phoneError = "please enter your phone number.";
        $success = false;
    }

    // Validate customer type
    if(empty($_POST['customerType'])){
        $customerTypeError = "please enter your customer type.";
        $success = false;
    }

    // Validate address
    if(empty($_POST['address'])){
        $addressError = "please enter your address.";
        $success = false;
    }

    // Validate notes
    if(empty($_POST['notes'])){
        $notesError = "please enter your notes.";
        $success = false;
    }

    if (!$success) {
        $errMsg = "Please fill all required fields.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
if($success){?>
    <div class="container py-4">
    <div class="alert alert-success">
    <h2 class="h4">Customer Information</h2>
    <table class="table table-bordered table-striped mb-0">
        <tr>
            <th scope="row">Full Name:</th>
            <td><?php echo $_POST["fullName"]; ?></td>
        </tr>
        <tr>
            <th scope="row">Email:</th>
            <td><?php echo $_POST["email"]; ?></td>
        </tr>
        <tr>
            <th scope="row">Phone:</th>
            <td><?php echo $_POST["phone"]; ?></td>
        </tr>
        <tr>
            <th scope="row">Customer Type:</th>
            <td><?php echo $_POST["customerType"]; ?></td>
        </tr>
        <tr>
            <th scope="row">Address:</th>
            <td><?php echo $_POST["address"]; ?></td>
        </tr>
        <tr>
            <th scope="row">Notes:</th>
            <td><?php echo $_POST["notes"]; ?></td>
        </tr>
    </table>
    </div>
    </div>
<?php } ?>
    

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Customer Form</h1>
                    </div>
                    <div class="card-body">

                    <!-- Display error message  -->
                      <?php if (!empty($errMsg)) { ?>
                        <div class="alert alert-danger"><?php echo $errMsg; ?></div>
                    <?php } ?>


    <form action="" method="post" id="customerForm">
            <!-- Full Name -->
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php if (!$success && isset($_POST["fullName"])) { echo $_POST["fullName"]; } ?>">
                <div id="fullNameError" class="invalid-feedback d-block"><?php echo $fullNameError; ?></div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if(!$success &&isset($_POST["email"])) echo($_POST["email"]); ?>">
                <div id="emailError" class="invalid-feedback d-block"><?php echo $emailError; ?></div>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php if(!$success &&isset($_POST["phone"])) echo($_POST["phone"]); ?>">
                <div id="phoneError" class="invalid-feedback d-block"><?php echo $phoneError; ?></div>
            </div>

            <!-- Customer Type -->
            <div class="mb-3">
                <label for="customerType" class="form-label">Customer Type:</label>
                <select class="form-select" id="customerType" name="customerType">
                    <option value="">Select Customer Type</option>
                    <option value="Individual" <?php if(!$success &&isset($_POST["customerType"]) && $_POST["customerType"] == "Individual") echo "selected"; ?>>Individual</option>
                    <option value="Company" <?php if(!$success && isset($_POST["customerType"]) && $_POST["customerType"] == "Company") echo "selected"; ?>>Company</option>
                </select>
                <div id="customerTypeError" class="invalid-feedback d-block"><?php echo $customerTypeError; ?></div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address"><?php if(!$success &&isset($_POST["address"])) echo($_POST["address"]); ?></textarea>
                <div id="addressError" class="invalid-feedback d-block"><?php echo $addressError; ?></div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes:</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any additional notes"><?php if(!$success &&isset($_POST["notes"])) echo($_POST["notes"]); ?></textarea>
                <div id="notesError" class="invalid-feedback d-block"><?php echo $notesError; ?></div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#customerForm").on("submit", function(e){
                 // full name validation
                if($("#fullName").val().trim() === ""){
                    $("#fullNameError").text("Please enter your full name.");
                    e.preventDefault();
                    }


                    //email validation
                   if($("#email").val().trim() == ""){
                    $("#emailError").text("please enter your Email.")
                    e.preventDefault();
                   }

                //    phone validation
                if($("#phone").val().trim() == ""){
                    $("#phoneError").text("please enter your phone number.")
                    e.preventDefault();
                }

                // customer type validation
                if($("#customerType").val().trim() == ""){
                    $("#customerTypeError").text("please select your customer type.")
                    e.preventDefault();
                }

                // address validation
                if($("#address").val().trim() == ""){
                    $("#addressError").text("please enter your address.")
                    e.preventDefault();
                }

                // notes validation
                if($("#notes").val().trim() == ""){
                    $("#notesError").text("please enter your notes.")
                    e.preventDefault();
                }   

            })

});
</script>

               
    

</body>
</html>
