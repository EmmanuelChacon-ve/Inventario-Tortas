<?php
require_once "../../Modelo/connect.php";
  session_start();

  $mensaje = '';
  $estado  = false;

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require "./PHPMailer-master/src/PHPMailer.php";
  require "./PHPMailer-master/src/SMTP.php";
  require "./PHPMailer-master/src/Exception.php";

  //funcion para mandar correo
  function sendEmail_verify($username,$email,$token)
  {
    $mail = new PHPMailer(true);
            try{
                $mail->isSMTP(); //rotocolo de envio
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; //logearse de forma segura
                $mail->Username = 'tortaskady@gmail.com';
                $mail->Password = 'phgdxrdkyculwjft';
                $mail->SMTPSecure = 'tls'; //formato de incriptacion
                $mail->Port       = 587;

                //datos del gmail

                $mail->setFrom('tortaskady@gmail.com','Tortas Kady');
                $mail->addAddress($email,'user');
                $mail->isHTML(true);
                $mail->Subject = 'Queremos mantenerte al tanto con tu cuenta';
                $mail->Body    = "<h1>Saludos de Tortas Kady</h1>
                <p> Apreciado '$username' estamos felices de que nos hayas elegido por favor entra al siguiente link para confirmar tu correo</p><br>
                <a href='http://localhost/proyecto-final/verificar-email.php?token=$token'>click para verificar</a>";
                $mail->send();
            }catch(Exception $e){
              $mensaje = 'ah ocurrido un error intentalo mas tarde';
              $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
              echo json_encode($salida);
            }
  }
  //
  // session_start();
//   $username = mysqli_real_escape_string($conn, $_POST['username']);
//   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
//   $sql = "SELECT username FROM user WHERE username ='" . $username . "'";
//   $query = mysqli_query($conn, $sql);
//   $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
//   if ($result) {
//       echo json_encode("el usuario se encuentra actualmente en uso");
//       exit();
//   }else{
//   if ($_POST['username'] != null && $_POST['password'] != null && $_POST['name'] != null && $_POST['cfpassword'] != null && $_POST['cfpassword'] == $_POST['password']) {
//       $sql = "INSERT INTO user (username,password,name) VALUES ('" . trim($_POST['username']) . "','" . trim(md5($_POST['password'])) . "','" . trim($_POST['name']) . "')";
//       if ($conn->query($sql)) {
//           echo json_encode(true);
//           exit();
//       } else {
//           echo "registro incompleto";
//           exit();
//       }
//   } else {
//       echo "los campos de contrasena no coinciden";
//       exit();
//   }
//       mysqli_close($conn);
//   }
     if(isset($_POST['submit']))
     {
      //validando que ninguna variable este vacia
      foreach($_POST as $key=>$value)
      {
        if(empty(trim($value)))
        {
          exit();
        }
      }
      //revisando igualdad de claves
      if($_POST['cfpassword'] != $_POST['password'])
      {
        exit();
      }
      //evitando correos repetidos
      $email = trim($_POST['email']);
      $rev_email = "SELECT email FROM usuario WHERE email='$email' LIMIT 1";
      $rev_email = mysqli_query($conn,$rev_email);

      if(mysqli_num_rows($rev_email) > 0)
      {
        // $_SESSION['status'] = 'Email en uso';
        // header('Location: ../login.html');
        $mensaje = 'el email se encuentra actualmente en uso';
        $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
        echo json_encode($salida);
        exit();
      }else
      {
        $usuario = mysqli_real_escape_string($conn,$_POST['name']);
        //para que no hayan usuarios repetidos
        $rev_usuario = "SELECT usuario FROM usuario WHERE usuario='$usuario' LIMIT 1";
        $rev_usuario = mysqli_query($conn,$rev_usuario);
        if(mysqli_num_rows($rev_usuario) > 0)
        {
          $mensaje = 'el usuario se encuentra actualmente en uso';
          $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
          echo json_encode($salida);
        }else{
        //
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $token    = mysqli_real_escape_string($conn,rand());
        //registrando usuario
        //si es por register normal
        if(isset($_POST['id_privilegio'])){
          $rol = $_POST['id_privilegio'];
          $token = '';
        }else
        {
          $rol = 2;
        }
        $query = "INSERT INTO usuario (email,usuario,codigo,password,id_privilegio) VALUES ('$email','$usuario','$token','$password','$rol')";
        $query = mysqli_query($conn,$query);
        if($query)
        {
          if(isset($_POST['id_privilegio']))
          {
          $mensaje = 'usuario registrado con exito';
          $estado = true;
          $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
          echo json_encode($salida);
          exit();
          }
          // $_SESSION['status'] = 'revisa tu email';
          $mensaje = 'te hemos enviado un email revisalo para confirmar tu cuenta';
          $estado = true;
          $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
          echo json_encode($salida);
          sendEmail_verify($usuario,$email,$token);
          exit();
        }else{
          $mensaje = 'ah ocurrido un error intentalo mas tarde';
          $salida = array('estado' =>$estado, 'mensaje'=>$mensaje);
          echo json_encode($salida);
        }
      }
    }
     }
  mysqli_close($conn);
?>