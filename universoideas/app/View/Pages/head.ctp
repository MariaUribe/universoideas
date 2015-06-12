
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
    input#buscarText {
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
                    window.location = "/pages/search_all?q=" + $('#buscarText').val();
                    return false;
                }
            });
            
            $('#buscarButton')
                .click( function() {
                    window.location = "/pages/search_all?q=" + $('#buscarText').val();
            });
    });
</script>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <script type="text/javascript" language="JavaScript">
                    document.write (Muestrafecha());
                </script>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END-->

<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="/img/logo.png" />
            </a>
        </div>

        <div class="left-div">
            <div class="user-settings-wrapper">
                <ul class="nav">
                    <?php 
                        if(!empty($user)) {
                            echo "<span class='login-msg'>Bienvenido, " . $user['username'] . "</span>";
                        } else {
                            echo "<a class='login-msg' href='/users/login'>Inicia Sesión</a>";
                        }
                    ?>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                        </a>
                        <?php 
                            if(!empty($user)) {
                                echo "<div class='dropdown-menu dropdown-settings dropdown-profile'>";
                                echo "<div class='media'>";
                                echo "<div class='media-body'>";
                                    echo "<h4 class='media-heading'>" . $user['name']. " " . $user['lastname']. "</h4>";
                                echo "</div>";
                                echo "</div>";
                                echo "<hr />";
                                echo "<h5><strong>Nombre de Usuario : </strong></h5>";
                                echo $user['username'];
                                echo "<hr />";
                                echo "<a href='/users/edit/" . $user['id'] . "' class='btn btn-info btn-sm'>Mi Perfil</a>&nbsp; <a href='/users/logout' class='btn btn-danger btn-sm'>Cerrar Sesión</a>";
                                echo "</div>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->

<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a id="index_menu" class="menu-top-active" href="/">Inicio</a></li>
                        <li><a id="calendario_menu" href="/pages/cronograma">Calendario</a></li>
                        <li class="dropdown">
                            <a id="vida_menu" class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" id="themes">
                                Vida Universitaria <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-settings" aria-labelledby="themes">
                                <li><a class="submenu-option" href="/pages/arte">Arte</a></li>
                                <li><a class="submenu-option" href="/pages/ciencia">Ciencia</a></li>
                                <li><a class="submenu-option" href="/pages/moda">Moda</a></li>
                                <li><a class="submenu-option" href="/pages/rumba">Rumba</a></li>
                                <li><a class="submenu-option" href="/pages/sexualidad">Sexualidad</a></li>
                            </ul>
                        </li>
                        <li><a id="encuentrame_menu" href="/pages/encuentrame">Soy emprendedor</a></li>
                        <li><a id="pasantias_menu" href="/pages/home_pasantias">Pasantías</a></li>
                        <?php 
                            if(!empty($user)) {
                                if($user['role_id'] == '1' || $user['role_id'] == '3') { 
                                    echo "<li><a id='emprendedores_menu' href='/pages/emprendedores'>Encuéntrame</a></li>";
                                }
                            }
                        ?>
                        <li><a id="forums_menu" href="/pages/forums">Foro</a></li>
                        <li><a id="conocenos_menu" href="/pages/contacto">Conócenos</a></li>

                        <?php 
                            if(!empty($user)) {
                                if($user['role_id'] == '1') { 
                                    echo "<li><a href='/articles'>Administración</a></li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MENU SECTION END-->




<!-- ANTES DESDE AQUI -->

<!--div class="logo"><a href="/"><img src="/img/logo.png" alt="Universo Ideas" /></a></div>


<div class="right">
    <div class="fecha pr5 mt15">
        <script type="text/javascript" language="JavaScript">
        document.write (Muestrafecha());
        </script>
    </div>
    <div class="bold fecha clear pr5 mt15">
        < php 
            if(!empty($user)) {
                echo "<span>Bienvenido, " . $user['username']. "</span><br><br>";
                echo "<span><a href='/users/edit/" . $user['id'] . "' class='fff'>Mi Perfil</a> | <a href='/users/logout' class='fff'>Cerrar Sesión</a></span>";
            } else {
                echo "<span><a href='/users/login' class='fff'>Registrate / Inicia Sesión</a></span>";
            }
        ?>
    </div>
    <div class="clear right mt15 pb5">
        <img src="/img/icons/icon_lupa.png" width="20" height="21" alt="lupa" class=" left mr5">
        <input id="buscarText" name="Busqueda" type="text" size="20" maxlength="50" class="fs11 left">
        <a id="buscarButton" class="boton_buscar fff tdno fecha" style="cursor: pointer;">Buscar</a>
    </div>
</div>

<div class="menu mt15">
    <ul class="menu2">
        <li><a class="selec1" href="/">Inicio</a></li>
        <li>|</li>
        <li><a class="selec2" href="/pages/cronograma">Calendario</a></li>
        <li>|</li>
        <li class="top"><a class="selec3" href="#"><strong class="down">Vida Universitaria</strong></a>
            <ul class="sub">			
                <li><a href="/pages/arte">Arte</a></li>
                <li><a href="/pages/ciencia">Ciencia</a></li>
                <li><a href="/pages/moda">Moda</a></li>
                <li><a href="/pages/rumba">Rumba</a></li>
                <li><a href="/pages/sexualidad">Sexualidad</a></li>
            </ul>
        </li>
        <li>|</li>
        <li><a class="selec4" href="/pages/encuentrame">Soy emprendedor</a></li>
        <li>|</li>
        <li><a class="selec5" href="/pages/home_pasantias">Pasantías</a></li>
        
        <php 
            if(!empty($user)) {
                if($user['role_id'] == '1' || $user['role_id'] == '3') { 
                    echo "<li>|</li>";
                    echo "<li><a class='selec6' href='/pages/emprendedores'>Encuéntrame</a></li>";
                }
            }
        ?>
        
        <li>|</li>
        <li><a class="selec7" href="/pages/forums">Foros </a></li>
        <li>|</li>
        <li><a class="selec8" href="/pages/contacto">Conócenos</a></li>
        
        <php 
            if(!empty($user)) {
                if($user['role_id'] == '1') { 
                    echo "<li>|</li>";
                    echo "<li><a href='/articles'>Administración</a></li>";
                }
            }
        ?>
    </ul>
</div-->
