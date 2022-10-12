<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- My_Account_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">My Account</span>
                        </div>
                        <div class="col-lg-6">
                           <!--  <button
                             class="btn user_invait_btn float-right">+ Add Category</button> -->
                        </div>
                    </div>
                    <!-- secod_Row_Start -->
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">

<!-- <div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
</div> -->
                          <div class="col-lg-3 Account_btn">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Name</a>
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Password</a>
 
 
</div>

                          </div>

                          <div class="col-lg-9 Account_Content">
      
      <div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <!--  -->
     <?php if($this->session->flashdata('errorprof')){?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$this->session->flashdata('errorprof');?>
      </div>
      <?php } ?>
      
    <form action="<?=base_url('users/update_profile')?>" method="post">
    <div class="row">
    <div class="col-lg-6">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" placeholder="Alpesh" name="name" value="<?=$edit->name?>">
       	<span><?=form_error('name');?></span>
   </div>
   
  </div>
    </div>
    <div class="col-lg-6 text-center pt-5 pl-5 pr-5">
       <?php 
          $userimg = $this->session->userdata('img');
          if($userimg == null ){ $img = base_url('uploads/users/default.png'); }else{$img = base_url('uploads/users/'.$userimg);}?>
      <img class="rounded-circle User_Box_img" src="<?=$img?> " width="70%" style="border: 5px solid #dee2e6;">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <input type="submit" name="submit" class="btn user_invait_btn" style="font-size: 12px" value="Update">
    </div>
  </div>
  </form>
    <!--  -->
  </div>


  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
     <?php if($this->session->flashdata('errorpass')){?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$this->session->flashdata('errorpass');?>
      </div>
      <?php } ?>
  	<form action="<?=base_url('users/update_password')?>" method="post">
    <!--  -->
      <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
            <label>Old Password</label>
            <input type="Password" class="form-control" placeholder="Enter Old Password" name="old_password">
            <span><?=form_error('old_password');?></span>
        </div>

        <div class="form-group">
            <label >Password</label>
            <input type="Password" class="form-control" placeholder="Enter Your Password" name="new_password">
            <span><?=form_error('new_password');?></span>
        </div>

        <div class="form-group">
            <label >Confirm Password</label>
            <input type="Password" class="form-control" placeholder="Confirm Your Password" name="confirm_password">
            <span><?=form_error('confirm_password');?></span>
        </div>
      </div>
      <div class="col-lg-6"></div>
    </div>
    <div class="row pt-3 ">
    <div class="col-lg-12">
      <input type="submit" name="submit" value="Change Password" class="btn user_invait_btn" style="font-size: 12px">
    </div>
  </div>
  </form>
    <!--  -->
  </div>
 
</div>
                          </div>
                         <!--  <div class="col-lg-5 ">
                            
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--My_Account_End-->
