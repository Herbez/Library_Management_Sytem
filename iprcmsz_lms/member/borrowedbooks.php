<?php 
session_start();  
$userid=$_SESSION["email"];
 if(isset($_SESSION["email"]))  
 {  
 	$dbh= new PDO("mysql:host=localhost;dbname=lms_db", "root", "");
  $sql="SELECT * FROM user WHERE email = ?";
  $query=$dbh->prepare($sql);
  $query->execute(array($userid));
  $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount()>0){
    foreach ($results as $result) {
       $result->names;
       $userEmail = $result->email;
       
    }
  }
  
  }  

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/RP_Logo.jpeg" rel="icon">
  <title>LMS - Dashboard</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="memberDash.php">
        <div class="sidebar-brand-text mx-3">
            <i class="fas fa-fw fa-tachometer-alt"></i> LMS Member
        </div>
        </a>
        <hr class="sidebar-divider my-0">   

        <li class="nav-item">
            <a class="nav-link" href="allbook.php">
                <i class="fas fa-fw fa-book"></i>
                <span>All Books</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="borrowedbooks.php">
                <i class="fas fa-fw fa-exchange-alt"></i>
                <span>Borrowed Books</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="activities.php">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Activities</span>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="recommendbooks.php">
                <i class="fas fa-fw fa-lightbulb"></i>
                <span>Recommend books</span>
            </a>
        </li> -->
    </ul>

    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">

          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                
                <span class="d-none d-lg-inline text-white small"><?php echo $result->names; ?> </span>
                <i class=" ml-2 fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="logout.php"  data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <?php
            require('dbconn.php');
                
                $sql="select * from records,book where email = '$userid' and borrowdate is NOT NULL and returndate is NULL and book.BookId = records.book_id";

                $result=$conn->query($sql);
                $rowcount=mysqli_num_rows($result);
                
                ?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
                    


          <!-- all books table   -->

          <div class="row mb-3">

            <div class="col-xl-12 col-lg-5 ">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Borrowed Books</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Book name</th>
                        <th>Borrow Request date</th>
                        <th>Due date</th>
                        <th>Days left</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      
                      $sql = "SELECT *, DATEDIFF(duedate, CURRENT_DATE()) AS days_left FROM records
                              JOIN book ON records.book_id = book.BookId
                              WHERE email = '$userid' AND borrowdate IS NOT NULL AND duedate IS NOT NULL AND returndate IS NULL";

                      $result = $conn->query($sql);

                      while ($row = $result->fetch_assoc()) {
                          $bookid = $row['BookId'];
                          $Title = $row['Title'];
                          $Email = $row['email'];
                          $borrowdate = $row['borrowdate'];
                          $duedate = $row['duedate'];
                          $renewals = $row['renewals'];
                          $Status = $row['Status'];
                          $days_left = $row['days_left'];
                      ?>       

                            <tr>
                                <td><b><?php echo $Title ?></b></td>
                                <td><b><?php echo $borrowdate ?></b></td>
                                <td><b><?php echo $duedate ?></b>  </td>
                                <td>
                                    <b>
                                        <?php 
                                            if ($days_left<0){            
                                                echo '<span class="text-danger">None</span>';
                                            }else{
                                                echo '<span class="text-success">'.$days_left.'</span>';
                                            } 
                                        ?>
                                    </b>
                                </td>

                                <td>
                                <?php 
                                if($renewals > 0){
                                  echo "<a  href=\"renew.php?id=".$bookid."&id2=".$Email."\" class=\"btn btn-primary\">Renew</a>";
                                  ?>
                                  <?php }?>
                                </td>
                            </tr>
                        <?php }?>

                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

          </div>




        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">

        <div class="container my-auto py-2">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - distributed by
              <b>RP IPRC MUSANZE</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>