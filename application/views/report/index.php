
<?php  
if($this->session->flashdata('errorreportsheet'))
{
    $all= " "; $all_btn="";$my_btn="";  $my=""; $ts="show active"; $ts_btn="active";
}
else
{
  if($this->session->userdata('user')==1 || $this->session->userdata('report_show')==1)
  {
     $all= "show active "; $all_btn="active";$my_btn=""; $my=""; $ts=""; $ts_btn="";
  }
  else if($this->session->userdata('user') == 1 || $this->session->userdata('report_p_show')==1)
  {
     $all= ""; $all_btn="";$my_btn="active"; $my="show active";$ts=""; $ts_btn="";
  }
  else if($this->session->userdata('user') == 1 || $this->session->userdata('report_wh')==1)
  {
     $all= ""; $all_btn="";$my_btn=""; $my="";$ts="show active"; $ts_btn="active";
  }
  else
  {
     $all= ""; $all_btn="";$my_btn=""; $my=""; $ts=""; $ts_btn="";
  }
}?>
  <link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Report_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Report</span>
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
              <?php if($this->session->userdata('user')==1 || $this->session->userdata('report_show')==1){?>
              <li class="nav-item mr-2">
                <a class="nav-link Project_Id_btn <?=$all_btn?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn " id="pills-profiles-tab" data-toggle="pill" href="#pills-profiles" role="tab" aria-controls="pills-profiles" aria-selected="false">Users</a>
              </li>
              <?php } if($this->session->userdata('report_p_show')==1){?>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn <?=$my_btn?>" id="pills-my-tab" data-toggle="pill" href="#pills-mytab" role="tab" aria-controls="pills-mytab" aria-selected="false">My report</a>
              </li>
              <?php } if($this->session->userdata('user')==1 || $this->session->userdata('report_wh')==1){?>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn <?=$ts_btn?>" id="pills-my-timesheet" data-toggle="pill" href="#pills-mytimesheet" role="tab" aria-controls="pills-mytimesheet" aria-selected="false">Timesheet</a>
              </li>
              <?php } ?>
          </ul>
        </div>
    </div>
    <?php if($this->session->userdata('user')==1 || $this->session->userdata('report_search')==1){ ?>
    <form action="<?=base_url('reports/getDateRangeReports')?>" method="post">
      <div class="row mt-2">
          <div class="col-4"></div>
          <div class="col-2">
              <div class="form-group">
                <label>From</label>
                <input type="text" class="form-control datepicker" name="fromDate" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                <span><?=form_error('startDate')?></span>
              </div>
          </div>
          <div class="col-2">
              <div class="form-group">
                <label>To</label>
                <input type="text" class="form-control datepicker" name="toDate" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
                <span><?=form_error('startDate')?></span>
              </div>
          </div>
          <div class="col-2" style="margin-top: 28px!important;">
            <input type="submit" name="submit" class="btn user_invait_btn confirm pop_up" value="Submit">
          </div>
          <div class="col-2"></div>
      </div>
    </form>
    <?php } ?>
    <!-- secod_Row_Start -->
    <div class="row pt-5">
      <div class="col-lg-12">
        <div class="tab-content" id="pills-tabContent">
          <!--allreportstart-->
          <div class="tab-pane fade <?=$all?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <?php if(is_array($reports) || is_object($reports)){ $i=0; foreach($reports as $key => $v):;if($v->img == null){ $img=base_url('uploads/users/default.png');}else{ $img=base_url('uploads/users/'.$v->img);}?>
              <div class="col-lg-6 mt-3 pt-5" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="rounded-circle User_Box_img" src="<?=$img ?>"width="25%" style="border: 5px solid #dee2e6; margin-top:-72px">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6"> 
                            <a class="Project_Title_Color"><?=$v->name?></a>
                          </div>
                          <div class="col-lg-6">
                            <a class="light_color" style="font-size: 13px;">
                              Date:-<?= date('d-m-Y',strtotime($v->report_date));?>
                            </a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-4"> 
                            <a class="Right_Togel_Drop_Item_1_Sub_3 bg-info text-white"><?=$v->status_n?></a>
                          </div>
                          <div class="col-lg-8 text-center">
                            <a class="light_color" style="font-size: 13px;">
                              From:<?=$v->from_time;?> To:<?=$v->to_time;?>
                            </a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8"> 
                             <h5 class="light_color">Report </h5>
                            </div>
                            <div class="col-lg-4">
                                <h6 class="light_color">Status</h6>
                            </div>
                        </div>
                        <div class="row">
                          <?php foreach($r_descriptions[$i] as $key => $v):?>
                            <div class="col-lg-8"> 
                              <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                <?=$v->report_description?>
                              </p>
                            </div>
                            <div class="col-lg-4">
                                <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                  <?=$v->report_status?> 
                                </p>
                            </div>
                          <?php endforeach;?>
                        </div>
                      </div>
                    </div>                 
                  </div>
                </div>
              </div>
              <?php $i++; endforeach;}?>
            </div>
          </div>
          <!--allreportend-->
          <!--allmanagementstaffreportstart--> 
          <div class="tab-pane fade card p-5" id="pills-profiles" role="tabpanel" aria-labelledby="pills-profiles-tab">
            <div class="row ">
              <div class="col-2 Project">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php if(is_array($users) || is_object($users)){ foreach($users as $key => $v):?>
                    <a class="nav-link" id="v-pills-profile-tab<?=$v->user_id?>" data-toggle="pill" href="#v-pills-profile<?=$v->user_id?>" role="tab" aria-controls="v-pills-home" aria-selected="true"><?=$v->name?></a>
                     <?php endforeach;}else{?>
                                    <p class="User_Box_Txt">
                                        <span class="light_color Bold">No record found...!</span>  
                                    </p>
                                  <?php } ?>
                </div>    
              </div>

              <div class="col-10 pr-4 pl-4 ">
                <div class="tab-content" id="v-pills-tabContent">
                  <?php if(is_array($users) || is_object($users)){ foreach($users as $keyu => $vu):;?>
                  <div class="tab-pane fade" id="v-pills-profile<?=$vu->user_id?>" role="tabpanel" aria-labelledby="v-pills-profile-tab<?=$vu->user_id?>">
                    <div class="row">
                      <?php $i=0; foreach($reports as $key => $v):;if($v->user_id == $vu->user_id){if($v->img == null){ $img=base_url('uploads/users/default.png');}else{ $img=base_url('uploads/users/'.$v->img);}?>
                      <div class="col-lg-6 mt-3 pt-5" style="padding-right: 3%">
                        <div class="row">
                          <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important;background-color: #f9f9f9!important;">
                            <div class="row">
                              <div class="col-lg-12 text-center">
                                <img class="rounded-circle User_Box_img" src="<?=$img ?>"width="25%" style="border: 5px solid #dee2e6; margin-top:-72px">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="row">
                                  <div class="col-lg-6"> 
                                    <a class="Project_Title_Color"><?=$v->name?></a>
                                  </div>
                                  <div class="col-lg-6">
                                    <a class="light_color" style="font-size: 13px;">
                                      Date:-<?= date('d-m-Y',strtotime($v->report_date));?>
                                    </a>
                                  </div>
                                </div>  
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="row">
                                  <div class="col-lg-5"> 
                                    <a class="Right_Togel_Drop_Item_1_Sub_3 bg-info text-white"><?=$v->status_n?></a>
                                  </div>
                                  <div class="col-lg-7 text-center">
                                    <a class="light_color" style="font-size: 13px;">
                                      From:<?=$v->from_time;?> To:<?=$v->to_time;?>
                                    </a>
                                  </div>
                                </div>  
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8"> 
                                     <h5 class="light_color">Report </h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <h6 class="light_color">Status</h6>
                                    </div>
                                </div>
                                <div class="row">
                                  <?php foreach($r_descriptions[$i] as $key => $v):?>
                                    <div class="col-lg-8"> 
                                      <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                        <?=$v->report_description?>
                                      </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                          <?=$v->report_status?>
                                        </p>
                                    </div>
                                  <?php endforeach;?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $i++;}endforeach;?>
                    </div>
                  </div>
                  <?php endforeach;}?>
                </div>
              </div>
            </div>
          </div>  
          <!--allmanagementstaffreportend--> 
          <!--myreportstart--> 
          <div class="tab-pane fade <?=$my?>" id="pills-mytab" role="tabpanel" aria-labelledby="pills-my-tab">
            <div class="row">
              <?php if(is_array($reports) || is_object($reports)){ $i=0; foreach($reports as $key => $v):;if($this->session->userdata('id') == $v->user_id){if($v->img == null){ $img=base_url('uploads/users/default.png');}else{ $img=base_url('uploads/users/'.$v->img);}?>
              <div class="col-lg-6 mt-3 pt-5" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="rounded-circle User_Box_img" src="<?=$img ?>"width="25%" style="border: 5px solid #dee2e6; margin-top:-72px">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6"> 
                            <a class="Project_Title_Color"><?=$v->name?></a>
                          </div>
                          <div class="col-lg-6">
                            <a class="light_color" style="font-size: 13px;">
                              Date:-<?= date('d-m-Y',strtotime($v->report_date));?>
                            </a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-4">
                            <a class="Right_Togel_Drop_Item_1_Sub_3 bg-info text-white"><?=$v->status_n?></a>
                          </div>
                          <div class="col-lg-8 text-center">
                            <a class="light_color" style="font-size: 13px;">
                              From:<?=$v->from_time;?> To:<?=$v->to_time;?>
                            </a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8"> 
                             <h5 class="light_color">Report </h5>
                            </div>
                            <div class="col-lg-4">
                                <h6 class="light_color">Status</h6>
                            </div>
                        </div>
                        <div class="row">
                          <?php foreach($r_descriptions[$i] as $key => $v):?>
                            <div class="col-lg-8"> 
                              <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                <?=$v->report_description?>
                              </p>
                            </div>
                            <div class="col-lg-4">
                                <p class="light_color pt-3 pb-2" style="font-size: 13px;">
                                  <?=$v->report_status?>
                                </p>
                            </div>
                          <?php endforeach;?>
                        </div>
                      </div>
                    </div>                 
                  </div>
                </div>
              </div>
              <?php $i++;}endforeach;}?>
            </div>
          </div>  
          <!--myreportend-->
          <!--timmesheetstart--> 
          <div class="tab-pane fade card p-5 <?=$ts?>" id="pills-mytimesheet" role="tabpanel" aria-labelledby="pills-my-timesheet">
            <div class="row ">
              <div class="col-6 pr-4 pl-4 ">
                <div class="row">
                  <div class="col-lg-12" style="padding-right: 3%">
                    <div class="row">
                      <div class="col-lg-12 card p-2 bn" style="border-top:2px solid #4fd1fe!important">
                        <p class="ml-2">Timesheet</p>
                        <div class="container">
                          <form action="<?=base_url('reports/getusersHours')?>" method="post" id="validate_form">
                            <div class="row">
                              <div class="col-lg-10 m-auto card" style="border:none">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Start Date</label>
                                      <input type="text" class="form-control datepicker" name="startDate" required  placeholder="DD/MM/YYYY"
                                    data-date-format="DD/MM/YYYY"/>
                                      <span><?=form_error('startDate')?></span>
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control datepicker" name="endDate" required  placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" >
                                        <span><?=form_error('endDate')?></span>
                                      </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label>Status</label>
                                      <select class="form-control sel_status" id="exampleFormControlSelect1" name="status" required data-parsley-required-message="You must select at least one option.">
                                        <option selected disabled>select status</option>
                                        <?php foreach($types as $v){?>
                                        <option value="<?=$v->role_id?>"><?=$v->role_name?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row sel_user" style="display: none;">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label>Select User(If you check this users working hours)</label>
                                      <select class="form-control sel_user_id" id="exampleFormControlSelect1" name="sel_user">
                                       
                                      </select>
                                    </div>
                                  </div>                                    
                                </div>
                                <div class="row pt-4">
                                  <div class="col-lg-12">
                                    <input type="submit" name="submit" class="btn user_invait_btn confirm pop_up" value="Submit">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="col-6 pr-4 pl-4 ">
                <div class="row">
                  <div class="col-lg-12" style="padding-right: 3%">
                    <div class="row">
                      <div class="col-lg-12 card p-2 bn" style="border-top:2px solid #4fd1fe!important">
                        <p class="ml-2">Working hours</p>
                          <div class="container">
                            <table id="example" class="table table-striped table-bordered " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Name</th>
                                        <th>Hours</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if(@$total_hours != null){$sno=1;$n=0; foreach($total_hours as $Key => $v):?>
                                    <tr>
                                      <td><?=$sno?></td>
                                      <td><?=$report_users[$n]->name?></td>
                                      <td><?=date('h:i:s', $v)?></td>
                                      <?php 
                                        if($report_users[$n]->status == 0)
                                        {
                                          $status = "Employee";
                                        }
                                        else
                                        {
                                          $status = "Coordiniter";
                                        } 
                                      ?>
                                      <td><?=$status?></td>
                                    </tr>
                                  <?php $n++; $sno++; endforeach;}else{?>
                                    <tr>
                                      <td>No record found..</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                  <?php } ?>  
                                </tbody>
                            </table>
                          </div>
                    
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          <!--timesheetend-->
      </div>

    </div>
  </div>
</div>  





<script type="text/javascript">
$('.sel_status').change(function(){
  var id  = $(this).val();
  $.ajax({
    url : "<?=base_url('reports/get_selected_Status_Users')?>",
    data : {id : id},
    method : "POST",
    dataType : 'json',
    success : function(data)
    {
      console.log(data);
      if(data.length>0)
      {
          var i;
          var html = '';
          html ='<option selected disabled>select user</option>';
          for(i=0;i<data.length;i++)
          {
              html +='<option value="'+data[i].user_id+'">'+data[i].name+'</option>';
          }
          $('.sel_user').css('display','block');
          $('.sel_user_id').html(html);
      }
        
    }
  }); 
}) 
</script>
       