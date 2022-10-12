<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Invite_User_Start -->
            <div class="pr-4 pl-4">
                <div class="container">
                    <div class="row pt-1 pb-1">
                        <div class="col-lg-6">
                            <a class="" style=""></a><span class="Page_Title">Edit Attendance</span>
                        </div>
                       

                    </div>
                    
                    <form action="<?=base_url('attendance/update')?>" method="post" id="validate_form" enctype="multipart/form-data">
                    <div class="row pt-5">
                      <input type="hidden" name="id" value="<?= $data2->attendance_id ?>">
                      <input type="hidden" name="uid" value="<?= $data2->user_id ?>">
                      <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
                        <div class="row">
                      <div class="col-lg-10 m-auto">
                        <div class="form-group">
                          <label>From</label>
                          <input type="text" class="form-control form-control-sm" id="timepicker1" name="from" value="<?= $data2->time_1 ?>" required data-date-format="DD/MM/YYYY">
                        </div>
                        
                        <div class="form-group">
                          <label>To</label>
                          <input type="text" class="form-control form-control-sm" id="timepicker2" name="to" value="<?= $data2->time_2 ?>" required data-date-format="DD/MM/YYYY">
                        </div>
                       

                        <div class="form-group">
                          <label>lates</label>
                          <input type="text" class="form-control form-control-sm late" value="<?= $data2->lates ?>" name="lates" >
                          <input type="hidden" class="form-control form-control-sm" value="<?= $data2->lates ?>" name="lates2">
                        </div>
                        <div class="form-group">
                          <label>Absent</label>
                          <input type="text" class="form-control form-control-sm al absent" name="Absent" value="<?= $data2->absent ?>">
                        </div>
                        <div class="form-group">
                          <label>Leave</label>
                          <input type="text" class="form-control form-control-sm al leave" name="Leave" value="<?= $data2->leave_ ?>">
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
  $(document).on('keyup', '.late', function(){
    alert('You are giving lates Manually , it will not work as per time '); 
    });
  // $(document).on('keyup', '.al', function(){
  //     var a = $('.absent').val();
  //     var b = $('.leave').val();
  //     if (a > 0 ) {
  //       $('.leave').val('0');
  //     }
  //     if (b > 0 ) {
  //       $('.absent').val('0');
  //     }
      
      
  //   });

</script>