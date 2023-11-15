
    <?php

        /**
         * @Description: Documento que gestiona los CRUD de la información para 'Galería'
         * @User: luis.chamorro
         * @Date: 06-jun-2020
         */

        class Galery
        {
            /**
             * @Description: Metodo que obtem os dados correspondentes a 'Galería'
             */
            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_galeria = NULL, $nome = NULL, $tipo = NULL) {

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

                //Filtro por '$id_galeria'
                if ($id_galeria !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND galeria.id_galeria = "%s"';
                    $this_condition = sprintf($this_condition, $id_galeria);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$nome'
                if ($nome !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND galeria.nome = "%s"';
                    $this_condition = sprintf($this_condition, $nome);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por '$tipo'
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND galeria.tipo = "%s"';
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
                        galeria.id_galeria,
                        galeria.nome,
                        galeria.imagem,
                        galeria.descricao,
                        galeria.tipo,
                        galeria.prioridade
                    ";

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                //Preparamos el query
                $sql = "
                    SELECT 
                        $sql_select
                    FROM 
                        galeria
                    WHERE
                        1+1=2
                        $conditions
                    ORDER BY 
                        galeria.nome
                    $sql_limit
                ";

                //Ejecutamos la consulta
                $result = DataBase::query($sql);

                //Retornamos la respuesta
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
             * @Description: Metodo que inserta uma galeria no BD
             */
            static function insertGalery($nome = NULL, $imagem = NULL, $descricao = NULL, $tipo = NULL){

                // ** Proceso para validar si existe una imagen con el mismo nome **
                $existing_galery = Galery::getAll(NULL,NULL,NULL,NULL, $nome);

                if ($existing_galery != NULL) return 'existing_galery';
                else{
                    //Preparamos Query
                    $sql = "
                        INSERT INTO galeria (
                            nome,
                            imagem,
                            descricao,
                            tipo
                        )
                        VALUES (
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    ";

                    //Nos substitui os valores
                    $sql = sprintf($sql,
                        $nome,
                        $imagem,
                        $descricao,
                        $tipo
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
             * @Description: Metodo que atualiza um galeria no BD
             */
            static function updateGalery($id_galeria = NULL, $nome = NULL, $imagem = NULL, $descricao = NULL, $tipo = NULL){

                // ** Proceso para validar si existe una imagen con el mismo nome **
                $existing_galery = Galery::getAll(NULL,NULL,NULL,NULL, $nome);

                //Variavel de control pra controlar a existencia do mesmo nome em outra tabela
                $existing_control = true;

                //Validamos se a variável é uma matriz (array) pra não possuir erros com o PHP ao momento de percorrer o 'foreach'
                if (is_array($existing_galery) || is_object($existing_galery))
                    //Percorremos os dados pra validar se o nome que vai-se salvar já existe com o meu Id
                    foreach ($existing_galery as $value){

                        //Validamos se o Id existe no mesmo Id que o atual da edição
                        if ($value['id_galeria'] !== $id_galeria)
                            $existing_control = false;
                    }

                //Validamos se o nome existe ou não
                if ($existing_control == false)
                    return 'existing_galery';
                else{

                    //Validamos se existe ou nao uma imagenm pra atualizar
                    if ($imagem != NULL)
                        $update_image = ", imagem = '$imagem'";
                    else
                        $update_image = "";

                    //Preparamos el Query
                    $sql = "
                        UPDATE galeria
                        SET
                            nome = '%s'
                            $update_image,
                            descricao = '%s',
                            tipo = '%s'
                        WHERE
                            id_galeria = '%s'
                    ";

                    //Reemplazamos valores
                    $sql = sprintf($sql,
                        $nome,
                        $descricao,
                        $tipo,
                        $id_galeria
                    );

                    //Ejecutamos el Query
                    $result = DataBase::query($sql);

                    //Retornamos el resultado de la consulta (true-false)
                    return $result;
                }
            }

            /**
             * @Description: Metodo que deletea uma galeria desde o BD
             */
            static function deleteGalery($id_galeria = NULL){

                //A gente prepara o query
                $sql = "
                            DELETE FROM
                                galeria 
                            WHERE 
                                id_galeria = '%s'
                        ";

                //A gente substituimos os valores
                $sql = sprintf($sql,
                    $id_galeria
                );

                //A gente executa o query
                $result = DataBase::query($sql);

                //A gente retorna o resultado da consulta (true-false)
                return $result;
            }
        }