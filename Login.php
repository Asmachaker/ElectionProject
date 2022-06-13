<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>S'identifier</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="shortcut icon" href="images/tunisia flag.png" type="image/x-icon">

      <!-- Icons font CSS-->
    <link href="css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="css/select2.min.css" rel="stylesheet" media="all">
    <link href="css/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/index.css">
 
</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <img src="images/logoprim.png" class="img" href="./index.php" alt="">
                  
                 
   </div>
                  <!-- MENU LINKS -->
                  <div class="collapse navbar-collapse">
                       <ul class="nav navbar-nav navbar-nav-first">
                            <li><a href="./index.php" class="smoothScroll">Acceuil</a></li>
                            <li><a href="./Inscription.php" class="smoothScroll">S'inscrire</a></li>
                            <li><a href="./Login.php" class="smoothScroll">S'identifier</a></li>
                            <li><a href="./Resultat.php" class="smoothScroll">Résultat élection </a></li>
                            <li><a href="./index.php#contact" class="smoothScroll">Contactez-nous</a></li> 
                        
                        
                    </ul>

                   
               </div>

          </div>
     </section>
    
    </style>

     
     <div class="container">
        <div class="row">
        
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title"><b>Identification</b></h2>
                    <form method="POST" action="">
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <label class="label">Login</label>
                                    <input class="input--style-4" style="width: 340px;" type="text" name="username">
                                </div>
                            </div>
                    </div> 
                    <div class="row row-space">
                        <div class="col-4">
                            <div class="input-group">
                                <label class="label">Mot de passe</label>
                                <input class="input--style-4" style="width: 340px;" type="password" name="password">
                            </div>
                        </div>
                </div> 
   
                        
                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" name="login"style ="margin-left: 150px; background-color: #DC143C;"type="submit">S'identifier</button>
                        </div>
                        <?php
        include 'cnx.php';
        if (isset($_POST['login'])) {
            $stm1 = $db->prepare("select * from electeur where pseudo='$_POST[username]' and motPasse='$_POST[password]'");
            $stm1->execute();
            $stm1->fetchAll();
            if ($stm1->rowCount() != 0) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                $user = $_SESSION['username'];

echo "Welcome $user";
               
                echo("<script>location.href = 'http://localhost/projet/home.php';</script>"); 
            } else {
               echo '<script language="Javascript">
               alert ("Vérifier Vos données" )
               </script>';
            }
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>


            
            <!-- FOOTER -->
     <footer id="footer" style="    padding: 30px 0; background-color: #FFEDED;">
        <div class="container">
             <div class="row">

                  <div class="col-md-4 col-sm-6">
                       <div class="footer-info">
                            <div class="section-title">
                                 <h2>Address</h2>
                            </div>
                            <address>
                                 <p>05 rue de l’île de Sardaigne,<br>  les jardins du lac - 1053 Tunis</p>
                            </address>

                            <ul class="social-icon">
                                 <li><a target="_blank" href="https://www.facebook.com/isietn" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                 <li><a target="_blank" href="https://www.instagram.com/isietn/" class="fa fa-twitter"></a></li>
                                 <li><a target="_blank" href="https://twitter.com/ISIETN?s=07&fbclid=IwAR0fspVdQHmSbDy_oIajW4M5r9AC7mqIwc_JR4Ko7cupnLXEpQ2dFj2ICK8" class="fa fa-instagram"></a></li>
                                 <li><a target="_blank" href="https://www.youtube.com/channel/UC_byK16UEi25LywHLZ7-HVw" class="fa fa-youtube" attr="youtube icon"></a></li>
                            </ul>

                            <div class="copyright-text"> 
                                 <p>Copyright &copy; 2021 ISIE</p>
                                 
                            </div>
                       </div>
                  </div>

                  <div class="col-md-4 col-sm-6">
                       <div class="footer-info">
                            <div class="section-title">
                                 <h2>Information générale</h2>
                            </div>
                            <address>
                                 <p>+216 70018540, +216 70018545</p>
                                 <p><a href="mailto:youremail.co">contact@isie.tn</a></p>
                            </address>

                           
                       </div>
                  </div>

                  <div class="col-md-4 col-sm-12">
                       <div class="footer-info newsletter-form">
                            <div class="section-title">
                                 <h2>Pour vous restez à jour</h2>
                            </div>
                            <div>
                                 <div class="form-group">
                                      <form action="#" method="get">
                                           <input type="email" class="form-control" placeholder="écrivez votre email" name="email" id="email" required="">
                                           <input type="submit" class="form-control" name="submit" id="form-submit"  value="Send me">
                                      </form>
                                     
                                 </div>
                            </div>
                       </div>
                  </div>
                  
             </div>
        </div>
   </footer>
<!-- SCRIPTS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>

</body>
</html>