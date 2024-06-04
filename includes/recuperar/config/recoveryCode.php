<?php 
use PHPMailer\PHPMailer\PHPMailer;// librerias de phpmailer
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';//librerias que se necesitan para recuperar la contraseña
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

require_once('db.php');//se requiere la conexion
$email = $_POST['email'];//crear una variable para llamar al correo
$query = "SELECT * FROM usuarios where Email = '$email'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

$id_codificado = base64_encode($row['IdUsuario']);
//$token = uniqid();

//$sql = "UPDATE usuarios SET token = '$token' WHERE correo = '$email'";

if($result->num_rows > 0){
  $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp-mail.outlook.com';// la direccion del correo
    $mail->SMTPAuth   = true; //stm ejecutar si se necesita autenticación
    $mail->Username   = 'tecnomecanicaistte@hotmail.com';//correo base para enviar la pagina de recuperación
    $mail->Password   = 'Tecnomecanica2024!';//contraseña del correo base
    $mail->Port       = 587;//Puerto
    $mail->CharSet    = 'UTF-8';//Envio mediante UTF-8

    $mail->setFrom('tecnomecanicaistte@hotmail.com', 'Tecnomecánica');//agregar correo base
    $mail->addAddress($email);//a quien se va enviar la pagina de recuperacion, se puede agregar una dirección, o se puede incluir a todos usuarios
    $mail->isHTML(true);// es la pagina de recuperacion
    $mail->Subject = 'Recuperación de contraseña';//el asunto
    //AQUI TOCA CAMBIAR POR LA VARIABLE
    //$mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la página de <a href="localhost/tecno-mecanica/includes/cambiar_password.php?id='.$id_codificado.'">Recuperación de contraseña</a>';
    $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña, por favor, visita la página de <a href="https://c855-190-89-45-21.ngrok-free.app/tecno-mecanica/includes/cambiar_password.php?id='.$id_codificado.'">Recuperación de contraseña</a>';//el mensaje

    $mail->send();
    header("Location: ../../_sesion/login.php?message=ok");//si todo va bien se ingresa con la nueva contraseña
} catch (Exception $e) {
  header("Location: ../../_sesion/login.php?message=error");
}

}else{
  header("Location: ../../_sesion/login.php?message=not_found");
}

?>
