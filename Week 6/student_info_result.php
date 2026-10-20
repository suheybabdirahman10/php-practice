<?php
session_start();

$student = $_SESSION["student_registration"] ?? null;
if (!is_array($student)) {
    header("Location: student_infoAssign.php");
    exit;
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

$rows = [
    "Student name" => $student["name"],
    "Place of birth" => $student["pob"],
    "Date of birth" => $student["dob"],
    "Address" => $student["address"],
    "Gender" => $student["gender"],
    "Telephone" => $student["telephone"],
    "Email" => $student["email"],
    "Parent/guardian name" => $student["parent_name"],
    "Parent/guardian telephone" => $student["parent_telephone"],
    "Relationship" => $student["relationship"],
    "Student ID" => $student["student_id"],
    "Faculty" => $student["faculty"],
    "Department" => $student["department"],
    "Class" => $student["class"],
    "Registration date" => $student["registration_date"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Complete | Jamhuriya University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<header class="bg-primary text-white py-4">
    <div class="container">
        <p class="text-uppercase small mb-1">Jamhuriya University of Science &amp; Technology</p>
        <h1 class="h3 mb-1">Registration Complete</h1>
        <p class="mb-0">Faculty of Computer &amp; IT</p>
    </div>
</header>

<main class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-success" role="status">
                        The student information was submitted successfully.
                    </div>
                    <div class="text-center mb-4">
                        <img
                            src="<?= escape($student["image"]) ?>"
                            alt="Student portrait"
                            class="rounded-circle border shadow-sm"
                            width="140"
                            height="140"
                            style="object-fit: cover;"
                        >
                    </div>
                    <h2 class="h4 mb-3">Submitted Student Information</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-4">
                            <tbody>
                                <?php foreach ($rows as $label => $value): ?>
                                    <tr>
                                        <th scope="row" class="table-primary" style="width: 35%;"><?= escape($label) ?></th>
                                        <td><?= escape($value) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row" class="table-primary">Student image</th>
                                    <td><?= escape(basename($student["image"])) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="student_infoAssign.php" class="btn btn-primary">Register another student</a>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
