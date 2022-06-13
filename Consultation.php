<?php
session_start();
include "cnx.php";  

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Consultation</title>

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
                    <li><a href="./home.php" class="smoothScroll">Acceuil</a></li>
                         <li><a href="./Voter.php" class="smoothScroll">Voter</a></li>
                         <li><a href="./Consultation.php" class="smoothScroll">Consulter Vote</a></li>
                         <li><a href="./rslt.php" class="smoothScroll">Résultat élection </a></li>
                         <li><a href="./index.php" class="smoothScroll">Déconnexion </a></li>
                        
                        
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
                    <h2 class="title" style="margin-bottom: 0px;"><b>Consultation de vote</b></h2>

                    
                        
                        
                        <div class="p-t-15">
                          
                           <form class="box" action="./Consultation.php" method="post">
                           
                           <?php
        $vote = false;
        if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
            $sth0 = $db->prepare("SELECT
idPartiElu,idGouvernorat
FROM
electeur
WHERE
pseudo ='$_SESSION[username]'");
            $sth0->execute();
       
            $result = $sth0->fetchAll(PDO::FETCH_ASSOC);
            $idG = $result[0]['idGouvernorat'];
            $idP = $result[0]['idPartiElu'];
            if (isset($_POST['supp'])) {
                $sth = $db->prepare("UPDATE electeur 
                SET idPartiElu=null
                WHERE pseudo='$_SESSION[username]' and motPasse='$_SESSION[password]'");
                $sth->execute();
                $sth1 = $db->prepare("DELETE from voix where 
                idGouvernorat='$idG' and
                idParti='$idP' and
                nombreVoix=1");
                $sth1->execute();
                if ($sth->rowCount() && $sth1->rowCount()) {
                    $vote = true;
                    echo "<center><h3>Vote supprimé avec succes</h3></center>";
                } else {
                    echo "<center><h3>Echec de supression de vote</h3></center>";
                }
            }

        ?>
            <?php
            $sth = $db->prepare("SELECT
electeur.pseudo,
gouvernorat.nomGouvernorat,
partipolitique.nomParti
FROM
electeur
INNER JOIN partipolitique ON electeur.idPartiElu = partipolitique.idParti
INNER JOIN gouvernorat ON electeur.idGouvernorat = gouvernorat.idGouvernorat
WHERE
electeur.pseudo ='$_SESSION[username]'");
            $sth->execute();
            /*Retourne un tableau associatif pour chaque entrée de notre table
*avec le nom des colonnes sélectionnées en clefs*/
            $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
            if ($sth->rowCount()) {
                echo "<center>" . $resultat[0]['pseudo'] . " vous avez voter pour le parti " . $resultat[0]['nomParti'] . " dans le gouvernorat de " . $resultat[0]['nomGouvernorat'] . "</center>";
            
            } else {
                if (!$vote)
                    echo "<center><h3>Vous n'avais pas encore voter</h3></center>";
            }
        } 
        ?>
        <button class="btn btn--radius " name='supp' style =" margin-left: 135px; margin-top:30px; margin-right: 10px; background-color: #DC143C;"type="submit">Supprimer</button>
                            
        </form>
                            
                        </div>
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