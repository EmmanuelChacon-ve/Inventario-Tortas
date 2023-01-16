
<?php
session_start();
require_once "../../../Modelo/connect.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Porfavor registrarse');</script>";
    header("Refresh:0 , url=../../index.html");
    exit();
}
$usuario = $_SESSION['username'];

$sql_fetch_todos = "SELECT * FROM ordenes where estado='A' ORDER BY id_orden ASC";
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
    <script src="../js/addlist.js"></script>
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
                            <a href="../orders.php" class="nav-link active ">Ordenes</a>
                        </li>
                        <li class="nav-item">
                            <a href="../sales.php" class="nav-link ">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a href="../supplies.php" class="nav-link ">Insumos</a>
                        </li>
                        <li class="nav-item">
                            <a href="../unit.php" class="nav-link ">Unidades</a>
                        </li>
                        <li class="nav-item">
                            <a href="../user.php" class="nav-link ">Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a href="../../../controlador/logout.php" class="nav-link ">Cerrar Sesión</a>
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
                <th scope="col">ID orden</th>
                <th scope="col">Id Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cedula</th>
                <th scope="col">Numero telefonico</th>
                <th scope="col">fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                    
                    <td><?php echo $row['id_orden'] ?></td>
                        <td><?php echo $row['id_usuario'] ?></td>
                        <td><?php echo $row['nombre_comprador'] ?></td>
                        <td><?php echo $row['cedula_comprador'] ?></td>
                        <td><?php echo $row['numero_comprador'] ?></td>
                        <td><?php echo $row['fecha_orden'] ?></td>
                    </tr>
                <?php
    
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="fixproduct">
        <form method="POST" action="../../../Controlador/admin/edit/orders.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del comprador</label>
                <br>
                <input type="text" class="form-control" name="nombre" value="<?php echo $_GET['nombre']; ?>" >
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cedula del comprador</label>
                <br>
                <input type="text" class="form-control" name="cedula" value="<?php echo $_GET['cedula']; ?>" >
                
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Numero del comprador</label>
                <br>
                <input type="text" class="form-control" name="numero" value="<?php echo $_GET['numero']; ?>" >
                
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Fecha</label>
                <br>
                <input type="text" class="form-control" name="fecha" value="<?php echo $_GET['fecha']; ?>" >
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
            </div>
            

            

            <br>
            <div class="form-button">
                <button type="submit" class="modify" style="float:right">Editar Orden</button>
                <a href="../orders.php" class="btn btn-primary" id="es"><b>volver</b> </a>
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