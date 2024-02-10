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

        <!-- <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
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
                    
        <!-- search for book -->

        <!-- <div class="col-md-6 mt-3 mb-3">
            <form class="custom-search-form" action="" method="post">
                <div class="input-group">
                    <input type="text" name="title" class="form-control custom-search-input" placeholder="Search for a Request" style="border-color: #3f51b5; border-radius: 5px 0 0 5px;">
                    <button class="btn btn-primary custom-search-btn" name="search" type="submit" style="border-color: #3f51b5; border-radius: 0 5px 5px 0;">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </form>
        </div> -->

          <!-- all books table   -->

          <div class="row mb-3">

            <div class="col-xl-12 col-lg-5 ">
              <div class="card">

                <div class="table-responsive">
                  <table class="table align-items-center table-bordered">
                    <thead class = "text-primary">
                      <tr >
                        

                        <th>Member</th>
                        <th>Book name</th>
                        <th>Borrow date</th>
                        <th>Due date</th>
                        <th>Fees</th>                      
                        <th >Action</th>

                        <!-- <th>Dues</th> -->
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                                require('dbconn.php');
                        
                                $sql=" SELECT *, DATEDIFF(CURRENT_DATE(), duedate) AS dues FROM user, records   
                                JOIN book ON records.book_id = book.BookId WHERE user.email=records.email AND returndate is NULL";
                                // $sql2="select datediff(borrowdate,duedate) as dues from records";
                                $result=$conn->query($sql);
                                while($row=$result->fetch_assoc())
                                {
                                    $bookid=$row['BookId'];
                                    $Email=$row['email'];
                                    $Names=$row['names'];
                                    $Title=$row['Title'];
                                    $borrowdate=$row['borrowdate'];
                                    $duedate=$row['duedate'];
                                    $Status=$row['Status'];
                                    $returndate=$row['returndate'];
                                    $renewals=$row['renewals'];
                                    $dues=$row['dues'];
                                    $fees = $dues*500;
                                    
                                ?>

                            <tr>
                 
                                <td><b><?php echo $Names ?></b></b></td>
                                <td><b><?php echo $Title ?></b></td>
                                <td><b><?php echo $borrowdate ?></td>

                                <td>
                                  <b>
                                      <?php 
                                        if ($duedate === null) {
                                          echo '<span class="text-danger">No due date</span>';
                                      } else {
                                          echo $duedate;
                                      }
                                      
                                      ?>
                                  </b>
                                </td>

                               
                                <td>
                                    <b>
                                        <?php 
                                            if ($dues<=0){            
                                                echo '<span class="text-success">0</span>';
                                            }else{
                                                echo '<span class="text-danger">'.$fees.'</span>';
                                            } 
                                        ?>
                                    </b>
                                </td>
                                <td>
                                <a href="returned.php?id1=<?php echo $bookid ?>&id2=<?php echo $Email ?>&id3=<?php echo $dues ?>" class="btn btn-primary">Return</a>
                                </td>
                                
                            </tr>
                            <?php }
                         ?>

                    </tbody>
                  </table>
                </div>
                
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