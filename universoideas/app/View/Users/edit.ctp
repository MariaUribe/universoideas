<script type="text/javascript">
    
    function checkMail(elem, value) {
        var clases = $(elem).attr('class');
        $.get('/users/exists_mail_user/' + value, function(data) {
            var rs = $(data).find("#result").val();
            if(rs == 0) { 
                var contains = (clases.indexOf('error_val') > -1);
                if(contains) {
                    $('.img_success_mail').css('display', 'none');
                    $('.img_error_mail').css('display', '');
                    $('#img_error_mail').css('display', 'none');
                    $('#submit-button').attr('disabled', 'disabled');
                } else {
                    $('.img_success_mail').css('display', '');
                    $('.img_error_mail').css('display', 'none');
                    $('#submit-button').removeAttr('disabled');
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
        var is_ent = $('#UserIsEnterprise').val();
        
        if(is_ent == 1) { // Es empresa 
            $('#apellido_row').css('display', 'none');
            $('#nacimiento_row').css('display', 'none');
            $('#sexo_row').css('display', 'none');
            $('#UserIsEnterprise').val("1");
            
            $('#UserLastname').removeClass('required');
        } else {
            $('#apellido_row').css('display', '');
            $('#nacimiento_row').css('display', '');
            $('#sexo_row').css('display', '');
            $('#UserIsEnterprise').val("0");
            
            $('#UserLastname').addClass('required');
        }
    }
    
</script>

<div id="content_col_izq">
    <div class="registro">
        <div class="rio">
            <div class="notas fs14 bgddd p10 pb30">
                <h2>Mi Perfil</h2>
                <input type="hidden" id="locationId" value="" name="locationId">
                <input type="hidden" value="success" name="forward">

                <?php echo $this->Form->create('User'); ?>

                <table width="500" cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                    <?php
                        echo $this->Form->input('id');
                        
                        echo $this->Form->input('is_enterprise', array('label' => false, 'type' => 'hidden'));
                        
                        echo "<tr>";
                        echo "<td width='150' colspan='2' style='text-align: center;'><a href='/pages/list_all' style='font-weight: bold'>Ver Mis Foros</a></td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td width='150' colspan='2' style='text-align: center;'><a href='/pages/mis_emprendimientos' style='font-weight: bold'>Ver Mis Emprendimientos</a></td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td colspan='2'>&nbsp;</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td class='tar vam' style='width: 43%;'>Nombre: </td>";
                        echo "<td class='tal'>" . $this->Form->input('name', array('label' => false, 'class' => 'left required', 'size' => '45')) . "</td>";
                        echo "</tr>";

                        echo "<tr id='apellido_row'>";
                        echo "<td class='tar vam'>Apellido: </td>";
                        echo "<td class='tal'>" . $this->Form->input('lastname', array('label' => false, 'class' => 'left required', 'size' => '45')) . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar vam'><label class='lh14'>Correo: </label></td>";
                        echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email lh14', 'size' => '45', 'onkeyup' => 'checkMail(this, this.value)')) . "<label id='img_error_mail' class='img_error_mail error_val' style='display: none'>Este correo ya esta registrado</label></td>";
                        echo "<td><label style='vertical-align: middle;'>
                                <img class='img_error_mail' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                                <img class='img_success_mail' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'></label></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar vam'>Cuenta de twitter: @</td>";
                        echo "<td class='tal'>" . $this->Form->input('twitter', array('label' => false, 'class' => 'left', 'size' => '45')) . "</td>";
                        echo "</tr>";
                       
                        echo "<tr id='nacimiento_row'>";
                        echo "<td class='tar vam'>Fecha de Nacimiento: </td>";
                        echo "<td class='tal'>";
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
                        echo "<td class='tac' colspan='2' style='padding-top: 20px;'><a onclick='changePassword()' class='mt20' style='cursor: pointer;'>Cambiar contraseña</a></td>";
                        echo "</tr>";

                        echo "<tr class='new_pass' style='display: none'>";
                        echo "<td class='tar'>Nueva contraseña: </td>";
                        echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left password', 'size' => '25', 'id' => 'password', 'value' => '')) . "</td>";
                        echo "</tr>";

                        echo "<tr class='new_pass' style='display: none'>";
                        echo "<td class='tar'>Confirme su contraseña: </td>";
                        echo "<td class='tal'>" . $this->Form->input('re_password', array('label' => false, 'class' => 'left password_confirm', 'type' => 'password', 'size' => '25', 'id' => 'password_confirm', 'name' => 'password_confirm'));
                        echo "<a onclick='cancelChangePassword()' class='mt20' style='cursor: pointer;'>Cancelar</a></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tac' colspan='2'><a onclick='changeAnswer()' class='mt20' style='cursor: pointer;'>Cambiar pregunta de seguridad</a></td>";
                        echo "</tr>";
                        
                        echo "<tr class='new_ans' style='display: none'>";
                        echo "<td class='tar vam'>Pregunta de seguridad: </td>";
                        echo "<td class='tal'>" . $this->Form->input('question_id', array('label' => false, 'class' => 'left', 'style' => 'width: 220px;')) . "</td>";
                        echo "</tr>";

                        echo "<tr class='new_ans' style='display: none'>";
                        echo "<td class='tar'></td>";
                        echo "<td class='tal'>" . $this->Form->input('securityAnswer', array('label' => false, 'class' => 'left lh14', 'style' => 'width: 220px;'));
                        echo "<a onclick='cancelChangeAnswer()' class='mt20' style='cursor: pointer;'>Cancelar</a></td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td class='tar'></td>";
                        echo "<td class='tar boton'><br/><br/></td>";
                        echo "</tr>";
                    ?>
                    
                    <tr>
                        <td class="tar">
                            <a onclick="document.forms[0].reset();" href="javascript://" class="mt20">Borrar</a>
                        </td>
                        <td class="tal boton">
                            &nbsp;
                            <a onclick="$('#UserEditForm').submit();" class="mt20" style="cursor: pointer;">Enviar</a>
                        </td>

                    </tr>
                </table>
                <?php echo $this->Form->end(); ?>
                <script type="text/javascript">setRegisterType();</script>
            </div>
        </div>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
</div>