
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Opiniones'
         * @User: luis.chamorro
         * @Date: 03-mar-2020
         */

        class Rooms
        {
            /**
             * @Description: Metodo que obtem os dados correspondentes aos 'Quartos'
             */
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_quarto = NULL, $nome = NULL, $descricao = NULL, $image = NULL, $preco = NULL, $adultos = NULL, $estado = NULL, $order_control = NULL) {

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

                //Filtro por '$id_quarto'
                if ($id_quarto !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.id_quarto = "%s"';
                    $this_condition = sprintf($this_condition, $id_quarto);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome'
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$descricao'
                if ($descricao !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.descricao = "%s"';
                    $this_condition = sprintf($this_condition, $descricao);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$image'
                if ($image !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.image = "%s"';
                    $this_condition = sprintf($this_condition, $image);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$preco'
                if ($preco !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.preco = "%s"';
                    $this_condition = sprintf($this_condition, $preco);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$adultos'
                if ($adultos !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.adultos = "%s"';
                    $this_condition = sprintf($this_condition, $adultos);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$estado'
                if ($estado !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.estado = "%s"';
                    $this_condition = sprintf($this_condition, $estado);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$order_control'
                if ($order_control !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND quartos.order_control = "%s"';
                    $this_condition = sprintf($this_condition, $order_control);

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
                            quartos.id_quarto,
                            quartos.nome,
                            quartos.descricao,
                            quartos.image,
                            quartos.preco,
                            quartos.adultos,
                            quartos.estado,
                            quartos.order_control
                        ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                //Preparamos el query
                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        quartos
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        quartos.nome
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
             * @Description: Metodo que inserta um quarto no BD
             */
            static function insertRoom($nome = NULL, $descricao = NULL, $image = NULL, $preco = NULL, $adultos = NULL, $estado = NULL){

                // ** Proceso para validar si existe un cuarto con el mismo nombre **
                $existing_quarto = Rooms::getAll(NULL,NULL,NULL,NULL, $nome);

                if ($existing_quarto != NULL)
                    return 'existing_quarto';
                else{
                    //Preparamos Query
                    $sql = "
                        INSERT INTO quartos (
                            nome,
                            descricao,
                            image,
                            preco,
                            adultos,
                            estado,
                            order_control
                        )
                        VALUES (
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            NULL
                        )
                    ";

                    //Nos substitui os valores
                    $sql = sprintf($sql,
                        $nome,
                        $descricao,
                        $image,
                        $preco,
                        $adultos,
                        $estado
                    );

                    //Ejecutamos el query
                    $result = DataBase::query($sql);

                    //Validamos si la consulta se ejecuto correctamente
                    if ($result != NULL)
                        return $result;
                    else
                        return false;
                }
            }

            /**
             * @Description: Metodo que atualiza um quarto no BD
             */
            static function updateRoom($id_quarto = NULL, $nome = NULL, $descricao = NULL, $image = NULL, $preco = NULL, $adultos = NULL, $estado = NULL){

                // ** Proceso para validar si existe un cuarto con el mismo nombre **
                $existing_quarto = Rooms::getAll(NULL,NULL,NULL,NULL, $nome);

                //Variavel de control pra controlar a existencia do mesmo nome em outra tabela
                $existing_control = true;

                //Validamos se a variável é uma matriz (array) pra não possuir erros com o PHP ao momento de percorrer o 'foreach'
                if (is_array($existing_quarto) || is_object($existing_quarto))
                    //Percorremos os dados pra validar se o nome que vai-se salvar já existe com o meu Id
                    foreach ($existing_quarto as $value){

                        //Validamos se o nome existe no mesmo Id que o atual da edição
                        if ($value['id_quarto'] !== $id_quarto)
                            $existing_control = false;
                    }

                //Validamos se o nome existe em outra tabela ou não
                if ($existing_control == false)
                    return 'existing_quarto';
                else{
                    //Validamos se existe ou nao uma imagem pra atualizar
                    if ($image != NULL)
                        $update_image = "image = '$image',";
                    else
                        $update_image = "";

                    //Preparamos el Query
                    $sql = "
                        UPDATE quartos
                        SET
                            nome = '%s',
                            descricao = '%s',
                            $update_image
                            preco = '%s',
                            adultos = '%s',
                            estado = '%s'
                        WHERE
                            id_quarto = '%s'
                    ";

                    //Reemplazamos valores
                    $sql = sprintf($sql,
                        $nome,
                        $descricao,
                        $preco,
                        $adultos,
                        $estado,
                        $id_quarto
                    );

                    //Ejecutamos el Query
                    $result = DataBase::query($sql);

                    //Retornamos el resultado de la consulta (true-false)
                    return $result;
                }
            }

            /**
             * @Description: Metodo que deletea um quarto desde o BD
             */
            static function deleteRoom($id_quarto = NULL){

                //A gente prepara o query
                $sql = "
                    DELETE FROM
                        quartos 
                    WHERE 
                        id_quarto = '%s'
                ";

                //A gente substituimos os valores
                $sql = sprintf($sql,
                    $id_quarto
                );

                //A gente executa o query
                $result = DataBase::query($sql);

                //A gente retorna o resultado da consulta (true-false)
                return $result;
            }
        }