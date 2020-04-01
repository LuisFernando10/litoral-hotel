
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../config-import.php');

        class Files
        {
            /**
             * @Description: Metodo que processa o arquivo escolhido pra mover no caminho fisico do servidor y faz processo de encriptaçao
             */
            static function uploadFile($file_document = NULL){

                //Nos obtemos a extensao do arquivo
                $get_extention = pathinfo($file_document['name'], PATHINFO_EXTENSION);

                //Obtemos os microssegundos atuais e os concatenamos com o nome
                $mtime = microtime(TRUE);
                $varFileName = $file_document['name'] . $mtime;

                //Nós criptografamos o nome do arquivo
                $fileName = hash("sha256", $varFileName);

                //Obtemos o caminho onde o arquivo será salvo
                $galery_folder = __DIR__.'/../assets/img/galery/';

                //Nos validamos se o diretorio ja existe
                Files::verifyDirectoryExisting($galery_folder);

                //Obtemos o nome final do arquivo
                $fileName = $fileName.'.'.$get_extention;

                //Obtemos o caminho aonde vamos mover o arquivo escolhido pelo usuario
                $directory_to_move = __DIR__.'/../assets/img/galery/'. $fileName;

                //Nos movemos o arquivo ao diretorio fisico
                $file_upload = Files::moveUploadFile($file_document, $directory_to_move);

                //Nos validamos se realmente o arquivo foi criado e movido
                if ($file_upload == false)
                    return false;
                else
                    //Nos definimos array com os dados do arquivo
                    return $fileName;
            }

            /**
             * @Description: Metodo que valida a existencia de um diretorio pra cria-lo ou nao
             */
            static function verifyDirectoryExisting($direcotiro_verify = null)
            {
                $directory = $direcotiro_verify;

                if (!file_exists($directory))
                    mkdir($directory, 0755, true);
            }

            /**
             * @Description: Método que move um arquivo para o caminho indicado
             */
            static function moveUploadFile($file_document = NULL, $target_path = NULL)
            {
                if (move_uploaded_file($file_document['tmp_name'], $target_path))
                    return true;
                else
                    return false;
            }

            static function getAll($page = NULL, $pagination = NULL, $type = NULL, $id_archivo = NULL, $nombre = NULL, $alias = NULL, $tipo = NULL, $fecha = NULL, $id_empresa = NULL, $id_template = NULL)
            {
                //Valor por defecto para page
                if (isset($page) && $page != NULL && is_numeric($page)){/* Se deja igual */}
                else
                    $page = 1;

                //Valor por defecto para pagination
                if (isset($pagination) && $pagination != NULL && is_numeric($pagination)) { /* Se deja igual */}
                else
                    $pagination = constant("PAGINATION");

                //Valor por defecto para tipo (normal - count)
                if (isset($type) && $type != NULL) { /* Se deja igual */}
                else
                    $type = "normal";

                //Se calcula desde que registro se va a listar segun la paginacion
                $limit_start = ($page * $pagination) - $pagination;

                //Se contruyen las condiciones de la consulta
                $conditions = "";

                //Filtro por $id_archivo
                if ($id_archivo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.id_archivo = "%s"';
                    $this_condition = sprintf($this_condition, $id_archivo);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $nombre
                if ($nombre !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.nombre = "%s"';
                    $this_condition = sprintf($this_condition, $nombre);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $alias
                if ($alias !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.alias = "%s"';
                    $this_condition = sprintf($this_condition, $alias);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $tipo
                if ($tipo !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.tipo = "%s"';
                    $this_condition = sprintf($this_condition, $tipo);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $fecha
                if ($fecha !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.fecha = "%s"';
                    $this_condition = sprintf($this_condition, $fecha);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $id_empresa
                if ($id_empresa !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.id_empresa = "%s"';
                    $this_condition = sprintf($this_condition, $id_empresa);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                //Filtro por $id_template
                if ($id_template !== NULL) {
                    unset($this_condition);
                    $this_condition = 'AND file.id_template = "%s"';
                    $this_condition = sprintf($this_condition, $id_template);

                    $conditions .= $this_condition;
                    unset($this_condition);
                }

                if ($type == 'count') {

                    $sql_select = "count(*) as count";

                    $sql_limit = "";

                } else {

                    $sql_select = " 
                        file.id_archivo,
                        file.nombre,
                        file.alias,
                        file.tipo,
                        file.fecha,
                        file.id_empresa,
                        file.id_template
                    ";

                    $sql='FROM archivo file
                    WHERE 
                        1+1=2
                        '.$conditions.'
                    ORDER BY 
                        file.id_template ASC';

                    $sql_limit = "LIMIT $limit_start, $pagination";
                }

                $sql = "
                    SELECT 
                        $sql_select
                        $sql
                        $sql_limit
                ";

                $result = Db::query($sql);

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
                    } else
                        return $result;
                } else
                    return NULL;
            }

            static function insertFile($file_name = NULL, $file_alias = NULL, $file_type = NULL, $id_company = NULL, $id_template = NULL){

                $sql = "
                    INSERT INTO archivo (
                        nombre,
                        alias,
                        tipo,
                        fecha,
                        id_empresa,
                        id_template
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        NOW(),
                        '%s',
                        '%s'
                    )
                ";

                $sql = sprintf($sql,
                    $file_name,
                    $file_alias,
                    $file_type,
                    $id_company,
                    $id_template
                );

                $result = Db::query(utf8_decode($sql));

                return $result;
            }

            static function updateFile($file_name = NULL, $file_alias = NULL, $file_type = NULL, $id_company = NULL, $id_template = NULL){

                $sql = "
                    INSERT INTO archivo (
                        nombre,
                        alias,
                        tipo,
                        fecha,
                        id_empresa,
                        id_template
                    )
                    VALUES (
                        '%s',
                        '%s',
                        '%s',
                        NOW(),
                        '%s',
                        '%s'
                    )
                ";

                $sql = sprintf($sql,
                    $file_name,
                    $file_alias,
                    $file_type,
                    $id_company,
                    $id_template
                );

                $result = Db::query(utf8_decode($sql));

                return $result;
            }

            static function deleteFile($id_file= NULL){

                if (ValidateData::validateInt($id_file)==false)
                    return false;

                $sql = "
                    DELETE FROM 
                        archivo 
                    WHERE 
                        id_archivo = '%s'
                ";

                $sql = sprintf($sql,
                    $id_file
                );

                $result = Db::query($sql);

                return $result;
            }

            static function deleteFileServer($file_current_name = NULL){

                //Obtemos o caminho aonde vamos mover o arquivo escolhido pelo usuario
                $file_to_delete = __DIR__.'/../assets/img/galery/'. $file_current_name;

                if (file_exists($file_to_delete)) {

                    //Deletamos o arquivo
                    $return = unlink($file_to_delete);

                    return $return;
                }
                else
                    return false;
            }
        }