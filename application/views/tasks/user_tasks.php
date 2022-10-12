<!-- Task_Board_Start -->
<div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Task Board</span>
                        </div>
                        <div class="col-lg-6"></div>
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
    <?php if(is_object($tasks) || is_array($tasks) && !empty($tasks)){ $i=1;$s=0; foreach($tasks as $key => $v):?>                    
    <div class="row pb-2">
      <div class="col-lg-12 card pt-2 bn" style="border-top: 2px solid #4FD1FE!important;
          box-shadow: 0px 3px 15px -4px rgba(153,240,240,1);">
        <!-- Task_Box_1_Row_Start -->
                        <div class="row">
                          <div class="col-lg-6">
<div class="pb-1" id="headingOne">
   
  <a  class="btn text-dark" 
    style="box-shadow: none;padding: 0.375rem 0.1rem;">
      <!-- <i class="fas fa-dot-circle" style="font-size: 6px"></i> --> <?=$i?> : <b><?=$v->subtask_title?></b>
  </a>
  <?php 
                if($v->subtask_priority == 'incomplete')
                {
                  $bg = "bg-secondary";
                }
                else
                {
                  $bg = "bg-success";
                }
              ?>
      <a class="Right_Togel_Drop_Item_1_Sub_3 <?=$bg?> text-white"><?=$v->subtask_priority?></a>
   <a data-toggle="collapse" data-target="#collapseOne<?=$v->project_task_id?>" 
              aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-sort-down light_color mt-2" style="font-size: 13px"></i>
          <!-- <i class="fas fa-sort-down"></i> -->
        </a>
</div>
                          </div>
                          <div class="col-lg-6">
                            <div class="float-right">
                                  <a href="<?=base_url('Tasks/subtask_view/'.$v->project_subtask_id .'/'.$v->project_task_id);?>" 
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
                                  <?php } if($this->session->userdata('user')==1 || $this->session->userdata('subtask_create')==1){?>
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

      </div>
    </div>
    <?php $s++; $i++;endforeach;}else{?>
                        <p class="User_Box_Txt">
                            <span class="light_color Bold">No record found...!</span>  
                        </p>
                      <?php } }?>
                        <!-- 2nd_Row_In_Inner_Row_End -->
<!-- Task_Box_1st_Row_End -->


         