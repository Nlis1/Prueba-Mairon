<?php

session_start();

// if(isset($_POST['busqueda_inicial'])){
//     $_SESSION['busqueda']=$_POST['busqueda_inicial'];

//         require_once '../controlador/DocumentController.php';
//         $insDocument = new DocumentController();

//         $datos= $insDocument->consultar("",$_SESSION['busqueda']);
//         $datos= json_decode($datos);
//         $contador=1;
//         echo json_encode($datos);

//         if($datos){
//         foreach ($datos as $row) {
//         echo '<tr>
//             <td>'.$contador.'</td>
//             <td>'.$row[2].'</td>
//             <td>'.$row[1].'</td>
//             <td>'.$row[3].'</td>
//             <td>'.$row[4].'</td>
//             <td>'.$row[5].'</td>
//             <td>
//                 <a href="../vista/mydocuments.php/'.$row[0].'" class="btn btn-success btn-xs">
//                     <i class="bi bi-arrow-clockwise"></i>
//                 </a>
//             </td>
//             <td>
//                 <form method="POST" action="../ajax/DocumentAjax.php" class="FormularioAjax eliminarDocumento">
//                     <input type="hidden" name="codigo-document" value="'.$row[0].'">
//                     <button type="submit" class="btn btn-danger btn-xs">
//                         <i class="bi bi-trash"></i>
//                     </button>
//                 </form>
//             </td>
//         </tr>';
//          $contador++;
//         }
// }else{
//     echo 'No se encontro el dato';
// }
// }

if (isset($_POST['eliminar_busqueda'])) {
    unset($_SESSION['busqueda']);
}

