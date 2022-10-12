<!-- Task_Board_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Task Board</span>
                        </div>
                        <div class="col-lg-6">
                            <?php  if($this->session->userdata('user')==1 || $this->session->userdata('task_add')==1){?>
                            <a href="<?=base_url('projects/insert_form_of_new_task/'.$id);?>"class="btn user_invait_btn btn-sm float-right ml-1">+ Add Task</a>
                            <?php } ?>
                            <a href="<?=base_url('projects/view_details/'.$id);?>" class="btn user_invait_btn btn-sm float-right">+ Back to project</a>
                        </div>
                    </div>
                    <?php if($this->session->flashdata('errortask')){?>
                    <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$this->session->flashdata('errortask');?>
                    </div>
                    <?php } ?>
                    <!-- Main_Row_Task_Section -->
                    <?php if($this->session->userdata('user')==1 || $this->session->userdata('task_show')==1 || $this->session->userdata('task_p_show')==1){ ?>
                    <div class="row">
                      <div class="col-lg-12">
                    <!-- secod_Row_Start -->
                    <div class="row pt-5">
                      <div class="col-lg-12 card pt-5 pb-5 bn" id="accordion">
<div class="row">
  <div class="col-lg-11 m-auto">
                            <!-- Drop_down_Start -->
                        <!-- 1st_Row_In_Inner_Row_Start -->
    <?php if(is_object($tasks) || is_array($tasks)){ $i=1;$s=0; foreach($tasks as $key => $v):?>                    
    <div class="row pb-2">
      <div class="col-lg-12 card pt-2 bn" style="border-top: 2px solid #4FD1FE!important;
          box-shadow: 0px 3px 15px -4px rgba(153,240,240,1);">
        <!-- Task_Box_1_Row_Start -->
                        <div class="row">
                          <div class="col-lg-6">
<div class="pb-1" id="headingOne">
   
  <a  class="btn text-dark" 
    style="box-shadow: none;padding: 0.375rem 0.1rem;">
      <!-- <i class="fas fa-dot-circle" style="font-size: 6px"></i> --> <?=$i?> : <b><?=$v->task_title?></b>
  </a>
  <?php 
                if($v->task_priority == 'incomplete')
                {
                  $bg = "bg-secondary";
                }
                else
                {
                  $bg = "bg-success";
                }
              ?>
      <a class="Right_Togel_Drop_Item_1_Sub_3 <?=$bg?> text-white"><?=$v->task_priority?></a>
   <a data-toggle="collapse" data-target="#collapseOne<?=$v->project_task_id?>" 
              aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-sort-down light_color mt-2" style="font-size: 13px"></i>
          <!-- <i class="fas fa-sort-down"></i> -->
        </a>
</div>
                          </div>
                          <div class="col-lg-6">
                            <div class="float-right">
                                  <a href="<?=base_url('projects/task_view/'.$v->project_task_id);?>" 
                                          class="btn btn-sm btn-outline-success float-right mt-1 ml-1">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                  <?php  if($this->session->userdata('user')==1 || $this->session->userdata('task_del')==1){?>
                                  <a type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove"
                                   href="#" class="btn btn-sm btn-outline-danger float-right mt-1 ml-1 del" data="<?=$v->project_task_id?>">
                                      <i class="fas fa-trash" style="font-size: 11px"></i>
                                  </a>
                                  <?php }if($this->session->userdata('user')==1 || $this->session->userdata('task_edit')==1){?>
                                  <a href="<?=base_url('projects/task_edit/'.$v->project_task_id);?>" 
                                          class="btn btn-sm btn-outline-info float-right mt-1 ml-1">
                                      <i class="fas fa-pencil-alt" style="font-size: 11px"></i>
                                  </a>
                                  <?php } if($this->session->userdata('user')==1 || $this->session->userdata('subtask_add')==1){?>
                                  <a href="<?=base_url('projects/insert_form_of_new_subtask/'.$v->project_task_id.'/'.$id);?>" 
                                          class="btn btn-sm btn-outline-primary float-right mt-1">
                                      <i class="fas fa-plus"></i>
                                  </a>
                                  <?php } ?>
                            </div>
                          </div>
                        </div>
                        <!-- 1st_Row_In_Inner_Row_End -->

                        <!-- 2nd_Row_In_Inner_Row_Start -->
                        <?php if($this->session->userdata('user')==1 || $this->session->userdata('subtask_show')==1 || $this->session->userdata('subtask_p_show')==1){?>
                          <div class="row">
                            <div class="col-lg-12">
<div class="collapse show pb-5" id="collapseOne<?=$v->project_task_id?>" aria-labelledby="headingOne" data-parent="#accordion">
  <!--  -->
    <?php 
      $t=1;
    
      for($p=0;$p<count($subtasks[$s]);$p++){
        $st=$subtasks[$s][$p];
        if($st == null)
        {

        }
        else{
    ?>
    <div class="card card-body Task_Box bn">
      <div class="row">
        <div class="col-lg-1 pt-4 pb-4">
          <a class="p-3 Task_Box_Circle">
                 <i class="fas fa-list-ul text-white" style="font-size: 20px"></i>
           </a>
        </div>
        <div class="col-lg-11 pb-4">
          <div class="row Task_Box_Content">
            <div class="col-lg-11">
              <div class="">
                  <a style="color:black!important;text-decoration:none;" href="<?=base_url('projects/subtask_view/'.$st->project_subtask_id.'/'.$id); ?>"><?=$t?> : <b><?=$st->subtask_title?></b></a>
                <?php    
                 if($v->task_priority == 'incomplete')
                  {
                    $bg = "bg-secondary";
                  }
                  else
                  {
                    $bg = "bg-success";
                  }
                ?>
              <a class="Right_Togel_Drop_Item_1_Sub_3 <?=$bg?> text-white"><?=$st->subtask_priority?></a>
                  <p>
                    <?=$st->subtask_description?>
                  </p>
              </div>
            </div>
            <div class="col-lg-1">
          <!-- Edit_btn_Start -->
                <?php if($this->session->userdata('user')==1 || $this->session->userdata('subtask_edit')==1 || $this->session->userdata('subtask_del')==1 || $this->session->userdata('subtask_show')==1 || $this->session->userdata('subtask_p_show')==1){?>
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
                    <?php  if($this->session->userdata('user')==1 || $this->session->userdata('subtask_edit')==1){ ?>
                    <button 
                     class="btn btn-primary"
                     style="background-color: transparent;border: none;box-shadow: none;">
                       <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                       <a href="<?=base_url('projects/subtask_edit/'.$st->project_subtask_id.'/'.$id); ?>"
                        class="text-dark" style="font-size: 12px"> Edit </a>
                     </button>
                     <br>
                    <?php } if($this->session->userdata('user')==1 || $this->session->userdata('subtask_del')==1){?>
                    <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_subtaskremove"
                     class="btn btn-primary delsubtask" style="background-color: transparent;border: none;box-shadow: none;" data="<?=$st->project_subtask_id?>" data-task="<?=$v->project_task_id?>">
                     <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                     <a class="text-dark" style="font-size: 12px">
                       Delete
                     </a>
                    </button>
                    <br>  
                    <?php } if($this->session->userdata('user')==1 || $this->session->userdata('subtask_show')==1 || $this->session->userdata('subtask_p_show')==1){?>
                    <button 
                     class="btn btn-primary"
                     style="background-color: transparent;border: none;box-shadow: none;">
                        <i class="fas fa-eye text-dark"  style="font-size: 12px"></i>
                       <a href="<?=base_url('projects/subtask_view/'.$st->project_subtask_id.'/'.$id); ?>"
                        class="text-dark" style="font-size: 12px"> View </a>
                    </button>
                    <?php } ?>
                    </button>
                  </div>
                </div>
                <?php } ?>
          <!-- Edit_Btn_End -->
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <?php $t++;}} ?>
</div>
                            </div>
                          </div>
                        <?php } ?>
      </div>
    </div>
    <?php $s++; $i++;endforeach;}else{?>
                        <p class="User_Box_Txt">
                            <span class="light_color Bold">No record found...!</span>  
                        </p>
                      <?php } ?>
                        <!-- 2nd_Row_In_Inner_Row_End -->
<!-- Task_Box_1st_Row_End -->



                        

                        <!-- Drop_Down_End -->
                      </div>
  </div>
</div>
                    </div>
                    <!-- secod_Row_End -->

                    <!-- 3rd_Row_Start -->
                    
                    <!-- 3rd_Row_End -->

                  </div>
                </div>
                <?php } ?>
                <!-- Task_Section_Main_Row_End -->
                </div>
            </div>
            <!--Task_Board_End-->




<!-- taskremove -->
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
            <input type="text" name="id" value="<?=$id?>" hidden>
            <input type="text" name="del" class="de" hidden>
        <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>
            <!-- taskremove -->

            <!-- subtaskremove -->
            <div class="modal fade" id="exampleModalLong_subtaskremove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">  Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?=base_url('projects/subtask_delete')?>" method="post">        
            <input type="text" name="id" class="redir" hidden>
            <input type="text" name="del" class="dels" hidden>
        <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>
            <!-- subtaskremove -->

            <script type="text/javascript">
                $('.del').click(function(){
                    var del=$(this).attr('data');
                    $('.de').val(del);
                });
                $('.delsubtask').click(function(){
                  var del = $(this).attr('data');
                  var redirect = $(this).attr('data-task');
                  $('.dels').val(del);
                  $('.redir').val(redirect);
                })
            </script>
                        