
    <?php

        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
//        use PHPMailer\PHPMailer\PHPMailer;
//        use PHPMailer\PHPMailer\SMTP;
//        use PHPMailer\PHPMailer\Exception;

        //Cargamos la configuracion global
//    require_once dirname(__FILE__).'/../vendor/autoload.php';
//    require_once dirname(__FILE__).'/../config-import.php';

        class GeneralMethods
        {
//            static function sendEmail($to = NULL, $subject = 'Contato', $message = NULL){
//
//                //Encabezados para especificar que se acepta HTML
//                $headers[] = "MIME-Version: 1.0" . "\r\n";
//                $headers[] = "Content-type:text/html; charset=UTF-8" . "\r\n";
//
//                // Additional headers
//                //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
//                //$headers[] = 'From: Birthday Reminder <birthday@example.com>';
//                //$headers[] = 'Cc: birthdayarchive@example.com';
//                //$headers[] = 'Bcc: birthdaycheck@example.com';
//
//                //En caso que el mensaje sea mayor a 70 caracteres, lo seteamos
//                $message = wordwrap($message, 70, "\r\n");
//
//                //Enviamos el Email
//                mail($to, $subject, $message, $headers);
//
//                //Retornamos '200' para saber que se envió el Email
//                return '200';
//            }

            static function sendPphMailerEmail($to = NULL, $subject = 'Contatoxxd', $message = NULL){
//
                echo 'ffkkkkkkkk';
                return '200';
//
//                // Instantiation and passing `true` enables exceptions
//                $mail = new PHPMailer(true);
//
//                try {
//                    //Server settings
//                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//                    $mail->isSMTP();                                            // Send using SMTP
//                    $mail->Host       = 'gmail.com';                    // Set the SMTP server to send through
//                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//                    $mail->Username   = 'ing.lfchamorro@gmail.com';                     // SMTP username
//                    $mail->Password   = 'cadeprop10data-name';                               // SMTP password
//                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//
//                    //Recipients
//                    $mail->setFrom('ing.lfchamorro.programas@gmail.com', 'Mailer Ing');
//                    $mail->addAddress($to, 'Luis Fernando UT');     // Add a recipient
//                    //$mail->addAddress('ellen@example.com');               // Name is optional
//                    //$mail->addReplyTo('info@example.com', 'Information');
//                    //$mail->addCC('cc@example.com');
//                    //$mail->addBCC('bcc@example.com');
//
//                    // Attachments
//                    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//
//                    // Content
//                    $mail->isHTML(true);                                  // Set email format to HTML
//                    $mail->Subject = $subject;
//                    $mail->Body    = $message;
//                    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//                    //Send email finally
//                    $mail->send();
//
//                    //Success process
//                    return '200';
//
//                } catch (Exception $e) {
//                    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//                }
            }
        }