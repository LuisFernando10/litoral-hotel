
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Correos Electrónicos'
         * @User: luis.chamorro
         * @Date: 19-jun-2020
         */

        class HotelContact
        {
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_contato_hotel = NULL, $nome = NULL, $email = NULL, $telefone = NULL, $mensagem = NULL, $data = NULL, $tipo = NULL, $estado = NULL) {

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

                //Filtro por '$id_contato_hotel'
                if ($id_contato_hotel !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.id_contato_hotel = "%s"';
                    $this_condition = sprintf($this_condition, $id_contato_hotel);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome'
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$email'
                if ($email !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.email = "%s"';
                    $this_condition = sprintf($this_condition, $email);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$telefone'
                if ($telefone !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.telefone = "%s"';
                    $this_condition = sprintf($this_condition, $telefone);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$data'
                if ($data !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.data = "%s"';
                    $this_condition = sprintf($this_condition, $data);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$tipo'
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.tipo = "%s"';
                    $this_condition = sprintf($this_condition, $tipo);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$estado'
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND contato_hotel.estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Evaluamos si es una consulta 'normal' o de 'count'
                if ($type == 'count') {
                    $sql_select = "count(*) as count";
                    $sql_limit = '';
                }
                else {
                    $sql_select = "
                            contato_hotel. 	id_contato_hotel,
                            contato_hotel.nome,
                            contato_hotel.email,
                            contato_hotel.mensagem,
                            contato_hotel.data,
                            contato_hotel.telefone,
                            contato_hotel.tipo,
                            contato_hotel.estado
                        ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        contato_hotel
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        contato_hotel.data DESC
                    $sql_limit
                ";

                //Ejecutamos la consulta
                $result = DataBase::query($sql);

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

            /**
             * @Description: Metodo que inserta un email en la BD
             */
            static function insertEmail($nome = NULL, $email = NULL, $telefone = NULL, $mensagem = NULL, $tipo = NULL){

                //Preparamos Query
                $sql = "
                    INSERT INTO contato_hotel (
                        nome,
                        email,
                        mensagem,
                        data,
                        telefone,
                        tipo,
                        estado
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        NOW(),
                        '%s',
                        '%s',
                        'sem_ler'
                    )
                ";

                //Reemplazamos los valores
                $sql = sprintf($sql,
                    $nome,
                    $email,
                    $mensagem,
                    $telefone,
                    $tipo
                );

                //Ejecutamos el query
                $result = DataBase::query($sql);

                //Validamos si la consulta se ejecuto correctamente
                if ($result != NULL)
                    return $result;
                else return false;
            }
        }