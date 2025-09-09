<?php
// contact.php - Envío por SMTP con PHPMailer
// 1) Ejecuta: composer require phpmailer/phpmailer
// 2) Configura tus credenciales SMTP abajo

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  $mail = new PHPMailer(true);
  try {
    // SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.tu_proveedor.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_usuario';
    $mail->Password = 'tu_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('no-reply@tu_dominio.com', 'Portafolio Web');
    $mail->addAddress('tu_correo@ejemplo.com', 'Luis');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje desde el Portafolio';
    $mail->Body = '<b>Nombre:</b> ' . htmlspecialchars($name) . '<br/>' .
                  '<b>Email:</b> ' . htmlspecialchars($email) . '<br/>' .
                  '<b>Mensaje:</b><br/>' . nl2br(htmlspecialchars($message));

    $mail->send();
    header('Location: /?sent=1#contact');
  } catch (Exception $e) {
    header('Location: /?error=1#contact');
  }
} else {
  http_response_code(405);
  echo 'Método no permitido';
}
