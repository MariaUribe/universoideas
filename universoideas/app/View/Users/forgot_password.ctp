<?php $question_id = $user_found['user']['question_id']; ?>
<?php $answer = $user_found['user']['securityAnswer']; ?>
<?php $username = $user_found['user']['username']; ?>

<script type="text/javascript">
    function verificarRespuesta() {
        var answer = $('#securityAnswer').val();
        var real_answer = "<?php Print($answer); ?>";
        if(answer == real_answer) {
            $('#reestablish').css('display', '');
            $('#question').css('display', 'none');
        } else {
            $('#reestablish').css('display', 'none');
            $('#question').css('display', '');
        }
    }
</script>

<div class="registro w500" style="display: block; margin-left: auto; margin-right: auto;">
    <div class="rio">
        <div id="question" class=" notas fs12 bgddd p10">
            <h2>Pregunta de seguridad</h2>
            
            <table width="480"cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                <?php 
                
                    echo "<tr>";
                    echo "<td colspan='2' class='vam'><label style='font-size: 11px!important; width: 370px; font-weight: bold;'>2.- Introduzca la respuesta a la pregunta de seguridad.</label></td>";
                    echo "</tr>";    
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td colspan='2' class='vam'><label>" . $question . "</label></td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td colspan='2' class='vam'>" . $this->Form->input('securityAnswer', array('label' => false, 'class' => 'left required', 'size' => '70', 'style' => 'line-height: 14px;')). "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                ?>
                
                <tr>
                    <td class="tar boton">
                        &nbsp;
                        <input id='submit-button' type='submit' onclick="verificarRespuesta()" value='Continuar'/>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="reestablish" class=" notas fs12 bgddd p10" style="display: none" >
            <h2>Reestablecer contraseña</h2>
            <?php echo $this->Form->create('User', array('action' => 'edit_password')); ?> 
            <table width="480"cellpadding="3" cellspacing="0" style="border:0;padding-right: 30px;" class="mt20">
                <?php 
                    echo "<tr>";
                    echo "<td colspan='2' class='vam'><label style='font-size: 11px!important; width: 370px; font-weight: bold;'>3.- Introduzca la nueva contraseña para el usuario: " . $username . "</label></td>";
                    echo "</tr>";    
                    
                    echo "<tr>";
                    echo "<td class='tar'></td>";
                    echo "<td class='tar boton'><br/><br/></td>";
                    echo "</tr>";
                    
                    echo $this->Form->input('id', array('value' => $id));
                    
                    echo "<tr>";
                    echo "<td class='tar' width='220'><label style='vertical-align: middle;'>Nueva contraseña: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left password', 'size' => '44', 'id' => 'password', 'value' => '')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'><label style='vertical-align: middle;'>Confirme su contraseña: </label></td>";
                    echo "<td class='tal'>" . $this->Form->input('re_password', array('label' => false, 'class' => 'left password_confirm', 'type' => 'password', 'size' => '44', 'id' => 'password_confirm', 'name' => 'password_confirm'));
                    echo "</td>";
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
                        <input id='submit-button' type='submit' value='Continuar'/>
                    </td>
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>