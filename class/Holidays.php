
    <?php

        class Holidays {

            # SELECT
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_feriado = NULL, $data_inicial = NULL, $data_final = NULL, $nome = NULL) {

                # General
                $page = isset($page) && $page != NULL && is_numeric($page) ? $page : 1;
                $pagination = isset($pagination) && $pagination != NULL && is_numeric($pagination) ? $pagination : constant("PAGINATION");
                $type = isset($type) && $type != NULL && is_numeric($type) ? $type : 'normal';

                # Condiciones
                $limit_start = ($page * $pagination) - $pagination;
                $conditions = "";

                # Filtros
                if ($id_feriado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND feriados.id_feriado = "%s"';
                    $this_condition = sprintf($this_condition, $id_feriado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND feriados.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_inicial !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND feriados.data_inicial >= "%s"';
                    $this_condition = sprintf($this_condition, $data_inicial);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_final !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND feriados.data_final <= "%s"';
                    $this_condition = sprintf($this_condition, $data_final);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                # Tipo Consulta
                if ($type == 'count') {
                    $sql_select = "count(*) as count";
                    $sql_limit = '';
                }
                else {
                    $sql_select = "
                        feriados.id_feriado,
                        feriados.data_inial,
                        feriados.data_final,
                        feriados.nome
                    ";
                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                # Query
                $sql = "
                    SELECT
                        $sql_select
                    FROM 
                        feriados
                    WHERE
                        1 + 1 = 2
                        $conditions
                    ORDER BY 
                        feriados.data_inicial
                    $sql_limit
                ";

                # Ejecucíon
                $result = DataBase::query($sql);

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
            static function insertHoliday($data_inicial = NULL, $data_final = NULL, $nome = NULL, $array_data = NULL){

                $existing_quarto = Holidays::getAll(NULL,NULL,NULL,NULL, NULL,NULL,$nome);

                if ($existing_quarto != NULL) return 'existing-holiday';
                else{
                    $sql = "
                        INSERT INTO feriados (
                            data_inicial,
                            data_final,
                            nome
                        )
                        VALUES (
                            '$data_inicial',
                            '$data_final',
                            '$nome'
                        )
                    ";

                    $id_holiday = DataBase::query($sql);

                    if ( is_numeric($id_holiday) ){
                        Holidays::insertRoomHoliday($id_holiday, $array_data);
                        return $id_holiday;
                    }
                    else return false;
                }
            }

            static function insertRoomHoliday($id_feriado, $array_data){

                $counter = 0;
                $data_values = '';

                foreach ($array_data as $value) {

                    $coma = $counter === 0 ? '' : ',';
                    $data_values .= "$coma('" . $value['id_quarto'] . "', '$id_feriado', '" . $value['preco'] . "')";
                    $counter++;

                }

                if ($counter == 0) return false;

                $sql = "
                    INSERT INTO
                        quarto_feriado
                        (
                            id_quarto,
                            id_feriado,
                            preco
                        )
                    VALUES
                " . $data_values;

                return DataBase::query($sql);
            }
        }