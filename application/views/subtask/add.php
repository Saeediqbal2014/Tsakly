  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Create_Milestone_Start -->
<?php
  if($this->session->userdata('user') == 1)
  {
    ?>
     <script>
      $(function(){
            
            $('#rev_val').val(1);
       
      });
    </script>
<?php    
  }
  else  if($this->session->userdata('user') == 1){
  $t=$task_budget->task_milestone-round($subtask_budget->subtasks_budget);
//   echo $t;
  if($t != 0 && $t >0)
  {

  }
  else
  {
      $b=$subtask_budget->c+1;
      $tot=$task_budget->task_milestone/$b;

?>
  
    <script>
      $(document).ready(function(){
          $('#myModal').modal({backdrop: 'static', keyboard: false});
          $('#rev').click(function(){

            $('#rev_val').val(1);
            // $('.my_milestone').prop('max','<?=$tot?>');
            $('.mile').hide();
            $('.my_milestone').removeAttr('required');
            $('.my_milestone').removeAttr('data-parsley-type');
            $('.my_milestone').removeAttr('data-parsley-trigger');

          });
      });
    </script>

<?php } }?>
 <!-- budget out of stock Modal start -->
  <div class="modal fade mt-5" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Warning...!</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p style="font-size: 13px;">Your task Budget is out of stock your don't add another task.<br>
          (if you want to edit your task budget so click on manage)
          Thanks..!</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a class="btn btn-primary text-white" id="rev" data-dismiss="modal">Revised</a>
          <?php if($this->session->userdata('user')==1 || $this->session->userdata('subtask_mb')==1){?>
          <a href="<?=base_url('projects/manage_subtasks_budget/'.$task_id.'/'.$project_id)?>" class="btn btn-success">Manage</a>
          <?php } ?>
          <a href="<?=base_url('projects/tasks/'.$project_id)?>" class="btn btn-danger">Close</a>
        </div>
        
      </div>
    </div>
  </div>
 <!--budget out of stock modal end--> 
                    <?php

                    $toDate = $taskDetails[0]->task_due_date;
                    $newDate = date("d/m/Y", strtotime($toDate)); 

                    ?>

                    <input type="hidden"  name="toDate" value="<?php $toDate = $taskDetails[0]->task_due_date?>">


                     <input type="hidden" id="taskid" name="toDates" value="<?php echo $newDate;?>">

            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a>
                            <span class="Page_Title">Create Subtask</span>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?=base_url('projects/tasks/'.$project_id)?>" class="btn user_invait_btn btn-sm float-right">+ Bact To Tasks</a>
                        </div>
                    </div>

                   
                    <form action="<?=base_url('projects/add_subtask')?>" method="post" id="validate_form">
                    <!-- secod_Row_Start -->
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <input type="text" name="task_id" value="<?=$task_id?>" hidden>
                              <input type="text" name="project_id" value="<?=$project_id?>" hidden>
                              <input type="hidden" name="Revised" id="rev_val">
                              <label>Title</label>
                              <input type="text" name="title" class="form-control" required  data-parsley-trigger="keyup">
                              <span><?=form_error('title')?></span>
                            </div>
                          </div>
                          <div class="col-lg-4 mile">
                              <?php if($this->session->userdata('user') == 1){?>
                                <div class="form-group">
                                  <label>Milestone</label>
                                  <input type="number" name="milestone" class="form-control my_milestone" required  data-parsley-trigger="keyup" data-parsley-type="number">
                                    <span><?=form_error('milestone')?></span>
                                </div>
                              <?php } ?>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-8">
                                <div class="form-group">
                                  <label>Due Date <label style="margin-left: 40px; color: red; text-align: right">(Task Due Date: <?php echo $newDate ?> MM-DD-YYYY)</label></label>
                                   <input type="text" id="detePick" class="form-control datepicker" name="due_date" required  placeholder="MM/DD/YYYY"
                                    data-date-format="DD/MM/YYYY"/>
                                  <span><?=form_error('due_date')?></span>
                                </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                <label>Priority</label>
                                <select class="form-control"  name="priority" required data-parsley-required-message="You must select at least one option.">
                                  <option value="complete">Complete</option>
                                  <option value="incomplete">InComplete</option>
                                </select>
                                <span><?=form_error('priority')?></span>
                              </div>
                          </div>
                        </div>
                          <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Employees</label>
                                <select name="users" class="form-control" id="exampleFormControlSelect1" required data-parsley-required-message="You must select at least one option.">
                                  <option selected disabled>select user</option>
                                  <!-- <php print_r($project_users); die('What is this');?> -->
                                  <?php foreach($project_users as $key =>$v):?>
                                  <option value="<?=$v->user_id?>"><?=$v->name?></option>
                                  <?php  endforeach;?>
                                </select>
                                <span><?=form_error('users')?></span>
                                </div>
                            </div>
                          </div>
                        <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."></textarea>
                                <span><?=form_error('description')?></span>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                               <input type="submit"  name="submit" value="Submit" class="btn user_invait_btn clk m" style="font-size: 13px">
                               <input type="submit" class="btn d-none sub m" >
                                                                  <!-- <i class="fas fa-envelope text-white mr-1" style="font-size: 12px"></i> -->
                            </div>
                        </div>
                      </div>
                    </div>
                    </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Create_Milestone_End-->

<script>
  $("#detePick").change(function() {
    var startDate = document.getElementById("detePick").value;
    var endDate = $("#taskid").val();
    var endD = Date.parse(endDate);
    
    if (endDate >= startDate) {
      
     $(".m").show();
    }
    else{
          alert("Sub-Task date should not be different");

         $(".m").hide();

         
    }
  });
</script>
            
<script>
$(document).ready(function(){
  
          alert("Hi");
          $(".clk").click(function(){
             var mile = $(".my_milestone").val();
             var t = <?= $t?>;
            //  alert("a;lskjdl");
             if(mile <= t){
                $(".sub").trigger("click");
             }else{
                 alert("Your Budget is lower than your milestone please reduce the amount of milestone");
             }
          })
})
</script>
