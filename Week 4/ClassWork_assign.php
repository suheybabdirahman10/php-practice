<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries and Student Transcript</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #555; padding: 6px 10px; text-align: left; }
        .warning { background-color: #fff3a3; }
        .fail { background-color: #f8b4b4; }
        .pass { background-color: #f6fcf8; }
    </style>
</head>
<body>
<?php

$world = array(
    "somalia" => array("mogadishu"),
    "kenya" => array("nairobi", "mombasa"),
    "Egypt" => array("cairo", "alexandria"),
    "south africa" => array("cape town", "johannesburg"),
    "argentina" => array("buenos aires", "cordoba"),
    "brazil" => array("rio de janeiro", "sao paulo"),
);

function getCities($country) {
    echo "<table border='1'>";
    echo "<tr><th>Cities in $country</th></tr>";
    global $world;
    if (isset($world[$country])) {
        foreach ($world[$country] as $city) {
            echo "<tr><td>$city</td></tr>";
        }
    } else {
        echo "<tr><td>Country not found.</td></tr>";
    }
    echo "</table>";
}

getCities("somalia");
echo "<br>";
getCities("kenya");
echo "<br>";
getCities("Egypt");
echo "<br>";
getCities("south africa");
echo "<br>";
getCities("argentina");
echo "<br>";
getCities("brazil");




// Question 5
$transcript = array(
    "Semester 1" => array(
        "subject1" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
        "subject2" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
        "subject3" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
    ),
    "Semester 2" => array(
        "subject1" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 10),
        "subject2" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 0),
        "subject3" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
    )
);

echo "<h2>Student Transcript by Semester</h2>";
echo "<table>";
echo "<tr><th>Semester</th><th>Course</th><th>CW1</th><th>MidTerm</th><th>CW2</th><th>Final</th><th>Total</th><th>Status</th></tr>";
foreach ($transcript as $semester => $courses) {
    foreach ($courses as $course => $marks) {
        $courseTotal = 0;
        foreach ($marks as $mark) {
            $courseTotal += $mark;
        }
        $status = "Fail";
        if ($courseTotal >= 50) {
            $status = "Pass";
        }
        if ($courseTotal < 50) {
            $statusClass = "fail";
        } elseif ($courseTotal <= 60) {
            $statusClass = "warning";
        } else {
            $statusClass = "pass";
        }
        echo "<tr class='" . $statusClass . "'><td>" . $semester . "</td><td>" . $course . "</td>";
        foreach ($marks as $mark) {
            echo "<td>" . $mark . "</td>";
        }
        echo "<td><strong>" . $courseTotal . "</strong></td>";
        echo "<td>" . $status . "</td></tr>";
    }
}
echo "</table>";
?>
</body>
</html>