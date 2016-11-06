<?php include "cabecera.php";

include "../include/class/banner.php";
include "../include/class/producto.php";

$obj = new banner();
$obj->loadbanner();

$producto = new producto();
$producto->loadCategoria(rand(1, 2));
 ?>
<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">

<div id="myCarousel" class="carousel slide" data-ride="carousel" style="background:none;" >
  <!-- Indicators -->

  <ol class="carousel-indicators">
  <?php for ($i=0;$i<count($obj->info);$i++): ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i==0) ? 'class="active"' : ''; ?>></li>
  <?php endfor; ?>
  </ol>
  <div class="carousel-inner">
  <?php for ($i=0;$i<count($obj->info);$i++): ?>
    <div class="item <?php echo ($i==0) ? 'active' : ''; ?>"> <img src="../images/banner/<?php echo $obj->info[$i]['imagen']; ?>" width="100%" alt="fachada">
      <div class="container" style="display:none;">
        <div class="carousel-caption">
          <h1>Slide 1</h1>
          <p>Aenean a rutrum nulla. Vestibulum a arcu at nisi tristique pretium.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
        </div>
      </div>
    </div>
    <?php endfor; ?>

  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> </div>
  <div class="separador"></div>
  <?php $n=count($producto->info) - 10;
  		$i=rand(0, $n); $j=array();

		for ($k=0;$k<9; $k++){	$j[$k]=$i+$k; }

		 ?>
   <div class="miga">Zapatos</div>
   <div class="galshoes">

	<?php for ($i=0;$i<9;$i++) : ?>
	<div class="zapato">
        <form action="producto.php" method="post" >
       		<input type="image" src="../images/producto/thumb/<?php echo $producto->info[$j[$i]]['thumb']; ?>" class="imgzap" >
            <input name="id" type="hidden" value="<?php echo $producto->info[$j[$i]]['id']; ?>">
		</form>
	</div>
	<?php endfor; ?>
	</div>

</div>
</div>
<script src="../js/script.js"></script>
</body>
</html>
