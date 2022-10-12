<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">

<?php
if($this->session->flashdata('errorpass1') || $this->session->flashdata('errorpass'))
{
  $ptab = 'show active';
  $pbtn = 'active';
  $dtab = '';
  $dbtn = '';
}
else if($this->session->flashdata('errorprofile1'))
{
  $ptab = '';
  $pbtn = '';
  $dtab = 'show active';
  $dbtn = 'active';
}
else
{
  $ptab = '';
  $pbtn = '';
  $dtab = 'show active';
  $dbtn = 'active';
}
?>
<!-- Project_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Profile</span>
                        </div>
                    </div>
                    <div class="row Project pt-2 pb-2">
                        <div class="col-lg-6">                         
                        </div>
                        <div class="col-lg-6">
                          <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
                              <li class="nav-item mr-2">
                                <a class="nav-link Project_Id_btn <?=$dbtn?> " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Profile</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link Project_Id_btn <?=$pbtn?>" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Password</a>
                              </li>
                          </ul>
                        </div>
                    </div>
<!-- secod_Row_Start -->
<div class="row pt-2">
  <div class="col-lg-12">
  <!-- Id_Content_Start -->
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade <?=$dtab?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!--All_Start  -->
                <form action="<?=base_url('profile/update_profile')?>" method="post" id="validate_form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-10 m-auto card pt-4 pb-5" style="border:none">
                        <div class="row">
                      <div class="col-lg-10 m-auto">
                    <div class="mtogglediv">
                    <div class="row pt-1">
                      <div class="col-lg-12">
                        <h3 >Personal Data</h3>
                      </div>
                    </div>
                    <?php if($this->session->flashdata("errorprofile")){?>
                      <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <?=$this->session->flashdata("errorprofile")?>
                      </div>
                    <?php } ?>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label >Name</label>
                          <input type="text" class="form-control form-control-sm" name="username" value="<?=$edit->name?>" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters.">
                          <span><?=form_error('username');?></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Contact No</label>
                          <input type="text" class="form-control form-control-sm" name="contact_no" value="<?=$edit->contact_no?>" data-parsley-trigger="keyup" data-parsley-type="number">
                          <span><?=form_error('contact_no');?></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">  
                        <div class="form-group">
                          <label>Date Of Birth</label>
                           <input type="text" class="form-control form-control-sm datepicker" name="dob" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" value="<?=date('d/m/Y',strtotime($edit->dob));?>"/>
                            <span><?=form_error('dob');?></span>
                        </div>
                      </div>
                       <div class="col-lg-6">
                        <div class="row">
                          <div class="col-lg-6">
                              <label>Image</label>
                              <div class="form-group">
                                  <input type="file" name="user_img" class="form-control form-control-sm">
                              </div>
                          </div>
                          <div class="col-lg-6 pt-3">
                            <?php 
                              if($edit->img == null ){ $img = base_url('uploads/users/default.png'); }else{$img = base_url('uploads/users/'.$edit->img);}?>
                             <img class="rounded-circle User_Box_img" src="<?=$img?> " width="60%" style="border: 5px solid #dee2e6;">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">  
                        <div class="form-group">
                          <label>CNIC</label>
                          <input type="text" class="form-control form-control-sm" name="cnic" placeholder="Type your cnic number here" required data-parsley-trigger="keyup" data-parsley-required-message="Type your CNIC number." value="<?=$edit->cnic?>">
                          <span><?=form_error('cnic')?></span>
                        </div>
                      </div>
                      <div class="col-lg-6">  
                        <div class="form-group">
                          <label>Address</label>
                          <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" placeholder="Type your address here" rows="3" name="address" required data-parsley-required-message="Type any description here."><?=$edit->address?></textarea>
                          <span><?=form_error('address')?></span>
                        </div>
                      </div>
                    </div>
                   
                        <div class="row">
                      <div class="col-md-12">
                        <h3>Skills</h3>
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">  
                              <label>Category</label>
                              <select class="form-control form-control-sm" name="category" required data-parsley-required-message="You must select at least one option.">
                                <option selected disabled>select any category</option>
                                <?php if(is_array($cat) || is_object($cat)){ foreach($cat as $key => $v){ if($v->cat_id != null){?>
                                <option <?php if($edit->cat_id == $v->cat_id){echo 'selected="selected"';}?> value="<?=$v->cat_id?>"><?=$v->cat_name?></option>
                                <?php } } }?>
                              </select> 
                              <span><?=form_error('category');?></span>                 
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="form-group">  
                          <label>Skills</label>
                          <select class="form-control form-control-sm js-example-basic-multiple1" name="skills[]" multiple="multiple" required data-parsley-required-message="You must select at least one option.">
                          <?php if(is_array($skills) || is_object($skills)){ foreach($skills as $key => $v){ if($v->is_skill_name != null){?>
                          <option <?php foreach ($uskills as $key => $v1){ if($v1->skill_name == $v->is_skill_name){ echo 'selected="selected"';}       }?>  value="<?=$v->is_skill_name?>"><?=$v->is_skill_name?></option>
                          <?php } } }?>
                          </select>   
                          <span><?=form_error('skills[]');?></span>
                        </div>   
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Qualification</h3>
                      </div>
                    </div> 
                    <?php if(is_array($qualification) || is_object($qualification)){?>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Degree</label>
                          <input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." value="<?=@$qualification[0]->degree_name?>">
                          <span><?=form_error('degree[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Grade/CGPA</label>
                          <input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required value="<?=@$qualification[0]->grade_or_cgpa?>">
                          <span><?=form_error('grade[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="text-white">Year</label>
                           <input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number" value="<?=@$qualification[0]->passing_year?>">
                          <span><?=form_error('year[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-1">
                        <button type="button" class="btn btn-sm btn-success add_morebtn" style="margin-top: 94%;">
                          +
                        </button>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if(is_array($qualification) || is_object($qualification)){ for($i=1;$i<count($qualification);$i++){?>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Degree</label>
                          <input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." value="<?=$qualification[$i]->degree_name?>">
                          <span><?=form_error('degree[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Grade/CGPA</label>
                          <input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required value="<?=$qualification[$i]->grade_or_cgpa?>">
                          <span><?=form_error('grade[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="text-white">Year</label>
                           <input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number" value="<?=$qualification[$i]->passing_year?>">
                          <span><?=form_error('year[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-1">
                        <button type="button" class="btn btn-sm btn-danger remove_morebtn" style="margin-top: 94%;">
                          -
                        </button>
                      </div>
                    </div>
                    <?php } } ?>
                    <div class="more_fields">
                      
                    </div>
                  </div>
                    
                  <div class="row pt-2">
                      <div class="col-lg-12 m-auto">
                         <input type="submit" name="submit" class="btn user_invait_btn" value="Submit">
                      </div>
                    </div>
                  </div>
                      </div>
                    </div>
                  </div>
                    </form>
        <!--All_End  -->
      </div>
      <div class="tab-pane fade <?=$ptab?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!--ongoing_Start  -->
                      <form action="<?=base_url('profile/update_password')?>" method="post" id="validate_form" data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" data-parsley-trigger="keyup" data-parsley-validate>
                        <div class="row">
                          <div class="col-lg-10 m-auto card pt-4 pb-5" style="border:none">
                            <div class="row">
                              <div class="col-lg-10 m-auto">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <h3>Password</h3>
                                  </div>
                                </div>
                                  <?php if($this->session->flashdata("errorpass")){?>
                                    <div class="alert alert-primary alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?=$this->session->flashdata("errorpass")?>
                                    </div>
                                  <?php } ?>  
                                <div class="row pt-1">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                          <label>Old Password</label>
                                          <input type="Password" class="form-control form-control-sm" placeholder="Enter Old Password" name="old_password">
                                          <span><?=form_error('old_password');?></span>
                                      </div>

                                      <div class="form-group">
                                          <label>New Password</label>
                                          <input type="Password" class="form-control form-control-sm" placeholder="Enter Your Password" name="new_password" id="password1" data-parsley-errors-container=".errorspannewpassinput" data-parsley-required-message="Please enter your new password."data-parsley-required />
                                          <span><?=form_error('new_password');?></span>
                                      </div>

                                      <div class="form-group">
                                          <label >Confirm Password</label>
                                          <input type="Password" class="form-control form-control-sm" placeholder="Confirm Your Password" name="confirm_password" data-parsley-errors-container=".errorspanconfirmnewpassinput" data-parsley-required-message="Please re-enter your new password." data-parsley-equalto="#password1" data-parsley-required>
                                          <span><?=form_error('confirm_password');?></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-lg-12 m-auto">
                                       <input type="submit" name="submit" class="btn user_invait_btn" value="Change Password">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
        <!--ongoing_End  -->
      </div>
    </div>
  <!-- Id_Content_End -->
  </div>
</div>
<!-- secod_Row_End -->
                </div>
            </div>
            <!--Project_User_End-->
<script type="text/javascript">
    $(document).ready(function(){
      // //select2
      $('.js-example-basic-single').select2({ width: '100%',tags : true });
      $('.js-example-basic-multiple1').select2({ width: '100%',tags : true,placeholder : 'select or write any skills' });

      $("input[type=file]").change(function(){
          readURL(this);
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('.User_Box_img').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }
      $('.add_morebtn').click(function(){
          var html = ''; 
          html = '<div class="row">'+
                      '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                          '<label class="text-white">Degree</label>'+
                          '<input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." >'+
                          '<span><?=form_error('degree[]')?></span>'+          
                        '</div>'+
                      '</div>'+
                      '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                          '<label class="text-white">Grade/CGPA</label>'+
                          '<input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required>'+
                          '<span><?=form_error('grade[]')?></span>'+          
                        '</div>'+
                      '</div>'+
                      '<div class="col-lg-3">'+
                        '<div class="form-group">'+
                          '<label class="text-white">Year</label>'+
                           '<input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number">'+
                          '<span><?=form_error('year[]')?></span>'+          
                        '</div>'+
                      '</div>'+
                      '<div class="col-lg-1">'+
                        '<button type="button" class="btn btn-sm btn-danger remove_morebtn" style="margin-top: 94%;">-'+
                        '</button>'+
                      '</div>'+
                  '</div>';
          $('.more_fields').append(html);        
      });
      $(document).on('click','.remove_morebtn',function(){
        $(this).closest('.row').remove();
      });
    });
  </script> 
 