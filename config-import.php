
    <?php
        /**
         * @Description: Documento que carga la 'configuraciòn global' y autocarga las 'clases' del proyecto
         * @User: luis.chamorro
         * @Date: 29-feb-2020
         */

        //Importamos el archivo 'config.php' para reutilizar la configuraciòn del mismo
        require_once (dirname(__FILE__).'/config.php');

        //Esto permite autoinstanciar las 'clases' segùn se necesiten sin necesidad de hacer imports en cada archivo
        function autoloader_class($class) {

            //Excepciones
            if($class == 'SebastianBergmann\Invoker\Invoker'){
                //No se importa nada para que no afecte a unit test
            }
            else
                require_once(dirname(__FILE__).'/class/'.$class.'.php');
        }

        //Cargamos el mètodo a la configuraciòn interna de PHP
        spl_autoload_register('autoloader_class');