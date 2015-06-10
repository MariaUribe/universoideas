<script type="text/javascript">
    function checkUserName(value) {
        $.get('/users/exists/' + value, function(data) {
            var rs = $(data).find("#result").val();
            
            if(rs == 0) { 
                var enable = validarSubmit();
                if (enable) {
                    $('.img_success').show();
                    $('.img_error').hide();
                    $('#btn-signup').removeAttr('disabled');
                } else {
                    $('.img_success').show();
                    $('.img_error').hide();
                    $('#btn-signup').attr('disabled', 'disabled');
                }
            } else if(rs == 1){
                $('.img_success').hide();
                $('.img_error').show();
                $('#btn-signup').attr('disabled', 'disabled');
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
                    $('#btn-signup').attr('disabled', 'disabled');
                } else {
                    if (enable == true) {
                        $('.img_success_mail').css('display', '');
                        $('.img_error_mail').css('display', 'none');
                        $('#btn-signup').removeAttr('disabled');
                    } else {
                        $('.img_success_mail').css('display', '');
                        $('.img_error_mail').css('display', 'none');
                        $('#btn-signup').attr('disabled', 'disabled');
                    }
                }
            } else if(rs == 1){
                $('.img_success_mail').css('display', 'none');
                $('.img_error_mail').css('display', '');
                $('#btn-signup').attr('disabled', 'disabled');
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
            
            $('#UserLastname').removeAttr('required');
        } else {
            $('#apellido_row').css('display', '');
            $('#nacimiento_row').css('display', '');
            $('#sexo_row').css('display', '');
            
            $('#UserLastname').attr('required', 'required');
        }
    }
    
    function validarSubmit() {
        var enable = false;
        var is_checked = $('#terminos').is(':checked');
        
        if (is_checked) { // Acepto los terminos
            $('#btn-signup').removeAttr('disabled');
            enable = true;
        } else {
            $('#btn-signup').attr('disabled', 'disabled');
            enable = false;
        }
        return enable;
    }
    
    function checkPasswordConf(value) {
        var pass = $('#password').val();
        var re_pass = value;
        var enable = validarSubmit();
        
        if(pass != re_pass) {
            $('#error_pass').show();
            $('#img_pass_success').hide();
            $('#img_pass_error').show();
            $('#btn-signup').attr('disabled', 'disabled');
        } else {
            $('#error_pass').hide();
            $('#img_pass_success').show();
            $('#img_pass_error').hide();
            if (enable) {
                $('#btn-signup').removeAttr('disabled');
            } else {
                $('#btn-signup').attr('disabled', 'disabled');
            }
        }
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

<div class="container">    
    <div id="loginbox" style="margin-top:10px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Inicia Sesión</div>
                <div style="float:right; font-size: 80%; position: relative; top:-15px"><a onclick='displayMail()' href='javascript://'>¿Olvidaste tu contraseña?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Form->create('User', array('action' => 'login', 'id' => 'loginform', 'class' => 'form-horizontal')); ?>

                <?php 
                    echo "<div style='margin-bottom: 25px' class='input-group'>";
                    echo "<span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>";
                    echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'id' => 'login-username', 'type' => 'text', 'placeholder' =>'usuario'));
                    echo "</div>";

                    echo "<div style='margin-bottom: 25px' class='input-group'>";
                    echo "<span class='input-group-addon'><i class='glyphicon glyphicon-lock'></i></span>";
                    echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'id' => 'login-password', 'type' => 'password', 'placeholder' =>'contraseña', 'required' => 'required'));
                    echo "</div>";
                ?>

                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Recordarme
                        </label>
                    </div>
                </div>

                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                      <input id='submit-button' class="btn btn-success" type='submit' value='Ingresar'/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            ¿Aún no estás registrado?
                            <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                Regístrate Aquí
                            </a>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>                     
        </div>  
    </div>
        
    <div id="signupbox" style="display:none; margin-top:10px" class="mainbox col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Registro de Usuario</div>
                <div style="float:right; font-size: 85%; position: relative; top:-15px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Inicia Sesión</a></div>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('User', array('action' => 'add', 'id' => 'signupform', 'class' => 'form-horizontal')); ?>

                <div id="signupalert" style="display:none" class="alert alert-danger">
                    <p>Error:</p>
                    <span></span>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label pt0">Campos Obligatorios <span class="asterisk-required">*</span></label>
                </div>

                <div class="form-group register-check">
                    <div class="col-md-4">
                        <?php 
                        echo $this->Form->input('is_enterprise', array('label' => false, 'onchange' => 'setRegisterType()', 'class' => 'f-right'));
                        ?>
                    </div>
                    <label for="is_enterprise" class="col-md-7 mb0">Registrarme como empresa</label>
                </div>
                
                <div class="form-group required">
                    <label for="username" class="col-md-4 control-label pt0">Nombre de Usuario</label>
                    <div class="col-md-7">
                        <?php 
                        echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' =>'Nombre de Usuario', 'required' => 'required', 'onkeyup' => 'checkUserName(this.value)')) . "<label class='img_error error_val' style='display: none'>Este nombre de usuario ya existe</label>";
                        ?>
                    </div>
                    <div>
                        <img id='img_error' class='img_error' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                        <img id='img_success' class='img_success' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'>
                    </div>
                </div>

                <div class="form-group required">
                    <label for="firstname" class="col-md-4 control-label pt0">Nombre</label>
                    <div class="col-md-7">
                        <?php 
                        echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'placeholder' =>'Nombre', 'required' => 'required'));
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
                
                <div class="form-group required">
                    <label for="password" class="col-md-4 control-label pt0">Contraseña</label>
                    <div class="col-md-7">
                        <?php 
                        echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña', 'required' => 'required'));
                        ?>
                    </div>
                </div>
                
                <div class="form-group required">
                    <label for="re_password" class="col-md-4 control-label pt0">Confirmar Contraseña</label>
                    <div class="col-md-7">
                        <?php
                        echo $this->Form->input('re_password', array('label' => false, 'class' => 'form-control password_confirm', 'type' => 'password', 'placeholder' => 'Contraseña', 'required' => 'required', 'id' => 'password_confirm', 'name' => 'password_confirm', 'onkeyup' => 'checkPasswordConf(this.value)')). "<label id='error_pass' class='error_pass error_val' style='display: none'>Las contraseñas no coinciden</label>";
                        ?>
                    </div>
                    <div>
                        <img id='img_pass_error' class='img_pass_error' src='/img/icons/error.png' width='20' height='20' alt='error' class='left mr5' style='display: none;'>
                        <img id='img_pass_success' class='img_pass_success' src='/img/icons/success.gif' width='20' height='20' alt='exito' class='left mr5' style='display: none;'>
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
                
                <div class="form-group required">
                    <label for="question_id" class="col-md-4 control-label pt0">Pregunta de Seguridad</label>
                    <div class="col-md-7">
                        <?php
                        echo $this->Form->input('question_id', array('label' => false, 'class' => 'form-control'));
                        ?>
                    </div>
                </div>
                
                <div class="form-group required">
                    <label for="securityAnswer" class="col-md-4 control-label pt0"></label>
                    <div class="col-md-7">
                        <?php
                        echo $this->Form->input('securityAnswer', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Respuesta de Seguridad', 'required' => 'required'));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-7">
                        <label class='checkbox-inline'>
                            <input id='terminos' type='checkbox' onChange='validarSubmit()'/>
                            He leído y acepto los Términos y Condiciones de uso. (<a class='cpointer' data-toggle="modal" data-target="#myModal">Leer términos</a>)
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info" disabled="disabled"><i class="icon-hand-right"></i> &nbsp Registrarme</button>
                    </div>
                </div>
                
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    
    <div id="forgotbox" style="margin-top:10px; display: none;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Olvide Mi Contraseña</div>
                <div style="float:right; font-size: 85%; position: relative; top:-15px"><a id="signinlink" href="#" onclick="$('#forgotbox').hide(); $('#loginbox').show()">Inicia Sesión</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Form->create('User', array('action' => 'forgot_password', 'id' => 'forgotform', 'class' => 'form-horizontal')); ?>

                <div class='form-group'>
                    <label class="col-md-12">
                        1.- Introduzca la dirección de correo con la cual se registró.
                    </label>
                    
                </div>
                
                <div style='margin-bottom: 25px' class='input-group'>
                    <span class='input-group-addon'><i class='glyphicon glyphicon-envelope'></i></span>
                    <?php
                    echo $this->Form->input('mail', array('label' => false, 'class' => 'form-control', 'id' => 'forgot-mail', 'type' => 'text', 'placeholder' =>'Correo Electrónico', 'required' => 'required'));
                    ?>
                </div>

                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                      <input id='submit-button' class="btn btn-success" type='submit' value='Enviar'/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            ¿Aún no estás registrado?
                            <a href="#" onClick="$('#forgotbox').hide(); $('#signupbox').show()">
                                Regístrate Aquí
                            </a>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>                     
        </div>  
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Términos y Condiciones de Uso</h4>
            </div>
            <div class="modal-body" style="overflow-y: scroll; height: 300px;">
                <?php include ("includes/published/terminos_uso.htm") ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Acepto</button>
            </div>
        </div>
    </div>
</div>

