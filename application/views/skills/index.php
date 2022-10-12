<html>  
 <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
      <title><?=$title?></title>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />  
    <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

     <!-- Select_2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select_2 -->
      <!--jquerystart-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--jqueryend-->
    <!--parsely validation-->
    <script src="<?=base_url('asset/js/parsely.js')?>"></script>
    <!--parsely validation end-->
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
 </head>  
 <body>  
      <div class="container m-auto"> 
           <br /><br /><br />
            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center"><img src="<?php echo base_url('asset/img/logo.png')?>" width="40%"></div>
                    <div class="col-md-4"></div>
            </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" style="background-color:#1d6077;border-radius:10px;border:4px solid #4fd1fe;">
              <form method="post" action="<?=base_url('skills/add'); ?>" id="validate_form" enctype="multipart/form-data">  
                <br>
                <div class="row">
                  <div class="col-lg-12">
                    <h3 class="text-white">Personal Data</h3>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="text-white">Name</label>
                      <input type="text" class="form-control form-control-sm" name="username" placeholder="Type your name here" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters.">
                      <span><?=form_error('username');?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="text-white">Contact No</label>
                      <input type="number" class="form-control form-control-sm" name="contact_no" placeholder="Type your contact number here" required  data-parsley-trigger="keyup" data-parsley-type="number">
                      <span><?=form_error('contact_no');?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">  
                    <div class="form-group">
                      <label class="text-white">Date Of Birth</label>
                      <input type="text" class="form-control form-control-sm datepicker" name="dob" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                      <span><?=form_error('dob');?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">  
                    <label class="text-white">Image</label>
                    <div class="form-group">
                        <input type="file" name="user_img" class="form-control form-control-sm">
                    </div>
                  </div>  
                </div>
                <div class="row">
                  <div class="col-lg-6">  
                    <div class="form-group">
                      <label class="text-white">CNIC</label>
                      <input type="text" class="form-control form-control-sm" name="cnic" placeholder="Type your cnic number here" required data-parsley-trigger="keyup" data-parsley-required-message="Type your CNIC number.">
                      <span><?=form_error('cnic')?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">  
                    <div class="form-group">
                      <label class="text-white">Address</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Type your address here" rows="3" name="address" required data-parsley-required-message="Type any description here."></textarea>
                      <span><?=form_error('address')?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h3 class="text-white">Skills</h3>
                  </div>
                </div>    
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">  
                              <label class="text-white">Category</label>
                              <select class="form-control form-control-sm" name="category" required data-parsley-required-message="You must select at least one option.">
                                <option selected disabled>select any category</option>
                                <?php if(is_array($cat) || is_object($cat)){ foreach($cat as $key => $v){ if($v->cat_id != null){?>
                                <option value="<?=$v->cat_id?>"><?=$v->cat_name?></option>
                                <?php } } }?>
                              </select> 
                              <span><?=form_error('category');?></span>                 
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="form-group">  
                          <label class="text-white">Skills</label>
                          <select class="form-control form-control-sm js-example-basic-multiple1" name="skills[]" multiple="multiple" id="exampleFormControlSelect1"  required data-parsley-required-message="You must select at least one option.">
                          <?php if(is_array($skills) || is_object($skills)){ foreach($skills as $key => $v){ if($v->is_skill_name != null){?>
                          <option value="<?=$v->is_skill_name?>"><?=$v->is_skill_name?></option>
                          <?php } } }?>
                          </select>   
                          <span><?=form_error('skills[]');?></span>
                        </div>   
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h3 class="text-white">Qualification</h3>
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Degree</label>
                          <input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." >
                          <span><?=form_error('degree[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Grade/CGPA</label>
                          <input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required>
                          <span><?=form_error('grade[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="text-white">Year</label>
                           <input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number">
                          <span><?=form_error('year[]')?></span>          
                        </div>
                      </div>
                      <div class="col-lg-1">
                        <!-- <label> asfa</label> -->
                        <button type="button" class="btn btn-sm btn-success add_morebtn" style="margin-top: 63%;">
                          +
                        </button>
                      </div>
                    </div>
                    <div class="more_fields">
                      
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                          <div class="form-group">  
                            <input type="submit" name="submit" value="Submit" class="btn btn-info" />  
                          </div>
                        </div>
                    </div>
              </form>
            </div> 
            <div class="col-md-1"></div>
        </div>   
      </div>  
       
    <!-- Select_2 -->
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Select_2 -->
    <!--Datepicker-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!--Datepicker-->
 </body>  
 </html>
  <script type="text/javascript">
    $(document).ready(function(){
      //validate form
      $('#validate_form').parsley();
      //datepicker
      $('.datepicker').datepicker(); 
      //select2
      $('.js-example-basic-multiple1').select2({ width: '100%',tags : true,placeholder : 'select or write any skills' });
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
                        '<button type="button" class="btn btn-sm btn-danger remove_morebtn" style="margin-top: 63%;">-'+
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
 