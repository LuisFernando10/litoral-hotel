
    <?php

        //Importamos la configuración global
        require_once (dirname(__FILE__).'/../config-import.php');

        class Security{

            /**
             * @Description: Método que construye el password con varios mecanismos de seguridad
             */
            static function passwordConstructor($password){

                $before_salt = 'xM$q3!';
                $after_salt = 'y7Z9d$';
                $md5_password = md5($before_salt.$password.$after_salt);
                $sha_password = sha1($md5_password);

                return $sha_password;
            }

            /**
             * @Description: Método que genera una contraseña de forma aleatoria
             */
            static function generatePassword($length = 15){

                $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            /**
             * @Description: Método que destruye y cierra las sesiones
             */
            static function sessionClose(){

                //Se valida si ya se ha iniciado el manejo de sesiones, en caso de que no se haya iniciado, se realiza la inicialización
                /*if(session_status() == PHP_SESSION_NONE){

                    session_start();

                    $id_sesion = Security::GetSessionUserId();
                    $company_id = Company::getCompanyIdByCompanyUserId($id_sesion);

                    //Apc::deleAllApcOperator(constant('PREFIJO_CONVERSACION_APC'),$id_sesion);
                    //Apc::deleteApc(constant('PREFIJO_SESSION').'_'.$company_id.'_' .$id_sesion);
                }
                else{

                    $id_sesion = Security::GetSessionUserId();
                    $company_id = Company::getCompanyIdByCompanyUserId($id_sesion);

                    //Apc::deleAllApcOperator(constant('PREFIJO_CONVERSACION_APC').$company_id,$id_sesion);
                    //Apc::deleteApc(constant('PREFIJO_SESSION').'_'.$company_id.'_' .$id_sesion);
                }*/

                //Apc::getAllApcOperador()
                //se obtiene el id de la sesion para eliminar el token creado
                //se elimina el token creado con el parametro id de la sesion, osea, el id usuario empresa

                //Destruimos todas las sesiones
                session_destroy();

                //Limpiamos todas las sesiones
                session_unset();

                //Retornamos la respuesta
                return true;
            }

            /**
             * @Description: Método que permite crear la sesión y le permite continuar al usuario
             */
            static function sessionCreate($user_role = null, $user_id = null, $token = NULL){

                //Se inicializa el manejo de sesiones
                if(session_status() == PHP_SESSION_NONE)
                    session_start();

                //Se carga el token de sesion de seguridad
                //$_SESSION['tokenLoginSecret'] = constant('TOKEN_SESSION_GENERAL');
                //$_SESSION['tokenLoginSecret'] = Security::generateRandomToken();

                //Se carga el 'estado' del login
                $_SESSION['session_status'] = '1';

                //Se carga el 'rol' del usuario
                $_SESSION['session_role'] = $user_role;

                //Se carga el 'id' del usuario
                $_SESSION['user_id'] = $user_id;

                //Se carga el 'token' de la sesion
                $_SESSION['session_token'] = $token;

                return true;

            }

            /**
             * @Description: Método que permite obtener el Id de la sesión
             */
            static function GetSessionUserId(){

                if(session_status() == PHP_SESSION_NONE)
                    session_start();

                //Retornamos la sesión que contiene el Id del usuario
                return $_SESSION['user_id'];
            }

            /**
             * @Description: Método que permite obtener el 'Token' de la sesión
             */
            static function GetSessionToken(){

                if(session_status() == PHP_SESSION_NONE)
                    session_start();

                //Retornamos la sesión que contiene el Token del usuario
                return $_SESSION['sessionToken'];
            }

            /**
             * @Description: Método que genera un Token aleatorio
             */
            static function generateRandomToken(){

                $token_pre = bin2hex(openssl_random_pseudo_bytes(16));
                $time = time();
                $token = md5($token_pre.$time);

                return $token;
            }

            /**
             * @Description: Método que inserta el Token en la Bd
             */
            static function insertToken($token = NULL, $id_usuario = NULL){

                //Validamos si '$id_usuario' es un entero
                if (ValidationData::validateInt($id_usuario) == false)
                    return false;

                //Preparamos el query
                $sql = "
                    INSERT INTO empresa_usuario_token 
                    (
                        id_empresa_usuario, 
                        token
                    )
                    VALUES
                    (
                        '%s',
                        '%s'
                    )
                ";

                //Reemplazamos los datos por los valores enviados
                $sql = sprintf($sql,
                    $id_usuario,
                    $token
                );

                //Ejecutamos el query
                $result = DataBase::query($sql);

                //Retornamos el Id recién creado
                return $result;
            }

            /**
             * @Description: Método que elimina el Token en la Bd
             */
            static function deletetToken($id_usuario = NULL, $token){

                //Validamos si '$id_usuario' es un entero
                if (ValidationData::validateInt($id_usuario) == false)
                    return false;

                //Preparamos el query
                $sql = "
                            DELETE FROM 
                                empresa_usuario_token 
                            WHERE 
                                id_empresa_usuario='%s'
                            AND
                                token='%s'
                        ";

                //Reemplazamos los datos por los valores enviados
                $sql = sprintf($sql,
                    $id_usuario,
                    $token
                );

                //Ejecutamos el query
                $result = DataBase::query($sql);

                //Retornamos la respuesta del query
                return $result;
            }
        }