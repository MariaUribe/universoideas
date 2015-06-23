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
    
    function checkPasswordConf(value) {
        var pass = $('#password').val();
        var re_pass = value;
        
        if(pass != re_pass) {
            $('#error_pass').show();
            $('#img_pass_success').hide();
            $('#img_pass_error').show();
            $('#btn-signup').attr('disabled', 'disabled');
        } else {
            $('#error_pass').hide();
            $('#img_pass_success').show();
            $('#img_pass_error').hide();
            $('#btn-signup').removeAttr('disabled');
            
        }
    }
    
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Mi Perfil</h3>
                </div>
                <div class="panel-body">
                    <?php echo $this->Form->create('User', array('class' => 'form-horizontal', 'role' => 'form')); ?>
                    <?php 
                        echo $this->Form->input('id');
                        echo $this->Form->input('is_enterprise', array('label' => false, 'type' => 'hidden'));
                    ?>
                    
                    <div class="row">
                        <div class="col-md-3 col-lg-3" align="center">
                            <img alt="User" src="/img/edit-user.png">
                            <div>
                                <a href='/pages/list_all' style='font-weight: bold'>Mis Temas en el Foro</a>
                            </div>

                            <div>
                                <a href='/pages/mis_emprendimientos' style='font-weight: bold'>Mis Emprendimientos</a>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-9">
                            
                            <fieldset>
                                
                                <div class="form-group required">
                                    <label for="name" class="col-md-4 control-label pt0">Nombre</label>
                                    <div class="col-md-7">
                                        <?php 
                                        echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'required' => 'required'));
                                        ?>
                                    </div>
                                </div>

                                <div id="apellido_row" class="form-group required">
                                    <label for="lastname" class="col-md-4 control-label pt0">Apellido</label>
                                    <div class="col-md-7">
                                        <?php 
                                        echo $this->Form->input('lastname', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' =>'Apellido', 'required' => 'required'));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label for="mail" class="col-md-4 control-label pt0">Correo Electrónico</label>
                                    <div class="col-md-7">
                                        <?php 
                                        echo $this->Form->input('mail', array('label' => false, 'class' => 'form-control email', 'type' => 'text', 'placeholder' =>'Correo Electrónico', 'required' => 'required', 'onkeyup' => 'checkMail(this, this.value)')) . "<label id='img_error_mail' class='img_error_mail error_val' style='display: none'>Este correo ya está registrado</label>";
                                        ?>
                                    </div>
                                    <div>
                                        <img class='img_error_mail' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                                        <img class='img_success_mail' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="twitter" class="col-md-4 control-label pt0">Cuenta de Twitter</label>
                                    <div class="col-md-7">
                                        <?php 
                                        echo $this->Form->input('twitter', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' =>'@twitter'));
                                        ?>
                                    </div>
                                </div>
                                
                                <div id="nacimiento_row" class="form-group">
                                    <label for="birthdate" class="col-md-4 control-label pt0">Fecha de Nacimiento</label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->day('User.birthdate', array('label' => false, 'class' => 'left', 'empty' => 'Día', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <div class="col-md-3 pl0">
                                        <?php
                                        echo $this->Form->month('User.birthdate', array('label' => false, 'empty' => 'Mes', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <div class="col-md-2 pl0">
                                        <?php
                                        echo $this->Form->year('User.birthdate', date('Y') - 50, date('Y'), array('label' => false, 'empty' => 'Año', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    
                                </div>

                                <div id="sexo_row" class="form-group">
                                    <label for="gender" class="col-md-4 control-label pt0">Sexo</label>
                                    <div class="col-md-7">
                                        <?php
                                        echo $this->Form->input('gender', array('label' => false, 'class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a onclick='changePassword()' style='cursor: pointer;'>Cambiar contraseña</a>
                                    </div>
                                </div>
                                
                                <div class="form-group new_pass" style='display: none'>
                                    <label for="password" class="col-md-4 control-label pt0">Contraseña</label>
                                    <div class="col-md-7">
                                        <?php 
                                        echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña', 'value' => ''));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group new_pass" style='display: none'>
                                    <label for="re_password" class="col-md-4 control-label pt0">Confirmar Contraseña</label>
                                    <div class="col-md-7">
                                        <?php
                                        echo $this->Form->input('re_password', array('label' => false, 'class' => 'form-control password_confirm', 'type' => 'password', 'placeholder' => 'Contraseña', 'id' => 'password_confirm', 'name' => 'password_confirm', 'onkeyup' => 'checkPasswordConf(this.value)')). "<label id='error_pass' class='error_pass error_val' style='display: none'>Las contraseñas no coinciden</label>";
                                        ?>
                                    </div>
                                    <div>
                                        <img id='img_pass_error' class='img_pass_error' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                                        <img id='img_pass_success' class='img_pass_success' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'>
                                    </div>
                                </div>
                                
                                <div class="form-group new_pass" style="display: none">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a onclick='cancelChangePassword()' class='mt20' style='cursor: pointer;'>Cancelar</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a onclick='changeAnswer()' style='cursor: pointer;'>Cambiar pregunta de seguridad</a>
                                    </div>
                                </div>
                                
                                <div class="form-group new_ans" style="display: none">
                                    <label for="question_id" class="col-md-4 control-label pt0">Pregunta de Seguridad</label>
                                    <div class="col-md-7">
                                        <?php
                                        echo $this->Form->input('question_id', array('label' => false, 'class' => 'form-control'));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group new_ans" style="display: none">
                                    <label for="securityAnswer" class="col-md-4 control-label pt0"></label>
                                    <div class="col-md-7">
                                        <?php
                                        echo $this->Form->input('securityAnswer', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Respuesta de Seguridad'));
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="form-group new_ans" style="display: none">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a onclick='cancelChangeAnswer()' class='mt20' style='cursor: pointer;'>Cancelar</a>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9"></div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" class="btn btn-primary"><i class="icon-hand-right"></i>Guardar</button>
                                        <button type="button" class="btn btn-danger"><i class="icon-hand-right"></i>Cancelar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <script type="text/javascript">setRegisterType();</script>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-2">
            <?php include ("includes/siguenos.htm") ?>
            <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
        </div>
    </div>
</div>

<!--div id="content_col_izq">
    <div class="registro">
        <div class="rio">
            <div class="notas fs14 bgfff p10 pb30">
                <h2>Mi Perfil</h2>
                <input type="hidden" id="locationId" value="" name="locationId">
                <input type="hidden" value="success" name="forward">

                <!--php echo $this->Form->create('User'); ?>

                <table width="500" cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                    <php
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
                        echo "<td class='tal'>" . $this->Form->input('name', array('label' => false, 'class' => 'left required lh20', 'size' => '45')) . "</td>";
                        echo "</tr>";

                        echo "<tr id='apellido_row'>";
                        echo "<td class='tar vam'>Apellido: </td>";
                        echo "<td class='tal'>" . $this->Form->input('lastname', array('label' => false, 'class' => 'left required lh20', 'size' => '45')) . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar vam'><label class='lh20'>Correo: </label></td>";
                        echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email lh20', 'size' => '45', 'onkeyup' => 'checkMail(this, this.value)')) . "<label id='img_error_mail' class='img_error_mail error_val' style='display: none'>Este correo ya esta registrado</label></td>";
                        echo "<td><label style='vertical-align: middle;'>
                                <img class='img_error_mail' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                                <img class='img_success_mail' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'></label></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar vam'>Cuenta de twitter: @</td>";
                        echo "<td class='tal'>" . $this->Form->input('twitter', array('label' => false, 'class' => 'left lh20', 'size' => '45')) . "</td>";
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
                        echo "<td class='tal'>" . $this->Form->input('securityAnswer', array('label' => false, 'class' => 'left lh20', 'style' => 'width: 220px;'));
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
                <!--php echo $this->Form->end(); >
                <script type="text/javascript">setRegisterType();</script>
            </div>
        </div>
    </div>
</div-->

