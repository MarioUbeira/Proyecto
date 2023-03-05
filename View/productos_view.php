<div class="contenedor_productos">
  <div class="owl-carousel owl-theme">
    <?php
    foreach ($array_productos as $row) {
      $cod = $row['Cod_producto'];
      $precio_formateado = number_format($row["Precio"], 2);
      echo "<div class='producto'>
        <a href='php/producto.php?codigo=" . $row['Cod_producto'] . "'>
          <img src='imagenes/Productos/{$row['Cod_producto']}.png'></img></a>
          <label>{$row['Nombre']}</label>
          <label>{$precio_formateado}€/Ud.</label>
          <div class='button'>
          <form class='fav' method='post' action='php/favoritos.php'>
          <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' type='number' min = '1' max='{$row['Stock']}' value = '1'>
            </form>
          </div>
        </div>";
    }
    ?>
  </div>
</div>