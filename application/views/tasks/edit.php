  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Create_Milestone_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a>
                            <span class="Page_Title">Create Task</span>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?=base_url('projects/tasks/'.$edit->project_id)?>" class="btn user_invait_btn btn-sm float-right">+ Bact To Task View</a>
                        </div>
                    </div>

                    <form action="<?=base_url('projects/task_update')?>" method="post" id="validate_form">
                    <!-- secod_Row_Start -->
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <input type="text" name="id" value="<?=$id?>" hidden>
                              <input type="text" name="project_id" value="<?=$edit->project_id?>" hidden>
                              <label>Title</label>
                              <input type="text" name="title" class="form-control" value="<?=$edit->task_title?>" required data-parsley-required-message="Type any title here.">
                              <span><?=form_error('title')?></span>
                            </div>
                          </div>
                          <div class="col-lg-4">
                                <div class="form-group">
                                  <label>Milestone</label>
                                  <input type="number" name="milestone" class="form-control" max="<?=$edit->task_milestone?>" value="<?=$edit->task_milestone?>" required  data-parsley-trigger="keyup" data-parsley-type="number">
                                    <span><?=form_error('milestone')?></span>
                                </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-8">
                                <div class="form-group">
                                  <label>Due Date</label>
                                   <input type="text" class="form-control datepicker" name="due_date" required  placeholder="DD/MM/YYYY"
                                    data-date-format="DD/MM/YYYY"/ value="<?=date('d/m/Y',strtotime($edit->task_due_date))?>">
                                  <span><?=form_error('due_date')?></span>
                                </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="priority" required data-parsley-required-message="You must select at least one option.">
                                  <option <?php if($edit->task_priority == 'complete'){echo 'selected="selected"';}?> value="complete">Complete</option>
                                  <option <?php if($edit->task_priority == 'incomplete'){echo 'selected="selected"';}?> value="incomplete">InComplete</option>
                                </select>
                                <span><?=form_error('priority')?></span>
                              </div>
                          </div>
                        </div>
<!--will be confirm-->
                      <!--   <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                              <label>Assign To</label>
                                  <select class="form-control" id="exampleFormControlSelect1">
                              <option>Complete</option>
                              <option>InComplete</option>
                            </select>
                            </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."><?=$edit->task_description?></textarea>
                                <span><?=form_error('description')?></span>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                               <input type="submit" name="submit" value="Submit" class="btn user_invait_btn" style="font-size: 13px">
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
