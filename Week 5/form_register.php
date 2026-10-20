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
</head>
<body>
    
<form method="get" action="">

<h1>Student Registration Form</h1>

<fieldset>
    <legend>Personal Info </legend>

    <?php
       if (isset($errMsg)) echo $errMsg . "<br>";
    ?>

<label for="">Fullname: </label>
<input type="text" name="fullname"><br><br>

<label for="">Email: </label>
<input type="email" name="email"><br><br>

<label for="">Place of Birth: </label>
<input type="text" name="pob" id=""> <br><br>

<label for="">Gender: </label>
<input type="radio" name="gender" value="male"> Male
<input type="radio" name="gender" value="female"> Female <br><br>

<label for="">Faculty: </label>
<select name="faculty" id="">
    <option value="computer">Computer and IT</option>
    <option value="medicine">Medicine and Health Science</option>
    <option value="engineering">Engineering</option>
    <option value="ecom">Business</option>
</select> <br><br>

<label for="">Languages: </label>
<input type="checkbox" name="languages[]" value="Somali">Somali
<input type="checkbox" name="languages[]" value="English">English
<input type="checkbox" name="languages[]" value="Arabic">Arabic
<input type="checkbox" name="languages[]" value="Chinese">Chinese <br><br>

<label for="">Comment: </label>
<textarea name="comment" id="" rows="4" cols="30"></textarea><br><br>

<input type="submit" name="submit" value="Register">
<input type="reset" name="reset" value="Clear">

</fieldset>

</form>

</body>
</html>


