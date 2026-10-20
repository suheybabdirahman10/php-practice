<?php

$errName = "";
$errEmail = "";
$errPob = "";
$errGender = "";
$errFaculty = "";
$errLanguages = "";
$errComment = "";

if (isset($_POST["submit"])) {

    // 1. Fullname validation
    if (empty(trim($_POST["fullname"] ?? ""))) {
        $errName = "Full name is required.";
    }

    // 2. Email validation
    if (empty(trim($_POST["email"] ?? ""))) {
        $errEmail = "Email is required.";
    }

    // 3. Place of Birth validation
    if (empty(trim($_POST["pob"] ?? ""))) {
        $errPob = "Place of Birth is required.";
    }

    // 4. Gender validation
    if (empty($_POST["gender"])) {
        $errGender = "Please select your gender.";
    }

    // 5. Faculty validation
    if (empty($_POST["faculty"])) {
        $errFaculty = "Please select your faculty.";
    }

    // 6. Languages validation
    if (empty($_POST["languages"]) || !is_array($_POST["languages"])) {
        $errLanguages = "Please select at least one language.";
    }

    // 7. Comment validation
    if (empty(trim($_POST["comment"] ?? ""))) {
        $errComment = "Comment is required.";
    }

    // Display Student Information only when all required fields are valid
    if (empty($errName) && empty($errEmail) && empty($errPob) && empty($errGender) && empty($errFaculty) && empty($errLanguages) && empty($errComment)) {
        echo "<div class='result-box'>";
        echo "<h2>Student Information</h2>";

        echo "Fullname: " . htmlspecialchars($_POST["fullname"]) . "<br>";
        echo "Email: " . htmlspecialchars($_POST["email"]) . "<br>";
        echo "Place of Birth: " . htmlspecialchars($_POST["pob"]) . "<br>";
        echo "Gender: " . htmlspecialchars($_POST["gender"]) . "<br>";
        echo "Faculty: " . htmlspecialchars($_POST["faculty"]) . "<br>";

        echo "Languages: ";
        foreach ($_POST["languages"] as $value) {
            echo htmlspecialchars($value) . ", ";
        }
        echo "<br>";

        echo "Comment: " . nl2br(htmlspecialchars($_POST["comment"])) . "<br>";
        echo "</div>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        .error-msg {
            color:red;
        }
    </style>
</head>
<body>
    
<form method="post" action="">

<h1>Student Registration Form</h1>

<fieldset>
    <legend>Personal Info </legend>

<label for="">Fullname: </label><br>
<input type="text" name="fullname" class="<?php if(!empty($errName)) echo 'input-error'; ?>" value="<?php if(isset($_POST['fullname'])) echo htmlspecialchars($_POST['fullname']); ?>"><br>
<?php if (!empty($errName)) echo "<span class='error-msg'>$errName</span>"; ?><br>
<label for="">Email: </label><?php if (!empty($errEmail)) echo "<span class='error-msg'>$errEmail</span>"; ?><br>
<input type="email" name="email" class="<?php if(!empty($errEmail)) echo 'input-error'; ?>" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>"><br><br>

<label for="">Place of Birth: </label><?php if (!empty($errPob)) echo "<span class='error-msg'>$errPob</span>"; ?><br>
<input type="text" name="pob" id="" class="<?php if(!empty($errPob)) echo 'input-error'; ?>" value="<?php if(isset($_POST['pob'])) echo htmlspecialchars($_POST['pob']); ?>"><br><br>

<label for="">Gender: </label><?php if (!empty($errGender)) echo "<span class='error-msg'>$errGender</span>"; ?><br>
<span class="<?php if(!empty($errGender)) echo 'choice-error'; ?>">
<input type="radio" name="gender" value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] === 'male') echo 'checked'; ?>> Male
<input type="radio" name="gender" value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] === 'female') echo 'checked'; ?>> Female
</span><br><br>

<label for="">Faculty: </label><?php if (!empty($errFaculty)) echo "<span class='error-msg'>$errFaculty</span>"; ?><br>
<select name="faculty" id="" class="<?php if(!empty($errFaculty)) echo 'input-error'; ?>">
    <option value="">-- Select Faculty --</option>
    <option value="computer" <?php if(isset($_POST['faculty']) && $_POST['faculty'] === 'computer') echo 'selected'; ?>>Computer and IT</option>
    <option value="medicine" <?php if(isset($_POST['faculty']) && $_POST['faculty'] === 'medicine') echo 'selected'; ?>>Medicine and Health Science</option>
    <option value="engineering" <?php if(isset($_POST['faculty']) && $_POST['faculty'] === 'engineering') echo 'selected'; ?>>Engineering</option>
    <option value="ecom" <?php if(isset($_POST['faculty']) && $_POST['faculty'] === 'ecom') echo 'selected'; ?>>Business</option>
</select><br><br>

<label for="">Languages: </label><?php if (!empty($errLanguages)) echo "<span class='error-msg'>$errLanguages</span>"; ?><br>
<span class="<?php if(!empty($errLanguages)) echo 'choice-error'; ?>">
<input type="checkbox" name="languages[]" value="Somali" <?php if(isset($_POST['languages']) && is_array($_POST['languages']) && in_array('Somali', $ _POST['languages'])) echo 'checked'; ?>>Somali
<input type="checkbox" name="languages[]" value="English" <?php if(isset($_POST['languages']) && is_array($_POST['languages']) && in_array('English', $_POST['languages'])) echo 'checked'; ?>>English
<input type="checkbox" name="languages[]" value="Arabic" <?php if(isset($_POST['languages']) && is_array($_POST['languages']) && in_array('Arabic', $_POST['languages'])) echo 'checked'; ?>>Arabic
<input type="checkbox" name="languages[]" value="Chinese" <?php if(isset($_POST['languages']) && is_array($_POST['languages']) && in_array('Chinese', $_POST['languages'])) echo 'checked'; ?>>Chinese
</span><br><br>

<label for="">Comment: </label><?php if (!empty($errComment)) echo "<span class='error-msg'>$errComment</span>"; ?><br>
<textarea name="comment" id="" rows="4" cols="30" class="<?php if(!empty($errComment)) echo 'input-error'; ?>"><?php if(isset($_POST['comment'])) echo htmlspecialchars($_POST['comment']); ?></textarea><br><br>

<input type="submit" name="submit" value="Register">
<input type="reset" name="reset" value="Clear" onclick="window.location.href='form_register.php';">

</fieldset>

</form>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Automatically remove red border and error message when user corrects the field
    const fields = document.querySelectorAll("input, select, textarea");
    fields.forEach(function (field) {
        function clearError() {
            field.classList.remove("input-error");
            const parentChoice = field.closest(".choice-error");
            if (parentChoice) {
                parentChoice.classList.remove("choice-error");
            }

            // Find preceding error message
            let prev = field.previousElementSibling;
            while (prev) {
                if (prev.classList && prev.classList.contains("error-msg")) {
                    prev.style.display = "none";
                    break;
                }
                if (prev.tagName === "LABEL") {
                    const msg = prev.nextElementSibling;
                    if (msg && msg.classList && msg.classList.contains("error-msg")) {
                        msg.style.display = "none";
                    }
                    break;
                }
                prev = prev.previousElementSibling;
            }
        }

        field.addEventListener("input", clearError);
        field.addEventListener("change", clearError);
    });
});
</script>

</body>
</html>
