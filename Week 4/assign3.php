<?php
echo "<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: Segoe UI, Arial, sans-serif;
        background: #f5f5f5;
        color: #1f2937;
    }
    .container {
        max-width: 1150px;
        margin: 30px auto;
        padding: 20px;
    }
    .header {
        text-align: center;
        background: linear-gradient(135deg, #0f172a, #1d4ed8);
        color: #ffffff;
        padding: 30px 18px;
        border: 1px solid #1e3a8a;
        border-radius: 14px;
        margin-bottom: 22px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.18);
    }
    .header h1 {
        margin: 0 0 10px;
        font-size: 2.1rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        color: #ffffff;
    }
    .header h2 {
        margin: 6px 0;
        font-size: 1.08rem;
        font-weight: 700;
        color: #dbeafe;
    }
    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }
    .q-card {
        min-width: 0;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-left: 5px solid #3b82f6;
        border-radius: 12px;
        padding: 18px 18px 16px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
    }
    .q-card:nth-child(2n) { border-left-color: #10b981; }
    .q-card:nth-child(3n) { border-left-color: #f59e0b; }
    .q-card h3 {
        margin: 10px 0 12px;
        font-size: 1.08rem;
        color: #111827;
    }
    .badge {
        display: inline-block;
        background: #f3f4f6;
        color: #374151;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.03em;
    }
    .results {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 10px;
        margin-top: 14px;
    }
    .result-box {
        background: #ffffff;
        border: 1px solid #dfe7f3;
        border-radius: 8px;
        padding: 10px 12px;
    }
    .result-box strong {
        display: block;
        color: #1e3a8a;
    }
    .table-wrap {
        overflow-x: auto;
        background: #fff;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }
    th, td {
        border: 1px solid #dfe7f3;
        padding: 8px 6px;
        text-align: center;
        font-size: 0.93rem;
    }
    th {
        background: #f3f6ff;
        color: #1e3a8a;
        font-weight: 700;
    }
    .pass { color: #047857; font-weight: 700; }
    .fail { color: #b91c1c; font-weight: 700; }
    @media (max-width: 700px) {
        .container { margin: 12px auto; padding: 12px; }
        .header h1 { font-size: 1.6rem; }
        .q-card { padding: 14px; }
    }
</style>";

// Question 1
$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);
$numberTotal = 0;
$evenTotal = 0;
$oddTotal = 0;
$numberMin = $numbers[0];
$numberMax = $numbers[0];
$minimumPositions = "";
$maximumPositions = "";

foreach ($numbers as $index => $number) {
    $numberTotal += $number;

    if ($number % 2 == 0) {
        $evenTotal += $number;
    } else {
        $oddTotal += $number;
    }

    if ($number < $numberMin) {
        $numberMin = $number;
    }
    if ($number > $numberMax) {
        $numberMax = $number;
    }
}

foreach ($numbers as $index => $number) {
    if ($number == $numberMin) {
        if ($minimumPositions != "") {
            $minimumPositions .= ", ";
        }
        $minimumPositions .= ($index + 1);
    }
    if ($number == $numberMax) {
        if ($maximumPositions != "") {
            $maximumPositions .= ", ";
        }
        $maximumPositions .= ($index + 1);
    }
}

// Question 2
$colors = array("Red", "Green", "Blue");
$shades = array("Light", "Normal", "Dark");
$shadeColors = array();
foreach ($shades as $shade) {
    foreach ($colors as $color) {
        $shadeColors[$shade][$color] = $shade . " " . $color;
    }
}

// Question 3
$matrix = array(
    array(2, -6, 8),
    array(-6, 1, 6),
    array(7, 8, -6)
);
$rowTotals = array();
$columnTotals = array(0, 0, 0);
$matrixOddTotal = 0;
$matrixEvenTotal = 0;
$matrixTotal = 0;
$mainDiagonalTotal = 0;
$otherDiagonalTotal = 0;
$matrixMin = $matrix[0][0];
$matrixMax = $matrix[0][0];
$minimumMatrixPositions = "";
$maximumMatrixPositions = "";

foreach ($matrix as $rowIndex => $row) {
    $rowTotal = 0;
    foreach ($row as $columnIndex => $value) {
        $rowTotal += $value;
        $columnTotals[$columnIndex] += $value;
        $matrixTotal += $value;

        if ($value % 2 == 0) {
            $matrixEvenTotal += $value;
        } else {
            $matrixOddTotal += $value;
        }
        if ($rowIndex == $columnIndex) {
            $mainDiagonalTotal += $value;
        }
        if ($rowIndex + $columnIndex == 2) {
            $otherDiagonalTotal += $value;
        }

        if ($value < $matrixMin) {
            $matrixMin = $value;
            $minimumMatrixPositions = "";
        }
        if ($value == $matrixMin) {
            if ($minimumMatrixPositions != "") {
                $minimumMatrixPositions .= ", ";
            }
            $minimumMatrixPositions .= "Row " . ($rowIndex + 1) . ", column " . ($columnIndex + 1);
        }
        if ($value > $matrixMax) {
            $matrixMax = $value;
            $maximumMatrixPositions = "";
        }
        if ($value == $matrixMax) {
            if ($maximumMatrixPositions != "") {
                $maximumMatrixPositions .= ", ";
            }
            $maximumMatrixPositions .= "Row " . ($rowIndex + 1) . ", column " . ($columnIndex + 1);
        }
    }
    $rowTotals[] = $rowTotal;
}

// Question 4
$students = array(
    "CA221" => array(
        "Name" => "Mohamed Ahmed Ali",
        "Phone" => "0648440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ),
    "CA223" => array(
        "Name" => "Ahmed Abdi Jama",
        "Phone" => "0647223201",
        "Address" => "Taleex, Hodan"
    ),
    "CA224" => array(
        "Name" => "Amina Nur Adan",
        "Phone" => "0646990276",
        "Address" => "Macmacaanka, Dharkeynley"
    )
);

// Question 5
$transcript = array(
    "Semester 1" => array(
        "subject1" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
        "subject2" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
        "subject3" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
    ),
    "Semester 2" => array(
        "subject1" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40),
        "subject2" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 0),
        "subject3" => array("CW1" => 9, "MidTerm" => 26, "CW2" => 10, "Final" => 40)
    )
);

echo "<div class='container'>";
echo "<div class='header'>";
echo "<h1>Jamhuriya University of Science and Technology</h1>";
echo "<h2>Faculty of Computer &amp; IT</h2>";
echo "<h2>Course Title: PHP &amp; MySQL</h2>";
echo "<h2>Arrays Assignment | Due October 06, 2026</h2>";
echo "</div>";
echo "<div class='grid'>";

echo "<div class='q-card'>";
echo "<span class='badge'>Question 1</span>";
echo "<h3>One-Dimensional Array</h3>";
echo "<div class='table-wrap'><table><tr><th>Position</th><th>Element</th></tr>";
foreach ($numbers as $index => $number) {
    echo "<tr><td>" . ($index + 1) . "</td><td>" . $number . "</td></tr>";
}
echo "</table></div>";
echo "<div class='results'>";
echo "<div class='result-box'><strong>Total of all elements</strong>" . $numberTotal . "</div>";
echo "<div class='result-box'><strong>Total of even elements</strong>" . $evenTotal . "</div>";
echo "<div class='result-box'><strong>Total of odd elements</strong>" . $oddTotal . "</div>";
echo "<div class='result-box'><strong>Minimum (positions)</strong>" . $numberMin . " (" . $minimumPositions . ")</div>";
echo "<div class='result-box'><strong>Maximum (positions)</strong>" . $numberMax . " (" . $maximumPositions . ")</div>";
echo "</div>";
echo "<p>Positions are numbered starting from 1.</p>";
echo "</div>";

echo "<div class='q-card'>";
echo "<span class='badge'>Question 2</span>";
echo "<h3>Shade and Color Associative Array</h3>";
echo "<div class='table-wrap'><table><tr><th>Shade</th>";
foreach ($colors as $color) {
    echo "<th>" . $color . "</th>";
}
echo "</tr>";
foreach ($shadeColors as $shade => $shadeRow) {
    echo "<tr><th>" . $shade . "</th>";
    foreach ($colors as $color) {
        echo "<td>" . $shadeRow[$color] . "</td>";
    }
    echo "</tr>";
}
echo "</table></div>";
echo "</div>";

echo "<div class='q-card'>";
echo "<span class='badge'>Question 3</span>";
echo "<h3>Three-by-Three Square Array</h3>";
echo "<div class='table-wrap'><table><tr><th>Row</th><th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Row total</th></tr>";
foreach ($matrix as $rowIndex => $row) {
    echo "<tr><th>Row " . ($rowIndex + 1) . "</th>";
    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "<td><strong>" . $rowTotals[$rowIndex] . "</strong></td></tr>";
}
echo "<tr><th>Column total</th>";
foreach ($columnTotals as $columnTotal) {
    echo "<td><strong>" . $columnTotal . "</strong></td>";
}
echo "<td><strong>" . $matrixTotal . "</strong></td></tr></table></div>";
echo "<div class='results'>";
echo "<div class='result-box'><strong>Total of odd elements</strong>" . $matrixOddTotal . "</div>";
echo "<div class='result-box'><strong>Total of even elements</strong>" . $matrixEvenTotal . "</div>";
echo "<div class='result-box'><strong>Main diagonal total</strong>" . $mainDiagonalTotal . "</div>";
echo "<div class='result-box'><strong>Other diagonal total</strong>" . $otherDiagonalTotal . "</div>";
echo "<div class='result-box'><strong>Total of all elements</strong>" . $matrixTotal . "</div>";
echo "<div class='result-box'><strong>Minimum (positions)</strong>" . $matrixMin . " (" . $minimumMatrixPositions . ")</div>";
echo "<div class='result-box'><strong>Maximum (positions)</strong>" . $matrixMax . " (" . $maximumMatrixPositions . ")</div>";
echo "</div>";
echo "</div>";

echo "<div class='q-card'>";
echo "<span class='badge'>Question 4</span>";
echo "<h3>Student Information</h3>";
echo "<div class='table-wrap'><table><tr><th>Student ID</th><th>Name</th><th>Phone</th><th>Address</th></tr>";
foreach ($students as $studentId => $student) {
    echo "<tr><td>" . $studentId . "</td>";
    foreach ($student as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table></div>";
echo "</div>";

echo "<div class='q-card'>";
echo "<span class='badge'>Question 5</span>";
echo "<h3>Student Transcript by Semester</h3>";
echo "<div class='table-wrap'><table><tr><th>Semester</th><th>Course</th><th>CW1</th><th>MidTerm</th><th>CW2</th><th>Final</th><th>Total</th><th>Status</th></tr>";
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
        $statusClass = "fail";
        if ($status == "Pass") {
            $statusClass = "pass";
        }
        echo "<tr><td>" . $semester . "</td><td>" . $course . "</td>";
        foreach ($marks as $mark) {
            echo "<td>" . $mark . "</td>";
        }
        echo "<td><strong>" . $courseTotal . "</strong></td>";
        echo "<td class='" . $statusClass . "'>" . $status . "</td></tr>";
    }
}
echo "</table></div>";
echo "</div>";
echo "</div>";
echo "</div>";
