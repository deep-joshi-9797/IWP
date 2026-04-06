<?php
$xmlFile = "contacts.xml";
$message = "";

// Load XML
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
} else {
    $xml = new SimpleXMLElement("<contacts></contacts>");
}

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $msg = htmlspecialchars($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($msg)) {
        $message = "All fields required!";
    } else {

        // ✅ Save to XML
        $contact = $xml->addChild("contact");
        $contact->addChild("name", $name);
        $contact->addChild("email", $email);
        $contact->addChild("subject", $subject);
        $contact->addChild("message", $msg);

        $xml->asXML($xmlFile);

        // ✅ Send Email (may not work on XAMPP without config)
        $to = "your-email@example.com";
        $headers = "From: $email";

        @mail($to, $subject, $msg, $headers);

        $message = "Message sent & saved!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input, textarea {
            width: 300px;
            padding: 8px;
            margin: 5px 0;
            display: block;
        }
        .box {
            border: 1px solid black;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<h2>Contact Form</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="subject" placeholder="Subject">
    <textarea name="message" placeholder="Message"></textarea>
    <button type="submit">Send</button>
</form>

<h3>Stored Contacts</h3>

<?php
foreach ($xml->contact as $c) {
    echo "<div class='box'>";
    echo "<strong>Name:</strong> $c->name <br>";
    echo "<strong>Email:</strong> $c->email <br>";
    echo "<strong>Subject:</strong> $c->subject <br>";
    echo "<strong>Message:</strong> $c->message <br>";
    echo "</div>";
}
?>

</body>
</html>
