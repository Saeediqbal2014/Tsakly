<?php
if ($this->session->userdata('status') == "user_active" || $this->session->userdata('attendance_p_show') == 1) {
  $all = "show active ";
  $all_btn = "active";
  $my_btn = "";
  $my = "";
} else if ($this->session->userdata('user') == 1) {
  $all = "";
  $all_btn = "";
  $my_btn = "active";
  $my = "show active";
} else {
  $all = "";
  $all_btn = "";
  $my_btn = "";
  $my = "";
  $ts = "";
  $ts_btn = "";
}
?>
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Report_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">Logs</span>
      </div>
    </div>

    <div class="row Project pt-3 pb-3">
      
      <div class="col-lg-6">
        <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
          <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('log_show') == 1) { ?>
            <li class="nav-item mr-2">
              <a class="nav-link Project_Id_btn <?= $all_btn ?>" href="<?=site_url('logs')?>" >All</a>
            </li>
          <?php }
          if ($this->session->userdata('user') != 1) { ?>
            <li class="nav-item">
              <a class="nav-link Project_Id_btn <?= $my_btn ?>" id="pills-my-tab" data-toggle="pill" href="#pills-mytab" role="tab" aria-controls="pills-mytab" aria-selected="false"></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('attendance_search') == 1) { ?>
      <form action="<?= base_url('logs/daterange') ?>" method="post">
        <div class="row mt-2">
          <div class="col-4"></div>
          <div class="col-2">
            <div class="form-group">
              <label>From</label>
              <input type="text" class="form-control datepicker" name="from" required placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" />
              <span><?= form_error('startDate') ?></span>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label>To</label>
              <input type="text" class="form-control datepicker" name="to" required placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" />
              <span><?= form_error('startDate') ?></span>
            </div>
          </div>
          <div class="col-2" style="margin-top: 28px!important;">
            <input type="submit" name="daterange" class="btn user_invait_btn confirm pop_up" value="Submit">
          </div>
          <div class="col-2"></div>
        </div>
      </form>
    <?php } ?>
    <!-- secod_Row_Start -->
    <div class="row pt-2">
      <div class="col-lg-12">
        <div class="tab-content" id="pills-tabContent">
          <!--allreportstart-->
          <div class="tab-pane fade <?= $all ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-lg-12 mt-1" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important; overflow-x:auto;">
                    <div class="container">
                      <table id="example" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                          <tr>
                            <th>Serial No</th>
                            <th>Name</th>
                            <th>IP</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($logs as $key => $v) { ?>
                            <tr>
                              <td><?= $key + 1 ?></td>
                              <td><?= $v->username ?> </td>
                              <td><?= $v->ip ?></td>
                              <td><?= $v->time_1 ?></td>
                              <td><?= $v->time_2 ?></td>
                              <td><?= $v->attendance_datetime ?></td>

                            </tr>
                          <?php 
                          } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--allreportend-->

        </div>

      </div>
    </div>
  </div>