  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Ediit_Project_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Create New Project</span>
                        </div>
                       <div class="col-lg-6">
                             <a href="<?=base_url('projects/view_details/'.$edit_user[0]->project_id); ?>" class="btn user_invait_btn float-right">+ Go Back To Project</a>
                        </div>
                    </div>
                     <?='<label class="text-primary">'.$this->session->flashdata("error").'</label>';  ?>
                    <!-- secod_Row_Start -->
                    <form action="<?=base_url('projects/add_team_member')?>" method="post">
                    <div class="row pt-3">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                    <!--  -->
                    <style type="text/css">
                      

/*Select_2_Start*/
.selection{
    width:100%!important;
  }
.select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #00BFFF;
    border: 1px solid #00BFFF;
    color: white;
  }
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    color: white;
  }
.select2-container--default .select2-selection--multiple .select2-selection {
        background-color: #00BFFF;
    border: 1px solid #00BFFF;
    color: white;
  }
.select2-container--default .select2-results__option[aria-selected=true] {
  background-color: #00BFFF!important;
  color: white!important;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #00BFFF!important;
  color: white!important;
}
/*Select_2_End*/

                    </style>
                    <!-- Select -->
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <input type="text" name="id" value="<?=$edit_user[0]->project_id?>" hidden>
                            <label>Employees</label>
                          <select name="users[]" multiple="multiple" class="js-example-basic-multiple" id="exampleFormControlSelect1">
                            <?php foreach($users as $key =>$v):?>
                            <option <?php foreach($edit_user as $key2 => $v2):; if($v2->user_id == $v->user_id ){ echo 'selected="selected"'; }endforeach; ?>  value="<?=$v->user_id?>"><?=$v->name?></option>
                            <?php  endforeach;?>
                          </select>
                          <span><?=form_error('users[]')?></span>
                          </div>
                      </div>
                      </div>
                    <!-- Select -->
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
  });
</script>