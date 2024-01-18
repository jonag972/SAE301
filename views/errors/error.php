<?php include 'views/elements/navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Erreur</title>
</head>
<body>
    <h1>Erreur</h1>
    <p><?php if (isset($message)) echo $message; ?></p>
    <p><?php if (isset($messageErreur)) echo $messageErreur; ?></p>
    <p><?php if (isset($error)) echo $error; ?></p>
</body>