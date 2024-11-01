<?php
require_once('db.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Форма обратной связи</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for="name">Имя:</label>
<input type="text" id="name" name="name" required placeholder="Введите имя...">

<label for="email">Email:</label>
<input type="email" id="email" name="email" required placeholder="Введите почту...">

<label for="message">Сообщение:</label>
<textarea id="message" name="message" required placeholder="Ваше послание..."></textarea>

<button type="submit">Отправить</button>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if (empty($name) || empty($email) || empty($message)) {
        echo "Пожалуйста, заполните все поля формы.";
    } else {
        $sql = "INSERT INTO kotofoto_table (name, email, message) VALUES (:name, :email, :message)";
    }
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        echo '<div class="success-message">Ваши пожелания успешно отправлены!</div>';
      } else {
        echo '<div class="error-message">Ошибка при отправке!</div>';
      }
    }

?>
</body>
</html>