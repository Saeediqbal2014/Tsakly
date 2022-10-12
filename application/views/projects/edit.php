  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<style>
.overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      height: 100%;
      width: 100%;
      opacity: 0;
      transition: .3s ease;
      background-color: #4fd1fe;
    }

    .icon {
      color: black;
      font-size: 100px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      text-align: center;
    }

    .image:hover .overlay {
      opacity: 1;
    }
</style>
<!-- Ediit_Project_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a></a><span class="Page_Title">Edit Project</span>
                        </div>
                       <div class="col-lg-6">
                             <a href="<?=base_url('projects/view_details/'.$edit->project_id); ?>" class="btn user_invait_btn float-right">+ Back to Projects</a>
                        </div>
                    </div>
                    <!-- secod_Row_Start -->
                     <form action="<?=base_url('projects/update')?>" method="post" id="validate_form" enctype="multipart/form-data">
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <input type="text" name="id" value="<?=$edit->project_id?>" hidden>
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="<?=$edit->project_name?>" required  data-parsley-required-message="Type only Characters.">
                          <span><?=form_error('name')?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="row">
                         <div class="col-lg-6">
                            <div class="form-group">
                              <label>Priority</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="priority" required data-parsley-required-message="You must select at least one option.">
                                <option selected disabled>select your project priority</option>
                                <option <?php if($edit->project_status == "high" ){ echo 'selected="selected"'; } ?> value="high">High</option>
                                <option <?php if($edit->project_status == "medium" ){ echo 'selected="selected"'; } ?> value="medium">Medium</option>
                                <option <?php if($edit->project_status == "low" ){ echo 'selected="selected"'; } ?> value="low">Low</option>
                              </select>
                               <span><?=form_error('priority')?></span>
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <?php if($this->session->userdata('user')==1 || $this->session->userdata('proj_b_edit') == 1){?>
                           <div class="form-group">
                              <label>Budget</label>
                              <div class="input-group">
                                <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">$</span></span>
                                <input type="number" class="form-control" step="any" id="budget" name="budget" value="<?=$edit->project_budget?>"placeholder="Project Budget" required  data-parsley-trigger="keyup" data-parsley-type="number">
                                 <span><?=form_error('budget')?></span>
                              </div>
                            </div>
                            <?php } ?>
                         </div>
                       </div>
                    </div>
                    </div>
                    <!--  -->
                       <div class="row">
                       <div class="col-lg-6">
                        <div class="form-group">
                          <label>Images</label>
                          <input type="file" class="form-control" name="images[]"   multiple/>
                          <span><?= form_error('images') ?></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label>Start Date</label>
                          <input type="text" class="form-control datepicker" name="startDate" required  placeholder="DD/MM/YYYY"
                        data-date-format="DD/MM/YYYY" value="<?=$edit->start_date;?>"/>
                           <span><?=form_error('startDate')?></span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                            <div class="form-group">
                              <label>End Date</label>
                              <input type="text" class="form-control datepicker" name="endDate" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" value="<?=$edit->end_date;?>">
                               <span><?=form_error('endDate')?></span>
                            </div>
                    </div>
                    </div>
                      <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Notify(Product notification before end date)</label>
                          <select name="notify_days" class="form-control" required data-parsley-required-message="You must select at least one option.">
                            <option></option>
                            <?php for($i=1;$i<=30;$i++){?>
                            <option <?php if($edit->notify_days == $i){echo 'selected="selected"';}?> value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                          </select>
                          <span><?=form_error('notify_days')?></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Status</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="status" required data-parsley-required-message="You must select at least one option.">
                            <option selected disabled>select your project status</option>
                            <option <?php if($edit->status_c_or_i == "pending" ){ echo 'selected="selected"'; } ?>  value="pending">Pending for Aproval</option>
                            <option <?php if($edit->status_c_or_i == "incomplete" ){ echo 'selected="selected"'; } ?>  value="incomplete">Incomplete</option>
                            <option <?php if($edit->status_c_or_i == "complete" ){ echo 'selected="selected"';}?> value="complete">Complete</option>
                          </select>
                          <span><?=form_error('status')?></span>
                        </div>
                      </div>
                    </div>
                    <!-- Select -->
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>Employees</label>
                          <select name="users[]" multiple="multiple" class="js-example-basic-multiple" id="exampleFormControlSelect1" required data-parsley-required-message="You must select at least one option.">
                            <?php foreach($users as $key =>$v):?>
                            <option <?php foreach($edit_user as $key2 => $v2):; if($v2->user_id == $v->user_id ){ echo 'selected="selected"'; }endforeach; ?>  value="<?=$v->user_id?>"><?=$v->name?></option>
                            <?php  endforeach;?>
                          </select>
                          <span><?=form_error('users[]')?></span>
                          </div>
                      </div>
                    </div>
                    <!--  -->
                       <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."><?=$edit->description?></textarea>
                             <span><?=form_error('description')?></span>
                        </div>
                    </div>
                    </div>

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
                          <div class="overlay">
                            <a href="javascript:void(0);" class="icon delete_img" data-id="<?=$image->pm_id?>" title="Delete">
                              <i class="fa fa-times"></i>
                            </a>
                          </div>
                        </div>
                      <?php 
                      $i++; 
                        }//End FOreach
                      }//End if ?>
                    </div>

                    <!--  -->
                    <div class="row pt-4">

                      <div class="col-lg-12">
                        <input type="submit" name="submit" class="btn user_invait_btn confirm pop_up" value="Submit">
                      </div>
                    </div>
                      </div>
                    </div>
                    </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Ediit_Project_End-->
<script type="text/javascript">
  $(document).ready(function(){
    $('.js-example-basic-multiple').select2({ width: '100%' });
    $(document).on("click",".delete_img",function(){
			var pm_id = $(this).attr("data-id");
			
			$.ajax({
				url:"<?=base_url('Projects/DeleteImage')?>",
				data:{action:"DelImage",pm_id:pm_id},
				type:"post",
				success:function(response)
				{
					if(response == "success")
					{
						
					}else{
						alert("Something Went Wrong.");
					}
				}
			})

			$(this).parents(".image").remove();
		})
  });
</script>