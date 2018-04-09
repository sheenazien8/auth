<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      Belajar login register
    </title>
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <header>
      <h1>SEMANGAT</h1>
      <nav>
        <?php if (Session::exist('username')) { ?>
          <a href="logout.php">Logout</a>
        <?php }else { ?>
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
        <?php } ?>
          <a href="profile.php">Profile</a>
      </nav>
    </header>
