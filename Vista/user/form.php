<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      />
      <link rel="shortcut icon" href="../img/LOGOv.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/user/styles.css">
        <link rel="stylesheet" href="../css/user/form.css">
        <link rel="stylesheet" href="../css/user/catalogo.css">
        <script src="index.js"></script>
        <title>TORTAS KADY</title>
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
                        <a href="./inicio.html" class="nav-link ">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="./catalogo.html" class="nav-link ">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a href="./info.html" class="nav-link ">SOBRE KADY</a>
                    </li>
                    <li class="nav-item">
                        <a href="promo.html" class="nav-link ">Promociones</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a href="form.php" class="nav-link active">Orden</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../controlador/logout.php" class="nav-link ">Cerrar Sesión</a>
                    </li>
                    
                    <li class="nav-item">
                      <div class="carrito__icon">
                      <i class="bx bx-cart"></i>
                    </div>
                </ul>
  
            </nav>
        </div>
    </header>


    <div class="addproduct">
            <form method="POST" action="../../controlador/user/form.php" id="form">
                <div class="form">
            <h1>¡ORDENA YA!</h1>
            <div class="grupo">
                <input type="text" name="nombre" id="name" required><span class="barra"></span>
                <label for="">Nombre Completo</label>
            </div>
            <div class="grupo">
                <input type="text" name="cedula" id="name" required><span class="barra"></span>
                <label for="">Cedula</label>
            </div>
            <div class="grupo">
                <input type="tel" name="numero" id="tel" required><span class="barra"></span>
                <label for="">Numero telefonico</label>
            </div>
      

            <div class="home-btn">
            <a class="btnf"><button type="submit">Enviar</button></a>
        </div>
        </div>
               
                
            </form>
            
        </div>
    </div>

 
     <footer>
        <div class="container">
            <div class="footer-content">

                <div class="footer-content-about">
                    <h4>Nosotros</h4>
                    <div class="circle">
                        <i class="fas fa-circle"></i>
                    </div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                        Praesentium odio labore dolorum veritatis, culpa cumque eum 
                        reprehenderit iure, commodi, repellat eaque possimus obcaecati 
                        assumenda exercitationem? 
                        Aperiam provident accusantium laboriosam. Necessitatibus!</p>
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