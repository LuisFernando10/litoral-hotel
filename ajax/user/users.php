
    <?php

        /**
         * @Description: Documento que procesa y gestiona la informacion de los usuarios
         * @User: luis.chamorro
         * @Date: 06-feb-2020
         */

        //Cargamos la configuracion global
        require_once dirname(__FILE__).'/../../config-import.php';

        $user_data = Users::getAll(null, null, null, null, null, null, null);

        echo json_encode($user_data);
