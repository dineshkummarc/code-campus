<?php
//session_start();
include ('includes/functions.php');
if(!isset($_SESSION["email"]))
{
    header("location:login.php");
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    include ('includes/head.php');

    ?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <!--		<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>-->
    <body>
    <?php
    //        Check if user is Admin
    $email = $_SESSION["email"];
    $userAdmin = isAdmin($email);
    if($userAdmin){
        ?>
        <div class="main-wrapper">
            <?php
            include ('includes/header.php');

            include ('includes/admin-sidebar.php');
            ?>


            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 col-md-6 offset-3">
                            <div class="card">
                                <div class="bg-soft-primary">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary">Welcome Back !</h5>
                                                <p class="mb-3">Innovation Academy Admin Panel</p>
                                            </div>
                                        </div>
                                        <div class="align-self-end col-5"><img src="assets/img/profile-img.png" alt="" class="img-fluid"></div>
                                    </div>
                                </div>
                                <div class="pt-0 card-body">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="avatar-md profile-user mb-4"><img src="assets/img/profiles/avatar.png" alt="" class="img-thumbnail rounded-circle img-fluid"></div>
                                            <div class="d-block">
                                                <h5><?php echo htmlentities($_SESSION["email"]);?></h5>
                                                <p class="text-muted mb-0  text-truncate">Administrator</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="pt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="font-size-15"><?php
                                                            $sqlcourses = "SELECT * FROM courses ORDER BY id ASC";
                                                            $courses = get_data($sqlcourses);
                                                            echo count($courses);
                                                            ?></h5>
                                                        <p class="text-muted mb-0">Courses</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="font-size-15">120+</h5>
                                                        <p class="text-muted mb-0">Sessions</p>
                                                    </div>
                                                </div>
                                                <div class="mt-4"><a class="btn btn-primary waves-effect waves-light btn-sm" href="courses.php">All Courses <i class="mdi mdi-arrow-right ml-1"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 offset-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Users</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%;padding: 15%;">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlusers = "SELECT * FROM users WHERE role_id != 1";
                                            $users = get_data($sqlusers);
                                            foreach($users as $user){
                                                $userid = $user['id'];
                                                $studentname = $user['name'];
                                                $email = $user['email'];
                                                $phone = $user['phone'];
                                                $role = $user['role_id'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $studentname;?></td>
                                                    <td><?php echo $email;?></td>
                                                    <td><?php echo $phone;?></td>
                                                    <td><?php
                                                        $sqlrole = "SELECT * FROM roles WHERE id =".$role;
                                                        $roles = get_data($sqlrole);
                                                        foreach($roles as $role){
                                                            $name = $role['name'];
                                                            echo $name;
                                                        }
                                                        ?></td>
                                                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?php echo $userid; ?>"> <i class="fa fa-user-cog"></i> Add Student To Course </button>
                                                        <div class="modal fade" id="exampleModal<?php echo $userid; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <form action="includes/functions.php" method="post" class="form-horizontal">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Student <?php echo htmlentities($email); ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p>Name: <?php echo htmlentities($studentname); ?></p>
                                                                        <div class="form-group">
                                                                            <label for="course_id">Select Course</label>
                                                                            <select name="course_id" class="form-control" required>
                                                                                <option disabled selected>Select A Course...</option>
                                                                                <?php
                                                                                $sqlcourses = "SELECT * FROM courses";
                                                                                $courses = get_data( $sqlcourses);
                                                                                foreach ($courses as $course){
                                                                                    $courseid = $course['id'];
                                                                                    $name = $course['name'];
                                                                                    ?>
                                                                                    <option value="<?php echo $courseid;?>"><?php echo $name;?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <input type="hidden" name="email" value="<?php echo $email;?>">
                                                                            <label for="amount">Amount</label>
                                                                            <input type="number" name="amount" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <input type="submit" name="enroll-student" class="btn btn-success" value="Submit">
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- /Recent Orders -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- /Page Wrapper -->

        </div>
        <!-- /Main Wrapper -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/raphael/raphael.min.js"></script>
        <script src="assets/plugins/morris/morris.min.js"></script>

        <!-- Datatables JS -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/datatables.min.js"></script>



        <!-- Chart JS -->
        <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
        <script src="assets/plugins/apexchart/dsh-apaxcharts.js"></script>

        <!-- Custom JS -->
        <script  src="assets/js/script.js"></script>
    <?php
    }else{
    ?>
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <?php
            include ('includes/header.php');

            include ('includes/sidebar.php');
            ?>


            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 text-center">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 col-12 offset-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="dash-widget-header">
												<span class="dash-widget-icon text-danger bg-danger-light">
												<i class="fas fa-user"></i>
												</span>
                                                <div class="text-center">
                                                    <h3>&emsp; Unauthorised User</h3>
                                                </div>
                                            </div>
                                            <div class="dash-widget-info">
                                                <h6 class="text-muted"><a href="index.php" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back Home</a> You are not Authorised to Access this page!</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger w-100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Wrapper -->

        </div>
        <!-- /Main Wrapper -->

        <!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Slimscroll JS -->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/raphael/raphael.min.js"></script>
        <script src="assets/plugins/morris/morris.min.js"></script>

        <!-- Datatables JS -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/datatables.min.js"></script>


        <!-- Chart JS -->
        <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
        <script src="assets/plugins/apexchart/dsh-apaxcharts.js"></script>

        <!-- Custom JS -->
        <script  src="assets/js/script.js"></script>
        <?php
    }
    ?>
    </body>
    </html>
    <?php
}
?>