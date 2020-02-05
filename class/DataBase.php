
    <?php

        //Importamos la configuración global
        require_once (dirname(__FILE__).'/../config-import.php');

        class DataBase{

            //Variable que guardará el error de las consultas Query
            public static  $query_error;

            static function query($query) {

                //Para evitar errores cuando la consulta inicia con varios espacios
                $typeQuery = trim($query);
                $typeQuery = trim($query);
                $typeQuery = trim($query);
                $typeQuery = trim($query);
                $typeQuery = trim($query);
                $typeQuery = trim($query);

                //Se separa el string por espacios
                $typeQuery = explode(" ", $typeQuery);

                //Se obtiene la primer parte del string
                $typeQuery = trim(strtolower($typeQuery[0]));

                //Evaluamos cada una de las posibles transacciones (CRUD)
                switch ($typeQuery) {

                    case 'select':

                        //Inicialization
                        $resultArray = array();

                        //The connection
                        $dbConnection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

                        //Declaramos la codificación de la Bd
                        $dbConnection->query("SET NAMES 'utf8mb4'");

                        if ($dbConnection->connect_error) {
                            self::$query_error=$dbConnection->error;//Guardamos el error en la variable previamente creada
                            Debug::register("Error de Conexión ( $dbConnection->connect_errno ) $dbConnection->connect_error", "error", __FILE__, __LINE__);
                        }

                        //trigger_error("La consulta es : ".$query);
                        $query = $dbConnection->query($query);
                        if ($query != null || $query != false) {
                            while ($result = $query->fetch_assoc()) {
                                $resultArray[] = $result;
                            }
                        }
                        else{
                            Debug::register("Error en la consulta Mysql: $dbConnection->error", "error", __FILE__, __LINE__);
                            //esta linea a continuación la agrega mario orozco como sugerencia y para evaluación de conveniencia
                            //throw new Exception("Error en la consulta Mysql: $dbConnection->error");
                            //Esto nos permite saber el error de manera más fácil cuando se implementa un try catch en el código.

                            self::$query_error=$dbConnection->error;//Guardamos el error en la variable previamente creada
                        }

                        if (isset($result)) {
                            $result->free();
                        }

                        $dbConnection->close();

                        return $resultArray;


                        break;

                    case 'insert':

                        //Inicialization
                        $result_final = false;

                        //The connection
                        $dbConnection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

                        //Declaramos la codificación de la Bd
                        $dbConnection->query("SET NAMES 'utf8mb4'");

                        if ($dbConnection->connect_error) {
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error de Conexión ( $dbConnection->connect_errno ) $dbConnection->connect_error", "error", __FILE__, __LINE__);
                        }

                        //The query
                        $query = $dbConnection->query($query);
                        if ($query != null || $query != false) {
                            $result_final = $dbConnection->insert_id;
                        }
                        else {
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error en la consulta Mysql: $dbConnection->error", "error", __FILE__, __LINE__);
                        }

                        if (isset($result)) {
                            $result->free();
                        }

                        $dbConnection->close();

                        return $result_final;
                        break;

                    case 'update':

                        //Inicialization
                        $result_final = false;

                        //The connection
                        $dbConnection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

                        if ($dbConnection->connect_error) {
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error de Conexión ( $dbConnection->connect_errno ) $dbConnection->connect_error", "error", __FILE__, __LINE__);
                        }

                        //The query
                        $query = $dbConnection->query($query);

                        if ($query != null || $query != false) {
                            $result_final = $dbConnection->affected_rows;
                        }
                        else{
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error en la consulta Mysql: $dbConnection->error", "error", __FILE__, __LINE__);
                        }

                        $dbConnection->close();


                        if ($result_final != -1) {
                            return true;
                        } else {
                            return false;
                        }
                        break;
                        
                    case 'delete':
                        
                        //Inicialization
                        $result_final = false;

                        //The connection
                        $dbConnection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
                        if ($dbConnection->connect_error) {
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error de Conexión ( $dbConnection->connect_errno ) $dbConnection->connect_error", "error", __FILE__, __LINE__);
                        }

                        //The query
                        $query = $dbConnection->query($query);
                        if ($query != null || $query != false) {
                            $result_final = $dbConnection->affected_rows;
                        } else {
                            self::$query_error=$dbConnection->error;  //aqui hago uso de la variable query_error (mario orozco)
                            Debug::register("Error en la consulta Mysql: $dbConnection->error", "error", __FILE__, __LINE__);
                        }

                        $dbConnection->close();


                        if ($result_final != -1) {
                            return true;
                        } else {
                            return false;
                        }
                        break;
                    default :

                        Debug::register("No se logro determinar el tipo de consulta a la base de datos.", "error", __FILE__, __LINE__);
                        break;
                }
            }
        }