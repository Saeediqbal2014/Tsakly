  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Create_Milestone_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a>
                            <span class="Page_Title">Create Milestone</span>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?=base_url('projects/view_details/'.$id)?>" class="btn user_invait_btn float-right">+ Back to the Project</a>
                        </div>
                    </div>
                      <?='<label class="text-primary">'.$this->session->flashdata("error").'</label>';  ?>
                    <!-- secod_Row_Start -->
                    <form action="<?=base_url('projects/add_milestone')?>" method='post'>
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <input type="text" name="id" value="<?=$id?>">
                              <label>Milestone Title</label>
                              <input type="text" class="form-control" name="title" placeholder="Enter Title">    
                               <span><?=form_error('title')?></span>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label>Milestone Cost</label>
                              <input type="number" step="any" class="form-control" placeholder="0" name="cost">
                               <span><?=form_error('cost')?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                              <label>Summary</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="summary"></textarea>
                               <span><?=form_error('summary')?></span>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                              <input type="submit" name="submit" value="Submit" class="btn user_invait_btn " style="font-size: 13px">
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Create_Milestone_End-->
