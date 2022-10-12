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
                    <form action="<?=base_url('reports/insert_new_report')?>" method="post" id="validate_form">
                    <div class="row pt-5">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

                       <div class="row">
                         <div class="col-lg-4">
                            <div class="form-group">
                              <label>Date</label>
                              <input type="text" class="form-control datepicker" name="report_date" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                          		<span><?=form_error('startDate')?></span>
                            </div>
                         </div>

                         <div class="col-lg-4">
                        <div class="form-group">
                          <label>from</label>
                          <input type="text" class="form-control" id="timepicker1" name="from_time" required>
                          	<span><?=form_error('from_time')?></span>

                        </div>
                    </div>

                    <div class="col-lg-4">
                            <div class="form-group">
                              <label>to</label>
                              <input type="text" class="form-control" id="timepicker2" name="to_time" required>
                          		<span><?=form_error('to_time')?></span>
                            </div>
                    </div>
                        
                       </div>
                  <!-- button_Start -->
                    <div class="row pt-4">

                      <div class="col-lg-12">
                      <button type="button" class="btn user_invait_btn btn-sm float-right add_morebtn">
                        + Description
                      </button>
                      </div>
                    </div>
                  <!-- button_end -->
                  <!-- add -->
                  <div class="extra">
                    <div class="row pt-4 ">
                      <div class="col-lg-7">
                        <div class="form-group">
                          <label>Description of work</label>
                 		 <textarea class="form-control" name="editor1[]" required data-parsley-required-message="Type any description here."></textarea>
                 		 <span><?=form_error('editor1[]')?></span>
                    </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                          <label>Status of the Task</label>
                              <input type="" class="form-control" name="report_status[]" required data-parsley-required-message="Type your description status here.">
                 		 <span><?=form_error('report_status[]')?></span>

                        </div>
                    </div>
                    <div class="col-lg-1">
                    <!--   <button type="button" 
                        class="btn user_invait_btn btn-sm float-right" style="margin-top: 70%">
                        -
                      </button> -->
                    </div>
                  </div>
              </div>
                  <!-- add -->
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

<script type="text/javascript">
	 var count = 1;
      $(document).on('click', '.add_morebtn', function(){
        count++;
        var html = '';
         html+='<div class="row pt-4">'+
                    '<div class="col-lg-7">'+
                        '<div class="form-group">'+
                          	'<label>Description of work</label>'+
                  			'<textarea class="form-control" name="editor1[]" required data-parsley-required-message="Type any description here."></textarea>'+
                 		 '<span><?=form_error('editor1[]')?></span>'+
                    	'</div>'+
                    '</div>'+
                    '<div class="col-lg-4">'+
                      	'<div class="form-group">'+
                          '<label>Status of the Description</label>'+
                              '<input type="text" class="form-control" name="report_status[]"  required data-parsley-required-message="Type your description status here.">'+
                               '<span><?=form_error('report_status[]')?></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-1">'+
                      '<button type="button" class="btn user_invait_btn btn-sm float-right remove" style="margin-top: 70%">'+
                        '-'+
                      '</button>'+
                    '</div>'+
                '</div>';
        $('.extra').append(html);
      });
      //remove additional fields
      $(document).on('click', '.remove', function(){
        $(this).closest('.row').remove();
      });

   

</script>
