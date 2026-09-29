
<?php

echo "<h2 style='color: #0a43bd; text-align: center; font-size: 50px; font-weight: bold;'>Jamhuuriya University of Science and Technology</h2>";

$sub_header1 = "About Information";

echo "<p style='color: green; padding-left: 30px; font-weight: 700; font-size: 30px;'>$sub_header1</p>";

$about = "Jamhuuriya University of Science and Technology provides quality education and practical skills to students in different fields. The university focuses on developing students' knowledge, creativity, communication, and professional skills. It prepares students for successful careers and encourages them to contribute positively to the development of society.";

echo "<p style='color: #333; font-size: 20px; padding-left: 30px; line-height: 1.5;'>$about</p>";

$sub_header2 = "Contact Information";

echo "<p style='color: green; font-weight: 700; padding-left: 30px; font-size: 30px;'>$sub_header2</p>";

$email = "info@just.edu.so";
$phone = "+252-61-2223999";
$address = "Digfeer Street, Hodan District, Banadir Region, Mogadishu, Somalia";
$website = "www.just.edu.so";

echo "<p style='padding-left: 30px; font-size: 22px;'>
        <strong style='color: #5f6063;'>Email:</strong> $email
      </p>";

echo "<p style='padding-left: 30px; font-size: 22px;'>
        <strong style='color: #545557;'>Phone:</strong> $phone
      </p>";

echo "<p style='padding-left: 30px; font-size: 22px;'>
        <strong style='color: #4c4d4e;'>Address:</strong> $address
      </p>";

echo "<p style='padding-left: 30px; font-size: 22px;'> 
<strong style='color: #555658;'>Website:</strong> <a href='https://$website' target='_blank' style='color: #0a43bd; font-weight: bold;'> $website </a> </p>";

?>

