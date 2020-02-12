
    <?php

        class Users
        {
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_usuario = NULL, $usu_login = NULL, $usu_senha = NULL, $usu_status = NULL) {

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
                    $this_condition = 'AND usuarios.id_usuario="%s"';
                    $this_condition = sprintf($this_condition, $id_usuario);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$usu_login'
                if ($usu_login !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND usuarios.usu_login="%s"';
                    $this_condition = sprintf($this_condition, $usu_login);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$usu_senha'
                if ($usu_senha !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND usuarios.usu_senha="%s"';
                    $this_condition = sprintf($this_condition, $usu_senha);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$usu_status'
                if ($usu_status !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND usuarios.usu_status="%s"';
                    $this_condition = sprintf($this_condition, $usu_status);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                if ($type == 'count') {
                    $sql_select = "count(*) as count";
                    $sql_limit = '';
                }
                else {
                    $sql_select = "
                        usuarios.id_usuario,
                        usuarios.usu_login,
                        usuarios.usu_senha,
                        usuarios.usu_status
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
                        usuarios.usu_login
                    $sql_limit
                ";

                //Ejecutamos la consulta
                $result = DataBase::query($sql);

                //var_dump($result);
                //exit();

                if (isset($result[0]) && $result != NULL) {

                    if ($type == 'count') {

                        //Se calcula el total de paginas con esta configuracion
                        $total_pages = ceil(($result[0]['count']) / $pagination);

                        return array(
                            "count" => $result[0]['count'],
                            "pagination" => "" . $pagination,
                            "page" => "" . $page,
                            "total_pages" => "" . $total_pages,
                        );
                    }
                    else
                        return $result;
                }
                else
                    return NULL;
            }
        }