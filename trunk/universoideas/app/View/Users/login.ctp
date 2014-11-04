<script type="text/javascript">
    function checkUserName(value) {
        $.get('/users/exists/' + value, function(data) {
            var rs = $(data).find("#result").val();
            if(rs == 0) { 
                var enable = validarSubmit();
                if (enable == true) {
                    $('.img_success').css('display', '');
                    $('.img_error').css('display', 'none');
                    $('#submit-button').removeAttr('disabled');
                } else {
                    $('.img_success').css('display', '');
                    $('.img_error').css('display', 'none');
                    $('#submit-button').attr('disabled', 'disabled');
                }
            } else if(rs == 1){
                $('.img_success').css('display', 'none');
                $('.img_error').css('display', '');
                $('#submit-button').attr('disabled', 'disabled');
            } 
        });
    }
    
    function checkMail(elem, value) {
        var clases = $(elem).attr('class');
        $.get('/users/exists_mail/' + value, function(data) {
            var rs = $(data).find("#result").val();
            if(rs == 0) { 
                var contains = (clases.indexOf('error_val') > -1);
                var enable = validarSubmit();
                
                if (contains) {
                    $('.img_success_mail').css('display', 'none');
                    $('.img_error_mail').css('display', '');
                    $('#img_error_mail').css('display', 'none');
                    $('#submit-button').attr('disabled', 'disabled');
                } else {
                    if (enable == true) {
                        $('.img_success_mail').css('display', '');
                        $('.img_error_mail').css('display', 'none');
                        $('#submit-button').removeAttr('disabled');
                    } else {
                        $('.img_success_mail').css('display', '');
                        $('.img_error_mail').css('display', 'none');
                        $('#submit-button').attr('disabled', 'disabled');
                    }
                }
            } else if(rs == 1){
                $('.img_success_mail').css('display', 'none');
                $('.img_error_mail').css('display', '');
                $('#submit-button').attr('disabled', 'disabled');
            } 
        });
    }
    
    /*
     * Funcion para determinar si el registro es una empresa o una persona
     * e inhabilitar o habilitar los campos necesarios segun sea el caso 
     **/
    function setRegisterType() {
        var is_checked = $('#UserIsEnterprise').is(':checked');
        
        if (is_checked) { // Es empresa 
            $('#apellido_row').css('display', 'none');
            $('#nacimiento_row').css('display', 'none');
            $('#sexo_row').css('display', 'none');
            
            $('#UserLastname').removeClass('required');
        } else {
            $('#apellido_row').css('display', '');
            $('#nacimiento_row').css('display', '');
            $('#sexo_row').css('display', '');
            
            $('#UserLastname').addClass('required');
        }
    }
    
    function validarSubmit() {
        var enable = false;
        var is_checked = $('#terminos').is(':checked');
        
        if (is_checked) { // Acepto los terminos
            $('#submit-button').removeAttr('disabled');
            enable = true;
        } else {
            $('#submit-button').attr('disabled', 'disabled');
            enable = false;
        }
        return enable;
    }
    
    function showDialog() {
        $( "#dialog-message" ).dialog({
            resizable: false,
            height:500,
            width: 500,
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    }
    
</script>

<div class="registro left w470">
    <div class="rio">
        <div class="notas fs12 bgfff p10">
            <h2>Nuevo usuario</h2>
            <input type="hidden" id="locationId" value="" name="locationId">
            <input type="hidden" value="success" name="forward">

            <?php echo $this->Form->create('User', array('action' => 'add')); ?>
            
            <table width="100%" cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                <?php
                    
                    echo "<tr>";
                    echo "<td class='tar vam'>" . $this->Form->input('is_enterprise', array('label' => false, 'class' => 'right', 'onchange' => 'setRegisterType()')) ."</td>";
                    echo "<td class='tal vam'><label class='lh20'>Registrarme como empresa</label></td>";
                    echo "</tr>";
                
                    echo "<tr>";
                    echo "<td class='tar vam' width='35%'><label class='lh20' style='width: 140px;'>Nombre de Usuario: </label></td>";
                    echo "<td class='tal' width='20%'>" . $this->Form->input('username', array('label' => false, 'class' => 'left required lh20 w230', 'size' => '35', 'onkeyup' => 'checkUserName(this.value)')) . "<label class='img_error error_val' style='display: none'>Este nombre de usuario ya existe</label></td>";
                    echo "<td><label style='vertical-align: middle;'>
                              <img id='img_error' class='img_error' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                              <img id='img_success' class='img_success' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'></label></td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar vam'><label class='lh120'>Nombre: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('name', array('label' => false, 'class' => 'left required lh20 w230', 'size' => '35')) . "</td>";
                    echo "</tr>";

                    echo "<tr id='apellido_row'>";
                    echo "<td class='tar vam'><label class='lh20'>Apellido: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('lastname', array('label' => false, 'class' => 'left required lh20 w230', 'size' => '35')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar vam'><label class='lh20'>Correo: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email lh20 w230', 'size' => '35', 'onkeyup' => 'checkMail(this, this.value)')) . "<label id='img_error_mail' class='img_error_mail error_val' style='display: none'>Este correo ya esta registrado</label></td>";
                    echo "<td><label style='vertical-align: middle;'>
                              <img class='img_error_mail' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                              <img class='img_success_mail' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'></label></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar vam'><label class='lh20'>Cuenta de Twitter: @</label></td>";
                    echo "<td class='tal'>" . $this->Form->input('twitter', array('label' => false, 'class' => 'left lh20 w230', 'size' => '35')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar vam'><label class='lh20'>Clave: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left password lh20 w230', 'size' => '35', 'id' => 'password')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar vam'><label class='lh20'>Confirme su clave: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('re_password', array('label' => false, 'class' => 'left password_confirm lh20 w230', 'type' => 'password', 'size' => '35', 'id' => 'password_confirm', 'name' => 'password_confirm')). "</td>";
                    echo "</tr>";
                      
                    echo "<tr id='nacimiento_row'>";
                    echo "<td class='tar vam'>Fecha de Nacimiento: </td>";
                    echo "<td class='tal' colspan='2'>";
                    echo $this->Form->day('User.birthdate', array('label' => false, 'class' => 'left', 'empty' => 'Día'));
                    echo $this->Form->month('User.birthdate', array('label' => false, 'empty' => 'Mes'));
                    echo $this->Form->year('User.birthdate', date('Y') - 50, date('Y'), array('label' => false, 'empty' => 'Año'));
                    echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr id='sexo_row'>";
                    echo "<td class='tar vam'>Sexo: </td>";
                    echo "<td class='tal'>" . $this->Form->input('gender', array('label' => false, 'class' => 'left')) . "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar vam'>Pregunta de seguridad: </td>";
                    echo "<td class='tal' colspan='2'>" . $this->Form->input('question_id', array('label' => false, 'class' => 'left w230')) . "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tal' colspan='2'>" . $this->Form->input('securityAnswer', array('label' => false, 'class' => 'left lh20', 'style' => 'width: 220px;')) . "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar vam'><input id='terminos' type='checkbox' onChange='validarSubmit()'/></td>";
                    echo "<td class='tal vam'><label class='lh20'>He leído y acepto los Términos y Condiciones de uso. (<a class='cpointer' onclick='showDialog()'>Leer términos</a>)</label></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                ?>
                
                <tr>
                    <td class="tar" style="vertical-align: middle;">
                        <a onclick="document.forms[0].reset();" href="javascript://" class="mt20">Borrar</a>
                    </td>
                    <td class="tal boton">
                        &nbsp;
                        <input id='submit-button' type='submit' value='Enviar' disabled="disabled"/>
                    </td>
                    
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div>

<div class="registro right w420">
    <div class="rio">
        <div class="notas fs12 bgfff p10">
            <h2>Usuario registrado</h2>

            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('action' => 'login')); ?>

            <table id="login" width="400"cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                <?php 
                    echo "<tr>";
                    echo "<td class='tar' width='150'>Nombre de Usuario: </td>";
                    echo "<td class='tal' width='250'>" . $this->Form->input('username', array('label' => false, 'class' => 'left required lh20', 'size' => '33', 'style' => 'margin-right: 30px')). "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'>Clave: </td>";
                    echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left required lh20', 'size' => '33', 'style' => 'margin-right: 30px')). "</td>";
                    echo "</tr>";
                     
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tal'><a onclick='displayMail()' href='javascript://'>¿Olvidó su contraseña?</a></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                ?>
                
                <tr>
                    <td class="tar" style="vertical-align: middle;">
                        <a onclick="document.forms[1].reset();" href="javascript://" class="mt20">Borrar</a>
                    </td>
                    <td class="tal boton">
                        &nbsp;
                        <input id='submit-button' type='submit' value='Ingresar'/>
                    </td>
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>
            
            <?php echo $this->Form->create('User', array('action' => 'forgot_password')); ?>
            <table id="forgot" width="380"cellpadding="3" cellspacing="0" style="border:0; display: none;" class="mt20">
                <?php 
                
                    echo "<tr>";
                    echo "<td colspan='2' style='vertical-align: middle;'><label style='font-size: 11px!important; width: 370px; font-weight: bold;'>1.- Introduzca la dirección de correo con la cual se registró.</label></td>";
                    echo "</tr>";    
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar' style='vertical-align: middle;' width='145'>Correo electrónico: </td>";
                    echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email', 'size' => '38')) . "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                ?>
                
                <tr>
                    <td class="tar" style="vertical-align: middle;">
                        <a onclick="cancelForgot();" href="javascript://" class="mt20">Cancelar</a>
                    </td>
                    <td class="tal boton">
                        &nbsp;
                        <input id='submit-forgot' type='submit' value='Continuar'/>
                    </td>
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<div id="dialog-message" title="Términos y Condiciones de Uso" style="display: none;">
    <?php include ("includes/published/terminos_uso.htm") ?>
</div>

