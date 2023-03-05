<nav>
   <!-- Resto del contenido de la barra de navegación -->
   <?php
   if (isset($_SESSION['carrito'])) {
      $count = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
      echo "<div class='contador'>" . $count . "</div>";
   } else {
      echo "<div class='contador'>0</div>";
   }

   ?>
</nav>