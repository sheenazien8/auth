<?php
  require_once 'core/init.php';
  // menguji jika session sudah ada
  if (Session::exist('username')) {
    header("Location: profile.php");
  } 
  // menyimpan error
  $errors = array();
  if (Input::get_post('submit')) {
    //memanggil objek validasi
    $validation = new Validation();

    //check fungsi
    $validation = $validation->check(array(
      'username' =>array(
        'requeired' => true,
        'min' => 3,
        'max' => 50,
      ),
      'password' =>array(
        'requeired' => true,
        'min' => 3,
      ),
    ));
    //lolos ujian
    if ($validation->passed()) {

      $user->register_user(array(
        'username' => Input::get_post('username'),
        'alamat' => Input::get_post('alamat'),
        'password' => password_hash(Input::get_post('password'), PASSWORD_DEFAULT)
      ));

      Session::set('username', Input::get_post('username'));
      header("Location: profile.php");


    }else {
      $errors = $validation->erros();
    }

  }


  require_once 'template/header.php';

?>

  <h2>Daftar Disini</h2>
  <form action="register.php" method="post">
    <label>Username</label>
    <input type="text" name="username"> <br>

    <label>Alamat</label>
    <input type="text" name="alamat"> <br>

    <label>Password</label>
    <input type="password" name="password"> <br>
    <input type="submit" name="submit" value="Daftar">

    <?php if (!empty($errors)) { ?>
      <div class="error">
        <?php foreach ($errors as $error): ?>
          <li><?= $error; ?></li>

        <?php endforeach; ?>
    </div>
    <?php } ?>
  </form>

<?php require_once 'template/footer.php'; ?>
