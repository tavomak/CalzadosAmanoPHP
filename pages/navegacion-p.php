<a href="../index.php">
    <div id="logo"></div>
</a>
<nav id="redes">
    <a href="pages/registrarse.php" class="boton btn_registrarse"></a>
    <a href="pages/iniciar.php" class="boton btn_sesion"></a>
    <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" class="boton btn_facebook" target="_blank"></a>
    <a href="https://twitter.com/amanocalzados" class="boton btn_twitter" target="_blank"></a>
    <a href="http://instagram.com/calzadosamano" class="boton btn_instagram" target="_blank"></a>
    <a href="pages/mispedidos.php" class="boton btn_carrito"></a> <span style="color: #009999; margin-left:10px; font-weight:bold;"><?php echo $_SESSION['articulos'];?></span>
</nav>

<div class="separador" style="margin-top:10px; margin-bottom:10px;"></div>

<nav id="menu" class="container-fluid">
    <ul class="menu text-center list-inline">
        <?php if ($pages=="/pages/nosotros.php")  { $class='btn_nuestrashover'; } else { $class='btn_nuestras'; } ?>
            <li>
                <a href="pages/nosotros.php" class="opcion <?php echo $class;?>"></a>
            </li>
            <?php if (($pages=="/pages/cintillosb.php")||($pages=="/pages/bebes.php")||($pages=="/pages/lazosb.php")||($pages=="/pages/pijamasb.php")) { $class='btn_bebeshover'; } else { $class='btn_bebes'; } ?>
                <li>
                    <a href="#" class="opcion <?php echo $class;?>"></a>
                    <ul class="menu2">
                        <li>
                            <a href="pages/bebes.php" class="btn_menu btn_zapatos"></a>
                        </li>
                        <li>
                            <a href="pages/lazosb.php" class="btn_menu btn_lazos"></a>
                        </li>
                        <li>
                            <a href="pages/cintillosb.php" class="btn_menu btn_cintillos"></a>
                        </li>
                        <li>
                            <a href="pages/pijamasb.php" class="btn_menu btn_pijamas"></a>
                        </li>
                    </ul>
                </li>
                <?php if (($pages=="/pages/cintillosg.php")||($pages=="/pages/girls.php")||($pages=="/pages/lazosg.php")||($pages=="/pages/pijamasg.php")) { $class='btn_girlshover'; } else { $class='btn_girls'; } ?>
                    <li>
                        <a href="#" class="opcion <?php echo $class;?>"></a>
                        <ul class="menu2">
                            <li>
                                <a href="pages/girls.php" class="btn_menu btn_zapatos"></a>
                            </li>
                            <li>
                                <a href="pages/lazosg.php" class="btn_menu btn_lazos"></a>
                            </li>
                            <li>
                                <a href="pages/cintillosg.php" class="btn_menu btn_cintillos"></a>
                            </li>
                            <li>
                                <a href="pages/pijamasg.php" class="btn_menu btn_pijamas"></a>
                            </li>
                        </ul>
                    </li>
                    <?php if (($pages=="/pages/boys.php")||($pages=="/pages/pijamaso.php")) { $class='btn_boyshover'; } else { $class='btn_boys'; } ?>
                        <li>
                            <a href="#" class="opcion <?php echo $class;?>"></a>
                            <ul class="menu2">
                                <li>
                                    <a href="pages/boys.php" class="btn_menu btn_zapatos"></a>
                                </li>
                                <li>
                                    <a href="pages/pijamaso.php" class="btn_menu btn_pijamas"></a>
                                </li>
                            </ul>
                        </li>
                        <?php if ($pages=="/pages/colegial.php")  { $class='btn_colegialhover'; } else { $class='btn_colegial'; } ?>
                            <li>
                                <a href="pages/colegial.php" class="opcion <?php echo $class;?>"></a>
                            </li>
                            <?php if ($pages=="/pages/mispedidos.php")  { $class='btn_pedidoshover'; } else { $class='btn_pedidos'; } ?>
                                <li>
                                    <a href="pages/mispedidos.php" class="opcion <?php echo $class;?>"></a>
                                </li>
                                <?php if ($pages=="/pages/contacto.php")  { $class='btn_contactohover'; } else { $class='btn_contacto'; } ?>
                                    <li>
                                        <a href="pages/contacto.php" class="opcion <?php echo $class;?>"></a>
                                    </li>
    </ul>
</nav>
