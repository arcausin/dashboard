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

    <style>
      .radius-up{
        border-radius: 1.5em;
      }
      .transition-bg-color {
        opacity: 1;
        transition: opacity 0.25s;
      }
      .transition-bg-color:hover {
        opacity: 0.75;
      }
    </style>

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
                    <div class="col-lg-12">
                      <div class="row mb-4">
                        <div class="col-md-6">
                          <h1 class="h3 text-gray-800">To Do List</h1>
                        </div>
                        <div class="col-md-6">
                          <form class="form-inline justify-content-end" action="create-processing.php" method="post">
                            <div class="form-group mb-2 mr-1">
                              <input type="text" class="form-control" name="task" placeholder="Tâche">
                            </div>
                            <button type="submit" class="btn btn-success mb-2" name="createSubmit">Ajouter</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-5">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4 border">
                          <h2 class="text-center mt-3">A faire</h2>
                          <hr>
                          <?php
                          $req = $conn_dashboard->prepare('SELECT id, idUser, task, step, dateToDoList FROM to_do_list WHERE idUser = ? AND step = ? ORDER BY id desc');
                          $req->execute(array($user['id'], 1));
                          while ($toDoList = $req->fetch()) {
                            ?>
                            <div class="mb-3">
                              <a class="text-decoration-none" href="update-processing.php?updateId=<?php echo $toDoList['id']; ?>">
                                <div class="card radius-up border-0 bg-secondary text-white transition-bg-color">
                                  <div class="card-body">
                                    <p class="card-text"><?php echo $toDoList['task']; ?></p>
                                    <p class="card-text text-right">
                                      <small><?php echo date("d/m/Y", strtotime($toDoList['dateToDoList']));?></small>
                                    </p>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <?php
                          }
                          $req->closeCursor();
                          ?>
                        </div>
                        <div class="col-md-4 border">
                          <h2 class="text-center mt-3">En cours</h2>
                          <hr>
                          <?php
                          $req = $conn_dashboard->prepare('SELECT id, idUser, task, step, dateToDoList FROM to_do_list WHERE idUser = ? AND step = ? ORDER BY id desc');
                          $req->execute(array($user['id'], 2));
                          while ($toDoList = $req->fetch()) {
                            ?>
                            <div class="mb-3">
                              <a class="text-decoration-none" href="update-processing.php?updateId=<?php echo $toDoList['id']; ?>">
                                <div class="card radius-up border-0 bg-secondary text-white transition-bg-color">
                                  <div class="card-body">
                                    <p class="card-text"><?php echo $toDoList['task']; ?></p>
                                    <p class="card-text text-right">
                                      <small><?php echo date("d/m/Y", strtotime($toDoList['dateToDoList']));?></small>
                                    </p>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <?php
                          }
                          $req->closeCursor();
                          ?>
                        </div>
                        <div class="col-md-4 border">
                          <h2 class="text-center mt-3">Terminer</h2>
                          <hr>
                          <?php
                          $req = $conn_dashboard->prepare('SELECT id, idUser, task, step, dateToDoList FROM to_do_list WHERE idUser = ? AND step = ? ORDER BY id desc');
                          $req->execute(array($user['id'], 3));
                          while ($toDoList = $req->fetch()) {
                            ?>
                            <div class="mb-3">
                              <a class="text-decoration-none" href="update-processing.php?updateId=<?php echo $toDoList['id']; ?>">
                                <div class="card radius-up border-0 bg-secondary text-white transition-bg-color">
                                  <div class="card-body">
                                    <p class="card-text"><?php echo $toDoList['task']; ?></p>
                                    <p class="card-text text-right">
                                      <small><?php echo date("d/m/Y", strtotime($toDoList['dateToDoList']));?></small>
                                    </p>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <?php
                          }
                          $req->closeCursor();
                          ?>
                        </div>
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

    <?php
    if (isset($_POST['deleteSubmit'])) {
      ?>
      <script>
        $(document).ready(function() {
          $('#deleteModal').modal('show');
        });
      </script>
      <?php
    }
    ?>

</body>

</html>
