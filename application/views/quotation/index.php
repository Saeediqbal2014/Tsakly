<style type="text/css">
  .nav-link {
    padding: 2px 10px !important;
  }
</style>
<!-- Category_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">All <?= $title ?></span>
      </div>
      <?php if($this->session->userdata('status') == "admin_active" || $this->session->userdata('quot_add') == 1){ ?>
          <div class="col-lg-6 mobile-padding-set-taskly">
            <a href="<?= base_url('quotation/insert_form'); ?>" class="btn user_invait_btn float-right">+ Create New <?= $title ?></a>
          </div>
      <?php } else if($this->session->userdata('status') == "user_active" || $this->session->userdata('quot_add') == 0){?>
        <div class="col-lg-6 d-none">
            <a href="<?= base_url('quotation/insert_form'); ?>" class="btn user_invait_btn float-right">+ Create New <?= $title ?></a>
       </div>
      <?php }?>
    </div>
    <!-- secod_Row_Start -->
    <div class="row pt-5">
      <div class="col-lg-12  card pt-5 pb-5">
        <div class="row">
          <div class="col-lg-12 Category_Tabel ">
            <!--show alert-->
            <?php if ($this->session->flashdata('msg')) { ?>
              <div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $this->session->flashdata('msg'); ?>
              </div>
            <?php } ?>
            <div class="table table-responsive">
                
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Serial No</th>
                  <th>Project Name</th>
                  <th>Description</th>
                  <th>Duration</th>
                  <th>Total Amount</th>
                  <th>Paid</th>
                  <th>Balance</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $sr = 1;
                if (!empty($qutation)) {
                  foreach ($qutation as $q) {
                ?>
                    <tr>
                      <td><?= $sr++; ?></td>
                      <td><?= $q->project_name ?></td>
                      <td><?= substr($q->description, 0, 45) ?>...</td>
                      <td><?= $q->duration ?> Months</td>
                      <td><?= $q->total_amnt ?></td>
                      <td><?= $q->paid ?> </td>
                      
                      <td><?= $q->total_amnt - (int)$q->paid ?></td>
                      <td>
                        <?php
                        if ($q->status == 0) {
                          echo 'Pending..';
                        } else {
                          echo 'Aproved';
                        }
                        ?>
                      </td>
                      <td class="text-center">

                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_edit') == 1 || $this->session->userdata('quot_del') == 1 || $this->session->userdata('quot_show') == 1) { ?>
                          <div class="btn-group Project_Box_Icon ">
                            <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                              <i class="fas fa-cog"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right p-1">
                              <ul class="navbar-nav">

                                <li>
                                  <?php
                                  if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_show') == 1) { ?>
                                    <a href="<?= base_url('quotation/view/' . $q->id) ?>" class="nav-link">View & print</a>
                                  <?php } ?>

                                </li>
                                <li>
                                  <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_edit') == 1) { ?>
                                    <a href="<?= base_url('quotation/edit/' . $q->id) ?>" class="nav-link">Edit</a>
                                  <?php
                                  } ?>
                                </li>

                                <li>
                                  <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_del') == 1) { ?>
                                    <a href="#" class="nav-link del_quot" data-toggle="modal" data-target="#myModalrole" data-id="<?= $q->id ?>">Delete</a>
                                  <?php } ?>
                                </li>

                                <li>
                                  <?php
                                  if ($q->status == 0) {
                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_create') == 1) { ?>
                                      <a href="<?= base_url('projects/insert_form/' . $q->id) ?>" class="nav-link">Move to Projects</a>
                                  <?php }
                                  } ?>
                                </li>

                              </ul>



                            </div>
                          </div>
                        <?php } ?>







                      </td>
                    </tr>

                <?php
                  }
                }
                ?>
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- secod_Row_End -->
  </div>
</div>
<!--Category_End-->


<!-- Modal -->


<div class="modal fade" id="myModalrole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?= base_url('quotation/delete') ?>" method="post">
          <input type="hidden" name="del" class="del_quot_id">
          <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>