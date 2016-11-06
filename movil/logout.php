<?php include "cabecera.php";
$_SESSION = array();
session_destroy();
?>
<body>
<?php include "menu.php"; ?>


<div id="wrapper">
<div style="height:300px;" >
<div id="resultado" style="display:block;">
     Sesi&oacute;n cerrada exitosamente
</div>     </div>
<div id="intwrapper">

 </div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
