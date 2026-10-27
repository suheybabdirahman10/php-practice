<?php

$success = false;
$nameErr = "";
$emailErr = "";
$uploadErrors = [];
$uploadedFiles = [];

if (isset($_POST["submit"])) {

$success = true;


if (empty($_POST["fullname"])) {
    $success = false;
    $nameErr = "Please fill name required fields<br>";
}
if (empty($_POST["email"])) {
    $success = false;
    $emailErr = "Please fill email required fields<br>";
}

if ($_FILES["cv"]["size"] > 1024 * 1024 ) { //1mb
    $success = false;
    $uploadErrors[] = "CV file size must not exceed 2 MB.";
}


if ($success) {
    $uploadFields = [
        "image" => [
            "label" => "Image",
            "directory" => "uploads/images",
            "types" => [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png",
                "gif" => "image/gif",
            ],
        ],
        "cv" => [
            "label" => "CV",
            "directory" => "uploads/cv",
            "types" => [
                "pdf" => "application/pdf"
            ],
          
        ]
    ];

    foreach ($uploadFields as $field => $settings) {
        if (!isset($_FILES[$field])) {
            continue;
        }

        $files = [];
        if ($field === "image") {
            foreach ($_FILES[$field]["name"] as $index => $name) {
                $files[] = [
                    "name" => $name,
                    "type" => $_FILES[$field]["type"][$index],
                    "tmp_name" => $_FILES[$field]["tmp_name"][$index],
                    "error" => $_FILES[$field]["error"][$index]
                ];
            }
        } else {
            $files[] = $_FILES[$field];
        }

        foreach ($files as $file) {
            if ($file["error"] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if ($file["error"] !== UPLOAD_ERR_OK) {
                $uploadErrors[] = $settings["label"] . " upload failed.";
                continue;
            }

            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo ? finfo_file($fileInfo, $file["tmp_name"]) : false;
            if ($fileInfo) {
                finfo_close($fileInfo);
            }

            if (
                !isset($settings["types"][$extension]) ||
                $mimeType !== $settings["types"][$extension]
            ) {
                $uploadErrors[] = "Please select a valid " . strtolower($settings["label"]) . " file.";
            } elseif (
                $field === "image" &&
                (($imageInfo = getimagesize($file["tmp_name"])) === false ||
                    $imageInfo["mime"] !== $settings["types"][$extension])
            ) {
                $uploadErrors[] = "The selected image file is invalid.";
            } else {
                if (!is_dir($settings["directory"]) && !mkdir($settings["directory"], 0755, true)) {
                    $uploadErrors[] = "Could not create the " . strtolower($settings["label"]) . " upload directory.";
                } else {
                    $filename = bin2hex(random_bytes(16)) . "." . $extension;
                    if (move_uploaded_file(
                        $file["tmp_name"],
                        $settings["directory"] . "/" . $filename
                    )) {
                        $uploadedFiles[$field][] = $filename;
                    } else {
                        $uploadErrors[] = $settings["label"] . " upload failed.";
                    }
                }
            }
        }
    }

    if ($uploadErrors) {
        $success = false;
    }
}

if ($success) {
    echo '<div class="container pt-4"><div class="row justify-content-center"><div class="col-md-8 col-lg-7">
        <div class="alert alert-success"><h4 class="alert-heading">Student Information</h4><hr>';
    echo "Fullname: " . htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8") . "<br>";
    echo "Email: " . htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8") . "<br>";
    echo "Education Level: " . htmlspecialchars($_POST["education"] ?? "", ENT_QUOTES, "UTF-8") . "<br>";

    if (!empty($_POST["gender"])) {
        echo "Gender: " . htmlspecialchars($_POST["gender"], ENT_QUOTES, "UTF-8") . "<br>";
    }

    echo "Job: " . htmlspecialchars($_POST["job"] ?? "", ENT_QUOTES, "UTF-8") . "<br>";
    echo "Skills: " . htmlspecialchars(implode(", ", $_POST["skills"] ?? []), ENT_QUOTES, "UTF-8") . "<br>";

    foreach ($uploadedFiles as $field => $filenames) {
        $label = $field === "image" ? "Image" : "CV";
        echo $label . ": " . htmlspecialchars(implode(", ", $filenames), ENT_QUOTES, "UTF-8") . "<br>";
    }

    echo '</div></div></div></div>';
}


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0">Job Registration Form</h2>
                </div>

                <div class="card-body">
                    <?php if ($uploadErrors) { ?>
                        <div class="alert alert-danger">
                            <?php foreach ($uploadErrors as $uploadError) { ?>
                                <div><?php echo htmlspecialchars($uploadError, ENT_QUOTES, "UTF-8"); ?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <form method="post" action="" enctype="multipart/form-data">
                        <fieldset>
                            <legend class="text-primary mb-3">Personal Information</legend>

                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                       placeholder="Enter your fullname"
                                       value="<?php if (!$success && isset($_POST["fullname"])) echo htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8"); ?>">
                                <div class="text-danger small"><?php echo htmlspecialchars($nameErr, ENT_QUOTES, "UTF-8"); ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter your email"
                                       value="<?php if (!$success && isset($_POST["email"])) echo htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8"); ?>">
                                <div class="text-danger small"><?php echo htmlspecialchars($emailErr, ENT_QUOTES, "UTF-8"); ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="education" class="form-label">Education Level</label>
                                <select class="form-select" name="education" id="education">
                                    <?php foreach (["High School", "Diploma", "Bachelor's Degree", "Master's Degree", "Doctorate"] as $educationOption) { ?>
                                        <option value="<?php echo htmlspecialchars($educationOption, ENT_QUOTES, "UTF-8"); ?>"
                                            <?php if (!$success && isset($_POST["education"]) && $_POST["education"] === $educationOption) echo "selected"; ?>>
                                            <?php echo htmlspecialchars($educationOption, ENT_QUOTES, "UTF-8"); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <?php foreach (["male" => "Male", "female" => "Female"] as $genderValue => $genderLabel) { ?>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="<?php echo $genderValue; ?>"
                                               name="gender" value="<?php echo $genderValue; ?>"
                                               <?php if (!$success && isset($_POST["gender"]) && $_POST["gender"] === $genderValue) echo "checked"; ?>>
                                        <label class="form-check-label" for="<?php echo $genderValue; ?>"><?php echo $genderLabel; ?></label>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="mb-3">
                                <label for="job" class="form-label">Job Position</label>
                                <select class="form-select" name="job" id="job">
                                    <?php foreach (["Teacher", "Engineer", "Doctor", "Businessman"] as $jobOption) { ?>
                                        <option value="<?php echo $jobOption; ?>"
                                            <?php if (!$success && isset($_POST["job"]) && $_POST["job"] === $jobOption) echo "selected"; ?>>
                                            <?php echo $jobOption; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Skills</label>
                                <?php foreach (["PHP", "HTML", "CSS", "JavaScript"] as $skill) { ?>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="skill-<?php echo strtolower($skill); ?>"
                                               name="skills[]" value="<?php echo $skill; ?>"
                                               <?php if (!$success && isset($_POST["skills"]) && in_array($skill, $_POST["skills"])) echo "checked"; ?>>
                                        <label class="form-check-label" for="skill-<?php echo strtolower($skill); ?>"><?php echo $skill; ?></label>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Images</label>
                                <input type="file" class="form-control" name="image[]" id="image" accept=".jpg,.jpeg,.png,.gif" multiple>
                                <div class="form-text">Select multiple JPG, PNG, or GIF images</div>
                            </div>

                            <div class="mb-4">
                                <label for="cv" class="form-label">Upload CV</label>
                                <input type="file" class="form-control" name="cv" id="cv" accept=".pdf">
                                <div class="form-text">PDF only</div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                <button type="reset" class="btn btn-outline-secondary">Clear</button>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    Job Registration System
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
