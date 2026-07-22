<?php
session_start();

$users = "users.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = trim($_POST["user"]);
    $p = password_hash($_POST["pass"], PASSWORD_DEFAULT);

    // prevent breaking the file format
    if (strpos($u, "|") !== false) { 
        die("Invalid username"); 
    }
	// Check for duplicate username
	$existing = file($users, FILE_IGNORE_NEW_LINES);
	foreach ($existing as $line) {
	    $parts = explode("|", $line, 2);
	    if (isset($parts[0]) && $parts[0] === $u) {
       		 die("Username already taken. <a href='register.php'>Try another</a>");
    }
}

    // Check if we can write to the file
    $result = file_put_contents($users, "$u|$p\n", FILE_APPEND);
    
    if ($result === false) {
        die("Error: Could not save user. Check file permissions.");
    }
    
    echo "Registered. <a href='login.php'>Login</a>";
    exit;
}
?>
<head>
    <style>
        body {
            font-family: Courier New;
            background: Black;
            color: lime;
        }
    </style>
</head>
<form method="POST">
    Username: <input name="user" required><br>
    Password: <input type="password" name="pass" required><br>
    <button>Sign in</button>
</form>
