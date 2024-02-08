<?php include_once('includes/dbconnection.php');
//Coding For query
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$emailid=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$querymsg=$_POST['query'];
$teacherid=$_GET['tid'];
$sql="insert into contact(formationId,fName,emailid,mobileNumber,Query)values(:teacherid,:fname,:emailid,:mobileno,:querymsg)";
$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':querymsg',$querymsg,PDO::PARAM_STR);
$query->bindParam(':teacherid',$teacherid,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if ($LastInsertId>0) {
echo '<script>alert("Message Sent Successfully.")</script>';
echo "<script>window.location.href ='index.php'</script>";
}else{
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
   }}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>formation Details</title>
        <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <link rel="stylesheet" href="css/font-awesome.min.css"/>
	         <link rel="stylesheet" href="css/owl.carousel.css"/>
            <link rel="stylesheet" href="css/style.css"/>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <?php
           include_once('includes/sidebar.php');?>
            <!-- Page Content-->

<?php
$tid=intval($_GET['tid']);
$sql="SELECT * from formations where  id='$tid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
            <section class="py-5"style="margin-left:18%;margin-top:-5%; width:80%">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder"style="color:crimson;"><?php  echo htmlentities($row->nom);?>'s Details</h1>
                        <p class="lead fw-normal text-muted mb-0"style="text-color:blue;">Début le  <?php  echo htmlentities($row->date_f);?></p>
                    </div>
                    <div class="row gx-5">
                        <div class="col-xl-8">
                            <!-- FAQ Accordion 1-->
                     <!--        <h2 class="fw-bolder mb-3">Persoanl Details </h2> -->
                            <div class="accordion mb-5" id="accordionExample" style="margin-top:-60px;">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"style="color:crimson;">Formation Details</button></h3>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
              <table class="table table-bordered">
                  

                  <tr>
                      <th>Nom de formation</th>
                      <td><?php  echo htmlentities($row->nom);?></td>
                  </tr>

                  <tr>
                      <th>Domain de formation</th>
                      <td><?php  echo htmlentities($row->domain);?></td>
                  </tr>

                  <tr>
                      <th>Date</th>
                      <td><?php  echo htmlentities($row->date_f);?></td>
                  </tr>
                  <tr>
                      <th>Description</th>
                      <td><?php  echo htmlentities($row->description);?></td>
                  </tr>
                  <tr>
                      <th>Duree</th>
                      <td><?php  echo htmlentities($row->duree);?></td>
                  </tr>
              </table>
                                        </div>
                                    </div>
                                </div>
                    
                     
                            </div>
                            <!-- FAQ Accordion 2-->
                           
                            <div class="accordion mb-5 mb-xl-0" id="accordionExample2" style="margin-top:-40px;">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:crimson;">Formateur Details</button></h3>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                        <?php
                                         } }
                                                                             
$tid=intval($_GET['tid']);
$sq="SELECT formateur_id as idf from formation_formateur where  formation_id='$tid'";  
$query = $dbh -> prepare($sq);
$query->execute();
$result=$query->fetchAll(PDO::FETCH_OBJ);
foreach($result as $ro){
    $idf =  $ro->idf;
}
$s="SELECT * from formateur where  id='$idf'";
$quer = $dbh -> prepare($s);
$quer->execute();
$result=$quer->fetchAll(PDO::FETCH_OBJ);
if($quer->rowCount() > 0)
{
foreach($result as $ro)
{               ?>
                                  <table class="table table-bordered">
                  

                  <tr>
                      <th>nom de formateur</th>
                      <td><?php  echo htmlentities($ro->nom);?></td>
                  </tr>

                  <tr>
                      <th>prenom de formateur</th>
                      <td><?php  echo htmlentities($ro->prenom);?></td>
                  </tr>

                  <tr>
                      <th>formateur email</th>
                      <td><?php  echo htmlentities($ro->email);?></td>
                  </tr>
                  <tr>
                      <th>Téléphone </th>
                      <td><?php  echo htmlentities($ro->tele);?></td>
                  </tr>
             
              </table>
                                        </div>
                                    </div>
                                </div>
                         
                      
                            </div>
                        </div>
                        <div class="col-xl-4" style="margin-top: -60px;">
                            <div class="card border-0 bg-light mt-xl-5">
                                <div class="card-body p-4 py-lg-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <div class="h6 fw-bolder">Have more questions?</div>
                                            <p class="text-muted mb-4">
                                                Contact me at
                                                <br />
                                                <a href="#!"><?php  echo 'english.castle@gmail.com';?></a>
                                            </p>
                                            <h5>OR</h5>
<form method="post">
 <p>  <input type="text" name="fname" placeholder="Enter your fullname" class="form-control" required></p>
<p><input type="email" name="emailid" placeholder="Enter your emaild" class="form-control" required></p>
<p><input type="text" name="mobileno" placeholder="Enter your mobile no" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required></p>
<p><textarea class="form-control" name="query" placeholder="Query / Message" required></textarea>
</p>
<input type="submit" class="btn btn-primary" name="submit">
</form>

                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } } else{ ?>
<hr />
<h3 align="center" style="color:red;">Record not Found</h3>
        <?php } ?>
        </main>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
