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
                      <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Ajouter</button>
                    </div>
                  </div>
                  <p class="mb-4 text-justify">Suspendisse finibus tortor eget tempus facilisis. Duis maximus convallis urna, et gravida felis elementum ut. Fusce maximus nisl non auctor ultricies. Nullam nec pharetra felis. Etiam pulvinar tortor eu luctus viverra. Vivamus consequat mi at diam aliquam ornare. Etiam suscipit erat vitae scelerisque varius. Donec facilisis sit amet leo id fringilla. Suspendisse luctus arcu nibh, a lobortis nisl tristique non.</p>

                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">

                      <?php
                      $req = $conn_dashboard->prepare('SELECT id, idUser, title, description, illustration, favorite, creationDate FROM note WHERE idUser = ? ORDER BY creationDate DESC');
                      $req->execute(array($_SESSION['id']));

                      while ($note = $req->fetch()) {
                        ?>
                        <div class="col-lg-6">
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
                              <div class="card-footer"><span class="text-primary float-right"><?php echo date("d/m/Y", strtotime($note['creationDate']));?></span></div>

                          </div>
                        </div>
                        <?php
                      }
                      $req->closeCursor();
                      ?>

                      <?php
                      if (isset($_POST['updateSubmit'])) {

                        $reqUpdate = $conn_dashboard->prepare('SELECT id, idUser, title, description, illustration, favorite, creationDate FROM note WHERE id = ?');
                        $reqUpdate->execute(array($_POST['updateId']));
                        $noteUpdate = $reqUpdate->fetch()
                        ?>
                        <!-- Modal Update -->
                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <form action="update-processing.php" method="post" enctype="multipart/form-data">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modifier la note - <span class="text-primary"><?php if (!empty($noteUpdate['title'])) { echo $noteUpdate['title']; } ?></span></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="updateId" value="<?php echo $_POST['updateId'] ?>" required>
                                  <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php if (!empty($noteUpdate['title'])) { echo $noteUpdate['title']; } ?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" required><?php if (!empty($noteUpdate['description'])) { echo $noteUpdate['description']; } ?></textarea>
                                  </div>
                                  <?php if (!empty($noteUpdate['illustration'])) { ?>
                                    <span class="mb-2" style="display: block;">Illustration</span>
                                    <img class="img-fluid mb-3 rounded" src="/img/notes/<?php echo $noteUpdate['illustration'] ?>" style="max-height: 15rem;">
                                    <div class="mb-3">
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteIllustrationModal">
                                        Supprimer la photo
                                      </button>
                                    </div>
                                  <?php } ?>

                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input  form-control" id="illustrationUpdate" name="illustrationUpdate" accept="image/png, image/jpeg, image/bmp, image/gif, image/x-icon, image/svg+xml, image/tiff, image/webp">
                                    <label class="custom-file-label form-label" for="illustrationUpdate">
                                      <?php
                                      if (!empty($noteUpdate['illustration'])) {
                                        echo $noteUpdate['illustration'];
                                      }
                                      else {
                                        echo "Image";
                                      }
                                      ?>
                                    </label>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary" name="updateSubmit">Modifier</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <?php
                        $reqUpdate->closeCursor();
                      }
                      ?>

                      <?php
                      if (isset($_POST['deleteSubmit'])) {

                        $reqDelete = $conn_dashboard->prepare('SELECT id, title, description, illustration FROM note WHERE id = ?');
                        $reqDelete->execute(array($_POST['deleteId']));
                        $noteDelete = $reqDelete->fetch()
                        ?>
                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <form action="delete-processing.php" method="post">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Supprimer la note - <span class="text-danger"><?php if (!empty($noteDelete['title'])) { echo $noteDelete['title']; } ?></span></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="deleteId" value="<?php echo $_POST['deleteId'] ?>" required>
                                  <div class="row">
                                    <div class="col-lg-<?php if (!empty($noteDelete['illustration'])) { if (strlen($noteDelete['description']) < 750) { echo "8"; } else { echo "12"; } } else { echo "12"; } ?> mb-3">
                                      <?php echo nl2br(htmlspecialchars($noteDelete['description'])); ?>
                                    </div>
                                    <?php if (!empty($noteDelete['illustration'])) { ?>
                                    <div class="col-lg-<?php if (!empty($noteDelete['illustration'])) { if (strlen($noteDelete['description']) < 750) { echo "4"; } else { echo "12"; } } else { echo "12"; } ?> d-flex justify-content-center align-items-center">
                                      <img class="img-fluid rounded" src="/img/notes/<?php echo $noteDelete['illustration'] ?>" style="max-height: 15rem;">
                                    </div>
                                    <?php } ?>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger" name="deleteSubmit">Supprimer</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <?php
                        $reqDelete->closeCursor();
                      }
                      ?>

                        <!-- Modal Create Note -->
                        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <form action="create-processing.php" method="post" enctype="multipart/form-data">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Ajouter une note</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="10" required></textarea>
                                  </div>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input  form-control" id="illustration" name="illustration" accept="image/png, image/jpeg, image/bmp, image/gif, image/x-icon, image/svg+xml, image/tiff, image/webp">
                                    <label class="custom-file-label form-label" for="illustration">Image</label>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success" name="createSubmit">Ajouter</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>

                        <!-- Modal Delete Illustration Note-->
                        <div class="modal fade" id="deleteIllustrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer la photo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p class="mb-3">Êtes-vous sûr de vouloir supprimer cette photo ?</p>
                              </div>
                              <div class="modal-footer">
                                <a class="btn btn-danger" href="update-processing.php?idDeleteIllustration=<?php echo $_POST['updateId'] ?>" role="button">Supprimer</a>
                              </div>
                            </div>
                          </div>
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
    if (isset($_POST['updateSubmit'])) {
      ?>
      <script>
        $(document).ready(function() {
          $('#updateModal').modal('show');
        });
      </script>
      <?php
    }
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

    <script type="text/javascript">
    $('.custom-file input').change(function (e) {
      var files = [];
      for (var i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
      }
      $(this).next('.custom-file-label').html(files.join(', '));
    });
    </script>

</body>

</html>
