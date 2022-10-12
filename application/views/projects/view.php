<!--Proect_Details_Start-->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <a class="" style=""></a><span class="Page_Title">Project Details</span>
      </div>
    </div>
    <div class="row pt-4 pb-3 Project_Details">
      <div class="col-lg-6">
        <a href="<?= base_url('projects'); ?>" class="btn user_invait_btn" style="font-size: 13px">
          + All Projects
        </a>
      </div>

      <div class="col-lg-6">
        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) { ?>
          <ul class="nav justify-content-end">
            <li class="nav-item mr-1">
              <a class="nav-link user_invait_btn active " href="<?= base_url('projects/tasks/' . $project->project_id) ?>" style="border-radius:5px">Task Board</a>
            </li>

          </ul>
        <?php } ?>
      </div>
    </div>
    <?php if ($this->session->flashdata("errornewmember")) { ?>
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata("errornewmember") ?>
      </div>
    <?php } ?>
    <!-- secod_Row_Start -->
    <div class="row pt-3">
      <div class="col-lg-8 pr-4">
        <div class="row">
          <!-- left_Box_Start -->
          <div class="col-lg-12 card p-3 bn" style="border-top:2px solid #4fd1fe!important">
            <a href="#" class="Project_Title_Color text-center" style="margin-top: -10px!important;">(<?= $project->status_c_or_i ?>)</a>

            <div class="row">
              <div class="col-lg-6">
                <a href="#" class="Project_Title_Color"><?= $project->project_name ?></a>
              </div>
              <div class="col-lg-6">
                <!-- Edit_Drop_Down -->
                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                  <div class="btn-group Project_Box_Icon float-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-1">
                      <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                        <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) { ?>
                          <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                            <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                            <a href="<?= base_url('projects/edit/' . $project->project_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                          </button>
                          <br>
                        <?php }
                        if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) { ?>
                          <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                            <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                            <!--<a class="text-dark" style="font-size: 12px">-->
                            <!--  Delete-->
                            <!--</a>-->
                            <a class="text-dark del" data-toggle="modal" data-target="#myModal" style="font-size: 12px" data="<?= base_url("projects/delete/{$project->project_id}") ?>">
                              Delete
                            </a>
                          </button>
                        <?php } ?>

                      </button>
                    </div>
                  </div>
                <?php } ?>
                <!-- Edit_Drop_Down -->
              </div>
            </div>
            <!-- 2nd_row_Start -->
            <div class="row">
              <div class="col-lg-12">
                <?php
                if ($project->project_status == 'high') {
                  $bg = "bg-danger";
                } else if ($project->project_status == 'medium') {
                  $bg = "bg-info";
                } else if ($project->project_status == 'low') {
                  $bg = "bg-secondary";
                }
                ?>
                <a class="Right_Togel_Drop_Item_1_Sub_3 <?= $bg ?> text-white"><?= $project->project_status ?></a>
                <p class="light_color pt-5 Bold" style="font-size: 13px;">Project Overview :</p>
                <p class="light_color pb-2" style="font-size: 13px;">
                  <?= $project->description ?>
                </p>
              </div>
            </div>
            <!-- 2nd_row_End -->
            <!-- 3rd_row_Start -->
            <div class="row pt-3 pb-1">
              <div class="col-lg-4">
                <h6 class="light_color">Start Date</h6>
                <p style="font-size: 14px;"><?= date('d-m-Y', strtotime($project->start_date)) ?></p>
              </div>
              <div class="col-lg-4">
                <h6 class="light_color">End Date</h6>
                <p style="font-size: 14px;"><?= date('d-m-Y', strtotime($project->end_date)) ?></p>
              </div>
              <div class="col-lg-4">
                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_b_show') == 1) { ?>
                  <h6 class="light_color">Budget</h6>
                  <p style="font-size: 14px;"><?= $project->project_budget ?></p>
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
                  Team Members (<?= count($emp); ?>)
                </h6>
              </div>
              <div class="col-lg-4">
                <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_mu') == 1) { ?>
                  <a href="<?= base_url('projects/insert_form_of_new_member/' . $project->project_id); ?>" class="btn user_invait_btn float-right" style="font-size: 13px">
                    <!--     <i class="fas fa-envelope text-white mr-1" style="font-size: 12px"></i> -->+ Add
                  </a>
                <?php } ?>
              </div>
            </div>
            <!-- 1st_row_End -->
            <!-- 2nd_Row_Start -->
            <?php foreach ($emp as $key => $v) :;
              if ($v->user_role == 0) {
                $check = '';
                $leader = '';
              } else {
                $check = 'checked';
                $leader = '(project leader)';
              }
              if ($v->img == null) {
                $img = base_url('uploads/users/default.png');
              } else {
                $img = base_url('uploads/users/' . $v->img);
              } ?>
              <div class="row pt-5" style="">
                <div class="col-lg-3" style="">
                  <img class="img-fluid rounded-circle" src="<?= $img ?>">
                </div>
                <div class="col-lg-5" style="">
                  <a href="#" class="Project_Title_Color"><?= $v->name ?><a class="light_color" style="font-size: 11px"><?= $leader ?></a></a>
                  <p>
                    <span class="light_color" style="font-size: 11px"><?= $v->email ?></span>
                  </p>
                </div>
                <div class="col-lg-4" style="">
                  <div class="form-check leader">
                    <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_leader') == 1) { ?>
                      <input type="radio" class="form-check-input leader_id" id="materialUnchecked" name="project_leader" value="<?= $v->user_id ?>" <?= $check ?>>
                      <label class="form-check-label" for="materialUnchecked">Leader</label>
                    <?php } ?>
                  </div>
                  <!-- <a href="#"><input type="radio" name="project_leader" value="<?= $v->user_id ?>"></a> -->
                  <!--dels-->
                  <!--  <a href="#" class="btn btn-sm btn-outline-danger float-right mt-1">
                    <i class="fas fa-trash" style="font-size: 11px"></i>
                  </a> -->
                  <!--dele-->
                </div>
              </div>
            <?php endforeach; ?>
            <!-- 2nd_Row_End -->
          </div>
        </div>
      </div>
    </div>
    <!-- secod_Row_End -->
    <!-- 3rd_Row_Start -->
    <div class="row pt-3">
      <div class="col-lg-4 pr-4">
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
                <h3>
                  <?php

                  $d = date('d-m-Y', strtotime($project->end_date));

                  $td = date('d-m-Y');
                  // echo $d;
                  if ($td >= $d) {
                    $RemainingDays = '0';
                  } else {
                    $currentDate = strtotime(date('Y-m-d'));
                    $project_end_date = date('Y-m-d', strtotime($project->end_date));
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
      <div class="col-lg-4 pr-4">
        <div class="row">
          <div class="col-lg-12 card pt-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important">
            <div class="row">
              <div class="col-lg-4 col-4" style="">
                <p class="pt-1 pb-1"></p>
                <a class="p-4 bg-danger" style="box-shadow: 0 2px 6px #acb5f6;border-radius: 5px">
                  <i class="fas fa-list text-white" style="font-size: 22px"></i>
                </a>
              </div>
              <div class="col-lg-8 col-8" style="">
                <p class="mb-0" style="font-size: 16px;font-weight: 400">Total task</p>
                <h3><?= $tasks->c ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 pl-4">
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
                <h3 class="com_length"><?=$comments?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 3rd_Row_End -->
    

    <div class="row mb-3">
      <?php  $i=0; 
        if(!empty($images)){
          foreach ($images as $image) { 
          if($i % 4 == 0)
          {
            echo"</div><div class='row mb-3'>";
          } 
        ?>
          <div class="col-md-3 image">
            <img style="height: 200px;width: 200px" src="<?=base_url('uploads/projects/'.$image->img)?>">
          </div>
        <?php 
        $i++; 
          }//End FOreach
        }//End if ?>
      </div>
    

  </div>
</div>
<!--Proect_Details_End-->
<script type="text/javascript">

 

  $('.leader_id').click(function() {
    var id = $(this).val();
    var idd= 2;
    $.ajax({
      url: "<?= base_url('projects/project_leader/' . $projectID) ?>",
      method: "POST",
      data: {
        user_id: idd
      },
      dataType: 'json',
      success: function() {

       


      }
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
          html += '<div class="row mt-3">';
          
          if($('.current_user').val() == data[i].user_id){
              
            html +='<div class="col-lg-12"><a href="javascript:void(0)" class="del_comment float-right text-danger" title="delete" data="'+ data[i].subtask_comment_id +'"> X </a></div>';
            
          }
            
            html +='<div class="col-lg-2">' +
            '<img class="img-fluid rounded-circle mt-4 ml-5" src="' + img + '" style="width: 100px;"><br><span style="margin-left:65px!important">'+ data[i].name + '</span>' +
            '</div>' +
            '<div class="col-lg-10 mt-4">' +
            '<div class="cp"><span style="margin-left: 83%;">(' + data[i].dateTime + ')</span><br>' + data[i].description +'</div><br>';
            
            if(data[i].file != ''){
                
                html +='<a href="<?= site_url('projects/download_comment_files/') ?>'+ data[i].subtask_comment_id + '" class="text-success">Download</a>';
            
            }
            
            html +='</div></div>';
        }
        
        $('.com_length').text(leng);
        $('.com').html(html);
      }
    });
  }

</script>