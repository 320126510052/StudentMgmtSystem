<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']) == 0) {
  header('location:logout.php');
} else {
   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ANITS Student Portal/View Results</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">View Result</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View Result</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table border="1" class="table table-bordered mg-b-0">
                      <?php
                      $student_id = $_SESSION['sturecmsstuid'];
                      $sql = "SELECT CGPA, SGPA, Result FROM tblstudent WHERE StuId = :student_id";
                      $query = $dbh->prepare($sql);
                      $query->bindParam(':student_id', $student_id, PDO::PARAM_STR);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_OBJ);

                      if ($query->rowCount() > 0) {
                        ?>
                        <tr align="center" class="table-warning">
                          <td colspan="3" style="font-size:20px;color:blue">Result</td>
                        </tr>
                        <tr class="table-info">
                          <th>CGPA</th>
                          <th>SGPA</th>
				  <th>Result</th>
                        </tr>
                        <tr class="table-info">
                          <td><?php echo $result->CGPA; ?></td>
                          <td><?php echo $result->SGPA; ?></td>
				  <td><?php echo $result->Result; ?></td>
                        </tr>
                      <?php
                      } else {
                      ?>
                        <tr>
                          <th colspan="2" style="color:red;">No results found</th>
                        </tr>
                      <?php
                      }
                      ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php
}
?>
