<style>
#ui-datepicker-div{
      top: 535.434px !important;
     }

</style>
<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Invite_User_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a></a><span class="Page_Title">Add User</span>
                        </div>
                        <div class="col-lg-6">
                           <a href="<?=base_url('users'); ?>" class="btn user_invait_btn float-right">+ All Users</a>
                        </div>

                    </div>
                    
                    <form action="<?=base_url('users/add')?>" method="post" id="validate_form" enctype="multipart/form-data">
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                      <div class="col-lg-10 m-auto">
                      <div class="form-group">
                          <label >Name</label>
                          <input type="text" class="form-control" placeholder="Name" name="username" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." value="<?php echo set_value('username'); ?>">
                          <span><?=form_error('username');?></span>
                        </div>

                        <div class="form-group">
                          <label>Contact No</label>
                          <input type="number" class="form-control" placeholder="Contact No" name="contact_no" required  data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo set_value('contact_no'); ?>">
                          <span><?=form_error('contact_no');?></span>
                        </div>

                        <div class="form-group">
                          <label>Date Of Birth</label>
                          <input type="text" id="dp" data-dropup-auto="false" class="form-control datepicker" name="dob" required  placeholder="MM/DD/YYYY" data-date-format="DD/MM/YYYY" value="<?php echo set_value('dob'); ?>"/>
                          <span><?=form_error('dob');?></span>
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control form-control-sm" placeholder="Email" name="email" required data-parsley-type="email" data-parsley-trigger="keyup" value="<?php echo set_value('email'); ?>">
                          <span><?=form_error('email');?></span>
                        </div>
                        
                        <div class="form-group">
                          <label>Password</label>
                          <input type="Password" class="form-control form-control-sm" placeholder="Password" name="password" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup" value="<?php echo set_value('password'); ?>">
                          <span><?=form_error('password');?></span>
                        </div>
                        
                        <div class="form-group">
                          <label>from (office time)</label>
                          <input type="text" class="form-control form-control-sm" placeholder="Time" id="timepicker1" name="time" required value="<?php echo set_value('time'); ?>">
                          <span><?=form_error('time')?></span>
                        </div>
                  
                      
                       
                        <div class="form-group">
                          <label>Designation</label>
                         <!--  <input type="text" class="form-control" name="designation" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters."> -->
                          <select class="form-control form-control-sm js-example-basic-single" name="designation" id="exampleFormControlSelect1"  required data-parsley-required-message="You must select at least one option.">
                            <option selected disabled>select or write any designation</option>
                            <?php if(is_array($designation) || is_object($designation)){ foreach ($designation as $key => $v) { if($v->cat_name != null){?>
                              <option value="<?=$v->cat_id;?>"><?=$v->cat_name;?></option>
                            <?php } } }?>
                          </select>  
                          <span><?=form_error('designation');?></span>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="status" required data-parsley-required-message="You must select at least one option.">
                              <option selected disabled>select user type</option>
                             <?php foreach ($types as $key => $v){  ?>
                              <option value="<?=$v->role_id?>"><?=$v->role_name?></option>
                             <?php } ?>
                            </select>
                            <span><?=form_error('status')?></span>
                        </div>
                        <div class="form-group">
                        <label>Salary</label>
                            <input type="number" placeholder="Salary" name="salary" class="form-control" required value="<?php echo set_value('salary'); ?>">
                            <?=form_error('salary')?>
                        </div>
                      </div>
                    </div>
                    <div class="row pt-4">

                      <div class="col-lg-10 m-auto">
                        <input type="submit" name="submit" class="btn user_invait_btn" value="Submit">
                      </div>
                    </div>
                      </div>
                    </div>
                    </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Invite_User_End-->
 <script type="text/javascript">
      $(document).ready(function(){
        $('.js-example-basic-single').select2({ width: '100%',tags : true });
      });

      
     
  </script> 
 