
    <?php

        class Promotions
        {
            # SELECT
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_promocao = NULL, $id_quarto = NULL, $nome = NULL, $data_inicial = NULL, $data_final = NULL, $estado = NULL) {

                #General
                $page = isset($page) && $page != NULL && is_numeric($page) ? $page : 1;
                $pagination = isset($pagination) && $pagination != NULL && is_numeric($pagination) ? $pagination : constant("PAGINATION");
                $type = isset($type) && $type != NULL && is_numeric($type) ? $type : 'normal';

                #Condiciones
                $limit_start = ($page * $pagination) - $pagination;
                $conditions = "";

                #Filtros
                if ($id_promocao !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND promocao.id_promocao = "%s"';
                    $this_condition = sprintf($this_condition, $id_promocao);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($id_quarto !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND promocao.id_quarto = "%s"';
                    $this_condition = sprintf($this_condition, $id_quarto);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND promocao.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_inicial !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND DATE(promocao.data_inicial) >= "%s"';
                    $this_condition = sprintf($this_condition, $data_inicial);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_final !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND DATE(promocao.data_final) <= "%s"';
                    $this_condition = sprintf($this_condition, $data_final);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND promocao.estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

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
                        promocao.id_promocao,
                        promocao.id_quarto,
                        quartos.nome_quarto,
                        promocao.nome,
                        promocao.data_inicial,
                        promocao.data_final,
                        promocao.preco,
                        promocao.estado
                    ";
                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                #Query
                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        promocao
                    INNER JOIN quartos ON promocao.id_quarto = quartos.id_quarto
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        promocao.data_inicial
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
            static function insertPromotion($id_quarto = NULL, $nome = NULL, $data_inicial = NULL, $data_final = NULL, $preco = NULL){

                #Query
                $sql = "
                    INSERT INTO promocao
                    (
                        id_quarto,
                        nome,
                        data_inicial,
                        data_final,
                        preco,
                        estado
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        'proximo'
                    )
                ";
                $sql = sprintf($sql,
                    $id_quarto,
                    $nome,
                    $data_inicial,
                    $data_final,
                    $preco
                );

                #Executar
                $result = DataBase::query($sql);

                #Resposta
                if ($result != NULL) return $result;
                else return false;
            }

            # UPDATE
            static function updatePromotion($id_promocao = NULL, $id_quarto = NULL, $nome = NULL, $data_inicial = NULL, $data_final = NULL, $preco = NULL){

                #Query
                $sql = "
                    UPDATE
                        promocao
                    SET
                        id_quarto = '%s',
                        nome = '%s',
                        data_inicial = '%s',
                        data_final = '%s',
                        preco = '%s'
                    WHERE
                        id_promocao = '%s'
                ";
                $sql = sprintf($sql,
                    $id_quarto,
                    $nome,
                    $data_inicial,
                    $data_final,
                    $preco,
                    $id_promocao
                );

                #Resposta
                return DataBase::query($sql);
            }
        }