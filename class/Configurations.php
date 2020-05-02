
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Configuracoes'
         * @User: luis.chamorro
         * @Date: 29-abr-2020
         */

        class Configurations
        {
            /**
             * @Description: Metodo que obtem os dados correspondentes aos 'Configuracoes'
             */
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_configuracao = NULL, $barrio = NULL, $estado = NULL, $pais = NULL, $telefones = NULL, $tipo = NULL) {

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

                //Filtro por '$id_configuracao'
                if ($id_configuracao !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.id_configuracao = "%s"';
                    $this_condition = sprintf($this_condition, $id_configuracao);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$barrio'
                if ($barrio !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.barrio = "%s"';
                    $this_condition = sprintf($this_condition, $barrio);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$estado'
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$pais'
                if ($pais !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.pais = "%s"';
                    $this_condition = sprintf($this_condition, $pais);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$telefones'
                if ($telefones !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.telefones = "%s"';
                    $this_condition = sprintf($this_condition, $telefones);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$barrio'
                if ($barrio !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.barrio = "%s"';
                    $this_condition = sprintf($this_condition, $barrio);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$tipo'
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.tipo = "%s"';
                    $this_condition = sprintf($this_condition, $tipo);

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
                        configuracoes.id_configuracao,
                        configuracoes.barrio,
                        configuracoes.estado,
                        configuracoes.pais,
                        configuracoes.telefones,
                        configuracoes.tipo
                    ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                //Preparamos el query
                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        configuracoes
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        configuracoes.id_configuracao
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
             * @Description: Método que insere um orferecimento no BD
             */
            static function insertConfiguration($barrio = NULL, $estado = NULL, $pais = NULL, $array_data = NULL){

                // *** Procesamos os dados do '$array_data' pra obter os 'telefones' e os 'tipos' ***

                //Criamos as variáveis que guardarao os telefones e os tipos
                $phones = [];
                $type = [];

                //Iteramos sobre o '$array_data'
                foreach ($array_data as $key => $value){
                    //Alimentamos os arrays generales correspondente ao dado certo
                    $phones[] = $value['telefone'];
                   $type[] = $value['tipo'];
                }

                //Preparamos el Query
                $sql = "
                    INSERT INTO configuracoes
                    (
                        barrio,
                        estado,
                        pais,
                        telefones,
                        tipo
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s'
                    )
                ";

                //Nos substitui os valores
                $sql = sprintf($sql,
                    $barrio,
                    $estado,
                    $pais,
                    json_encode($phones),
                    json_encode($type)
                );

                //Executamos o Query
                $result = DataBase::query($sql);

                //Validamos se a operacao foi com sucesso
                if ($result != NULL)
                    return $result;
                else
                    return false;
            }

            /**
             * @Description: Método que 'atualiza' um orferecimento no BD
             */
            static function updateConfiguration($id_configuracao = NULL, $barrio = NULL, $estado = NULL, $pais = NULL, $array_data = NULL){

                // *** Procesamos os dados do '$array_data' pra obter os 'telefones' e os 'tipos' ***

                //Criamos as variáveis que guardarao os telefones e os tipos
                $phones = [];
                $type = [];

                //Iteramos sobre o '$array_data'
                foreach ($array_data as $key => $value){
                    //Alimentamos os arrays generales correspondente ao dado certo
                    $phones[] = $value['telefone'];
                    $type[] = $value['tipo'];
                }

                //Preparamos el SQL
                $sql = "
                    UPDATE
                        configuracoes
                    SET
                        barrio = '%s',
                        estado = '%s',
                        pais = '%s',
                        telefones = '%s',
                        tipo = '%s'
                    WHERE
                        id_configuracao = '%s'
                ";

                //Reemplazamos valores
                $sql = sprintf($sql,
                    $barrio,
                    $estado,
                    $pais,
                    json_encode($phones),
                    json_encode($type),
                    $id_configuracao
                );

                //Ejecutamos el Query (true-false)
                $result = DataBase::query($sql);

                //Retornamos a resposta
                return $result;
            }
        }