<div class="registro left w400">
    <div class="rio">
        <div class="notas fs11 bgddd p10">
            <h2>Nuevo usuario</h2>
            <input type="hidden" id="locationId" value="" name="locationId">
            <input type="hidden" value="success" name="forward">
            
            <?php echo $this->Form->create('User', array('action' => 'add')); ?>
            
            <table width="380" cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                <?php
                    echo "<tr>";
                    echo "<td class='tar' width='150'>Nombre de Usuario: </td>";
                    echo "<td class='tal'>" . $this->Form->input('username', array('label' => false, 'class' => 'left required', 'size' => '33', 'style' => 'margin-right: 30px')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'>Nombre: </td>";
                    echo "<td class='tal'>" . $this->Form->input('name', array('label' => false, 'class' => 'left required', 'size' => '33', 'style' => 'margin-right: 30px')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'>Apellido: </td>";
                    echo "<td class='tal'>" . $this->Form->input('lastname', array('label' => false, 'class' => 'left required', 'size' => '33', 'style' => 'margin-right: 30px')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'>Correo: </td>";
                    echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email', 'size' => '33', 'style' => 'margin-right: 33px')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'>Clave: </td>";
                    echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left password', 'size' => '33', 'id' => 'password', 'style' => 'margin-right: 30px')) . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td class='tar'>Confirme su clave: </td>";
                    echo "<td class='tal'>" . $this->Form->input('re_password', array('label' => false, 'class' => 'left password_confirm', 'type' => 'password', 'size' => '33', 'id' => 'password_confirm', 'name' => 'password_confirm', 'style' => 'margin-right: 33px')). "</td>";
                    echo "</tr>";
                      
                    echo "<tr>";
                    echo "<td class='tar'>Fecha de Nacimiento: </td>";
                    echo "<td class='tal'>";
                    echo $this->Form->day('User.birthdate', array('label' => false, 'class' => 'left', 'empty' => 'Día'));
                    echo $this->Form->month('User.birthdate', array('label' => false, 'empty' => 'Mes'));
                    echo $this->Form->year('User.birthdate', date('Y') - 50, date('Y'), array('label' => false, 'empty' => 'Año'));
                    echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'>Sexo: </td>";
                    echo "<td class='tal'>" . $this->Form->input('gender', array('label' => false, 'class' => 'left')) . "</td>";
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
                        <input id='submit-button' type='submit' value='Enviar' />
                    </td>
                    
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div>

<div class="registro right w400">
    <div class="rio">
        <div class=" notas fs11 bgddd p10">
            <h2>Usuario registrado</h2>

            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('action' => 'login')); ?>

            <table width="400"cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                <?php 
                    echo "<tr>";
                    echo "<td class='tar' width='150'>Nombre de Usuario: </td>";
                    echo "<td class='tal' width='250'>" . $this->Form->input('username', array('label' => false, 'class' => 'left required', 'size' => '33', 'style' => 'margin-right: 30px')). "</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td class='tar'>Clave: </td>";
                    echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left required', 'size' => '33', 'style' => 'margin-right: 30px')). "</td>";
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
<!--                        <a onclick="$('#UserLoginForm').submit();" class="mt20" style="cursor: pointer;">Ingresar</a>-->
                    </td>
                </tr>
            </table>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>