<!DOCTYPE html>
<html lang="en">
<head>

     <title>Inscription</title>

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
          <li><a href="#contact" class="smoothScroll">Contactez-nous</a></li>
     </ul>

                  
            

               
                    </ul>
                    
                     </div>

                   
               </div>

          </div>
     </section>
    
    </style>

     
     <div class="container">
        <div class="row">
        
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title"><b>Formulaire d'inscription</b></h2>
                    <form method="POST" action="">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Nom</label>
                                    <input class="input--style-4" type="text" name="first_name" required="">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Prenom</label>
                                    <input class="input--style-4" type="text" name="last_name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Login</label>
                                    <input class="input--style-4" type="text" name="email" required="">
                                </div>
                            </div>
                           <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Age</label>
                                    <div class="input-group-icon">
                                        <input style="    margin-left:40px;margin-top: 20px;
    border-left-width: 10px;" type="number"  name="Age"
                                         required="" min="18"    >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mot de passe</label>
                                    <input class="input--style-4" type="password" name="mdp" required="">
                                </div>
                            </div>
                            <div class="col-2">
                            <div class="input-group">
                            
                            <label class="label" style="margin-left: 60px;" >Gouvernorat</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                               
                                    
                                     
                                    <?php
        include "cnx.php";  // Using database connection file here
        try { 
            $sql = "SELECT * FROM gouvernorat";
            $projresult = $db->query($sql);
            $projresult->setFetchMode(PDO::FETCH_ASSOC);

            echo '<select name="Gouvernorat"  id="Gov" class="form-control"  
            style ="height: 42px; margin-left: 20px;" >';
 echo '<option disabled="disabled" selected="selected">Choisir une Gouvernorat</option> ';
         
            while ($row = $projresult->fetch()) {
                echo '<option  value="' . $row['idGouvernorat'] . '">' . $row['nomGouvernorat'] . '</option>';
                  }
            echo '</select>';
        } catch (PDOException $e) {
            die("Some problem getting data from database !!!" . $e->getMessage());
        }
        ?>
                            
                        </div>
                        
     
        
        
       
                                <div class="select-dropdown"></div>
                            </div>
                            
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" style ="margin-left: 150px; background-color: #DC143C;" name="Inscrire">S'inscrire</button>
                        </div>
                        <?php
    include 'cnx.php';
    if (isset($_POST['Inscrire'])) {
        $stm1 = $db->prepare("select * from electeur where pseudo='$_POST[email]'");
        $stm1->execute();
        $stm1->fetchAll();
        if ($stm1->rowCount() != 0 ) {
            echo  '<h4 style ="margin-left: 140px;
            margin-top: 30px;"> le login est déja utilisé </h4> '
           ;
        } else {
            try {

                $dt = getdate();
                $date = $dt['year'] . "/" . $dt['mon'] . "/" . $dt['mday'];
               
             
                //$sth appartient à la classe PDOStatement
                $sth = $db->prepare("
 INSERT INTO electeur (Nom,motPasse,pseudo,age,dateInscription,idGouvernorat)
    VALUES (?,?,?,?,?,?)
 ");
                //La constante de type par défaut est STR
                $sth->bindValue(1, $_POST['first_name']);
                $sth->bindValue(2, $_POST['mdp']);
                $sth->bindValue(3, $_POST['email']);
                $sth->bindValue(4, $_POST['Age'], PDO::PARAM_INT);
                $sth->bindValue(5, $date);
                $sth->bindValue(6, $_POST['Gouvernorat']);
                $sth->execute();
              
                
                echo '<script >
                alert ("Vous etes inscrit");
                location.href = \'http://localhost/projet/home.php\';</script>'; 
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }}
    
    ?>

                    </form>
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

     <script> var $password = $("#password");
        var $confirmPassword = $("#confirm_password");
        
        //Hide hints
        $("form span").hide();
        
        function isPasswordValid() {
          return $password.val().length > 8;
        }
        
        function arePasswordsMatching() {
          return $password.val() === $confirmPassword.val();
        }
        
        function canSubmit() {
          return isPasswordValid() && arePasswordsMatching();
        }
        
        function passwordEvent(){
            //Find out if password is valid  
            if(isPasswordValid()) {
              //Hide hint if valid
              $password.next().hide();
            } else {
              //else show hint
              $password.next().show();
            }
        }
        
        function confirmPasswordEvent() {
          //Find out if password and confirmation match
          if(arePasswordsMatching()) {
            //Hide hint if match
            $confirmPassword.next().hide();
          } else {
            //else show hint 
            $confirmPassword.next().show();
          }
        }
        
        function enableSubmitEvent() {
          $("#submit").prop("disabled", !canSubmit());
        }
        
        //When event happens on password input
        $password.focus(passwordEvent).keyup(passwordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);
        
        //When event happens on confirmation input
        $confirmPassword.focus(confirmPasswordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);
        
        enableSubmitEvent();</script>
     </body>
     </html>