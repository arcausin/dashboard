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
                    <div class="col-lg-12">
                      <div class="row mb-4">
                        <div class="col-md-6">
                          <h1 class="h3 text-gray-800">Kanban</h1>
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

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row text-center">
                        <div class="col-lg-4 border">
                          <h2>A faire</h2>
                          <?php
                      $req = $conn_dashboard->prepare('SELECT id, idUser, title, description, illustration, favorite, dateNotes FROM note WHERE idUser = ? ORDER BY dateNotes DESC');
                      $req->execute(array($user['id']));

                      while ($note = $req->fetch()) {
                        ?>
                        <!-- Dropdown Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold"><span class="text-warning"><?php if ($note['favorite'] == 0) { echo '<i class="far fa-star"></i>'; } else { echo '<i class="fas fa-star"></i>'; } ?></span> <span class="text-primary"><?php echo $note['title'] ?></span></h6>
                              <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                  <form action="" method="post">
                                    <input type="hidden" name="updateId" value="<?php echo $note['id'] ?>">
                                    <button type="submit" class="dropdown-item" name="updateSubmit">Modifier</button>
                                  </form>
                                  <form action="" method="post">
                                    <input type="hidden" name="deleteId" value="<?php echo $note['id'] ?>">
                                    <button type="submit" class="dropdown-item" name="deleteSubmit">Supprimer</button>
                                  </form>
                                  <div class="dropdown-divider"></div>
                                  <form action="favorite-processing.php" method="post">
                                    <input type="hidden" name="favoriteId" value="<?php echo $note['id'] ?>">
                                  <?php
                                  if ($note['favorite'] == FALSE) {
                                    ?>
                                    <button type="submit" class="dropdown-item" name="addFavoriteSubmit">Ajouter aux favoris</button>
                                    <?php
                                  }
                                  else {
                                    ?>
                                    <button type="submit" class="dropdown-item" name="removeFavoriteSubmit">Enlever des favoris</button>
                                    <?php
                                  }
                                  ?>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-<?php if (!empty($note['illustration'])) { if (strlen($note['description']) < 750) { echo "8"; } else { echo "12"; } } else { echo "12"; } ?> mb-3">
                                  <?php echo nl2br(htmlspecialchars($note['description'])); ?>
                                </div>
                                <?php if (!empty($note['illustration'])) { ?>
                                <div class="col-lg-<?php if (!empty($note['illustration'])) { if (strlen($note['description']) < 750) { echo "4"; } else { echo "12"; } } else { echo "12"; } ?> d-flex justify-content-center align-items-center">
                                  <img class="img-fluid rounded" src="/img/notes/<?php echo $note['illustration'] ?>" style="max-height: 15rem;">
                                </div>
                                <?php } ?>
                              </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="card-footer"><span class="text-primary float-right"><?php echo date("d/m/Y", strtotime($note['dateNotes']));?></span></div>

                        </div>
                        <?php
                      }
                      $req->closeCursor();
                      ?>
                        </div>
                        <div class="col-lg-4 border">
                          <h2>En cours</h2>
                        </div>
                        <div class="col-lg-4 border">
                          <h1>Terminer</h1>
                        </div>
                      </div>
                    </div>
                  </div>

                  <ul class="list-group">

                    <?php
                    $req = $conn_dashboard->prepare('SELECT id, idUser, task, dateToDoList FROM to_do_list WHERE idUser = ? ORDER BY id ASC');
                    $req->execute(array($user['id']));

                    while ($toDoList = $req->fetch()) {
                      ?>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $toDoList['task']; ?>
                        <form action="" method="post">
                          <input type="hidden" name="deleteId" value="<?php echo $toDoList['id'] ?>">
                          <button type="submit" name="deleteSubmit" class="btn btn-danger pr-1 pl-1 pt-0 pb-0">X</button>
                        </form>
                      </li>
                      <?php
                    }
                    $req->closeCursor();
                    ?>
                  </ul>

                  <?php
                  if (isset($_POST['deleteSubmit'])) {
                    $reqDeleteToDoList = $conn_dashboard->prepare('SELECT idUser FROM to_do_list WHERE id = ? AND idUser = ?');
                    $reqDeleteToDoList->execute(array($_POST['deleteId'], $user['id']));
                    $reqDeleteToDoList->closeCursor();

                    if ($reqDeleteToDoList->rowCount() == 0) {
                    }
                    else {
                      $reqDelete = $conn_dashboard->prepare('SELECT id, task, dateToDoList FROM to_do_list WHERE id = ?');
                      $reqDelete->execute(array($_POST['deleteId']));
                      $toDoListDelete = $reqDelete->fetch();
                      $reqDelete->closeCursor();
                      ?>
                      <!-- Modal Delete -->
                      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <form action="delete-processing.php" method="post">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer la Tâche - <span class="text-danger"><?php if (!empty($toDoListDelete['task'])) { echo $toDoListDelete['task']; } ?></span></h5>
                                <input type="hidden" name="deleteId" value="<?php echo $_POST['deleteId'] ?>" required>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer d-flex justify-content-between">
                                <span><?php echo date("d/m/Y", strtotime($toDoListDelete['dateToDoList']));?></span>
                                <button type="submit" class="btn btn-danger" name="deleteSubmit">Supprimer</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <?php
                    }
                  }
                  ?>

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
