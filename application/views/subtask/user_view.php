<!--Proect_Details_Start-->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <a class="" style=""></a><span class="Page_Title">Subtask Details</span>
      </div>
    </div>
    <div class="row pt-4 pb-3 Project_Details">
      <div class="col-lg-12">
        <a href="<?= base_url('Tasks/'); ?>" class="btn user_invait_btn btn-sm float-right" style="font-size: 13px">
          + Back to Subtasks
        </a>
      </div>
    </div>
    <?php if ($this->session->flashdata('errorsubtaskview')) { ?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('errorsubtaskview'); ?>
      </div>
    <?php } ?>
    <!--  <div class="row pt-4 pb-3 Project_Details">
                        <div class="col-lg-6">
                           <a href="<php echo base_url('Project/Edit_Project'); ?>" 
                          class="btn user_invait_btn" style="font-size: 13px">
                            + Create Project
                        </a>
                        </div>
                        <div class="col-lg-6">
<ul class="nav justify-content-end">
  <li class="nav-item mr-1">
    <a class="nav-link user_invait_btn active " href="#" style="border-radius:5px">Task Board</a>
  </li>
  <li class="nav-item mr-1">
    <a class="nav-link user_invait_btn" href="#"  style="border-radius:5px">Timesheet</a>
  </li>
  <li class="nav-item mr-1">
    <a class="nav-link user_invait_btn" href="#"  style="border-radius:5px">Bug Report</a>
  </li>
  
</ul>
                        </div>
                    </div> -->
    <!-- secod_Row_Start -->
    <div class="row pt-3">
      <div class="col-lg-8 pr-4">
        <div class="row">
          <!-- left_Box_Start -->
          <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
            <div class="row">
              <div class="col-lg-6"><?php $subtask = $subtask[0];
                                    $subtask_user = $subtask_user[0]; ?>
                <a href="<?php echo base_url('Project/Project_Detail') ?>" class="Project_Title_Color"><?= $subtask->subtask_title ?></a>
              </div>
              <div class="col-lg-6">
                <!-- Edit_Drop_Down -->
                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_edit') == 1 || $this->session->userdata('subtask_del') == 1) { ?>
                  <div class="btn-group Project_Box_Icon float-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-1">
                      <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_edit') == 1) { ?>
                          <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                            <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                            <a href="<?= base_url('projects/subtask_edit/' . $subtask->project_subtask_id . '/' . $projectid); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                          </button>
                          <br>
                        <?php }
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_del') == 1) { ?>
                          <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_subtaskremove" class="btn btn-primary delsubtask" style="background-color: transparent;border: none;box-shadow: none;" data="<?= $subtask->project_subtask_id ?>" data-task="<?= $subtask->project_task_id ?>">
                            <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                            <a class="text-dark" style="font-size: 12px">
                              Delete
                            </a>
                          </button>
                        <?php } ?>
                      </button>
                    </div>
                  </div><br>
                  <?php }
                if ($subtask->subtask_status != 'completed') {
                  if ($this->session->userdata('status') == 'user_active') {
                    if ($this->session->userdata('subtask_notify_') == 0) { ?>
                      <select class="form-control float-right" id="exampleFormControlSelect1" name="status_subtask" style="width:200px;">
                        <option selected disabled>Subtask status</option>
                        <option <?php if ($subtask->subtask_status == 'started') {
                                  echo 'selected="selected"';
                                } ?> value="started">Started</option>
                        <option <?php if ($subtask->subtask_status == 'completed') {
                                  echo 'selected="selected"';
                                  echo "disabled";
                                } ?> value="completed">Completed</option>
                      </select>
                <?php }
                  }
                }

                if ($subtask->subtask_status_by == 1) {
                  if ($subtask->subtask_status == 'started') {
                    if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_notify_') == 1) {
                      echo $txt = '<div class="text-dark float-right" style="font-size: 12px;font-style:italic;">This subtask has been started by user</div>';
                    }
                  } else if ($subtask->subtask_status == 'completed') {
                    if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_notify_') == 1) {
                      echo $txt = '<div class="text-dark float-right" style="font-size: 12px;font-style:italic;">This subtask has been completed by user</div><br>';
                    }
                    if ($this->session->userdata('subtask_notify_') == 1) {
                      echo $btn = '<div class="float-right"><a href="' . base_url('projects/change_subtask_status_by_coordinator/' . $subtask->project_subtask_id . '/' . $subtask->project_id . '/app') . '" class="text-dark" style="font-size: 12px">Approved</a> / <a href="' . base_url('projects/change_subtask_status_by_coordinator/' . $subtask->project_subtask_id . '/' . $subtask->project_id . '/rej') . '" class="text-dark" style="font-size: 12px">Reject</a></div>';
                    }
                  }
                } else if ($subtask->subtask_status_by == 2) {
                  echo $txt = '<div class="text-dark float-right" style="font-size: 12px;font-style:italic;">This subtask has been approved by ' . $subtask->subtask_status_by_name . '</div>';
                  if ($this->session->userdata('user') == 1) {
                    echo $btn = '<div class="float-right"><a href="' . base_url('projects/change_subtask_status_by_admin/' . $subtask->project_subtask_id . '/' . $subtask->project_id . '/app') . '" class="text-dark" style="font-size: 12px">Approved</a> / <a href="' . base_url('projects/change_subtask_status_by_admin/' . $subtask->project_subtask_id . '/' . $subtask->project_id . '/rej') . '" class="text-dark" style="font-size: 12px">Reject</a></div>';
                  }
                } else if ($subtask->subtask_status_by == 3) {
                  echo $txt = '<div class="text-dark float-right" style="font-size: 12px;font-style:italic;">This subtask has been approved by admin</div>';
                }
                if ($subtask->subtask_status_by == 1) {
                  if ($subtask->subtask_status == 'completed') {
                    if ($this->session->userdata('status') == 'user_active') {
                      if ($this->session->userdata('subtask_notify_') == 0) {
                        echo $txt = '<div class="text-dark float-right" style="font-size: 12px;font-style:italic;">You completed this subtask wait for the approval of management</div>';
                      }
                    }
                  }
                }
                ?>
                <!-- Edit_Drop_Down -->
              </div>
            </div>
            <!-- 2nd_row_Start -->
            <div class="row">
              <div class="col-lg-12">
                <?php
                if ($subtask->subtask_priority == 'incomplete') {
                  $bg = "bg-secondary";
                } else {
                  $bg = "bg-success";
                }
                ?>
                <a class="Right_Togel_Drop_Item_1_Sub_3 <?= $bg ?> text-white"><?= $subtask->subtask_priority ?></a>
                <p class="light_color pt-5 Bold" style="font-size: 13px;">Project Overview :</p>
                <p class="light_color pb-2" style="font-size: 13px;">
                  <?= $subtask->subtask_description ?>
                </p>
              </div>
            </div>
            <!-- 2nd_row_End -->
            <!-- 3rd_row_Start -->
            <div class="row pt-3 pb-1">
              <div class="col-lg-4">
                <h6 class="light_color">Due Date</h6>
                <p style="font-size: 14px;"><?= $subtask->subtask_due_date ?></p>
              </div>
              <div class="col-lg-4">

              </div>
              <div class="col-lg-4">
                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_b_show') == 1) { ?>
                  <h6 class="light_color">Budget</h6>
                  <p style="font-size: 14px;"><?= $subtask->subtask_milestone ?></p>
                <?php } ?>
              </div>
            </div>
            <!--  3rd_Row_End-->
            <!-- 4th_Row_Start -->

            <!-- 4th_Row_End -->
          </div>
          <!-- Left_box_End -->
        </div>
      </div>
      <div class="col-lg-4 pl-4 Team_Member">
        <div class="row">
          <div class="col-lg-12 card pt-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important">
            <!-- 1st_row_Start -->
            <div class="row">
              <div class="col-lg-8">
                <h6 class="Secondry_Font_Color mt-2">
                  Assign to
                </h6>
              </div>
              <div class="col-lg-4">

              </div>
            </div>
            <!-- 1st_row_End -->
            <!-- 6th_Row_Start -->
            <div class="row pt-4" style="">
              <div class="col-lg-1"></div>
              <div class="col-lg-10 text-center" style="">
                <?php if ($subtask_user->img == null) {
                  $img = base_url('uploads/users/default.png');
                } else {
                  $img = base_url('uploads/users/' . $subtask_user->img);
                } ?>
                <img class="img-fluid rounded-circle" src="<?= $img ?>" style="width: 100px;">
              </div>
              <div class="col-lg-1"></div>
            </div>
            <!-- 6th_Row_End -->
            <div class="row pt-2">
              <div class="col-lg-1"></div>
              <div class="col-lg-10 text-center" style="">
                <a href="#" class="Project_Title_Color"><?= $subtask_user->name ?></a>
                <p>
                  <span class="light_color" style="font-size: 11px"><?= $subtask_user->email ?></span>
                </p>
              </div>
              <div class="col-lg-1"></div>
            </div>
            <?php
            if ($subtask->subtask_status != 'completed') {

              if ($_SESSION["user"] == $subtask_user->user_id || $_SESSION["user"] == 1) {

            ?>
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <a href="<?= base_url('Projects/complete_subtask/' . $subtask->project_subtask_id . '/' . $subtask->project_id . '/' . $_SESSION["user"]) ?>" class="btn btn-success">Complete Task</a>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- secod_Row_End -->
    <!-- 3rd_Row_Start -->
    <div class="row pt-3">
      <div class="col-lg-6 pr-4">
        <div class="row">
          <div class="col-lg-12 card pt-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important">
            <div class="row">
              <div class="col-lg-4 col-4" style="">
                <p class="pt-1 pb-1"></p>
                <a class="p-4" style="background-color: #4FD1FE;box-shadow: 0 2px 6px #acb5f6;border-radius: 5px">
                  <i class="fas fa-clock text-white" style="font-size: 22px"></i>
                </a>
              </div>
              <div class="col-lg-8 col-8" style="">
                <p class="mb-0" style="font-size: 16px;font-weight: 400">Days left</p>
                <h3><?php

                    $d = date('d-m-Y', strtotime($subtask->subtask_due_date));
                    $td = date('d-m-Y');
                    if ($td >= $d) {
                      $RemainingDays = '0';
                    } else {
                      $currentDate = strtotime(date('Y-m-d'));
                      $project_end_date = date('Y-m-d', strtotime($subtask->subtask_due_date));
                      $project_end_date2 = strtotime($project_end_date);
                      $timeDiff = abs($project_end_date2 - $currentDate);
                      $RemainingDays = $timeDiff / 86400;
                      $RemainingDays = intval($RemainingDays);
                    }
                    ?>
                  <?= $RemainingDays ?>

                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 pl-4">
        <div class="row">
          <div class="col-lg-12 card pt-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important">
            <div class="row">
              <div class="col-lg-4 col-4" style="">
                <p class="pt-1 pb-1"></p>
                <a class="p-4 bg-success" style="box-shadow: 0 2px 6px #acb5f6;border-radius: 5px">
                  <i class="fas fa-comment text-white" style="font-size: 22px"></i>
                </a>
              </div>
              <div class="col-lg-8 col-8" style="">
                <p class="mb-0" style="font-size: 16px;font-weight: 400">Comments</p>
                <h3 class="com_length"></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 3rd_Row_End -->
    <!-- 4th_Row -->
    <div class="row pt-3">
      <div class="col-lg-12 card pr-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important">
        <div class="com">

        </div>
        <div class="row mt-5">
          <div class="col-lg-2">
            <img class="img-fluid rounded-circle mt-4 ml-5" src="<?= base_url('uploads/users/default.png'); ?>" style="width: 100px;background-color: #e8e3e3;">
          </div>
          <div class="col-lg-9 mt-4">
            <textarea class="form-control mt-2 comment" rows="4" name="comment" placeholder="  leave a comment..."></textarea>
          </div>
          <div class="col-lg-1" style="padding: 0px;margin: 0px;margin-top: 109px;">
            <button class="btn btn-sm user_invait_btn confirm pop_up sub">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- 4th_Row -->
  </div>
</div>
<!--Proect_Details_End-->
<div class="modal fade" id="exampleModalLong_subtaskremove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?= base_url('projects/subtask_delete') ?>" method="post">
          <input type="text" name="id" class="redir" hidden>
          <input type="text" name="del" class="dels" hidden>
          <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    // subtask_status();
    comments();
  });
  $('.del').click(function() {
    var del = $(this).attr('data');
    $('.de').val(del);
  });
  $('.delsubtask').click(function() {
    var del = $(this).attr('data');
    var redirect = $(this).attr('data-task');
    $('.dels').val(del);
    $('.redir').val(redirect);
  });
  $('.sub').click(function() {
    var id = '<?= $subtask->project_subtask_id ?>';
    var comment = $('.comment').val();
    if (comment.length == 0) {
      $('.comment').addClass('is-invalid');
      $('.comment').removeClass('is-valid');
    } else {
      $('.comment').addClass('is-valid');
      $('.comment').removeClass('is-invalid');

      $.ajax({
        url: '<?= base_url('projects/subtask_comments_insert') ?>',
        data: {
          id: id,
          comment: comment
        },
        method: 'Post',
        dataType: 'json',
        success: function(data) {
          if (data > 0) {
            $('.comment').removeClass('is-valid');
            $('.comment').removeClass('is-invalid');
            $('.comment').val('');
            comments();
          }
        }
      });
    }
  });
  $('.delsubtask').click(function() {
    var del = $(this).attr('data');
    var redirect = $(this).attr('data-task');
    $('.dels').val(del);
    $('.redir').val(redirect);
  });
  $('select[name=status_subtask]').change(function() {
    var id = '<?= $subtask->project_subtask_id ?>';
    var st = $(this).val();
    $.ajax({
      url: '<?= base_url('projects/change_subtask_status') ?>',
      data: {
        id: id,
        st: st
      },
      method: 'Post'
    });
  });

  function comments() {
    var id = '<?= $subtask->project_subtask_id ?>';
    $.ajax({
      url: '<?= base_url('projects/subtask_comments') ?>',
      data: {
        id: id
      },
      method: 'Post',
      dataType: 'json',
      success: function(data) {
        var leng = data.length;
        if (leng == '') {
          leng = '0';
        }
        var i;
        var html = '';
        for (i = 0; i < data.length; i++) {
          if (data[i].img == '') {
            var img = '<?= base_url('uploads/users/default.png') ?>';
          } else {
            var img = '<?= base_url('uploads/users/') ?>' + data[i].img;
          }
          html += '<div class="row mt-3">' +
            '<div class="col-lg-2">' +
            '<img class="img-fluid rounded-circle mt-4 ml-5" src="' + img + '" style="width: 100px;">' +
            '</div>' +
            '<div class="col-lg-10 mt-4">' +
            '<div class="cp"><span style="margin-left: 83%;">(' + data[i].dateTime + ')</span><br>' + data[i].description + '' +
            '</div>' +
            '</div>' +
            '</div>';
        }
        $('.com_length').text(leng);
        $('.com').html(html);
      }
    });
  }

  function subtask_status() {
    var id = '<?= $subtask->project_subtask_id ?>';
    $.ajax({
      url: '<?= base_url('projects/subtask_status') ?>',
      data: {
        id: id
      },
      method: 'Post',
      dataType: 'json',
      success: function(data) {

        if (data.subtask_status == null || data.subtask_status == '') {

        } else {
          $('select[name=status_subtask]').val(data.subtask_status);

        }
        if (data.subtask_status_by == 1) {
          if (data.subtask_status == 'started') {
            $('.subst').text('This subtask has been started by user');
          } else if (data.subtask_status == 'completed') {
            $('.subst').text('This subtask has been completed by user');
          }
        } else if (data.subtask_status_by == 2) {
          $('.subst').text('This subtask has been approved by coordinator');
        } else if (data.subtask_status_by == 3) {
          $('.subst').text('This subtask has been approved by coordinator');
        }
      }
    });
  }
</script>