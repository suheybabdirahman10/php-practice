<?php
$schoolName = "Jamhuuriya University of Science and Technology";
$aboutText = "Jamhuriya University of Science and Technology (JUST) was officially established in Mogadishu, Somalia, in 2011 by a group of Somali scholars and intellectuals to address the need for higher quality education in the country.";
$email = "info@just.edu.so";
$phone = "+252 612 223999";
$address = "Digfeer Street, Hodan District";
$website = "https://www.just.edu.so";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $schoolName; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f7fb;
            color: #1f2937;
        }
        h2 {
            color: #0a43bd;
            text-align: center;
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        h3 {
            color: #0f172a;
            margin-top: 20px;
        }
        p, a {
            font-size: 18px;
            line-height: 1.6;
        }
        .contact-item {
            margin: 10px 0;
        }
        strong {
            color: #0f172a;
        }
    </style>
</head>
<body>
    <h2><?php echo $schoolName; ?></h2>

    <h3>About Information</h3>
    <p><?php echo $aboutText; ?></p>

    <h3>Contact Information</h3>
    <div class="contact-item"><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
    <div class="contact-item"><strong>Phone:</strong> <a href="tel:<?php echo str_replace([' ', '-'], '', $phone); ?>"><?php echo $phone; ?></a></div>
    <div class="contact-item"><strong>Address:</strong> <?php echo $address; ?></div>
    <div class="contact-item"><strong>Website:</strong> <a href="<?php echo $website; ?>" target="_blank" rel="noopener noreferrer">Visit website</a></div>
</body>
</html>
