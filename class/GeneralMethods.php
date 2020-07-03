
    <?php

        //Cargamos la configuracion global
        require_once dirname(__FILE__).'/../config-import.php';


        class GeneralMethods
        {
            static function sendEmail($to = NULL, $subject = 'Contato', $message = NULL){

                //Encabezados para especificar que se acepta HTML
                $headers[] = "MIME-Version: 1.0" . "\r\n";
                $headers[] = "Content-type:text/html; charset=UTF-8" . "\r\n";

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
        }