<?php 
session_start();  

if (!isset($_SESSION["email"])) {
  header("Location: ../index.php"); 
  exit();
}

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
       
    }
  }
  
  }  
 
// Function to get the count of users
function getUserCount($dbh) {
  $query = "SELECT COUNT(*) AS userCount FROM user";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['userCount'] : 0;
}

// Function to get the count of available books
function getTotalBooksCount($dbh) {
  $query = "SELECT SUM(Availability) AS TotalBooksCount FROM book ";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['TotalBooksCount'] : 0;
}

// Function to get the count of book requests
function getBookRequestCount($dbh) {
  $query = "SELECT COUNT(*) AS bookRequestCount FROM records WHERE Status = 'Pending'";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['bookRequestCount'] : 0;
}

// Example usage
$userCount = getUserCount($dbh);
$totalBooksCount = getTotalBooksCount($dbh);
$bookRequestCount = getBookRequestCount($dbh);
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminDash.php">
        <div class="sidebar-brand-text mx-3">
            <i class="fas fa-fw fa-tachometer-alt"></i> LMS Admin
        </div>
        </a>
        <hr class="sidebar-divider my-0">   

        <li class="nav-item">
        <a class="nav-link" href="allusers.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Manage Users</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="allbook.php">
            <i class="fas fa-fw fa-book"></i>
            <span>All Books</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="addbook.php">
            <i class="fas fa-fw fa-plus"></i>
            <span>Add Books</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="borrow_request.php">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Borrow Request</span>
        </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="book_return.php">
              <i class="fas fa-fw fa-reply"></i>
              <span>Returning Book</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="renew_request.php">
              <i class="fas fa-fw fa-sync"></i>
              <span>Renewals Request</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="activities.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Activities</span>
          </a>
        </li>
<!-- 
        <li class="nav-item">
        <a class="nav-link" href="bookrecommendation.php">
            <i class="fas fa-fw fa-lightbulb"></i>
            <span>Book Recommendation</span>
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
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $result->names; ?> </span>
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


        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">


          <div class="row mb-3">
            <!-- Available books -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Books</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBooksCount ?></div>

                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Available books-->

            <!-- New User  -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $userCount ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Book Pending Requests  -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Borrow  Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $bookRequestCount ?></div>

                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Invoice Example -->
          
            <!-- Message From Customer-->
            

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

