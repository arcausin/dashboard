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

    <title><?php echo $user['firstName'] . " " . $user['lastName'] ?> - Notes</title>

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
                      <h1 class="h3 text-gray-800">Notes</h1>
                      <button type="button" class="btn btn-success float-right">Ajouter</button>
                    </div>
                  </div>
                  <p class="mb-4 text-justify">Suspendisse finibus tortor eget tempus facilisis. Duis maximus convallis urna, et gravida felis elementum ut. Fusce maximus nisl non auctor ultricies. Nullam nec pharetra felis. Etiam pulvinar tortor eu luctus viverra. Vivamus consequat mi at diam aliquam ornare. Etiam suscipit erat vitae scelerisque varius. Donec facilisis sit amet leo id fringilla. Suspendisse luctus arcu nibh, a lobortis nisl tristique non.</p>

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">

                      <?php
                      $req = $conn->prepare('SELECT id, idUser, title, description, illustration, favori, creationDate FROM note WHERE idUser = ? ORDER BY creationDate DESC');
                      $req->execute(array($_SESSION['id']));

                      while ($note = $req->fetch()) {
                        ?>
                        <div class="col-lg-6">
                          <!-- Dropdown Card Example -->
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div
                                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $note['title'] ?></h6>
                                  <div class="dropdown no-arrow">
                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                          aria-labelledby="dropdownMenuLink">
                                          <a class="dropdown-item" href="#">Modifier</a>
                                          <a class="dropdown-item" href="#">Supprimer</a>
                                          <div class="dropdown-divider"></div>
                                          <?php
                                          if ($note['favori'] == FALSE) {
                                            ?>
                                            <a class="dropdown-item" href="#">Ajouter aux favoris</a>
                                            <?php
                                          }
                                          else {
                                            ?>
                                            <a class="dropdown-item" href="#">Enlever des favoris</a>
                                            <?php
                                          }
                                          ?>

                                      </div>
                                  </div>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body"><?php echo $note['description'] ?></div>
                          </div>
                        </div>
                        <?php
                      }
                      $req->closeCursor();
                      ?>



                      </div>
                    </div>
                  </div>
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
