<?php
session_start();
include "cnx.php";  

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Acceuil</title>

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
                    <img src="images/logoprim.png" class="img" alt="">
                  
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="./home.php" class="smoothScroll">Acceuil</a></li>
                         <li><a href="./Voter.php" class="smoothScroll">Voter</a></li>
                         <li><a href="./Consultation.php" class="smoothScroll">Consulter Vote</a></li>
                         <li><a href="./rslt.php" class="smoothScroll">Résultat élection </a></li>
                         
                         <li><a href="./index.php" class="smoothScroll">Déconnexion </a></li>
                    </ul>

                   
               </div>

          </div>
     </section>

     <div class="container" style="padding-left: 0px; margin-left: 200px;">
          <div class="row">
               <img src="images/tunisia flag.png" id="flag">
               <p class="write"> Bienvenue cher(e) <?php $user = $_SESSION['username'];

echo "$user";?> </p>
               <h1 class="write" >Pour un avenir beaucoup plus mieux</h1>
               

               </div>
               </div>





     <!-- FEATURE -->
     <section id="feature">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              
                              <img src="images/vote.png" alt="">
                             <a href="./Voter.php"> <button type="button" class="btn btn-primary btn-lg" style="background-color: #CD5C5C;">Voter
                              </button> </a>
                              
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <img src="images/inscrip.png" >
                              <a href="./Consultation.php"><button type="button" onclick="window.location='./Consultation.php'" class="btn btn-primary btn-lg" style="background-color: #8B0000;">Consulter Vote</button>
                              
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <img src="images/rslt.png" >
                              <a href="./rslt.php"> <button type="button" class="btn btn-primary btn-lg" style="background-color:#0000A3;">Les résultats</button></a>
                         
                         </div>
                    </div>

               </div>
          </div>
     </section>

<!-- CONTACT -->
<section id="contact" style="    padding-bottom: 50px; padding-top: 50px;" >
    <div class="container">
         <div class="row">

              <div class="col-md-6 col-sm-12">
                   <form id="contact-form" role="form" action="" method="post">
                        <div class="section-title">
                             <h2>Contactez nous <small></small></h2>
                        </div>

                        <div class="col-md-12 col-sm-12">
         
              
                             <input type="email" class="form-control" placeholder="Entrez votre address mail" name="email" required="">

                             <textarea class="form-control" rows="6" placeholder="Entrez votre message" name="message" required=""></textarea>
                        </div>

                        <div class="col-md-4 col-sm-12">
                             <input type="submit" class="form-control" name="Envoyer le message" value="Envoyer le message">
                        </div>

                   </form>
              </div>

              <div class="col-md-6 col-sm-12">
                   <div class="contact-image">
                        <div class="google-map w-100">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d823055.7333743584!2d9.901367609556518!3d36.31081645550276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc61987948d6dba42!2sInstance%20Sup%C3%A9rieure%20Ind%C3%A9pendante%20pour%20les%20%C3%89lections!5e0!3m2!1sfr!2stn!4v1621149974701!5m2!1sfr!2stn" width="600" title="map"height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                             
                           </div>
                   </div>
              </div>

         </div>
    </div>
</section>       


<!-- FOOTER -->
<footer id="footer" style="    padding: 30px 0;">
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