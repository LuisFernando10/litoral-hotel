
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Configuracoes'
         * @User: luis.chamorro
         * @Date: 29-abr-2020
         */

        class Configurations
        {
            # SELECT
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_configuracao = NULL, $barrio = NULL, $estado = NULL, $pais = NULL, $telefones = NULL, $tipo = NULL, $emails = NULL) {

                #General
                $page = isset($page) && $page != NULL && is_numeric($page) ? $page : 1;
                $pagination = isset($pagination) && $pagination != NULL && is_numeric($pagination) ? $pagination : constant("PAGINATION");;
                $type = isset($type) && $type != NULL && is_numeric($type) ? $type : 'normal';

                #Condiciones
                $limit_start = ($page * $pagination) - $pagination;
                $conditions = "";

                #Filtros
                if ($id_configuracao !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.id_configuracao = "%s"';
                    $this_condition = sprintf($this_condition, $id_configuracao);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($barrio !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.barrio = "%s"';
                    $this_condition = sprintf($this_condition, $barrio);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($pais !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.pais = "%s"';
                    $this_condition = sprintf($this_condition, $pais);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($telefones !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.telefones = "%s"';
                    $this_condition = sprintf($this_condition, $telefones);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($barrio !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.barrio = "%s"';
                    $this_condition = sprintf($this_condition, $barrio);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.tipo = "%s"';
                    $this_condition = sprintf($this_condition, $tipo);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($emails !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND configuracoes.email = "%s"';
                    $this_condition = sprintf($this_condition, $emails);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                #Campos
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
                        configuracoes.tipo,
                        configuracoes.email,
                        configuracoes.numero_wp
                    ";
                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                #Query
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

                #Executar
                $result = DataBase::query($sql);

                #Resposta
                if (isset($result[0]) && $result != NULL) {
                    if ($type == 'count') {
                        $total_pages = ceil(($result[0]['count']) / $pagination);
                        return [
                            "count" => $result[0]['count'],
                            "pagination" => "" . $pagination,
                            "page" => "" . $page,
                            "total_pages" => "" . $total_pages,
                        ];
                    }
                    else return $result;
                }
                else return NULL;
            }

            # INSERT
            static function insertConfiguration($barrio = NULL, $estado = NULL, $pais = NULL, $array_data = NULL, $array_email = NULL, $numero_wp  = NULL){

                # Procesamos os dados dos '$array' pra obter os 'telefones', os 'tipos' e os 'email'
                $phones = [];
                $type = [];
                $emails = [];

                #Telefones
                foreach ($array_data as $key => $value){
                    $phones[] = $value['telefone'];
                   $type[] = $value['tipo'];
                }

                #Email
                foreach ($array_email as $key => $value){
                    $emails[] = $value['email'];
                }

                #Query
                $sql = "
                    INSERT INTO configuracoes
                    (
                        barrio,
                        estado,
                        pais,
                        telefones,
                        tipo,
                        email,
                        numero_wp
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s'
                    )
                ";
                $sql = sprintf($sql,
                    $barrio,
                    $estado,
                    $pais,
                    json_encode($phones),
                    json_encode($type),
                    json_encode($emails),
                    $numero_wp
                );

                #Executar
                $result = DataBase::query($sql);

                #Resposta
                if ($result != NULL) return $result;
                else return false;
            }

            # UPDATE
            static function updateConfiguration($id_configuracao = NULL, $barrio = NULL, $estado = NULL, $pais = NULL, $array_data = NULL, $array_email = NULL, $numero_wp  = NULL){

                // *** Procesamos os dados dos '$array' pra obter os 'telefones', os 'tipos' e os 'email' ***

                $phones = [];
                $type = [];
                $emails = [];

                # Telefones
                foreach ($array_data as $key => $value){
                    $phones[] = $value['telefone'];
                    $type[] = $value['tipo'];
                }

                #Email
                foreach ($array_email as $key => $value){
                    $emails[] = $value['email'];
                }

                #Query
                $sql = "
                    UPDATE
                        configuracoes
                    SET
                        barrio = '%s',
                        estado = '%s',
                        pais = '%s',
                        telefones = '%s',
                        tipo = '%s',
                        email = '%s',
                        numero_wp = '%s'
                    WHERE
                        id_configuracao = '%s'
                ";
                $sql = sprintf($sql,
                    $barrio,
                    $estado,
                    $pais,
                    json_encode($phones),
                    json_encode($type),
                    json_encode($emails),
                    $numero_wp,
                    $id_configuracao
                );

                #Resposta
                return DataBase::query($sql);
            }
        }