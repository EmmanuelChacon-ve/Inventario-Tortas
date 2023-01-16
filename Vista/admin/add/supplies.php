<?php
session_start();
require_once "../../../Modelo/connect.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Porfavor registrarse');</script>";
    header("Refresh:0 , url=../../index.html");
    exit();
}
$usuario = $_SESSION['username'];

$sql_fetch_todos = "SELECT * FROM insumos where estado='A' ORDER BY id_ins ASC";
$query = mysqli_query($conn, $sql_fetch_todos);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Editar Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../img/LOGOv.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/edits.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/font.css">
        <!-- javascript -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../../js/admin/SoloInput.js"></script>
    <script defer src="../../js/admin/crearSelect.js"></script>
</head>
<body>
<header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
                <a href="inicio.html" class="logo">TORTAS KADY</a>
                <ul class="nav-list">
                    <li class="nav-item">
                            <a href="../cakes.php" class="nav-link ">Tortas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../sales.php" class="nav-link ">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../supplies.php" class="nav-link active">Insumos</a>
                        </li>
                        <li class="nav-item">
                            <a href="../unit.php" class="nav-link ">Unidades</a>
                        </li>
                        <li class="nav-item">
                            <a href="../user.php" class="nav-link ">Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../controlador/logout.php" class="nav-link ">Cerrar Seccion</a>
                        </li>
                        
                    </ul>
  
            </nav>
        </div>
    </header>
    <div class="containe">
        <h1>Lista de Productos</h1>
        <h2>Has accedido como <?php echo $str = strtoupper($usuario) ?></h2>
    </div>
    <div class="table-product">
        <table class="table table-dark table-striped"  id="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Insumo</th>
                <th scope="col">ID: unidad de medida</th>
                <th scope='col'>Existencia minima</th>
                <th scope='col'>Existencia maxima</th>
                <th scope='col'>Cantidad disponible</th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                    
                    <td><?php echo $row['id_ins'] ?></td>
                        <td><?php echo $row['des_ins'] ?></td>
                        <td><?php echo $row['id_uni'] ?></td>
                        <td><?php echo $row['exi_min'] ?></td>
                        <td><?php echo $row['exi_max'] ?></td>
                        <td><?php echo $row['can_disp'] ?></td>

                    </tr>
                <?php
    
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="fixproduct">
        <form method="POST" action="../../../Controlador/admin/add/supplies.php">

        <div class="form-group">
                <label for="exampleInputEmail1">Insumo</label>
                <br>
                <input type="text" class="form-control textoEspacio" name="insumo">
                
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Insumo</label>
                <br>
                <select name="unidad" id="select"  class="form-select" aria-label="Default select example">

                </select>
                <input type="hidden" value='../../../Controlador/admin/unidadMedida.php' id="url">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Existencia Maxima</label>
                <br>
                <input type="text" class="form-control numeros" name="max"  >
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Existencia Minima</label>
                <br>
                <input type="text" class="form-control numeros" name="min"  >
                
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad Disponible</label>
                <br>
                <input type="text" class="form-control numeros" name="cantidad"  >
                
            </div>
            

            

            <br>
            <div class="form-button">
            <button class="boton-validador modify" style="float:right">Agregar insumo</button>
            <button type="submit" class="original" style="float:right" hidden>Agregar Insumo</button>
                <a href="../supplies.php" class="btn btn-primary" id="es"><b>volver</b> </a>
            </div>
        </form>
    </div>
    <?php
    mysqli_close($conn);
    ?>
    <footer>
        <div class="container">
            <div class="footer-content">

                <div class="footer-content-about">
                    <h4>Nosotros</h4>
                    <div class="circle">
                        <i class="fas fa-circle"></i>
                    </div>
                    <p>Desde hace dos años estamos complaciendo a nuestros clientes en la creación de la torta de sus sueños porque de que sirve crear algo ordinario cuando podemos crear algo extraordinario, aqui en tortas kady nos enorgullece dar rienda suelta a la imaginación de nuestros clientes y permitirles experimentar una experiencia de-gustativa fuera de lo usual.</p>
                </div>
                <div class="footer-div">
                    <div class="social-media">
                        <h4>Siguenos</h4>
                        <ul class="social-icons">

                            <li>
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/tortaskady_/"><i class="fab fa-instagram"></i></a>
                            </li>
 

                        </ul>
                    </div>
                    <div>
                        <h4 class="tlfh4">Telefono</h4>
                        <div class="tlf-n">
                        <span class="social-icons"><i class="fab fa-whatsapp"></i></span>
                        <h5 class="tlf">+584247395109</h5>
                        </div>
                        
  
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <script>

const selectElement = function(element) {
    return document.querySelector(element);
}


let menuToggle = selectElement('.menu-toggle');
let body = selectElement('body');

menuToggle.addEventListener('click', function(){
    body.classList.toggle('open');
})
</script> 
</body>
</html>