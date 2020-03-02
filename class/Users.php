
    <?php

        //Importamos la configuración global
        require_once (dirname(__FILE__).'/../config-import.php');

        class Users
        {
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_usuario = NULL, $nome = NULL, $user = NULL, $senha = NULL, $rol = NULL, $estado = NULL) {

                //Valor por defecto para 'page'
                if (isset($page) && $page != NULL && is_numeric($page)){
                    /* Se deja igual */
                }
                else
                    $page = 1;

                //Valor por defecto para 'pagination'
                if (isset($pagination) && $pagination != NULL && is_numeric($pagination)) {
                    /* Se deja igual */
                }
                else
                    $pagination = constant("PAGINATION");

                //Valor por defecto para tipo (normal - count)
                if (isset($type) && $type != NULL) {
                    /* Se deja igual */
                }
                else
                    $type = "normal";

                //Se calcula desde que registro se va a listar segun la paginacion
                $limit_start = ($page * $pagination) - $pagination;

                //Construimos las condiciones de la consulta
                $conditions = "";

                //Filtro por '$id_usuario'
                if ($id_usuario !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND id_usuario = "%s"';
                    $this_condition = sprintf($this_condition, $id_usuario);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome'
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$user'
                if ($user !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND user = "%s"';
                    $this_condition = sprintf($this_condition, $user);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$senha'
                if ($senha !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND senha = "%s"';
                    $this_condition = sprintf($this_condition, $senha);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$rol'
                if ($rol !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND rol = "%s"';
                    $this_condition = sprintf($this_condition, $rol);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$estado'
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                if ($type == 'count') {
                    $sql_select = "count(*) as count";
                    $sql_limit = '';
                }
                else {
                    $sql_select = "
                        id_usuario,
                        nome,
                        user,
                        senha,
                        rol,
                        estado
                    ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        usuarios
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        usuarios.user
                    $sql_limit
                ";

                //Ejecutamos la consulta
                $result = DataBase::query($sql);

                //Validamos si la consulta retornó datos o no
                if (isset($result[0]) && $result != NULL) {

                    //Validamos si fue tipo 'count' o normal
                    if ($type == 'count') {

                        //Se calcula el total de paginas con esta configuracion
                        $total_pages = ceil(($result[0]['count']) / $pagination);

                        //Retornamos array que se usará para las paginaciones
                        return array(
                            "count" => $result[0]['count'],
                            "pagination" => "" . $pagination,
                            "page" => "" . $page,
                            "total_pages" => "" . $total_pages,
                        );
                    }
                    else
                        //Retornamos array con los datos retornados por la consulta
                        return $result;
                }
                else
                    //Retornamos NULL en caso de no haber encontrado nungún dato
                    return NULL;
            }

            /**
             * @Description: Método para validar que el usuario y la contraseña sean las correctas
             */
            static function validateUserAccessData($user = NULL, $senha = NULL){

                //Creamos variable de control
                $valid = true;

                //Se valida que se envía un 'usuario'
                if(isset($user) && $user != NULL && $user != ''){
                    //Pasa la validación
                }
                else
                    $valid = false;

                //Se valida que se envía una 'contraseña'
                if(isset($senha) && $senha != NULL && $senha != ''){
                    /* Se deja igual */
                }
                else
                    $valid = false;

                //Si 'valid' es true
                if($valid){

                    //Se encripta la contraseña
                    $senha_secure = Security::passwordConstructor($senha);

                    //Se consulta por el usuario y el password
                    $sql = "
                        SELECT
                            id_usuario,
                            rol
                        FROM
                            usuarios
                        WHERE
                            user = '%s'
                        AND   
                            senha = '%s'
                        AND 
                            estado = 'ativo'
                        LIMIT 0,1
                    ";

                    $sql = sprintf($sql,
                        $user,
                        $senha_secure
                    );

                    //Ejecutamos el query
                    $result = DataBase::query($sql);

                    if(isset($result[0]['id_usuario']) && is_numeric($result[0]['id_usuario']))
                        return $result;
                    else
                        return false;
                }
                else
                    return false;
            }
        }