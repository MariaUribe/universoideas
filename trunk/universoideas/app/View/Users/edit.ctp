<div id="content_col_izq">
    <div class="registro">
        <div class="rio">
            <div class="notas fs11 bgddd p10">
                <h2>Mi Perfil</h2>
                <input type="hidden" id="locationId" value="" name="locationId">
                <input type="hidden" value="success" name="forward">

                <?php echo $this->Form->create('User'); ?>

                <table width="400" cellpadding="3" cellspacing="0" style="border:0" class="mt20">
                    <?php
                        echo $this->Form->input('id');
                        echo "<tr>";
                        echo "<td class='tar' width='150'>Nombre de Usuario: </td>";
                        echo "<td class='tal'>" . $this->Form->input('username', array('label' => false, 'class' => 'left required', 'size' => '40')) . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar'>Nombre: </td>";
                        echo "<td class='tal'>" . $this->Form->input('name', array('label' => false, 'class' => 'left required', 'size' => '40')) . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar'>Apellido: </td>";
                        echo "<td class='tal'>" . $this->Form->input('lastname', array('label' => false, 'class' => 'left required', 'size' => '40')) . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td class='tar'>Correo: </td>";
                        echo "<td class='tal'>" . $this->Form->input('mail', array('label' => false, 'class' => 'left required email', 'size' => '40')) . "</td>";
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

                        echo $this->Form->input('role_id', array('type' => 'hidden'));

                        echo "<tr>";
                        echo "<td class='tac' colspan='2'><a onclick='changePassword()' class='mt20' style='cursor: pointer;'>Cambiar clave</a></td>";
                        echo "</tr>";

                        echo "<tr class='new_pass' style='display: none'>";
                        echo "<td class='tar'>Nueva clave: </td>";
                        echo "<td class='tal'>" . $this->Form->input('password', array('label' => false, 'class' => 'left password', 'size' => '25', 'id' => 'password', 'value' => '')) . "</td>";
                        echo "</tr>";

                        echo "<tr class='new_pass' style='display: none'>";
                        echo "<td class='tar'>Confirme su clave: </td>";
                        echo "<td class='tal'>" . $this->Form->input('re_password', array('label' => false, 'class' => 'left password_confirm', 'type' => 'password', 'size' => '25', 'id' => 'password_confirm', 'name' => 'password_confirm'));
                        echo "<a onclick='cancelChangePassword()' class='mt20' style='cursor: pointer;'>Cancelar</a></td>";
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
            </div>
        </div>
    </div>
    <span><a href="/universoideas/forums/list_all">Ver Mis Foros</a></span>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
</div>