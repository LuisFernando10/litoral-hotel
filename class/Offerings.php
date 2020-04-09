
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Oferecimentos'
         * @User: luis.chamorro
         * @Date: 08-abr-2020
         */

        class Offerings
        {
            /**
             * @Description: Metodo que obtem os dados correspondentes aos 'Quartos'
             */
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_oferecimento = NULL, $nome = NULL, $tipo = NULL, $prioridade = NULL) {

                //Valor por defeito para '$page'
                if (isset($page) && $page != NULL && is_numeric($page)){
                    /* Se deixa igual */
                }
                else
                    $page = 1;

                //Valor por defeito para '$pagination'
                if (isset($pagination) && $pagination != NULL && is_numeric($pagination)) {
                    /* Se deixa igual */
                }
                else
                    $pagination = constant("PAGINATION");

                //Valor por defeito para '$type' (normal - count)
                if (isset($type) && $type != NULL) {
                    /* Se deixa igual */
                }
                else
                    $type = "normal";

                //Se calcula desde que registro se va a listar según la paginacion
                $limit_start = ($page * $pagination) - $pagination;

                //Construimos las condiciones de la consulta
                $conditions = "";

                //Filtro por '$id_oferecimento'
                if ($id_oferecimento !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND oferecimentos.id_oferecimento = "%s"';
                    $this_condition = sprintf($this_condition, $id_oferecimento);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome'
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND oferecimentos.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$tipo'
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND oferecimentos.tipo = "%s"';
                    $this_condition = sprintf($this_condition, $tipo);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$prioridade'
                if ($prioridade !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND oferecimentos.prioridade = "%s"';
                    $this_condition = sprintf($this_condition, $prioridade);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Evaluamos el tipo de consulta
                if ($type == 'count') {
                    $sql_select = "count(*) as count";
                    $sql_limit = '';
                }
                else {
                    $sql_select = "
                                            oferecimentos.id_oferecimento,
                                            oferecimentos.nome,
                                            oferecimentos.tipo,
                                            oferecimentos.prioridade
                                        ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                //Preparamos el query
                $sql = "
                                    SELECT 
                                        $sql_select
                                    FROM 
                                        oferecimentos
                                    WHERE
                                        1+1=2
                                        $conditions
                                    ORDER BY 
                                        oferecimentos.prioridade
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
        }