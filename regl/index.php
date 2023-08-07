<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must log in first.";
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = true;
}

if (isset($_SESSION['logged_out']) && $_SESSION['logged_out']) {
    unset($_SESSION['logged_out']);
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Panel</title>
</head>
<body>
    <?php if (isset($_SESSION['auth']) && $_SESSION['auth']) : ?>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <form method="post" action="logout.php">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php else : ?>
        <?php
            header("Location: login.php");
            exit();
        ?>
    <?php endif; ?>
</body>
</html>
