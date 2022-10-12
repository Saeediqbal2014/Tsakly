<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Invite_User_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Edit Category</span>
                        </div>
                        <div class="col-lg-6">
                             <a href="<?=base_url('categories'); ?>" class="btn user_invait_btn float-right">+ All Categories</a>
                        </div>
                    </div>
                    <!-- secod_Row_Start -->
                      <form action="<?=base_url('categories/update')?>" method="post" id="validate_form"> 
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                      <div class="col-lg-10 m-auto">
                        <div class="form-group">
                          <label>Category</label>
                          <input type="text" name="id" value="<?=$edit->cat_id?>" hidden>
                          <input type="text" class="form-control form-control-sm" name="category" value="<?=$edit->cat_name?>" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters.">
                         <span><?=form_error('category');?></span>  
                        </div>
                    </div>
                    </div>
                    <div class="row pt-4">

                      <div class="col-lg-10 m-auto">
                        <input type="submit" name="submit" value="Update" class="btn user_invait_btn">
                      </div>
                    </div>
                      </div>
                    </div>
                      </form>
                    <!-- secod_Row_End -->
                </div>
            </div>
            <!--Invite_User_End-->
