<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/database-connexion.php");
require_once($_SERVER['DOCUMENT_ROOT']."/include/security.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $user['firstName'] . " " . $user['lastName'] ?> - To Do List</title>

    <!-- Custom fonts and styles for this template-->
    <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/css.php"); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <div class="row">
                    <div class="col-lg-12 d-flex justify-content-between mb-4">
                      <h1 class="h3 text-gray-800">To Do List</h1>
                      <form class="form-inline" action="#" method="post">
                        <div class="form-group mx-sm-3 mb-2 mr-1">
                          <input type="text" class="form-control" name="task" placeholder="Tâches">
                        </div>
                        <button type="submit" class="btn btn-success mb-2" data-toggle="modal" data-target="#createModal">Ajouter</button>
                      </form>
                    </div>
                  </div>
                  <p class="mb-4 text-justify">Suspendisse finibus tortor eget tempus facilisis. Duis maximus convallis urna, et gravida felis elementum ut.</p>

                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac maximus lorem.
                      <a href="#"><span class="badge badge-danger badge-pill">X</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Suspendisse imperdiet metus vel nisi efficitur bibendum.
                      <a href="#"><span class="badge badge-danger badge-pill">X</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Cras facilisis magna interdum rutrum placerat.
                      <a href="#"><span class="badge badge-danger badge-pill">X</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Suspendisse justo nunc, elementum vitae tempus vehicula, varius nec ante.
                      <a href="#"><span class="badge badge-danger badge-pill">X</span></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Cras commodo rutrum cursus.
                      <a href="#"><span class="badge badge-danger badge-pill">X</span></a>
                    </li>
                  </ul>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/logout-modal.php"); ?>

    <!-- JavaScript -->
    <?php require_once($_SERVER['DOCUMENT_ROOT']."/include/javascript.php"); ?>

</body>

</html>
