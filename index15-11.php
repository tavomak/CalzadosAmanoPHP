<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];

$mobile_browser = '0';

if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile|o2|opera mini|palm( os)?|plucker|pocket|pre\/|psp|smartphone|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce; (iemobile|ppc)|xiino|iIEMobile|Windows CE|NetFront|PlayStation|PLAYSTATION|like Mac OS X|MIDP|UP\.Browser|Symbian|Nintendo|Android/',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
$mobile_browser++;
}

if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
$mobile_browser++;
}

if(preg_match("/Android/i",$_SERVER["HTTP_ACCEPT"])){
$mobile_browser++;
}

if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
$mobile_browser++;
}

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
$mobile_agents = array(
'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
'blaz','brew','cell','cldc','cmd-','dang','deviceBB','doco','eric',
'hipt','inno','ipaq','ipod','iphon','java','jigs','kddi','keji','leno',
'lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi',
'mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant',
'phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-',
'send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-',
'symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda',
'wap-','wapa','wapi','wapp','wapr','webc','webOS','winw','winw','xda',
'xda-');

if(in_array($mobile_ua,$mobile_agents)) {
$mobile_browser++;
}

if (strpos(strtolower($_SERVER['ALL_HTTP']),'operamini')>0) {
$mobile_browser++;
}

if(isset($_SERVER["HTTP_X_SKYFIRE_PHONE"])){
$mobile_browser++;
}

if (strpos(strtolower($_SERVER['ALL_HTTP']),'iphone')>0) {
$mobile_browser++;
}

if (strpos(strtolower($_SERVER['ALL_HTTP']),'ipod')>0) {
$mobile_browser++;
}

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),' ppc;')>0) {
$mobile_browser++;
}

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows ce')>0) {
$mobile_browser++;
}
else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
$mobile_browser=0;
}

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iemobile')>0) {
$mobile_browser++;
}

$dm_usergent = array(
'PIE4' => 'compatible; MSIE 4.01; Windows CE; PPC; 240x320',
'PIE4_Smartphone' => 'compatible; MSIE 4.01; Windows CE; Smartphone;',
'PIE6' => 'compatible; MSIE 6.0; Windows CE;',
'Minimo' => 'Minimo',
'OperaMini' => 'Opera Mini',
'AvantGo' => 'AvantGo',
'Plucker' => 'Plucker',
'NetFront' => 'NetFront',
'SonyEricsson' => 'SonyEricsson',
'Nokia' => 'Nokia',
'Motorola' => 'mot-',
'BlackBerry' => 'BlackBerry',
'WindowsMobile' => 'Windows CE',
'PPC' => 'PPC',
'PDA' => 'PDA',
'Smartphone' => 'Smartphone',
'Palm' => 'Palm'
);



if ($mobile_browser>0){ ?>

<script>window.location.href ="http://calzadosamano.com/movil/"</script>

<?php } else {
 session_start(); ?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calzados A'mano</title>
    <meta name="description" content="Calzados A'mano es una empresa ubicada en la ciudad de Caracas con más de 15 años en el mercado de calzados en Venezuela." />
    <meta name="keywords" content="Calzados a'mano" />
    <link rel="shortcut icon" href="favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/basic.css" />
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
   <header>
        <?php include "include/navegacion.php"; ?>
    </header>
    <div id="wrapper">
        <div id="intwrapper">
            <a href="javascript: ocultar();">
                <div id="resultado" align="center"></div>
            </a>


            <div id="ventanaRegistro" name="ventanaRegistro" class="ventanaRegistro" onClick="cerrar()"></div>
            <div id="videoYoutube" name="videoYoutube" class="videoYoutube centrado-porcentual">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/qTYa9rySwK0?rel=0&showinfo=0&modestbranding=1" frameborder="0" allowfullscreen style="margin-left:0"></iframe>
            </div>
            <div class="container" style="background-image:url(images/home/fachada.jpg); background-repeat:no-repeat; background-position:center; min-width:1100px;">
                <div id="toma" style="position:absolute;  z-index:301;  margin-top:0px;  width:60%; margin-left:-5%;  min-width:600px; display:none; ">
                    <a href="javascript: ocultar();"> <img src="images/home/bannernavidad.png" width="100%" border="0"></a>
                </div>
                <section id="derecha">
                    <a href="javascript: vv();" class="btn_ver"></a>
                    <br> </section>
            </div>
        </div>
    </div>
    <?php include "pages/footer.php"; ?>
    <!-- fin wrapper -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/inicio.js"></script>
</body>

</html>
<?php } ?>
