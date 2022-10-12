<!--Proect_Details_Start-->
            <div class="pr-4 pl-4">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12">
                       <a class="" style=""></a><span class="Page_Title">Task Details</span>
                    </div>
                  </div>
                    <div class="row pt-4 pb-3 Project_Details">
                        <div class="col-lg-12">
                           <a href="<?=base_url('projects/tasks/'.$task->project_id); ?>"  class="btn user_invait_btn btn-sm float-right" style="font-size: 13px">
                                + Back to Tasks
                            </a>
                        </div>
                    </div>
                        <!--
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
                      <div class="col-lg-12 pr-4">
                        <div class="row">
                          <!-- left_Box_Start -->
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
<div class="row">
  <div class="col-lg-6">
    <a href="" class="Project_Title_Color"><?=$task->task_title?></a>
  </div>
  <div class="col-lg-6">
    <!-- Edit_Drop_Down -->
              <?php if($this->session->userdata('user')==1 || $this->session->userdata('task_edit')==1 || $this->session->userdata('task_del')==1){?>
                <div class="btn-group Project_Box_Icon float-right">
                  <button type="button"  
                  class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop p-0"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  style="background-color: transparent;border: none;box-shadow: none;">
                    <i class="fas fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right p-1">
                    <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" 
                    type="button">
                    <?php if($this->session->userdata('user')==1 || $this->session->userdata('task_edit')==1){ ?>
                      <button 
                       class="btn btn-primary"
                       style="background-color: transparent;border: none;box-shadow: none;">
                         <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                         <a href="<?=base_url('projects/task_edit/'.$task->project_task_id); ?>"
                          class="text-dark" style="font-size: 12px"> Edit </a>
                      </button>
                      <br>
                      <?php 
                      } if($this->session->userdata('user')==1 || $this->session->userdata('task_del')==1){ ?>
                    	<button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove"
                           class="btn btn-primary"
                           style="background-color: transparent;border: none;box-shadow: none;">
                           <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                           <a class="text-dark del" data-toggle="modal" data-target="#exampleModalLong_remove" style="font-size: 12px" data="<?=$task->project_task_id?>">
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
                if($task->task_priority == 'incomplete')
                {
                  $bg = "bg-secondary";
                }
                else
                {
                  $bg = "bg-success";
                }
              ?>
      <a class="Right_Togel_Drop_Item_1_Sub_3 <?=$bg?> text-white"><?=$task->task_priority?></a>
      <p class="light_color pt-5 Bold" style="font-size: 13px;">Project Overview :</p>
      <p class="light_color pb-2" style="font-size: 13px;">
        <?=$task->task_description?>
      </p>
    </div>
  </div>
<!-- 2nd_row_End -->
<!-- 3rd_row_Start -->
 <div class="row pt-3 pb-1">
   <div class="col-lg-4">
     <h6 class="light_color">Due Date</h6>
     <p style="font-size: 14px;"><?=$task->task_due_date?></p>
   </div>
   <div class="col-lg-4">
 	<?php if($this->session->userdata('user') == 1 || $this->session->userdata('task_b_show')==1 ){?>
      <h6 class="light_color">Budget</h6>
     <p style="font-size: 14px;"><?=$task->task_milestone?></p>
 	<?php } ?>
   </div>
   <div class="col-lg-4">
     
   </div>
 </div>
<!--  3rd_Row_End-->
<!-- 4th_Row_Start -->
  
<!-- 4th_Row_End -->
</div>
                          <!-- Left_box_End -->
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
                                            $d = date('d-m-Y', strtotime($task->task_due_date));
                                            $td = date('d-m-Y');
                                            // print_r($d); die();
                                            if($td >= $d)
                                            {
                                              $RemainingDays = '0';
                                            }
                                            else
                                            {
                                              $currentDate = strtotime(date('Y-m-d'));
                                              $project_end_date = date('Y-m-d',strtotime($task->task_due_date));
                                              $project_end_date2 = strtotime($project_end_date);
                                              $timeDiff = abs($project_end_date2 - $currentDate);
                                              $RemainingDays = $timeDiff/86400;
                                              $RemainingDays = intval($RemainingDays);
                                            }
                                        ?>
                                        <?=$RemainingDays?>
                                        	
                                </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                    <div class="col-lg-6 pl-4">
                      <div class="row">
                        <div class="col-lg-12 card pt-4 pb-4 bn" style="border-top:2px solid #4fd1fe!important; padding-bottom: 2.7rem!important;">
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
                            <textarea class="form-control mt-2 comment" rows="4" name="comment" placeholder="leave a comment..."></textarea>
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
<div class="modal fade" id="exampleModalLong_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">  Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?=base_url('projects/task_delete')?>" method="post">        
            <input type="text" name="id" value="<?=$task->project_id?>" hidden>
            <input type="text" name="del" class="de" hidden>
        <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>

 
<script type="text/javascript">
	$('.del').click(function(){
        var del=$(this).attr('data');
        $('.de').val(del);
    });
</script>         