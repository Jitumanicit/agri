        <?php require_once('header.php'); ?>
        <?php 
          include_once("class/fetch-data.php");
          $b2g_schedule_meeting=new fetch_data();
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">B2G Request Meeting Schedule</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered able-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead style="font-size: 13px;">
                    <tr>
                      <th>Sr No</th>
                      <th>Sender Register Id</th>
                      <th>Receiver Register Id</th>
                      <th>Meeting Date</th>
                      <th>Meeting Time Slot</th>
                      <th>Sender Note</th>
                      <th>Reply Note</th>
                      <th>Activation Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 14px;">
                    <?php
                      $sql=$b2g_schedule_meeting->b2g_schedule_meeting_list();
                      $c = 0;
                      while($row=mysqli_fetch_array($sql))
                      {
                    ?>
                    <tr>
                      <td><?php echo ++$c; ?></td>
                      <td><?php echo $row['sender_register_id'] ?></td>
                      <td><?php echo $row['reciver_register_id'] ?></td>
                      <td><?php echo $row['meeting_date'] ?></td>
                      <td><?php echo $row['meeting_time_slot'] ?></td>
                      <td><?php echo $row['meeting_send_note'] ?></td>
                      <td><?php echo $row['meeting_reply_note'] ?></td> 
                      <td>
                        <?php
                          if($row['activation_status'] == 1){
                            echo "<span class='badge badge-success'>Schedule</span>";
                          } else{
                            echo "<span class='badge badge-danger'>Not-Schedule</span>";
                          }   
                        ?>                          
                      </td> 
                      <td style="padding: 0.5rem;"><a href="meeting-accept.php?id=<?= $row['id'] ?>" class="badge badge-success">Accept</a><a href="meeting-suggestion.php?id=<?= $row['id'] ?>" class="badge badge-primary">Suggest Another Time</a></td>                    
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
