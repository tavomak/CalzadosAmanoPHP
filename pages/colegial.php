<?php session_start();
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	$obj = new producto();
	$obj->loadCategoria('4');
	$n=count($obj->info);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calzados A'mano</title>
	<meta name="description" content="Calzados A'mano" />
	<meta name="keywords" content="Calzados A'mano" />
	<link rel="shortcut icon" href="../favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/zapatos.css" />
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
 <script type="text/javascript">
function alertSize() {
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //No-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  window.alert( 'Width = ' + myWidth );
  window.alert( 'Height = ' + myHeight );
document.getElementById("resultado").innerHTML="El ancho de la pagina es de "+ myWidth +"px y el alto es de "+ myHeight +"px";
}
</script>

</head>

<body>
	<div id="wrapper">
    	<div id="intwrapper" style="height:auto;">
        	<header>
            <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<?php include "redes.php"; ?>

                <div class="separador"></div>
                <nav id="menu">
               <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>

               </nav>
            </header>
     </div>
<!--<a href="javascript:alertSize();" > mostrar Height / Width </a>
<p id="resultado"></p> -->

		<div class="container" style="overflow-y:auto;" >
        	<section id="centrozap" >
            <?php for ($i=0;$i<$n;$i++) : ?>
             	<div class="zapato">
                	 <form action="producto.php" method="post" >
       	 	 		<input type="image" src="../images/producto/thumb/<?php echo $obj->info[$i]['thumb']; ?>" >
                    <?php if ($obj->info[$i]['nuevo']=='1') : ?><div class="nuevo">NUEVO</div><?php endif; ?>
                    <?php if (strlen($obj->info[$i]['descuento'])>0) : ?><div class="descuento"><?php echo $obj->info[$i]['descuento']; ?></div><?php endif; ?>
                    <input name="id" type="hidden" value="<?php echo $obj->info[$i]['id']; ?>">

                    </form>

                    <p><?php echo $obj->info[$i]['nombre']; ?></p>

                </div>

			 <?php endfor; ?>

              </section>

		</div> <!--fin container -->

<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
</body>
</html>
