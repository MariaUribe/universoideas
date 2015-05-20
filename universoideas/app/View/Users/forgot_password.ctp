<?php $question_id = $user_found['user']['question_id']; ?>
<?php $answer = $user_found['user']['securityAnswer']; ?>
<?php $username = $user_found['user']['username']; ?>

<script type="text/javascript">
    function verificarRespuesta() {
        var answer = $('#securityAnswer').val();
        var real_answer = "<?php Print($answer); ?>";
        if(answer == real_answer) {
            $('#reestablishbox').show();
            $('#questionbox').hide();
            $('#error_msg').hide();
        } else {
            $('#reestablishbox').hide();
            $('#questionbox').show();
            $('#error_msg').show();
            $('#error_msg').insertBefore('#js_container');
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
        }
    }
</script>

<div id="error_msg" style="margin: 15px 15px 0px 15px; display: none;">
    <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: -15px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong>&nbsp;Respuesta equivocada
    </div>
</div>

<div class="container">
    <div id="questionbox" style="margin-top:10px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Olvide Mi Contraseña</div>
                <div style="float:right; font-size: 85%; position: relative; top:-15px"><a id="signinlink" href="/users/login">Inicia Sesión</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body form-horizontal" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <div class='form-group'>
                    <label class="col-md-12">
                        2.- Introduzca la respuesta a la pregunta de seguridad.
                    </label>
                </div>
                
                <div class='form-group mb0'>
                    <label class="col-md-12">
                        <strong><?php echo $question ?></strong>
                    </label>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <?php 
                        echo $this->Form->input('securityAnswer', array('label' => false, 'class' => 'form-control', 'size' => '70', 'placeholder' => 'Respuesta de Seguridad'));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 controls">
                      <input id='submit-button' class="btn btn-success" type='submit' onclick="verificarRespuesta()" value='Continuar'/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="reestablishbox" style="margin-top:10px; display: none;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Reestablecer Contraseña</div>
                <div style="float:right; font-size: 85%; position: relative; top:-15px"><a id="signinlink" href="#" onclick="$('#forgotbox').hide(); $('#loginbox').show()">Inicia Sesión</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body form-horizontal" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                
                <?php echo $this->Form->create('User', array('action' => 'edit_password')); ?> 

                <div class='form-group'>
                    <label class="col-md-12">
                        3.- Introduzca la nueva contraseña para el usuario: <?php echo $username ?>
                    </label>
                </div>
                
                <?php echo $this->Form->input('id', array('value' => $id)); ?>
                
                <div class="form-group">
                    <label for="password" class="col-md-4 control-label pt0">Contraseña</label>
                    <div class="col-md-7">
                        <?php 
                        echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña', 'required' => 'required'));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
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

                <div class="form-group">
                    <div class="col-sm-12 controls">
                      <input id='submit-button' class="btn btn-success" type='submit' value='Continuar'/>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>