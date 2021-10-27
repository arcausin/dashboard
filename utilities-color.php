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

    <title><?php echo $user['firstName'] . " " . $user['lastName']?> - Color Utilities</title>

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
                    <h1 class="h3 mb-1 text-gray-800">Color Utilities</h1>
                    <p class="mb-4">Bootstrap's default utility classes can be found on the official <a
                            href="https://getbootstrap.com/docs">Bootstrap Documentation</a> page. The custom utilities
                        below were created to extend this theme past the default utility classes built into Bootstrap's
                        framework.</p>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- First Column -->
                        <div class="col-lg-4">

                            <!-- Custom Text Color Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Custom Text Color Utilities</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-gray-100 p-3 bg-dark m-0">.text-gray-100</p>
                                    <p class="text-gray-200 p-3 bg-dark m-0">.text-gray-200</p>
                                    <p class="text-gray-300 p-3 bg-dark m-0">.text-gray-300</p>
                                    <p class="text-gray-400 p-3 bg-dark m-0">.text-gray-400</p>
                                    <p class="text-gray-500 p-3 m-0">.text-gray-500</p>
                                    <p class="text-gray-600 p-3 m-0">.text-gray-600</p>
                                    <p class="text-gray-700 p-3 m-0">.text-gray-700</p>
                                    <p class="text-gray-800 p-3 m-0">.text-gray-800</p>
                                    <p class="text-gray-900 p-3 m-0">.text-gray-900</p>
                                </div>
                            </div>

                            <!-- Custom Font Size Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                                </div>
                                <div class="card-body">
                                    <p class="text-xs">.text-xs</p>
                                    <p class="text-lg mb-0">.text-lg</p>
                                </div>
                            </div>

                        </div>

                        <!-- Second Column -->
                        <div class="col-lg-4">

                            <!-- Background Gradient Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Custom Background Gradient Utilities
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="px-3 py-5 bg-gradient-primary text-white">.bg-gradient-primary</div>
                                    <div class="px-3 py-5 bg-gradient-secondary text-white">.bg-gradient-secondary</div>
                                    <div class="px-3 py-5 bg-gradient-success text-white">.bg-gradient-success</div>
                                    <div class="px-3 py-5 bg-gradient-info text-white">.bg-gradient-info</div>
                                    <div class="px-3 py-5 bg-gradient-warning text-white">.bg-gradient-warning</div>
                                    <div class="px-3 py-5 bg-gradient-danger text-white">.bg-gradient-danger</div>
                                    <div class="px-3 py-5 bg-gradient-light text-white">.bg-gradient-light</div>
                                    <div class="px-3 py-5 bg-gradient-dark text-white">.bg-gradient-dark</div>
                                </div>
                            </div>

                        </div>

                        <!-- Third Column -->
                        <div class="col-lg-4">

                            <!-- Grayscale Utilities -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Custom Grayscale Background Utilities
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 bg-gray-100">.bg-gray-100</div>
                                    <div class="p-3 bg-gray-200">.bg-gray-200</div>
                                    <div class="p-3 bg-gray-300">.bg-gray-300</div>
                                    <div class="p-3 bg-gray-400">.bg-gray-400</div>
                                    <div class="p-3 bg-gray-500 text-white">.bg-gray-500</div>
                                    <div class="p-3 bg-gray-600 text-white">.bg-gray-600</div>
                                    <div class="p-3 bg-gray-700 text-white">.bg-gray-700</div>
                                    <div class="p-3 bg-gray-800 text-white">.bg-gray-800</div>
                                    <div class="p-3 bg-gray-900 text-white">.bg-gray-900</div>
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

</body>

</html>
