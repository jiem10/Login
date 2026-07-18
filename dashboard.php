<?php
require_once __DIR__ . '/config.php';

if (session_has_expired()) {
    end_session();
    redirect_to('login.php');
}

if (!isset($_SESSION['user_id'])) {
    redirect_to('login.php');
}

$stmt = $conn->prepare('SELECT 1 FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$userExists = (bool) $stmt->get_result()->fetch_row();
$stmt->close();

if (!$userExists) {
    end_session();
    redirect_to('login.php');
}

$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Global Reciprocal Colleges</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dashboard-page">
    <header class="dashboard-header">
        <div class="dashboard-brand">
            <img src="https://raw.githubusercontent.com/jiem10/Login/main/download.png" alt="Global Reciprocal Colleges logo">
            <h1>GRC Student Dashboard</h1>
        </div>
        <a href="logout.php" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </header>
</body>
</html>
