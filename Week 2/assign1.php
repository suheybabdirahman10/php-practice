<?php
// PHP & MySQL Assignment 1

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
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 18px;
    }
    .q-card {
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
    .answer {
        background: #fafafa;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
        line-height: 1.8;
        color: #1f2937;
    }
    .result-box {
        background: #ffffff;
        border: 1px solid #dfe7f3;
        border-radius: 8px;
        padding: 10px 12px;
        font-weight: 600;
    }
    .math-box {
        background: #ffffff;
        border: 1px solid #dfe7f3;
        border-radius: 8px;
        padding: 10px;
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
    .prime-result {
        display: inline-block;
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 7px 12px;
        border-radius: 8px;
        font-weight: 700;
        margin-top: 6px;
    }
</style>";

echo "<div class='container'>";
echo "<div class='header'>";
echo "<h1>Jamhuriya University of Science and Technology</h1>";
echo "<h2>Course Title: PHP & MySQL</h2>";
echo "<h2>Assignment 1</h2>";
echo "</div>";
echo "<div class='grid'>";

// Question 1
$a = 42; $b = 17; $c = 29;
$greatest = $a; $smallest = $a;
if ($b > $greatest) $greatest = $b;
if ($c > $greatest) $greatest = $c;
if ($b < $smallest) $smallest = $b;
if ($c < $smallest) $smallest = $c;

echo "<div class='q-card'><span class='badge'>Question 1</span><h3>Greatest and Smallest of Three Integers</h3><div class='answer'>Numbers: $a, $b, $c<br>Greatest = <strong>$greatest</strong><br>Smallest = <strong>$smallest</strong></div></div>";

// Question 2
$num = 15; $result = "";
if ($num % 3 == 0 && $num % 5 == 0) {
    $result = "Divisible by both 3 and 5";
} elseif ($num % 3 == 0) {
    $result = "Divisible by 3 only";
} elseif ($num % 5 == 0) {
    $result = "Divisible by 5 only";
} else {
    $result = "Not divisible by 3 or 5";
}

echo "<div class='q-card'><span class='badge'>Question 2</span><h3>Divisible by 3, 5, Both, or None</h3><div class='answer'>Number: $num<br>Result: <strong>$result</strong></div></div>";

// Question 3
$oddNumbers = "";
for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        $oddNumbers .= $i . " ";
    }
}
$evenNumbers = "";
for ($i = 35; $i >= 7; $i--) {
    if ($i % 2 == 0) {
        $evenNumbers .= $i . " ";
    }
}

echo "<div class='q-card'><span class='badge'>Question 3</span><h3>Odd Numbers from 2 to 20 and Even Numbers from 35 to 7</h3><div class='answer'>Odd numbers from 2 to 20: <strong>" . trim($oddNumbers) . "</strong><br>Even numbers from 35 to 7: <strong>" . trim($evenNumbers) . "</strong></div></div>";

// Question 4
$commonDivisible = "";
for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        $commonDivisible .= $i . " ";
    }
}

echo "<div class='q-card'><span class='badge'>Question 4</span><h3>Numbers Divisible by 2 and 5 from 50 to 2</h3><div class='answer'><strong>" . trim($commonDivisible) . "</strong></div></div>";

// Question 5
$original = 12345; $reverse = 0; $temp = $original;
while ($temp > 0) {
    $remainder = $temp % 10;
    $reverse = ($reverse * 10) + $remainder;
    $temp = (int)($temp / 10);
}

echo "<div class='q-card'><span class='badge'>Question 5</span><h3>Reverse of a Number</h3><div class='answer'>Original number: $original<br>Reverse: <strong>$reverse</strong></div></div>";

// Question 6
$n1 = 8; $n2 = 12; $a = $n1; $b = $n2;
while ($a != $b) {
    if ($a < $b) {
        $a += $n1;
    } else {
        $b += $n2;
    }
}
$lcm = $a;

echo "<div class='q-card'><span class='badge'>Question 6</span><h3>Lowest Common Multiple (LCM)</h3><div class='answer'>LCM of $n1 and $n2 is <strong>$lcm</strong></div></div>";

// Question 7
$x = 18; $y = 24;
while ($y != 0) {
    $temp = $y;
    $y = $x % $y;
    $x = $temp;
}
$hcf = $x;

echo "<div class='q-card'><span class='badge'>Question 7</span><h3>Highest Common Factor (HCF)</h3><div class='answer'><div class='result-box'>HCF of 18 and 24 is <strong>$hcf</strong></div></div></div>";

// Question 8
$multTable = "<div class='table-wrap'><table><tr><th>*</th>";
for ($i = 1; $i <= 12; $i++) {
    $multTable .= "<th>$i</th>";
}
$multTable .= "</tr>";
for ($row = 1; $row <= 12; $row++) {
    $multTable .= "<tr><th>$row</th>";
    for ($col = 1; $col <= 12; $col++) {
        $multTable .= "<td>" . ($row * $col) . "</td>";
    }
    $multTable .= "</tr>";
}
$multTable .= "</table></div>";

echo "<div class='q-card'><span class='badge'>Question 8</span><h3>Multiplication Table (1 to 12)</h3><div class='answer'><div class='math-box'>$multTable</div></div></div>";

// Question 9
$check = 29; $isPrime = true;
if ($check < 2) {
    $isPrime = false;
} else {
    for ($i = 2; $i <= (int)($check / 2); $i++) {
        if ($check % $i == 0) {
            $isPrime = false;
            break;
        }
    }
}

$primeStatus = $isPrime ? 'Prime' : 'Non-prime';
echo "<div class='q-card'><span class='badge'>Question 9</span><h3>Prime or Non-Prime Number</h3><div class='answer'><div class='result-box'>Number: $check<br>Result: <span class='prime-result'>$primeStatus</span></div></div></div>";

// Question 10
$primeList = "";
for ($num = 10; $num <= 50; $num++) {
    $prime = true;
    if ($num < 2) {
        $prime = false;
    } else {
        for ($i = 2; $i <= (int)($num / 2); $i++) {
            if ($num % $i == 0) {
                $prime = false;
                break;
            }
        }
    }
    if ($prime) {
        $primeList .= $num . " ";
    }
}

echo "<div class='q-card'><span class='badge'>Question 10</span><h3>Prime Numbers from 10 to 50</h3><div class='answer'><strong>" . trim($primeList) . "</strong></div></div>";

echo "</div></div>";
?>
