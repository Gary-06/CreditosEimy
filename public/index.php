<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora de Precio de Electrodoméstico</title>
  <link href="./css/tailwind.css" rel="stylesheet">
  <script src="js/script.js" defer></script>
</head>
<body class="bg-green-200 flex items-center justify-center min-h-screen">
  <div class="container mx-auto mt-4">
    <h1 class="text-center text-3xl font-bold">Calculadora de Precio de Electrodoméstico</h1>

    <div class="flex justify-center mt-4">
      <form id="calculator-form" action="index.php" method="post" class="w-full max-w-md flex flex-col bg-white p-6 rounded-lg shadow-md">
        <label for="nombre" class="text-gray-800 mb-2">Nombre del Electrodoméstico:</label>
        <input type="text" id="nombre" name="nombre" class="border border-gray-300 rounded-md px-2 py-2 mb-4" required>

        <label for="color" class="text-gray-800 mb-2">Color:</label>
        <select id="color" name="color" class="border border-gray-300 rounded-md px-2 py-2 mb-4" required>
          <option value="blanco">Blanco</option>
          <option value="gris">Gris</option>
          <option value="negro">Negro</option>
        </select>

        <label for="consumo" class="text-gray-800 mb-2">Consumo Energético:</label>
        <select id="consumo" name="consumo" class="border border-gray-300 rounded-md px-2 py-2 mb-4" required>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>

        <label for="peso" class="text-gray-800 mb-2">Peso (en kg):</label>
        <input type="number" id="peso" name="peso" class="border border-gray-300 rounded-md px-2 py-2 mb-4" min="0" max="49" required>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Calcular Precio</button>
      </form>
    </div>

    <div id="result-container" class="flex justify-center mt-4">
      <div id="result" class="text-center bg-white p-6 rounded-lg shadow-md">
        <?php
       
       function calcularPrecioBase($consumo) {
           switch ($consumo) {
               case 'A':
                   return 1000;
               case 'B':
                   return 800;
               case 'C':
                   return 600;
               default:
                   return 0;
           }
       }
       
       function calcularPrecioPeso($peso) {
           if ($peso >= 0 && $peso <= 19) {
               return 105;
           } else if ($peso >= 20 && $peso <= 49) {
               return 505;
           } else {
               return 0;
           }
       }
       
       function calcularDescuento($color) {
           switch ($color) {
               case 'blanco':
                   return 5;
               case 'gris':
                   return 7;
               case 'negro':
                   return 10;
               default:
                   return 0;
           }
       }
       
       function procesarElectrodomestico($nombre, $color, $consumo, $peso) {
           // Sanitize inputs
           $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
           $color = filter_var($color, FILTER_SANITIZE_STRING);
           $consumo = filter_var($consumo, FILTER_SANITIZE_STRING);
           $peso = filter_var($peso, FILTER_SANITIZE_NUMBER_INT);
       
           // Calculate base price
           $precioBase = calcularPrecioBase($consumo);
           // Calculate price based on weight
           $precioPeso = calcularPrecioPeso($peso);
           // Total product price
           $precioProducto = $precioBase + $precioPeso;
       
           // Calculate discount
           $descuento = calcularDescuento($color);
           $descuentoValor = ($precioProducto * $descuento) / 100;
           // Final price after discount
           $precioFinal = $precioProducto - $descuentoValor;
       
           // Create an associative array with the product details
           $electrodomestico = [
               'Nombre' => $nombre,
               'Color' => $color,
               'Consumo Energético' => $consumo,
               'Peso' => $peso . ' kg',
               'Precio Base' => '$' . number_format($precioBase, 2),
               'Descuento' => $descuento . '%',
               'Precio Final' => '$' . number_format($precioFinal, 2)
           ];
       
           return $electrodomestico;
       }
       
       function generarInformacionElectrodomestico($electrodomestico) {
           $html = "<h2 class='text-xl font-semibold mb-4'>Información del Electrodoméstico:</h2>
                   <table class='min-w-full bg-white'>
                     <thead>
                       <tr>
                         <th class='py-2'>Campo</th>
                         <th class='py-2'>Valor</th>
                       </tr>
                     </thead>
                     <tbody>";
       
           foreach ($electrodomestico as $campo => $valor) {
               $html .= "<tr>
                           <td class='border px-4 py-2'>{$campo}</td>
                           <td class='border px-4 py-2'>{$valor}</td>
                         </tr>";
           }
       
           $html .= "  </tbody>
                   </table>";
       
           return $html;
       }
       
       // Example usage
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $nombre = $_POST['nombre'];
           $color = $_POST['color'];
           $consumo = $_POST['consumo'];
           $peso = $_POST['peso'];
       
           $electrodomestico = procesarElectrodomestico($nombre, $color, $consumo, $peso);
           // Output the result
           echo generarInformacionElectrodomestico($electrodomestico);
       }
      
       
 
        ?>
      </div>
    </div>
  </div>
</body>
</html>