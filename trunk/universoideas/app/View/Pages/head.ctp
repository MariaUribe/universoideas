
<script language="Javascript"> 

var muestra;
function makeArray(n){this.length = n;
for (i=1;i<=n;i++){this[i]=0;}
return this;}

function Muestrafecha() {
//arreglo de los meses
var meses = new makeArray(12);
meses[0]  = "Enero";
meses[1]  = "Febrero";
meses[2]  = "Marzo";
meses[3]  = "Abril";
meses[4]  = "Mayo";
meses[5]  = "Junio";
meses[6]  = "Julio";
meses[7]  = "Agosto";
meses[8]  = "Septiembre";
meses[9]  = "Octubre";
meses[10] = "Noviembre";
meses[11] = "Deciembre";

//arreglo de los dias
var dias_de_la_semana = new makeArray(7);
dias_de_la_semana[0]  = "Domingo";
dias_de_la_semana[1]  = "Lunes";
dias_de_la_semana[2]  = "Martes";
dias_de_la_semana[3]  = "Miércoles";
dias_de_la_semana[4]  = "Jueves";
dias_de_la_semana[5]  = "Viernes";
dias_de_la_semana[6]  = "Sábado";

var today = new Date();
var day   = today.getDate();
var month = today.getMonth();
var year  = today.getYear();
var dia = today.getDay();
if (year < 1000) {year += 1900; }

// mostrar la fecha 
return(dias_de_la_semana[dia] + ", " + day + " de " + meses[month] + " del " + year);
}
</script>

<style type="text/css">
    input.watermark { color: #999; }
    input {
        width:200px;
        height: 15px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {

        var watermark = 'Buscar';

        //init, set watermark text and class
        $('#buscarText').val(watermark).addClass('watermark');

        //if blur and no value inside, set watermark text and class again.
        $('#buscarText').blur(function(){
            if ($(this).val().length == 0){
                $(this).val(watermark).addClass('watermark');
            }
        });

        //if focus and text is watermrk, set it to empty and remove the watermark class
        $('#buscarText').focus(function(){
            if ($(this).val() == watermark){
                $(this).val('').removeClass('watermark');
            }
        });
        
        $('#buscarText')
            .keypress( function(event) {
                if(event.keyCode==13) {
                    window.location = "/universoideas/pages/search_all?q=" + $('#buscarText').val();
                    return false;
                }
            });
            
            $('#buscarButton')
                .click( function() {
                    window.location = "/universoideas/pages/search_all?q=" + $('#buscarText').val();
            });
    });
</script>

<div class="logo"><a href="#"><img src="/universoideas/img/logo.png" alt="Universo Ideas" /></a></div>


<div class="right">
    <div class="fecha pr5 mt15">
        <script type="text/javascript" language="JavaScript">
        document.write (Muestrafecha());
        </script>
    </div>
    <div class="bold fecha clear pr5 mt15">
        <?php 
            if(!empty($user)) {
                echo "<span>Bienvenido, " . $user['username']. "</span><br><br>";
                echo "<span><a href='/universoideas/users/edit/" . $user['id'] . "' class='fff'>Mi Perfil</a> | <a href='/universoideas/users/logout' class='fff'>Cerrar Sesión</a></span>";
            } else {
                echo "<span><a href='/universoideas/users/login' class='fff'>Registrate / Inicia Sesión</a></span>";
            }
        ?>
    </div>
    <div class="clear right mt15 pb5">
        <img src="/universoideas/img/icons/icon_lupa.png" width="20" height="21" alt="lupa" class=" left mr5">
        <input id="buscarText" name="Busqueda" type="text" size="20" maxlength="50" class="fs11 left">
        <a id="buscarButton" class="boton_buscar fff tdno fecha" style="cursor: pointer;">Buscar</a>
    </div>
</div>

<div class="menu mt15">
    <ul class="">
        <li><a class="selec1" href="/universoideas/pages/home">Inicio</a></li>
        <li>|</li>
        <li><a class="selec2" href="/universoideas/pages/cronograma">Calendario</a></li>
        <li>|</li>
        <li><a class="selec3" href="/universoideas/vida_universitaria.shtml">Vida Universitaria</a></li>
        <li>|</li>
        <li><a class="selec4" href="/universoideas/pages/encuentrame">Encuéntrame</a></li>
        <li>|</li>
        <li><a class="selec5" href="/universoideas/pages/home_pasantias">Pasantías</a></li>
        <li>|</li>
        <li><a class="selec6" href="/universoideas/emprendedor.shtml">Soy emprendedor</a></li>
        <li>|</li>
        <li><a class="selec7" href="/universoideas/pages/forums">Foros </a></li>
        <li>|</li>
        <li><a class="selec8" href="/universoideas/pages/contacto">Conócenos</a></li>
        
        <?php 
            if(!empty($user)) {
                if($user['role_id'] == '1') { 
                    echo "<li>|</li>";
                    echo "<li><a href='/universoideas/articles'>Administración</a></li>";
                }
            }
        ?>
    </ul>
</div>
