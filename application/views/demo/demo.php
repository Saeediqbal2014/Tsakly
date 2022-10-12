<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Add_Report_Start -->
            <div class="pr-4 pl-4 Edit_Project_Form">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Add Report</span>
                        </div>
                        <div class="col-lg-6">
                            <a href="<?=base_url('reports');?>" class="btn user_invait_btn btn-sm float-right">+ Back to Reports</a>
                        </div>
                    </div>
                     <?php if($this->session->flashdata("errorreport")){?>
                      <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <?=$this->session->flashdata("errorreport")?>
                      </div>
                    <?php } ?>
                    <!-- secod_Row_Start -->
                    <form action="<?=base_url('Attendance/index_form')?>" method="post">
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

                       <div class="row">
                         <div class="col-lg-4">
                        <div class="form-group">
                          <label>from</label>
                          <input type="text" class="form-control" id="timepicker1" name="from_time" >
                          	<span><?=form_error('from_time')?></span>

                        </div>
                    </div>

                    <div class="col-lg-4">
                            <div class="form-group">
                              <label>to</label>
                              <input type="text" class="form-control" id="timepicker2" name="to_time">
                          		<span><?=form_error('to_time')?></span>
                            </div>
                    </div>
                        
                       </div>
                 
                    <div class="row pt-4">

                      <div class="col-lg-12">
                        <input type="submit" name="submit" value="submit" class="btn user_invait_btn btn-sm">
                      </div>
                    </div>
                      </div>
                    </div>
                	</form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Add_Report_End-->