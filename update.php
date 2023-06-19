<?php include 'partials/header.php' ?>

<?php

require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
  include 'partials/not_found.php';
  exit;
}

$userId = $_GET['id'];

$user = getUserById($userId);

if (!$user) {
  include 'partials/not_found.php';
  exit;
}

$errors = [
  'name' => "",
  'username' => "",
  'email' => "",
  'phone' => "",
  'website' => "",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = array_merge($user, $_POST);

  $isValid = validateUser($user, $errors);

  if($isValid) {
    $user = updateUser($_POST, $userId);
    uploadImage($_FILES['picture'], $user);
    header("Location: index.php");
  }

  
}

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

?>


<?php include '_form.php' ?>
    




<?php include 'partials/footer.php' ?>