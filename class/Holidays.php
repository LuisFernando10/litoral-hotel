
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
                        feriados.data_inicial,
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

            static function getAllDetail($page = NULL, $pagination = NULL, $type = NULL, $id_feriado = NULL, $data_inicial = NULL, $data_final = NULL, $nome = NULL) {

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
                    $this_condition = 'AND fer.id_feriado = "%s"';
                    $this_condition = sprintf($this_condition, $id_feriado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND fer.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_inicial !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND fer.data_inicial >= "%s"';
                    $this_condition = sprintf($this_condition, $data_inicial);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }
                if ($data_final !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND fer.data_final <= "%s"';
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
                        fer.id_feriado,
                        fer.data_inicial,
                        fer.data_final,
                        fer.nome as nome_feriado,
                        qua_fer.id_quarto_feriado,
                        qua_fer.preco,
                        qua.id_quarto,
                        qua.nome as nome_quarto,
                        qua.image,
                        qua.estado
                    ";
                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                # Query
                $sql = "
                    SELECT
                        $sql_select
                    FROM 
                        quarto_feriado qua_fer
                    INNER JOIN feriados fer ON qua_fer.id_feriado = fer.id_feriado
                    INNER JOIN quartos qua ON qua_fer.id_quarto = qua.id_quarto
                    WHERE
                        1 + 1 = 2
                        $conditions
                    AND qua.estado = 'disponivel'
                    ORDER BY 
                        qua.order_control
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

                $existing_holiday = Holidays::getAll(NULL,NULL,NULL,NULL, NULL,NULL,$nome);

                if ($existing_holiday != NULL) return 'existing-holiday';
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
                $array_data_decode = json_decode( $array_data, true );

                foreach ($array_data_decode as $key => $value) {

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

            #UPDATE
            static function updateHoliday($id_feriado, $data_inicial = NULL, $data_final = NULL, $nome = NULL, $array_data = NULL){

                $existing_holiday = Holidays::getAll(NULL,NULL,NULL,NULL, NULL,NULL, $nome);

                if ($existing_holiday != NULL) return 'existing-holiday';
                else{
                    $sql = "
                        UPDATE
                            feriados
                        SET
                            data_inicial = '$data_inicial',
                            data_final = '$data_final',
                            nome = '$nome'
                        WHERE
                            id_feriado = '$id_feriado'
                    ";

                    $update_holiday = DataBase::query($sql);

                    if ( $update_holiday ){
                        Holidays::updateRoomHoliday($id_feriado, $array_data);
                        return $update_holiday;
                    }
                    else return false;
                }
            }

            static function updateRoomHoliday($id_feriado, $array_data){

                $array_data2 = json_decode( $array_data, true );

                foreach ($array_data2 as $key => $value) {

                    $price = $value['preco'];
                    $id_room_holiday = $value['id_quarto_feriado'];

                    $sql = "
                        UPDATE
                            quarto_feriado
                        SET
                            preco = '$price'
                        WHERE
                            id_feriado = '$id_feriado'
                        AND
                            id_quarto_feriado = '$id_room_holiday'
                    ";

                    DataBase::query($sql);
                }
                return true;
            }
        }