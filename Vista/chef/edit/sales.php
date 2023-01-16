
<?php
session_start();
require_once "../../../Modelo/connect.php";

if ($_SESSION['username'] == null) {
    echo "<script>alert('Porfavor registrarse');</script>";
    header("Refresh:0 , url=../../index.html");
    exit();
}
$usuario = $_SESSION['username'];
$sql_fetch_todos = "SELECT * FROM tandas where estado='A' ORDER BY id_tan ASC";
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
    <script defer src="../../js/crearSelect.js"></script>
    <script defer src="../../js/SoloInput.js"></script>
</head>
<body>
<header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
                <a href="../inicio.html" class="logo">TORTAS KADY</a>
                <ul class="nav-list">
                    <li class="nav-item">
                            <a href="../cakes.php" class="nav-link ">Tortas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../sales.php" class="nav-link active">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../orders.php" class="nav-link ">Ordenes</a>
                        </li>
                        <li class="nav-item">
                            <a href="../prescriptions.php" class="nav-link ">Recetas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../controlador/logout.php" class="nav-link ">Cerrar Sesión</a>
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
                <th scope="col">Fecha</th>
                <th scope="col">Id Torta vendidad</th>
                <th scope="col">Cantidad vendida </th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                    
                    <td><?php echo $row['id_tan'] ?></td>
                        <td><?php echo $row['fec_tan'] ?></td>
                        <td><?php echo $row['id_torta'] ?></td>
                        <td><?php echo $row['can_pie'] ?></td>
                    </tr>
                <?php
    
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="fixproduct">
        <form method="POST" action="../../../Controlador/chef/edit/sales.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Fecha</label>
                <br>
                <input type="text" class="form-control" name="fecha" value="<?php echo $_GET['fecha']; ?>">
                
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">ID Torta</label>
                <br>
                <select name="torta" id="select"  class="form-select" aria-label="Default select example">
                <input type="hidden" name="" id="url" value="../../../Controlador/admin/torta.php">
                </select>
                
                
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad Vendida</label>
                <br>
                <input type="text" class="form-control numeros" name="cantidad" value="<?php echo $_GET['cant_ven']; ?>">
                <input type="hidden" value="<?php echo $_GET['id_tan'] ?>" name="id" />
            </div>
            

            

            <br>
            <div class="form-button">
            <button class="boton-validador modify" style="float:right">Editar venta</button>
                <button type="submit" class="original" style="float:right" hidden>Editar venta</button>
                <a href="../sales.php" class="btn btn-primary" id="es"><b>volver</b> </a>
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