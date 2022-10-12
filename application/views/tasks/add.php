  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Create_Milestone_Start -->
<?php 
  $t=$project_budget->project_budget-round($tasks_budget->tasks_budget);
  
   if($t != 0 && $t >0)
  {

  }
  else
  {
      $b=$tasks_budget->c+1;
      $tot=$project_budget->project_budget/$b;

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
<?php } ?>

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
          <?php if($this->session->userdata('user')==1 || $this->session->userdata('task_mb')==1){?>
          <a href="<?=base_url('projects/manage_tasks_budget/'.$id)?>" class="btn btn-success">Manage</a>
          <?php } ?>
          <a href="<?=base_url('projects/tasks/'.$id)?>" class="btn btn-danger">Close</a>
        </div>
        
      </div>
    </div>
  </div>
 <!--budget out of stock modal end--> 
  
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a>
                            <span class="Page_Title">Create Task</span>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?=base_url('projects/tasks/'.$id)?>" class="btn user_invait_btn btn-sm float-right">+ Bact To Tasks</a>
                        </div>
                    </div>
                    
                    <form action="<?=base_url('projects/add_task')?>" method="post" id="validate_form">
                    <!-- secod_Row_Start -->
                    
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">                              
                              <input type="text" name="id" value="<?=$id?>" hidden>
                              <input type="text" name="Revised" id="rev_val" hidden>
                              <label>Title</label>
                              <input type="text" name="title" class="form-control" required data-parsley-required-message="Type any title here.">
                              <span><?=form_error('title')?></span>
                            </div>
                          </div>
                          <div class="col-lg-4 mile">
                                <div class="form-group">
                                  <label>Milestone</label>
                                  <input type="number" name="milestone" step="any" class="form-control my_milestone" required  data-parsley-trigger="keyup" data-parsley-type="number">
                                    <span><?=form_error('milestone')?></span>
                                </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-8">
                                <div class="form-group">
                                  <label>Due Date</label>
                                   <input type="text" class="form-control datepicker" name="due_date" required  placeholder="MM/DD/YYYY"
                                    data-date-format="DD/MM/YYYY"/>
                                  <span><?=form_error('due_date')?></span>
                                </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="priority" required data-parsley-required-message="You must select at least one option.">
                                  <option selected disabled>select your project status</option>
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
                                <label>Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."></textarea>
                                <span><?=form_error('description')?></span>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                               <input type="button" name="submit" value="Submit" class="btn user_invait_btn clk" style="font-size: 13px" id="add_task">
                               <input type="submit" class="btn d-none sub " >
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
$(document).ready(function(){
  
          
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