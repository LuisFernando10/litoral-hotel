
    /**
     * @Description: Método que valida um telefone válido
     */
    function phone_validatios(){
        $('.js-input-number').on('input', function () {
            this.value = this.value.replace(/[^0-9()-. ]/g,'');
        });
    }

    /**
     * @Description: Método para notificación de 'Exito'
     */
    function notify_success_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">check_circle</i>',
            message: message
        },{
            type: 'success',
            timer: time,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para notificación de 'Error'
     */
    function notify_error_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">error</i>',
            message: message
        },{
            type: 'danger',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para notificación de 'Advertencia'
     */
    function notify_warning_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">warning</i>',
            message: message
        },{
            type: 'warning',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para validar texto com todos os caracteres
     */
    function validateFullString(index, length = 128, message = 'Este campo é obrigatório.') {

        let value = index.val();

        if (value === null || value === "" || value.length === 0){

            index.addClass('border-bottom border-danger');
            notify_warning_notification(message);
            return false;
        }
        else if (value.length > length){
            index.addClass('border-bottom border-danger');
            notify_warning_notification(message);
            return false;
        }
        else{
            index.removeClass('border-bottom border-danger');
            return true;
        }
    }

    /**
     * @Description: Método para marcar o borde de cor vermelho quando um processo errou
     */
    function markErrorBorder(index, message = 'Ocorreu um erro.') {

        index.addClass('border-bottom border-danger');
        notify_warning_notification(message);
        return false;
    }

    /**
     * @Description: Método pra validar um email
     */
    function validateEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    /**
     * @Description: Método pra validar um número
     */
    function validateNumber(number) {
        let regExp = /^([0-9])*$/;
        return regExp.test(number);
    }

    /**
     * @Description: Método pra validar um número de telefone
     */
    function validatePhoneNumber(number) {
        let regExp = /^([0-9()+])*$/;
        return regExp.test(number);
    }

    /**
     * @Description: Método que valida se uma data é maior que outra
     */
    function validateIsGreaterDate(element_initial_date = null, element_final_date = null, initial_date, final_date) {

        if (Date.parse(initial_date) > Date.parse(final_date)){
            notify_error_notification('A "Data de Chegada" deve ser menor que a "Data de Saída".');
            return false;
        }
    }

    /**
     * @Description: Format a decimal number, add decimals, separate decimals from integers, and separate thousand units
     * @Param: Number|NumberDecimals|DecimalSeparator|ThousandUnitsSeparator
     * @return: (string) formatted number
     */
    function number_format_js(number, decimals, dec_point, thousands_point) {

        //if (number == null || !isFinite(number)) throw new TypeError("number is not valid");

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) dec_point = '.';

        if (!thousands_point) thousands_point = ',';

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    }

    /**
     * @Description: Method that returns the value formatted with correct decimals
     * @Call: When el método 'addOrRemoveDecimalsToAffiliateValue()' es ejecutado
     * @Param: String (Value or Balance of afiliate)
     * @return: (sting) Number with decimals without aproximation
     */
    function numberFormatNoApproximationJs(value_nunber){

        //We capture the 'value of the affiliate' in a variable to facilitate access to it
        var valueBalance = value_nunber;
        //Formatting the value, we show 4 decimals, separate the decimals with (,) and separate with space the units of a thousand
        valueBalance = number_format_js(valueBalance,2,',','.');
        //We obtain and save the last 4 characters of the received value as parameter
        var correctDecimals = value_nunber.substr(value_nunber.length-2);
        //We obtain and save the last 5 characters of the formatted value, also obtaining the comma (,) that separates the decimals
        var decimalsToEliminate = valueBalance.substr(valueBalance.length-3);
        //We search and delete the last 5 characters obtained to leave only the whole part of the value
        var valueWithoutDecimals = valueBalance.replace(decimalsToEliminate,'');
        //The value of integers is concatenated with decimals of the original value
        //We return the formatted value of the member's obligation and with the correct decimals
        return valueWithoutDecimals + ',' + correctDecimals;
    }

    /**
     * @Description: Method to validate the addition or not of the decimals of the balance
     * @Param: String (Value or Balance of afiliate)
     * @return: (sting) Number with or without decimals
     */
    function addOrRemoveDecimalsToAffiliateValue(value_number){
        //We obtain and save the total balance of the affiliate
        var valueBalance = value_number;
        //We obtain the position in which the last point is found (.)
        var positionCharacterLastPoint = valueBalance.lastIndexOf(',');
        //We get the last 4 characters of the value, which are the decimals
        var lastFourChararcters = valueBalance.substr(positionCharacterLastPoint+1,4);

        //Initialize variable that will contain the definitive value
        var formattedValue ='';
        //We evaluate if the different decimals of the number end in '0000', '000', '00' or '0'; and hide them respectively
        if (lastFourChararcters === '0000'){
            //We format the value and we do not show decimals
            formattedValue = number_format_js(valueBalance,2,',','.');
            //We search and delete the last 3 characters to delete the comma (,) and the zeros (00) that are added by default (, 00)
            //formattedValue = formattedValue.replace(formattedValue.substr(-3),'');
        }
        else if (lastFourChararcters.substr(-3) === '000'){
            //We format the value and we do show one decimal
            formattedValue = number_format_js(valueBalance,2,',','.');
        }
        else if (lastFourChararcters.substr(-2) === '00'){
            //We format the value and we do show two decimals
            formattedValue = number_format_js(valueBalance,2,',','.');
        }
        else if (lastFourChararcters.substr(-1) === '0'){
            //We format the value and we do show three decimals
            formattedValue = number_format_js(valueBalance,2,',','.');
        }
        else{
            //We save the formatted value that returns the method that takes away the approximation
            formattedValue = numberFormatNoApproximationJs(valueBalance);
        }
        //We return the value with or without decimals
        return formattedValue;
    }