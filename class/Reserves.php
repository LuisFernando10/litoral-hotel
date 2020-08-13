
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Correos Electrónicos'
         * @User: luis.chamorro
         * @Date: 19-jun-2020
         */

        class Reserves
        {
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_reserva = NULL, $nome_cliente = NULL, $telefone = NULL, $email = NULL, $data_entrada = NULL, $data_saida = NULL, $num_quartos = NULL, $num_adultos = NULL, $num_criancas = NULL, $valor_total = NULL, $data_reserva = NULL, $estado = NULL) {

                //Valor por defecto para 'page'
                if (isset($page) && $page != NULL && is_numeric($page)){/* Se deja igual */}
                else $page = 1;

                //Valor por defecto para 'pagination'
                if (isset($pagination) && $pagination != NULL && is_numeric($pagination)) {/* Se deja igual */}
                else $pagination = constant("PAGINATION");

                //Valor por defecto para tipo (normal - count)
                if (isset($type) && $type != NULL) {/* Se deja igual */}
                else $type = "normal";

                //Se calcula desde que registro se va a listar segun la paginacion
                $limit_start = ($page * $pagination) - $pagination;

                //Construimos las condiciones de la consulta
                $conditions = "";

                //Filtro por '$id_reserva'
                if ($id_reserva !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.id_reserva = "%s"';
                    $this_condition = sprintf($this_condition, $id_reserva);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome_cliente'
                if ($nome_cliente !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.nome_cliente = "%s"';
                    $this_condition = sprintf($this_condition, $nome_cliente);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$telefone'
                if ($telefone !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.telefone = "%s"';
                    $this_condition = sprintf($this_condition, $telefone);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$email'
                if ($email !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.email = "%s"';
                    $this_condition = sprintf($this_condition, $email);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$data_entrada'
                if ($data_entrada !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.data_entrada = "%s"';
                    $this_condition = sprintf($this_condition, $data_entrada);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$data_saida'
                if ($data_saida !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.data_saida = "%s"';
                    $this_condition = sprintf($this_condition, $data_saida);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$num_quartos'
                if ($num_quartos !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.num_quartos = "%s"';
                    $this_condition = sprintf($this_condition, $num_quartos);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$num_adultos'
                if ($num_adultos !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.num_adultos = "%s"';
                    $this_condition = sprintf($this_condition, $num_adultos);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$num_criancas'
                if ($num_criancas !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.num_criancas = "%s"';
                    $this_condition = sprintf($this_condition, $num_criancas);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$valor_total'
                if ($valor_total !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.valor_total = "%s"';
                    $this_condition = sprintf($this_condition, $valor_total);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$data_reserva'
                if ($data_reserva !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.data_reserva = "%s"';
                    $this_condition = sprintf($this_condition, $data_reserva);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$estado'
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND reservas.estado = "%s"';
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
                        reservas.id_reserva,
                        reservas.id_quarto,
                        reservas.nome_cliente,
                        reservas.telefone,
                        reservas.email,
                        reservas.mensagem,
                        reservas.data_entrada,
                        reservas.data_saida,
                        reservas.num_dias,
                        reservas.num_quartos,
                        reservas.num_adultos,
                        reservas.num_criancas,
                        reservas.valor_total,
                        reservas.data_reserva,
                        reservas.estado
                    ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        reservas
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        reservas.data_reserva DESC
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
                else return NULL;
            }

            /**
             * @Description: Metodo que inserta un email en la BD
             */
            static function insertReserve($id_quarto = NULL, $nome_cliente = NULL, $telefone = NULL, $email = NULL, $mensagem = NULL, $data_entrada = NULL, $data_saida = NULL, $num_quartos = NULL, $num_adultos = NULL, $num_criancas = NULL, $valor_total = NULL){

                //Nós removemos as vírgulas do valor total
                $sanitized_total_value = str_replace(",", "", $valor_total);

                //Preparamos Query
                $sql = "
                    INSERT INTO reservas (
                        id_quarto,
                        nome_cliente,
                        telefone,
                        email,
                        mensagem,
                        data_entrada,
                        data_saida,
                        num_quartos,
                        num_adultos,
                        num_criancas,
                        valor_total,
                        data_reserva,
                        estado
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        NOW(),
                        'pendente'
                    )
                ";

                //Reemplazamos los valores
                $sql = sprintf($sql,
                    $id_quarto,
                    $nome_cliente,
                    $telefone,
                    $email,
                    $mensagem,
                    $data_entrada,
                    $data_saida,
                    $num_quartos,
                    $num_adultos,
                    $num_criancas,
                    $sanitized_total_value
                );

                //Ejecutamos el query
                $result = DataBase::query($sql);

                //Validamos si la consulta se ejecuto correctamente
                if ($result != NULL) return $result;
                else return false;
            }
        }