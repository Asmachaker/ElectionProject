<!DOCTYPE html>
<html lang="en">
<head>

     <title>Résultat</title>

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
<style>
    body { 
  font-family: Tahoma, Arial, Verdana;
  font-size: 12px;
  color: black; }
  
  #chartdiv  {
	  width: 640px;
	  height: 400px;
  }

</style>
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
                          <li>   <a href="./home.php" class="smoothScroll">Acceuil</a></li>
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
        
        <div class="wrapper wrapper--w680" style="margin-left: 90px">
            <div class="card card-4" style="width: 1000px; height: 850px;">
                <div class="card-body">
                    <h2 class="title"><b>Résultat des votes</b></h2>

                    
                        
                        
                        <div class="p-t-15">
                            <div id="chartdiv" style="margin-left:120px"></div>

                            <div class="input-group">
                            <form method="POST" action="">
                                
                                <div class="rs-select2 js-select-simple select--no-search">
                                
                                <?php
        include "cnx.php";  // Using database connection file here
        try { 
            $sql = "SELECT * FROM gouvernorat";
            $projresult = $db->query($sql);
            $projresult->setFetchMode(PDO::FETCH_ASSOC);

            echo '<select name="Gouvernorat"  id="Gov" class="form-control"  
            style ="height: 42px;width: 126px ;     margin-top: 30px; margin-left: 70px;" >';

            while ($row = $projresult->fetch()) {
                echo '<option  value="' . $row['idGouvernorat'] . '">' . $row['nomGouvernorat'] . '</option>';
           
            }
            echo '</select>';
        } catch (PDOException $e) {
            die("Some problem getting data from database !!!" . $e->getMessage());
        }
        ?>     


<?php
        $sieges = array();
        $Nbsieges = array(15, 12, 10, 9, 7, 13, 8, 8, 14, 10, 9, 7, 7, 8, 8, 6, 10, 9, 6, 10, 9, 7, 7, 8);
        $i = 0;
        $j = 0;
        for ($i = 0; $i < 24; $i++) {
            $sum = 0;
            for ($j = 0; $j < 7; $j++) {
                $x = $j + 1;
                $y = $i + 1;
                $sth = $db->prepare("SELECT
SUM(voix.nombrevoix) Total,
gouvernorat.nomGouvernorat,
partipolitique.nomParti
FROM
voix
INNER JOIN partipolitique ON voix.idParti = partipolitique.idParti
INNER JOIN gouvernorat ON voix.idGouvernorat = gouvernorat.idGouvernorat
where voix.idParti ='$x' and voix.idGouvernorat ='$y'");
                $sth->execute();
                $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                $sieges[$i][$j] = $resultat[0]['Total'];
                $sum += $resultat[0]['Total'];
                if ($j == 6) {
                    $sieges[$i][7] = $Nbsieges[$i];
                    $sieges[$i][8] = $sum;
                }
            }
        }

        $rest = array();
        for ($i = 0; $i < 24; $i++) {
            $quotient = intval($sieges[$i][8] / $sieges[$i][7]);
            for ($j = 0; $j < 7; $j++) {
                $rest[$i][$j] = $sieges[$i][$j] % $quotient;
                $sieges[$i][$j] = intval($sieges[$i][$j] /= $quotient);
            }
        }
        for ($i = 0; $i < 24; $i++) {
            $s = array();
            $arr = 0;
            for ($j = 0; $j < 7; $j++) {
                $s = array_slice($sieges[$i], 0, 7);
                $som = array_sum($s);
       
                if ($sieges[$i][7] > $som) {
              
                    for ($k = 0; $k < intval($sieges[$i][7] - $som); $k++) {
                        $index = array_search(max($rest[$i]), $rest[$i]);
                        
                        $sieges[$i][$index] += 1;
                  
                        unset($rest[$i][$index]);
                    }
                }
            }
        }
       
    
        
        if (isset($_POST['tout'])) {  
        $sth = $db->prepare("SELECT * FROM partipolitique");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
      
        
        $nahdha=0;
            for ($i = 0; $i < 24; $i++) {
                $nahdha += $sieges[$i][0];
            }

     $etailar=0;
            for ($i = 0; $i < 24; $i++) {
               $etailar += $sieges[$i][1];
           }

           $pdl=0;
           for ($i = 0; $i < 24; $i++) {
               $pdl += $sieges[$i][2];
           }

           $front=0;
           for ($i = 0; $i < 24; $i++) {
               $front += $sieges[$i][3];
           }

           $ajjom=0;
           for ($i = 0; $i < 24; $i++) {
               $ajjom += $sieges[$i][4];
           }
           $pdm=0;
           for ($i = 0; $i < 24; $i++) {
               $pdm += $sieges[$i][5];
           }
           $afek=0;
           for ($i = 0; $i < 24; $i++) {
               $afek += $sieges[$i][6];
           }


          echo' <script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
          <script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
          
           <script>
var chart;
var graph;
var categoryAxis;

var chartData = 
[
  {
	  "country": "Elnahdha",
		"visits":' ,$nahdha ,',
    "color": "#FF0F00"
	},
	{
		"country": "Ettaillar",
		"visits": ', $etailar,',
    "color": "#FF6600"
	}, 
	{
		"country": "PDL",
		"visits":' ,$pdl,',
    "color": "#FF9E01"
	}, 
	{
	  "country": "Front populaire",
		"visits": ',$front,',
    "color": "#FCD202"
	}, 
	{
		"country": "Ajjomhouri",
		"visits": ',$ajjom,',
    "color": "#F8FF01"
	}, 
	{
		"country": "PDM",
		"visits": ',$pdm,',
    "color": "#B0DE09"
	}, 
	{
		"country": "Afek Tunis",
		"visits": ',$afek,',
    "color": "#04D215"
    
	}, 
	
];


AmCharts.ready(function () {
  chart = new AmCharts.AmSerialChart();
	chart.dataProvider = chartData;
	chart.categoryField = "country";
  chart.position = "left";
  chart.angle = 30;
	chart.depth3D = 15;
  chart.startDuration = 1;
  
  categoryAxis = chart.categoryAxis;
	categoryAxis.labelRotation = 45;
  categoryAxis.dashLength = 5; 
  categoryAxis.gridPosition = "start";
  categoryAxis.autoGridCount = false;
	categoryAxis.gridCount = chartData.length;
  
    
	graph = new AmCharts.AmGraph();
	graph.valueField = "visits";
	graph.type = "column";	
  graph.colorField = "color";
	graph.lineAlpha = 0;
  graph.fillAlphas = 0.8;
  graph.balloonText = "[[category]]: <b>[[value]]</b>";
  
  chart.addGraph(graph);
  
  chart.write(\'chartdiv\');
});
</script>' ;};
    
     
        ?>

        <?php


$sieges = array();
$Nbsieges = array(15, 12, 10, 9, 7, 13, 8, 8, 14, 10, 9, 7, 7, 8, 8, 6, 10, 9, 6, 10, 9, 7, 7, 8);
$i = 0;
$j = 0;
for ($i = 0; $i < 24; $i++) {
    $sum = 0;
    for ($j = 0; $j < 7; $j++) {
        $x = $j + 1;
        $y = $i + 1;
        $sth = $db->prepare("SELECT
SUM(voix.nombrevoix) Total,
gouvernorat.nomGouvernorat,
partipolitique.nomParti
FROM
voix
INNER JOIN partipolitique ON voix.idParti = partipolitique.idParti
INNER JOIN gouvernorat ON voix.idGouvernorat = gouvernorat.idGouvernorat
where voix.idParti ='$x' and voix.idGouvernorat ='$y'");
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sieges[$i][$j] = $resultat[0]['Total'];
        $sum += $resultat[0]['Total'];
        if ($j == 6) {
            $sieges[$i][7] = $Nbsieges[$i];
            $sieges[$i][8] = $sum;
        }
    }
}

$rest = array();
for ($i = 0; $i < 24; $i++) {
    $quotient = intval($sieges[$i][8] / $sieges[$i][7]);
    for ($j = 0; $j < 7; $j++) {
        $rest[$i][$j] = $sieges[$i][$j] % $quotient;
        $sieges[$i][$j] = intval($sieges[$i][$j] /= $quotient);
    }
}
for ($i = 0; $i < 24; $i++) {
    $s = array();
    $arr = 0;
    for ($j = 0; $j < 7; $j++) {
        $s = array_slice($sieges[$i], 0, 7);
        $som = array_sum($s);

        if ($sieges[$i][7] > $som) {
      
            for ($k = 0; $k < intval($sieges[$i][7] - $som); $k++) {
                $index = array_search(max($rest[$i]), $rest[$i]);
                
                $sieges[$i][$index] += 1;
          
                unset($rest[$i][$index]);
            }
        }
    }
}


        if (isset($_POST['afficher'])){
         
          $nah=0;
           $nah = $sieges[$_POST['Gouvernorat']][0] ;

           $etai=0;
           $etai = $sieges[$_POST['Gouvernorat']][1] ;

           $pd=0;
           $pd = $sieges[$_POST['Gouvernorat']][2] ;

           $pop=0;
           $pop = $sieges[$_POST['Gouvernorat']][3] ;

           $ajj=0;
           $ajj = $sieges[$_POST['Gouvernorat']][4] ;

           $pm=0;
           $pm = $sieges[$_POST['Gouvernorat']][5] ;

           $tn=0;
           $tn = $sieges[$_POST['Gouvernorat']][6] ;
             



           echo' <script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
           <script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
           
            <script>
 var chart;
 var graph;
 var categoryAxis;
 
 var chartData = 
 [
   {
        "country": "Elnahdha",
           "visits":' ,$nah ,',
     "color": "#FF0F00"
      },
      {
           "country": "Ettaillar",
           "visits": ', $etai,',
     "color": "#FF6600"
      }, 
      {
           "country": "PDL",
           "visits":' ,$pd,',
     "color": "#FF9E01"
      }, 
      {
        "country": "Front populaire",
           "visits": ',$pop,',
     "color": "#FCD202"
      }, 
      {
           "country": "Ajjomhouri",
           "visits": ',$ajj,',
     "color": "#F8FF01"
      }, 
      {
           "country": "PDM",
           "visits": ',$pm,',
     "color": "#B0DE09"
      }, 
      {
           "country": "Afek Tunis",
           "visits": ',$tn,',
     "color": "#04D215"
     
      }, 
      
 ];
 
 
 AmCharts.ready(function () {
   chart = new AmCharts.AmSerialChart();
      chart.dataProvider = chartData;
      chart.categoryField = "country";
   chart.position = "left";
   chart.angle = 30;
      chart.depth3D = 15;
   chart.startDuration = 1;
   
   categoryAxis = chart.categoryAxis;
      categoryAxis.labelRotation = 45;
   categoryAxis.dashLength = 5; 
   categoryAxis.gridPosition = "start";
   categoryAxis.autoGridCount = false;
      categoryAxis.gridCount = chartData.length;
   
     
      graph = new AmCharts.AmGraph();
      graph.valueField = "visits";
      graph.type = "column";	
   graph.colorField = "color";
      graph.lineAlpha = 0;
   graph.fillAlphas = 0.8;
   graph.balloonText = "[[category]]: <b>[[value]]</b>";
   
   chart.addGraph(graph);
   
   chart.write(\'chartdiv\');
 });
 </script>' ;};
     
   
        
        
        
        
        
        ?>
                                    <div class="p-t-15">
                            
                            <button class="btn btn--radius-2 btn--blue" style ="margin-left: 500px;
    margin-top: 20px; background-color: #DC143C;" name="tout">Sur toute La Tunisie</button>
                      <button class="btn btn--radius-2 btn--blue" style =" position: absolute ; left: 50px;
    top: 90px;background-color: #DC143C;" name="afficher">Afficher</button>
                         </div>
                                    <div class="select-dropdown"></div>
                                </div>
                                
                            </div>
        
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

<script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>



</body>
</html>