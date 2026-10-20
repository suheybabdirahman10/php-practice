<?php
session_start();

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

function postedValue(string $key): string
{
    $value = $_POST[$key] ?? "";
    return is_string($value) ? trim($value) : "";
}

$fields = [
    "name" => "Student name",
    "pob" => "Place of birth",
    "dob" => "Date of birth",
    "address" => "Address",
    "gender" => "Gender",
    "telephone" => "Telephone",
    "email" => "Email",
    "parent_name" => "Parent/guardian name",
    "parent_telephone" => "Parent/guardian telephone",
    "relationship" => "Relationship",
    "student_id" => "Student ID",
    "faculty" => "Faculty",
    "department" => "Department",
    "class" => "Class",
    "registration_date" => "Registration date",
];

$values = array_fill_keys(array_keys($fields), "");
$nameErr = "";
$pobErr = "";
$dobErr = "";
$addressErr = "";
$genderErr = "";
$telephoneErr = "";
$emailErr = "";
$parentNameErr = "";
$parentTelephoneErr = "";
$relationshipErr = "";
$studentIdErr = "";
$facultyErr = "";
$departmentErr = "";
$classErr = "";
$registrationDateErr = "";
$imageErr = "";
$success = true;
$submitted = isset($_POST["submit"]);

if ($submitted) {
    $success = true;

    foreach ($fields as $key => $label) {
        $values[$key] = postedValue($key);
    }

    if ($values["name"] === "") {
        $nameErr = "Please enter the student name.";
        $success = false;
    } elseif (!preg_match("/^[\\p{L} ]+$/u", $values["name"])) {
        $nameErr = "Use letters and spaces only for the student name.";
        $success = false;
    }

    if ($values["pob"] === "") {
        $pobErr = "Please enter the place of birth.";
        $success = false;
    }

    if ($values["dob"] === "") {
        $dobErr = "Please enter the date of birth.";
        $success = false;
    } else {
        $date = DateTime::createFromFormat("!Y-m-d", $values["dob"]);
        if (!$date || $date->format("Y-m-d") !== $values["dob"]) {
            $dobErr = "Enter a valid date of birth.";
            $success = false;
        }
    }

    if ($values["address"] === "") {
        $addressErr = "Please enter the address.";
        $success = false;
    }

    if ($values["gender"] === "") {
        $genderErr = "Please select a gender.";
        $success = false;
    } elseif (!in_array($values["gender"], ["Female", "Male", "Other"], true)) {
        $genderErr = "Select a valid gender.";
        $success = false;
    }

    if ($values["telephone"] === "") {
        $telephoneErr = "Please enter the telephone number.";
        $success = false;
    }

    if ($values["email"] === "") {
        $emailErr = "Please enter the email address.";
        $success = false;
    } elseif (!filter_var($values["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Enter a valid email address.";
        $success = false;
    }

    if ($values["parent_name"] === "") {
        $parentNameErr = "Please enter the parent/guardian name.";
        $success = false;
    }

    if ($values["parent_telephone"] === "") {
        $parentTelephoneErr = "Please enter the parent/guardian telephone.";
        $success = false;
    }

    if ($values["relationship"] === "") {
        $relationshipErr = "Please enter the relationship.";
        $success = false;
    }

    if ($values["student_id"] === "") {
        $studentIdErr = "Please enter the student ID.";
        $success = false;
    }

    if ($values["faculty"] === "") {
        $facultyErr = "Please enter the faculty.";
        $success = false;
    }

    if ($values["department"] === "") {
        $departmentErr = "Please enter the department.";
        $success = false;
    }

    if ($values["class"] === "") {
        $classErr = "Please enter the class.";
        $success = false;
    }

    if ($values["registration_date"] === "") {
        $registrationDateErr = "Please enter the registration date.";
        $success = false;
    } else {
        $date = DateTime::createFromFormat("!Y-m-d", $values["registration_date"]);
        if (!$date || $date->format("Y-m-d") !== $values["registration_date"]) {
            $registrationDateErr = "Enter a valid registration date.";
            $success = false;
        }
    }

    $image = $_FILES["image"] ?? null;
    if (!is_array($image) || !isset($image["error"]) || $image["error"] === UPLOAD_ERR_NO_FILE) {
        $imageErr = "Please select a student image.";
        $success = false;
    } elseif ($image["error"] !== UPLOAD_ERR_OK) {
        $imageErr = "The image upload failed. Please select the image again.";
        $success = false;
    } elseif (($image["size"] ?? 0) > 5 * 1024 * 1024) {
        $imageErr = "The image must be 5 MB or smaller.";
        $success = false;
    } else {
        $extension = strtolower(pathinfo($image["name"] ?? "", PATHINFO_EXTENSION));
        $allowedTypes = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png",
            "gif" => "image/gif",
            "webp" => "image/webp",
        ];
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->file($image["tmp_name"]);
        $imageInfo = getimagesize($image["tmp_name"]);

        if (
            !isset($allowedTypes[$extension]) ||
            $mimeType !== $allowedTypes[$extension] ||
            $imageInfo === false ||
            $imageInfo["mime"] !== $allowedTypes[$extension]
        ) {
            $imageErr = "Upload a valid JPG, PNG, GIF, or WEBP image.";
            $success = false;
        }
    }

    if ($success) {
        $uploadDirectory = __DIR__ . DIRECTORY_SEPARATOR . "student_images";
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
            $imageErr = "The image could not be saved. Please try again.";
            $success = false;
        } else {
            $filename = bin2hex(random_bytes(16)) . "." . $extension;
            if (!move_uploaded_file($image["tmp_name"], $uploadDirectory . DIRECTORY_SEPARATOR . $filename)) {
                $imageErr = "The image could not be saved. Please try again.";
                $success = false;
            } else {
                $values["image"] = "student_images/" . $filename;
                $_SESSION["student_registration"] = $values;
                header("Location: student_info_result.php");
                exit;
            }
        }
    }

}

$firstInvalid = "";
foreach ([
    "name" => $nameErr,
    "pob" => $pobErr,
    "dob" => $dobErr,
    "address" => $addressErr,
    "gender" => $genderErr,
    "telephone" => $telephoneErr,
    "email" => $emailErr,
    "image" => $imageErr,
    "parent_name" => $parentNameErr,
    "parent_telephone" => $parentTelephoneErr,
    "relationship" => $relationshipErr,
    "student_id" => $studentIdErr,
    "faculty" => $facultyErr,
    "department" => $departmentErr,
    "class" => $classErr,
    "registration_date" => $registrationDateErr,
] as $field => $error) {
    if ($error !== "") {
        $firstInvalid = $field;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration | Jamhuriya University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<header class="bg-primary text-white py-4">
    <div class="container">
        <p class="text-uppercase small mb-1">Jamhuriya University of Science &amp; Technology</p>
        <h1 class="h3 mb-1">Student Registration</h1>
        <p class="mb-0">Faculty of Computer &amp; IT</p>
    </div>
</header>

<main class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h4 mb-4">Student Information Form</h2>

                    <?php if ($submitted && !$success): ?>
                        <div class="alert alert-danger" role="alert">
                            Please correct the highlighted fields and submit the form again.
                        </div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="MAX_FILE_SIZE" value="5242880">

                        <fieldset class="mb-4">
                            <legend class="h5 border-bottom pb-2 mb-3">Personal Information</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full name</label>
                                    <input type="text" id="name" name="name" class="form-control<?= $nameErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["name"]) ?>"<?= $firstInvalid === "name" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($nameErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="pob" class="form-label">Place of birth (POB)</label>
                                    <input type="text" id="pob" name="pob" class="form-control<?= $pobErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["pob"]) ?>"<?= $firstInvalid === "pob" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($pobErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="dob" class="form-label">Date of birth (DOB)</label>
                                    <input type="date" id="dob" name="dob" class="form-control<?= $dobErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["dob"]) ?>"<?= $firstInvalid === "dob" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($dobErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control<?= $addressErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["address"]) ?>"<?= $firstInvalid === "address" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($addressErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-select<?= $genderErr !== "" ? " is-invalid" : "" ?>"<?= $firstInvalid === "gender" ? " autofocus" : "" ?> required>
                                        <option value="">Select gender</option>
                                        <?php foreach (["Female", "Male", "Other"] as $gender): ?>
                                            <option value="<?= escape($gender) ?>"<?= $values["gender"] === $gender ? " selected" : "" ?>><?= escape($gender) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?= escape($genderErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="tel" id="telephone" name="telephone" class="form-control<?= $telephoneErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["telephone"]) ?>"<?= $firstInvalid === "telephone" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($telephoneErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control<?= $emailErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["email"]) ?>"<?= $firstInvalid === "email" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($emailErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Student image</label>
                                    <input type="file" id="image" name="image" class="form-control<?= $imageErr !== "" ? " is-invalid" : "" ?>" accept=".jpg,.jpeg,.png,.gif,.webp"<?= $firstInvalid === "image" ? " autofocus" : "" ?> required>
                                    <div class="form-text">JPG, PNG, GIF, or WEBP. Maximum size: 5 MB.</div>
                                    <span class="text-danger"><?= escape($imageErr) ?></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-4">
                            <legend class="h5 border-bottom pb-2 mb-3">Parent Information</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label">Parent/guardian name</label>
                                    <input type="text" id="parent_name" name="parent_name" class="form-control<?= $parentNameErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["parent_name"]) ?>"<?= $firstInvalid === "parent_name" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($parentNameErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_telephone" class="form-label">Parent/guardian telephone</label>
                                    <input type="tel" id="parent_telephone" name="parent_telephone" class="form-control<?= $parentTelephoneErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["parent_telephone"]) ?>"<?= $firstInvalid === "parent_telephone" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($parentTelephoneErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="relationship" class="form-label">Relationship to student</label>
                                    <input type="text" id="relationship" name="relationship" class="form-control<?= $relationshipErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["relationship"]) ?>"<?= $firstInvalid === "relationship" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($relationshipErr) ?></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="mb-4">
                            <legend class="h5 border-bottom pb-2 mb-3">Academic Information</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" id="student_id" name="student_id" class="form-control<?= $studentIdErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["student_id"]) ?>"<?= $firstInvalid === "student_id" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($studentIdErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="faculty" class="form-label">Faculty</label>
                                    <input type="text" id="faculty" name="faculty" class="form-control<?= $facultyErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["faculty"]) ?>"<?= $firstInvalid === "faculty" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($facultyErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" id="department" name="department" class="form-control<?= $departmentErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["department"]) ?>"<?= $firstInvalid === "department" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($departmentErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" id="class" name="class" class="form-control<?= $classErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["class"]) ?>"<?= $firstInvalid === "class" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($classErr) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="registration_date" class="form-label">Registration date</label>
                                    <input type="date" id="registration_date" name="registration_date" class="form-control<?= $registrationDateErr !== "" ? " is-invalid" : "" ?>" value="<?= escape($values["registration_date"]) ?>"<?= $firstInvalid === "registration_date" ? " autofocus" : "" ?> required>
                                    <span class="text-danger"><?= escape($registrationDateErr) ?></span>
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" name="submit" value="Register" class="btn btn-primary btn-lg">Register Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>