
<?php  
  if($this->session->userdata('user')==1 || $this->session->userdata('attendance_show')==1)
  {
     $all= "show active "; $all_btn="active";$my_btn=""; $my="";
  }
  else if($this->session->userdata('user') == 1 || $this->session->userdata('attendance_p_show')==1)
  {
     $all= ""; $all_btn="";$my_btn="active"; $my="show active";
  }
  else
  {
     $all= ""; $all_btn="";$my_btn=""; $my=""; $ts=""; $ts_btn="";
  }
?>
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Report_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Attendance</span>
        </div>
    </div>

    <div class="row Project pt-3 pb-3">
        <div class="col-lg-6">
          <?php if($this->session->userdata('report_create')==1){?>
            <a href="<?=base_url('reports/new_report'); ?>" class="btn user_invait_btn" style="font-size: 13px">+ New Report
            </a>
          <?php } ?>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
            <?php if($this->session->userdata('user')==1 || $this->session->userdata('attendance_show')==1){?>
              <li class="nav-item mr-2">
                <a class="nav-link Project_Id_btn <?=$all_btn?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
              </li>
              <?php } if($this->session->userdata('user')!=1){?>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn <?=$my_btn?>" id="pills-my-tab" data-toggle="pill" href="#pills-mytab" role="tab" aria-controls="pills-mytab" aria-selected="false">My Attendance</a>
              </li>
              <?php } ?>
          </ul>
        </div>
    </div>
    <?php if($this->session->userdata('user')==1 || $this->session->userdata('attendance_search')==1){ ?>
    <form action="<?=base_url('Attendance/daterange')?>" method="post">
      <div class="row mt-2">
          <div class="col-4"></div>
          <div class="col-2">
              <div class="form-group">
                <label>From</label>
                <input type="text" class="form-control datepicker" name="from" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                <span><?=form_error('startDate')?></span>
              </div>
          </div>
          <div class="col-2">  
              <div class="form-group">
                <label>To</label >
                <input type="text" class="form-control datepicker" name="to" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                <span><?=form_error('startDate')?></span>
              </div>
          </div>
          <div class="col-2" style="margin-top: 28px!important;">
            <input type="submit" name="daterange" class="btn user_invait_btn confirm pop_up" value="Submit">
          </div>
          <div class="col-2"></div>
      </div>
    </form>
    <?php } ?>
    <!-- secod_Row_Start -->
    <div class="row pt-2">
      <div class="col-lg-12">
        <div class="tab-content" id="pills-tabContent">
          <!--allreportstart-->
          <div class="tab-pane fade <?=$all?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-lg-12 mt-1" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important;">
                    <div class="container">
                      <table id="example" class="table table-striped table-bordered " style="width:100%;">
                          <thead>
                              <tr>
                                  <th>Serial No</th>
                                  <th>Name</th>
                                  <th>Late</th>
                                  <th>Absent</th>
                                  <th>Leave</th>
                                  <th>Salary</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $i=0; foreach ($users as $v){?>
                              <tr>
                                <td><?=$i+1?></td>
                                <td><?=$v->name?></td>
                                <td><?=$tot_atd[$i]->lates?></td>
                                <td><?=$tot_atd[$i]->absents?></td>
                                <td><?=$tot_atd[$i]->leaves?></td>
                                <?php
                                if ($tot_atd[$i]->lates <= '2' ) {
                                  $salary = 0;
                                }
                                if ($tot_atd[$i]->absents != '0') {
                                    $spd = 10000/date("t");
                                    $spd = $spd*$tot_atd[$i]->absents; 
                                }
                                else{
                                  $spd=0;
                                }
                                
                                  $latesow = $tot_atd[$i]->lates*50;
                                  $salary = round(10000-$latesow-$spd);
                                
                                

                                 ?>
                                <td><?= $salary;?></td>
                                <td><a href="#" class="button btn view" data ='<?=$v->user_id?>' >View</a></td>
                              </tr>
                            <?php $i++;}?>
                          </tbody>
                      </table>
                    </div>          
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--allreportend-->
          <!--myreportstart--> 
          <div class="tab-pane fade <?=$my?>" id="pills-mytab" role="tabpanel" aria-labelledby="pills-my-tab">
            <div class="row">
              <?php $i=0; foreach ($users as $v){if($this->session->userdata('id') == $v->user_id){if($v->img == null){ $img=base_url('uploads/users/default.png');}else{ $img=base_url('uploads/users/'.$v->img);}?>
              <div class="col-lg-6 mt-3 pt-5" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="rounded-circle User_Box_img" src="<?=$img ?>"width="25%" style="border: 5px solid #dee2e6; margin-top:-72px">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-12 text-center"> 
                            <a class="Project_Title_Color"><?=$v->name?></a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3"> 
                             <h6 class="light_color">Lates </h6>
                            </div>
                            <div class="col-lg-3">
                              <h6 class="light_color">Absent</h6>
                            </div>
                            <div class="col-lg-3">
                              <h6 class="light_color">Leave</h6>
                            </div>
                            <div class="col-lg-3">
                              <h6 class="light_color">Salary</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"> 
                             <h6 class="light_color"><?= $tot_atd[$i]->lates?> </h6>
                            </div>
                            <div class="col-lg-3">
                              <h6 class="light_color"><?= $tot_atd[$i]->absents?></h6>
                            </div>
                            <div class="col-lg-3">
                              <h6 class="light_color"><?= $tot_atd[$i]->leaves?></h6>
                            </div>
                            <div class="col-lg-3">
                               <?php
                                if ($tot_atd[$i]->lates <= '2' ) {
                                  $salary = 0;
                                }
                                if ($tot_atd[$i]->absents != '0') {
                                    $spd = 10000/date("t");
                                    $spd = $spd*$tot_atd[$i]->absents; 
                                }
                                else{
                                  $spd=0;
                                }
                                
                                  $latesow = $tot_atd[$i]->lates*50;
                                  $salary = round(10000-$latesow-$spd);
                                ?>
                              <h6 class="light_color"><?= $salary;?></h6>
                            </div>
                        </div>
                      </div>
                    </div>                 
                  </div>
                </div>
              </div>
              <?php }$i++;} ?>
            </div>
          </div>  
          <!--myreportend-->
      </div>

    </div>
  </div>
</div> 
<!-- viewdetailsmodal  -->
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Attendance details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Serial No</th>
                  <th>From</th>
                  <th>To</th>
                  <th>DateTime</th>
                  <th>Lates</th>
                  <th>Absent</th>
                  <th>Leave</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="vdetails">
              </tbody>
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- viewdetailsmodal -->
<script type="text/javascript">
  
  $('.view').click(function(){
    var id=$(this).attr('data');
    $.ajax({
      url : "<?=base_url('attendance/getAtdDetails')?>",
      data : {id:id},
      method : 'post',
      dataType : 'json',
      success:function(data)
      {
        $('#myModal').modal('show');
        var i;
        var html='';
        var sno=1;
         
        for(i=0;i<data.length;i++)
        {
          html+='<tr>'+
                  '<td>'+sno+'</td>'+
                  '<td>'+data[i].time_1+'</td>'+
                  '<td>'+data[i].time_2+'</td>'+
                  '<td>'+data[i].attendance_datetime+'</td>'+
                  '<td>'+data[i].lates+'</td>'+
                  '<td>'+data[i].absent+'</td>'+
                  '<td>'+data[i].leave_+'</td>'+
                  '<td><a href="<?=base_url('attendance/editAtdRow/')?>'+data[i].attendance_id+'" class="btn btn-success">Edit</a></td>'+
                '</tr>';
            sno++;
        }               
        
        $('#vdetails').html(html);
      }
    });
  })

</script>     