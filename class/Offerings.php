
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Oferecimentos'
         * @User: luis.chamorro
         * @Date: 08-abr-2020
         */

        class Offerings
        {
            /**
             * @Description: Metodo que obtem os dados correspondentes aos 'Oferecimentos'
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

            /**
             * @Description: Método que insere um orferecimento no BD
             */
            static function insertOffering($id_plantilla = NULL, $array_data_tags = NULL){

                //Validamos
                if (ValidateData::validateInt($id_plantilla) == false)
                    return false;

                //Definimos variables de control para insertar los registros en la BD
                $counter = 0;
                $new_insert_row = '';

                //Recorremos el array general ($data_array) para obtener cada uno de los datos recibidos como objeto
                foreach ($array_data_tags as $object) {

                    //Guardamos la coma(,) separadora que diferenciará un 'VALUE-Insert' del anterior
                    $coma = ',';

                    //Si contador es 0, no va la coma(,) para no generar error de sintaxis en el insert (Será el primer insert)
                    if ($counter == 0)
                        $coma = '';

                    //Validamos que el 'Id_etiqueta' exista y no esté vacío para hacer la 'Edición'
                    if ($object['id_tag'] != '')
                        //Obtenemos cada una de las plantillas correspondientes a su 'prioridad'
                        $data_item = Tag::getAllTag(NULL, NULL, NULL, $object['id_tag'], $id_plantilla, NULL);
                    else
                        $data_item = NULL;

                    //Si hay información, 'actualizamos' las que ya hay, si no, 'insertamos' nuevas etiquetas
                    if ($data_item != NULL)
                        //Actualizamos la plantilla correspondiente a la prioridad en curso
                        Tag::updateTag($data_item[0]['id_etiqueta'], $id_plantilla, html_entity_decode($object['nombre'], ENT_QUOTES | ENT_HTML401, "UTF-8"));
                    else {
                        //Variable que contiene la cadena de inserción a la Bd "Ej: VALUE ',(valor, valor, valor')"
                        $new_insert_row .= "$coma(".$id_plantilla.",'".html_entity_decode($object['nombre'], ENT_QUOTES | ENT_HTML401, "UTF-8")."')";

                        //Incrementamos contador para referirnos a más de una inserción
                        $counter++;
                    }
                }

                //Validamos si contador sigue en 0 para asumir que no se hizo ninguna actualización
                if ($counter == 0)
                    return true;

                //Preparamos el Query
                $sql = "
                    INSERT INTO etiqueta
                    (
                        id_plantilla,
                        nombre
                    )
                    VALUES 
                ".$new_insert_row;

                //Ejecutamos el Query
                $result = DataBase::query($sql);

                //Retornamos el Id de la plantilla recién ingresada
                return $result;
            }

            /**
             * @Description: Método que reordena consecutivamente las prioridades de 'Ofrecimientos'
             */
            static function updatePriorityOffering($id_plantilla = NULL, $id_plantilla_detalle = NULL,$prioridad = NULL){

                //Preparamos el Query
                $sql = "
                    UPDATE
                        plantilla_detalle
                    SET
                        prioridad = '%s'
                    WHERE
                        id_plantilla_detalle = '%s'
                ";

                //Reemplazamos valores
                $sql = sprintf($sql,
                    $prioridad,
                    $id_plantilla_detalle
                );

                //Ejecutamos el Query
                $result = DataBase::query($sql);

                //Retornamos la operación true-false
                return $result;
            }
        }