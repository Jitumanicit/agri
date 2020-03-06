        <?php require_once('header.php'); ?>
        <?php 
          include_once("class/fetch-data.php");
          $delegates_list=new fetch_data();
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Delegate List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <button type="button" class="btn btn-success btn-sm" id="approved">Approved</button>
                <button type="button" class="btn btn-danger btn-sm"id="not_approved">Not Approved</button>
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Set Category
                </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" id="category-diamond">Diamond</a>
                    <a class="dropdown-item" id="category-gold">Gold</a>
                    <a class="dropdown-item" id="category-blue">Blue</a>
                    <a class="dropdown-item" id="category-organiser">Organiser</a>
                    <a class="dropdown-item" id="category-crew">Event Crew</a>
                    <a class="dropdown-item" id="category-media">Media</a>
                    <a class="dropdown-item" id="category-exhibitor">Exhibitor</a>
                  </div>
                <button style="border: none; background: transparent;">
                  <form action="webservice/delegates_admin_excel.php" method="post">
                    <input type="submit" name="export_excel" class="btn btn-info btn-sm" value="Excel Download">
                  </form>
                </button>
                <table class="table table-bordered able-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead style="font-size: 13px;">
                    <tr>
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Sector</th>
                      <th>Address</th>
                      <th>Organisation</th>
                      <th>Org Turnover</th>
                      <th>Org Profile</th>
                      <th>Details</th>
                      <th>Designation</th>
                      <th>Register Id</th>
                      <th>Category</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 14px;">
                    <?php
                      $sql=$delegates_list->all_delegate_list();
                      while($row=mysqli_fetch_array($sql))
                      {
                    ?>
                    <tr>
                      <td><input class="checkbox" type="checkbox" name="id[]" id="<?php echo $row['mobile'] ?>"></td>
                      <td><?php echo $row['fname'].$row['mname'].$row['lname'] ?></td>
                      <td><?php echo $row['mobile'] ?></td>
                      <td><?php echo $row['email'] ?></td>
                      <td><?php echo $row['sector'] ?></td>
                      <td><?php echo $row['address1'].','.$row['address2'] ?></td>
                      <td><?php echo $row['organisation'] ?></td>
                      <td><?php echo $row['organisation_turnover'] ?></td>
                      <td><?php echo $row['organisation_profile'] ?></td>
                      <td><?php echo $row['city'].','.$row['state'].','.$row['pin'].','.$row['country'] ?></td>
                      <td><?php echo $row['designation'] ?></td>
                      <td><?php echo $row['register_id'] ?></td>
                      <td><?php echo $row['delegates_category'] ?></td>
                      <td><?php 
                        if($row['activation_status'] == 1){
                          echo "<a class='badge badge-success' style='color:white;'>Activated</a>";
                        } else{
                          echo "<a class='badge badge-danger' style='color:white;'>Not-Activated</a>";
                        }
                       ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
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
<script>
    $(document).ready(function(){
      $('#checkAll').click(function(){
        if(this.checked){
          $('.checkbox').each(function(){
            this.checked = true;
          });
        }else{
          $('.checkbox').each(function(){
            this.checked = false;
          });
        }
      });
    });
    $('#approved').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendApprovel(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendApprovel(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_activated.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#not_approved').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendNotApprovel(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendNotApprovel(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_notactivated.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-diamond').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryDiamond(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryDiamond(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_diamond.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-gold').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryGold(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryGold(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_gold.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-blue').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryBlue(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryBlue(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_blue.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-blue').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryBlue(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryBlue(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_blue.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-organiser').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryOrganiser(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryOrganiser(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_organiser.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-crew').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryCrew(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryCrew(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_crew.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-media').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryMedia(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryMedia(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_media.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }

    $('#category-exhibitor').click(function(){
      var dataArr = new Array();
      if($('input:checkbox:checked').length > 0){
        $('input:checkbox:checked').each(function(){
          dataArr.push($(this).attr('id'));
        });
        sendCategoryExhibitor(dataArr)
      }else{
        alert('No record selected');
      }
    });

    function sendCategoryExhibitor(dataArr){
      $.ajax({
        type    : 'post',
        url     : 'webservice/ajax_admin_exhibitor.php',
        data    : {'data' : dataArr},
        success : function(response){
                    location.reload();
                  },
        error   : function(errResponse){
                    alert(errResponse);
                  }
      });
    }
  </script>
</html>
