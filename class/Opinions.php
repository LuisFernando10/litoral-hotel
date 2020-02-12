
    <?php

    /**
     * @Description: Documento que gestiona los CRUD de la información para 'Opiniones'
     * @User: luis.chamorro
     * @Date: 12-feb-2020
     */


    class Opinions
    {

        static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_opiniao = NULL, $op_nome = NULL, $op_texto = NULL, $op_data = NULL, $op_status = NULL) {

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

            //Filtro por '$id_opiniao'
            if ($id_opiniao !== NULL) {
                unset($this_condition);
                $this_condition = 'AND opiniao.id_usuario = "%s"';
                $this_condition = sprintf($this_condition, $id_opiniao);

                $conditions .= $this_condition;
                unset($this_condition);
            }

            //Filtro por '$op_nome'
            if ($op_nome !== NULL) {
                unset($this_condition);
                $this_condition = 'AND opiniao.op_nome = "%s"';
                $this_condition = sprintf($this_condition, $op_nome);

                $conditions .= $this_condition;
                unset($this_condition);
            }

            //Filtro por '$op_texto'
            if ($op_texto !== NULL) {
                unset($this_condition);
                $this_condition = 'AND opiniao.op_texto = "%s"';
                $this_condition = sprintf($this_condition, $op_texto);

                $conditions .= $this_condition;
                unset($this_condition);
            }

            //Filtro por '$op_data'
            if ($op_data !== NULL) {
                unset($this_condition);
                $this_condition = 'AND opiniao.op_data = "%s"';
                $this_condition = sprintf($this_condition, $op_data);

                $conditions .= $this_condition;
                unset($this_condition);
            }

            //Filtro por '$op_status'
            if ($op_status !== NULL) {
                unset($this_condition);
                $this_condition = 'AND opiniao.op_status = "%s"';
                $this_condition = sprintf($this_condition, $op_status);

                $conditions .= $this_condition;
                unset($this_condition);
            }

            if ($type == 'count') {
                $sql_select = "count(*) as count";
                $sql_limit = '';
            }
            else {
                $sql_select = "
                    opiniao.id_opiniao,
                    opiniao.op_nome,
                    opiniao.op_texto,
                    opiniao.op_data,
                    opiniao.op_status
                ";

                $sql_limit = "LIMIT $limit_start, $pagination";
            }

            $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        opiniao
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        opiniao.op_data
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