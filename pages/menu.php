<ul class="menu" >
<?php if ($pages=="/pages/nosotros.php")  { $class='btn_nuestrashover'; } else { $class='btn_nuestras'; } ?>
	<li><a href="nosotros.php" class="opcion <?php echo $class;?>"></a></li>
    <?php if (($pages=="/pages/cintillosb.php")||($pages=="/pages/bebes.php")||($pages=="/pages/lazosb.php")||($pages=="/pages/pijamasb.php")) { $class='btn_bebeshover'; } else { $class='btn_bebes'; } ?>
    <li><a href="#" class="opcion <?php echo $class;?>"></a>
        <ul class="menu2">
            <li><a href="bebes.php" class="btn_menu btn_zapatos"></a></li>
            <li><a href="lazosb.php" class="btn_menu btn_lazos"></a></li>
            <li><a href="cintillosb.php" class="btn_menu btn_cintillos"></a></li>
            <li><a href="pijamasb.php" class="btn_menu btn_pijamas"></a></li>
        </ul>
    </li>

    <?php if (($pages=="/pages/cintillosg.php")||($pages=="/pages/girls.php")||($pages=="/pages/lazosg.php")||($pages=="/pages/pijamasg.php")) { $class='btn_girlshover'; } else { $class='btn_girls'; } ?>
   	<li><a href="#" class="opcion <?php echo $class;?>" ></a>
        <ul class="menu2">
            <li><a href="girls.php" class="btn_menu btn_zapatos"></a></li>
            <li><a href="lazosg.php" class="btn_menu btn_lazos"></a></li>
            <li><a href="cintillosg.php" class="btn_menu btn_cintillos"></a></li>
            <li><a href="pijamasg.php" class="btn_menu btn_pijamas"></a></li>
         </ul>
    </li>
    <?php if (($pages=="/pages/boys.php")||($pages=="/pages/pijamaso.php")) { $class='btn_boyshover'; } else { $class='btn_boys'; } ?>
    <li><a href="#" class="opcion <?php echo $class;?>" ></a>
         <ul class="menu2">
             <li><a href="boys.php" class="btn_menu btn_zapatos"></a></li>
              <li><a href="pijamaso.php" class="btn_menu btn_pijamas"></a></li>
         </ul>

    </li>
    <?php if ($pages=="/pages/colegial.php")  { $class='btn_colegialhover'; } else { $class='btn_colegial'; } ?>
    <li><a href="colegial.php" class="opcion <?php echo $class;?>"></a></li>

    <?php if ($pages=="/pages/mispedidos.php")  { $class='btn_pedidoshover'; } else { $class='btn_pedidos'; } ?>
    <li><a href="mispedidos.php" class="opcion <?php echo $class;?>"></a></li>

    <?php if ($pages=="/pages/contacto.php")  { $class='btn_contactohover'; } else { $class='btn_contacto'; } ?>
    <li> <a href="contacto.php" class="opcion <?php echo $class;?>"></a></li>
</ul>
