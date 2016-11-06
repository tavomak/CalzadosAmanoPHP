<?php session_start();?>
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
 <link rel="stylesheet" type="text/css" href="../css/conversion.css">
 <link rel="stylesheet" type="text/css" href="../css/menu.css">

</head>

<body>

<div id="wrapper">
   	<div id="intwrapper">
      	<header>
            <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<?php include "redes.php"; ?>

                <div class="separador"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
               </nav>
            </header>

  	<div class="container">
        	<section id="centrozap" style="text-align:center;"  >
				<img src="../images/conversion/conversion_medidas.jpg" width="70%" >

              </section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>

	</div>       <!-- fin wrapper -->

</body>

</html>
