<?php
session_start();
include "cnx.php";  

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Voter</title>

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
                    <h2 class="title" ><b>Votre vote est important</b></h2>
                   

                    
                        
                        
                    <form class="box" action="./Voter.php" method="post">
                        <div class="input-group">
                            
                            
                            <div class="rs-select2 js-select-simple select--no-search">
                                <label class="label" style="margin-left:60px; margin-bottom:10px; font-size: 20px;     margin-right: 200px;">Choisissez votre parti</label>
                                    
                                    <?php
        
        try {
            $sql = "SELECT * FROM partipolitique";
            $projresult = $db->query($sql);
            $projresult->setFetchMode(PDO::FETCH_ASSOC);
            echo '<select name="partipolitique"  id="partipol" class="form-control" style="     margin-right: 200px;
               margin-left: 90px;
            width: 302px;
            height: 42px;margin-bottom: 20px;" >';
            echo '<option disabled="disabled" selected="selected">Choisir une parti</option> ';
            while ($row = $projresult->fetch()) {
                echo '<option value="' . $row['idParti'] . '">' . $row['nomParti'] . '</option>';
            }
            echo '</select>';
        } catch (PDOException $e) {
            die("Some problem getting data from database !!!" . $e->getMessage());
        }
    ?>
                                   
                                </select></div> <!-- <div class="p-t-15">
                            
 
                        </div>
                                 <div class="select-dropdown"></div> -->
                         
        <?php


            if (isset($_POST['Voter'])) {
                try {
                    $stm2 = $db->prepare("select idPartiElu from electeur where pseudo='$_SESSION[username]'");
                    $stm2->execute();
                    $resultat = $stm2->fetchAll(PDO::FETCH_ASSOC);
                    if ($resultat[0]['idPartiElu'] != null) {
                        echo 
                            '<h3 style= "margin-left: 20px;
                            margin-right: 130px;
                            margin-bottom: 30px; text-align:center;">Vous avez déja voter s\'il vous plait consulter votre vote</h3>';
                    } else {
                        $dt = getdate();
                        $date = $dt['year'] . "/" . $dt['mon'] . "/" . $dt['mday'];
                        //$sth appartient à la classe PDOStatement 
                        $sql = "SELECT idGouvernorat FROM electeur where pseudo='$_SESSION[username]'";
                        $projresult = $db->query($sql);
                        $projresult->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $projresult->fetch();
                        $sth = $db->prepare("
    INSERT INTO voix(
    idGouvernorat,
    idParti,
    nombreVoix)
    VALUES (?,?,?)
    ");
                        $sth->bindValue(1, $row['idGouvernorat'], PDO::PARAM_INT);
                        $sth->bindValue(2, $_POST['partipolitique'], PDO::PARAM_INT);
                        $sth->bindValue(3, 1, PDO::PARAM_INT);
                        $sth->execute();
                        $sth = $db->prepare("
UPDATE electeur 
SET idPartiElu='$_POST[partipolitique]',dateDerniereElection='$date'
WHERE pseudo='$_SESSION[username]' and motPasse='$_SESSION[password]'
");
                        $sth->execute();
                        if ($sth->rowCount() != 0) {
                            echo '<script >
                            alert ("Votre Vote est enregistré")
                            </script>';
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        
        ?>
                                   <button class="btn btn--radius " name="Voter" style ="background-color: #DC143C;margin-left: 150px;"type="submit">Voter</button> </form>
                        </div>
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