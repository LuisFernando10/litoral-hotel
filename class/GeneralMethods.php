
    <?php

        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        //use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Cargamos la configuracion global
        require_once dirname(__FILE__).'/../config-import.php';
        require_once dirname(__FILE__).'/../vendor/autoload.php';

        class GeneralMethods
        {
            static function sendEmail($to = NULL, $subject = 'Contato', $message = NULL){

                //Encabezados para especificar que se acepta HTML
                //$headers[] = "MIME-Version: 1.0" . "\r\n";
                //$headers[] = "Content-type:text/html; charset=UTF-8" . "\r\n";
                $headers = 'From: luis_teste@hotellitoral.com.br' . "\r\n" .
                    'Reply-To: ing.lfchamorro@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                // Additional headers
                //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
                //$headers[] = 'From: Birthday Reminder <birthday@example.com>';
                //$headers[] = 'Cc: birthdayarchive@example.com';
                //$headers[] = 'Bcc: birthdaycheck@example.com';

                //En caso que el mensaje sea mayor a 70 caracteres, lo seteamos
                $message = wordwrap($message, 70, "\r\n");

                //Enviamos el Email
                mail($to, $subject, $message, $headers);

                //Retornamos '200' para saber que se envió el Email
                return '200';
            }

            static function sendPhpMailerEmail($to = NULL, $subject = 'Contato (Hotel Litoral)', $message = NULL){

                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer;

                //Server settings
                $mail->isSMTP();                                              // Send using SMTP
                $mail->SMTPAuth   = false;                                     // Enable SMTP authentication
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Host       = 'smtp.hotellitoral.com.br';               // Set the SMTP server to send through
                $mail->Port       = 25;                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //$mail->SMTPSecure = 'tls';                                    // Enable TLS encryption, ssl also accepted
                $mail->Username   = 'luis_teste@hotellitoral.com.br';         // SMTP username
                $mail->Password   = 'lfchamorro10f';                          // SMTP password

                //Recipients
                $mail->setFrom('luis_teste@hotellitoral.com.br');
                $mail->addAddress('ing.lfchamorro@gmail.com');  // Add a recipient
                //$mail->addAddress('ing.lfchamorro@gmail.com');  // Add a recipient
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('ing.lfchamorro@gmail.com');
                //$mail->addBCC('bcc@example.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');               // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');          // Optional name

                // Content
                $mail->isHTML(true);                                   // Set email format to HTML
                $mail->Subject = utf8_decode($subject);
                $mail->Body    = utf8_decode($message);
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                //send the message, check for errors
                if (!$mail->send()) return 'Mailer Error: '. $mail->ErrorInfo;
                else return '200';
            }

            static function calculateDaysDiff($date_1, $date_2){
                $days = (strtotime($date_1)-strtotime($date_2))/86400;
                $days = abs($days);
                $days = floor($days);

                return $days;
            }

            static function changeDateFormat($date){
                $formatted_date = str_replace('/', '-', $date);
                return date('Y-m-d', strtotime($formatted_date));
            }

            static function checkInRangeDate($date_start, $date_end, $date_now) {
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $date_now = strtotime($date_now);
                if (($date_now >= $date_start) && ($date_now <= $date_end)) return true;
                return false;
            }
        }