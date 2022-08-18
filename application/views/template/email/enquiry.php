<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Customer Enquiry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hi sir/Madam,</p> 
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Thanks for contact in Ganesh Property.</p>

<p>Property : <b><?php echo $customer['property_name']; ?></b></p>
<br>
<p>Name:<?php echo $customer['name']; ?></p>
<p>Email:<?php echo $customer['email']; ?></p>
<p>Phone:<?php echo $customer['phone']; ?></p>
<p>Message:<?php echo $customer['message']; ?></p>

<p>
Thanks & Regards<br>
Ganesh Property
</p>
</div>
</body>
</html>
