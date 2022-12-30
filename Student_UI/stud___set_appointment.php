<?php

session_start();

include_once("../connections/connection.php");

if (!isset($_SESSION['UserEmail'])) {

  echo "<script>window.open('../loginForm.php','_self')</script>";
} else {

  $con = connection();

  $user_id = $_SESSION['UserId'];

  $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
  $get_user = $con->query($user_query) or die($con->error);
  $row_user = $get_user->fetch_assoc();

  if ($row_user) {
    $id_number = $row_user['id_number'];
  }

  $app_query = "SELECT * FROM appointments WHERE id_number = '$id_number' ORDER BY date DESC";
  $get_app = $con->query($app_query) or die($con->error);
  $row_app = $get_app->fetch_assoc();

  if($row_app){
    $appby = $row_app['app_by'];
  }else{
    $appby = 1;
  }

?>


  <!doctype html>
  <html class="no-js" lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Guidance and Counseling - STI College Angeles</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- logo angeles_sti
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/sti_logo.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="./css/datapicker/datepicker3.css">
    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="css/editor/select2.css">
    <link rel="stylesheet" href="css/editor/datetimepicker.css">
    <link rel="stylesheet" href="css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="css/editor/x-editor-style.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="./css/modals.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
      input[type="radio"] {
        margin-left: 10px 0;
      }
    </style>
  </head>

  <body>

    <?php include('includes/stud___left-menu-area.php') ?>
    <?php include('includes/stud___top-menu-area.php') ?>
    <?php include('includes/stud___mobile_menu.php')  ?>


    <div class="breadcome-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="breadcome-list single-page-breadcome">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div class="breadcome-heading">

                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <ul class="breadcome-menu">
                    <li><a href="#">Home</a> <span class="bread-slash">/</span>
                    </li>
                    <li><span class="bread-blod">Appointment Table</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

           
    <!-------------------------------------------REASON FOR CANCELLING REFERRAL FORM --------------------------------------------------------->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div id="CANCEL_FORM" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header header-color-modal bg-color-1">
                            <h4 class="modal-title">Reason for Cancelling</h4>
                            <div class="modal-close-area modal-close-df">
                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                            </div>
                        </div>

                        <form id="RejectForm" action="" method="POST">
                            <div class="modal-body">
                                <div class="form-group-inner">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label class="login2 pull-right">Reason</label>
                                        </div>
                                        <div class="form-group res-mg-t-15 col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="reason" placeholder="Enter the Reason for Cancelling Appointment"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary btn-md" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submit_cancel" class="btn btn-primary btn-md">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    <!-- Static Table Start -->
    <div class="data-table-area mg-b-15">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sparkline13-list">
              <div class="sparkline13-hd">
                <div class="main-sparkline13-hd">
                  <h1>Appointment<span class="table-project-n"> Table</span> </h1>
                </div>

              </div>
              <div class="sparkline13-graph">
                <div class="datatable-dashv1-list custom-datatable-overright">
                  <div id="toolbar">
                    <!-- <select class="form-control dt-tb">
                                        <option value="">Export Basic</option>
                                        <option value="all">Export All</option>
                                        <option value="selected">Export Selected</option>
                                    </select> -->

                    <div class="card-header py-3">
                      <h5 class="m-0 font-weight-bold text-primary">
                        <!-- Guidance Counselor -->
                        <a href="stud___dashboard.php">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ADD_APPOINTMENT">
                            Add New Appointment
                          </button>
                        </a>

                      </h5>
                    </div>
                  </div>
                  <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-click-to-select="true" data-toolbar="#toolbar">
                    <thead>

                    
                      <tr>
                        <th data-field="appoint_reason">Nature</th>
                        <th data-field="appoint_ref_reason">Information</th>
                        <th data-field="appoint_date">Date</th>
                        <th data-field="appoint_time">Time</th> <!-- time start - time end -->
                        <th data-field="appoint_type">Type</th>
                        <th data-field="appoint_link">Meeting Link</th>
                        <th data-field="appoint_status">Status</th>
                        <th data-field="appoint_cancel">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if ($row_app == 0) {
                        echo null;
                      } else {
                        do { ?>
                          <tr>
                            <td><?= $row_app['subject'] ?></td>
                            <td><?= $row_app['info'] ?></td>
                            <td><?= $row_app['date'] ?></td>
                            <td><?= $row_app['timeslot']." - ".$row_app['timeslot_end'] ?></td>
                            <td><?= $row_app['appointment_type'] ?></td>
                            <td><?= $row_app['meeting_link'] ?></td>
                            <td>
                              <?= $row_app['app_status'] ?>
                            </td>

                            <td>
                              <div style="display: flex; justify-content: center;">
                                  <?php if ($row_app['app_status'] == "completed" || $row_app['app_status'] == "Completed") {
                                          echo null;
                                        } else { ?>
                                          <form action="thecode.php" method="post">
                                            <input type="hidden" name="delete_username_id" value="<?php echo $row['GC_USER_ID']; ?>">
                                            <?php
                                        if($appby == 1){
                                  ?>
                                  <?php 
                                        }else{
                                  ?>
                                        <button onclick="showRejection(this)" type="button" id="CancelApp" data-id="<?php echo $row_app['id']; ?>" class="btn btn-danger btn-md">Cancel</button>
                                        
                                  <?php } ?>
                                    </form>
                                  <?php } ?>
                              </div>
                            </td>

                          </tr>

                      <?php } while ($row_app = $get_app->fetch_assoc());
                      } ?>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Static Table End -->

    </div>
    <script>
        function showRejection(button) {
          var id = $(button).data("id");
          console.log(id);

          $('#RejectForm').attr('action', 'CancelAppointment.php?id='+id);

          $('#CANCEL_FORM').modal('show');
        }
    </script>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="js/editable/jquery.mockjax.js"></script>
    <script src="js/editable/mock-active.js"></script>
    <script src="js/editable/select2.js"></script>
    <script src="js/editable/moment.min.js"></script>
    <script src="js/editable/bootstrap-datetimepicker.js"></script>
    <script src="js/editable/bootstrap-editable.js"></script>
    <script src="js/editable/xediable-active.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="js/chart/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <!-- <script src="js/tawk-chat.js"></script> -->
  </body>

  </html>

<?php } ?>