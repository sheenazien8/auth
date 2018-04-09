<?php
  require_once 'core/init.php';
  // menguji jika session sudah ada
  if (Session::exist('username')) {
    header("Location: profile.php");
  }
  // menyimpan error
  $errors = [];
  if (Input::get_post('submit')) {
    //memanggil objek validasi
    $validation = new Validation();

    //check fungsi
    $validation = $validation->check(array(
      'username' =>array('requeired' => true),
      'password' =>array('requeired' => true)
    ));
    //lolos ujian
    if ($validation->passed()) {
      //check nama yang ada di database
      if ($user->checkNama(Input::get_post('username'))) {

        //menyimpan input jika sudah benar
        if ($user->loginUser(Input::get_post('username'),Input::get_post('password'))){
          Session::set('username', Input::get_post('username'));
          header("Location: profile.php");
        }else {
          $errors[] = "Login Gagal";
        }
      }else {
        $errors[] = "nama belum terdaftar";
      }
    }else {
      $errors = $validation->erros();
    }
  }

  require_once 'template/header.php';
?>
<h2>Login Disini</h2>
<form action="login.php" method="post">
  <label>Username</label>
  <input type="text" name="username"> <br>

  <label>Password</label>
  <input type="password" name="password"> <br>
  <input type="submit" name="submit" value="Login">

  <?php if (!empty($errors)) { ?>
    <div class="error">
      <?php foreach ($errors as $error): ?>
        <li><?= $error; ?></li>

      <?php endforeach; ?>
  </div>
  <?php } ?>
</form>
<?php require_once 'template/footer.php'; ?>
