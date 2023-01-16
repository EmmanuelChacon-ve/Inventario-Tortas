<?php
session_start();
require_once "../../Modelo/connect.php";

if ($_SESSION['username'] == null) {
    echo "<script>alert('Porfavor registrarse');</script>";
    header("Refresh:0 , url=../../index.html");
    exit();
}
$usuario = $_SESSION['username'];

$sql_fetch_todos = "SELECT * FROM tortas where estado='A' ORDER BY id_torta ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Lista de Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/font.css">
    <link rel="icon" href="../../Vista/img/LOGOv.png">
    


    
  
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
                            <a href="cakes.php" class="nav-link active">Tortas</a>
                        </li>
                        <li class="nav-item">
                            <a href="orders.php" class="nav-link ">Ordenes</a>
                        </li>
                        <li class="nav-item">
                            <a href="sales.php" class="nav-link ">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a href="supplies.php" class="nav-link ">Insumos</a>
                        </li>
                        <li class="nav-item">
                            <a href="unit.php" class="nav-link ">Unidades</a>
                        </li>
                        <li class="nav-item">
                            <a href="user.php" class="nav-link ">Usuario</a>
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
            <tr>
              
                <th scope="col">ID</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Editar </th>
                <th scope="col">Eliminar</th>
                
            </tr>
            <tbody>
            <?php
                
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>

                        <td><?php echo $row['id_torta'] ?></td>
                        <td><?php echo $row['des_torta'] ?></td>
                        <td><?php echo $row['precio'] ?></td>
                        <td class="modify"><a name="edit" id="" class="bfix" href="./edit/cakes.php?id=<?php echo $row['id_torta'] ?>&message=<?php echo $row['des_torta'] ?>&precio=<?php echo $row['precio']?>" role="button">
                        

                        <img src="../img/editor-de-texto.png" class="edit">
                         
                            </a></td>
                           
                        <td class="delete"><a name="id" id="" class="bdelete"  href="../../Controlador/delete/cake.php?id=<?php echo $row['id_torta'] ?>" role="button">
                                <img src="../img/eliminar.png" alt="">
                            </a></td>
                    </tr>
                <?php  
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="add/cakes.php" role="button">Agregar Torta</a>
        <a href="../pdf/cakes.php" class="btn btn-primary" id="esp"><b>PDF</b> </a>
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