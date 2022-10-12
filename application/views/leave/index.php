<?php  
  if($this->session->userdata('user') == 1 || $this->session->userdata('leave_show')==1 || $this->session->userdata('leave_r_show')==1 || $this->session->userdata('leave_p_show')==1)
  {
      if($box > 0)
      {
        $all= ""; $all_btn="";$l="show active";$l_btn="active";$my_btn=""; $my="";
      }
      else if($this->session->userdata('user') == 1 || $this->session->userdata('leave_show')==1)
      {
        $all= "show active "; $all_btn="active";$l="";$l_btn="";$my_btn=""; $my="";
      }
      else if($this->session->userdata('user') == 1 || $this->session->userdata('leave_r_show')==1)
      {
        $all= ""; $all_btn="";$l="show active";$l_btn="active";$my_btn=""; $my="";
      }
      else if($this->session->userdata('user') == 1 || $this->session->userdata('leave_p_show')==1)
      {
        $all= ""; $all_btn="";$l="";$l_btn="";$my_btn="active"; $my="show active";
      }
     
  }
  else
  {
     $all= ""; $all_btn="";$l="";$l_btn="";$my_btn="";$my="";
  }
?>
<link rel="stylesheet" type="text/css" href="<?=base_url('asset/css/error.css');?>" type="text/css">
<!-- Report_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
        <div class="col-lg-6">
            <a class="" style=""></a><span class="Page_Title">Leave</span>
        </div>
    </div>
    <div class="row Project pt-3 pb-3">
        <div class="col-lg-6">
            <?php if($this->session->userdata('leave_create')==1){?>
            <a href="<?=base_url('leave/take_leave'); ?>" class="btn user_invait_btn" style="font-size: 13px">+ Take Leave
            </a>
            <?php } ?>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
              <?php if($this->session->userdata('user') == 1 || $this->session->userdata('leave_show')==1){?>
              <li class="nav-item mr-2">
                <a class="nav-link Project_Id_btn <?=$all_btn?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
              </li>
              <?php } if($this->session->userdata('user') == 1 || $this->session->userdata('leave_r_show')==1){ ?>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn <?=$l_btn?>" id="pills-my-tab" data-toggle="pill" href="#pills-mytab" role="tab" aria-controls="pills-mytab" aria-selected="false">Leaves</a>
              </li>
              <?php } if($this->session->userdata('leave_p_show')==1){?>
              <li class="nav-item">
                <a class="nav-link Project_Id_btn <?=$my_btn?>" id="pills-my-timesheet" data-toggle="pill" href="#pills-mytimesheet" role="tab" aria-controls="pills-mytimesheet" aria-selected="false">My leaves</a>
              </li>
              <?php } ?>
          </ul>
        </div>
    </div>
      <?php if($this->session->flashdata("errorleave")){?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?=$this->session->flashdata("errorleave")?>
      </div>
      <?php } ?>
    <!-- secod_Row_Start -->
    <div class="row pt-2">
      <div class="col-lg-12">
        <div class="tab-content" id="pills-tabContent">
          <!--allstart-->
          <div class="tab-pane fade <?=$all?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-lg-12 mt-1 pt-1" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important; overflow-x:auto;">
                	<table id="example" class="table table-striped table-bordered " style="width:100%">
				        <thead>
				            <tr>
				                <th>SNo.</th>
                        <th>Name</th>
				                <th>Status</th>
                        <th>With Pay</th>
                        <th>Without Pay</th>
                        <th>Approved</th>
				                <th>Reject</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
                    <?php if(is_array($users) || is_object($users)){ $sno=1;$i=0; foreach($users as $key => $v){?>
				            <tr>
				                <td><?=$sno?></td>
                        <td><?=$v->name?></td>
                        <td><?=$v->status_n?></td>
                        <td><?=$t_leaves[$i][0]['with_pay']?></td>
                        <td><?=$t_leaves[$i][0]['without_pay']?></td>
                        <td><?=$t_leaves[$i][0]['app_leave']?></td>
				                <td><?=$t_leaves[$i][0]['rej_leave']?></td>
				                <td>
				                	<a href="#" class="btn btn-sm user_invait_btn vleaves" data="<?=$v->user_id?>">+ View</a>
				                </td>
				            </tr>
                    <?php $i++;$sno++; }} ?>
				        </tbody>
				    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--allend-->
          <!--leavestart--> 
          <div class="tab-pane fade <?=$l?>" id="pills-mytab" role="tabpanel" aria-labelledby="pills-my-tab">
            <div class="row">
              <div class="col-lg-12 mt-1 pt-1" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                  <table id="example1" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                        <tr>
                            <th>SNo.</th>
                            <th>Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Leave Days</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($leaves) || is_object($leaves)){ $i=1; foreach($leaves as $key => $v){?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$v->name?></td>
                            <td><?=date('d-m-Y',strtotime($v->from_date));?></td>
                            <td><?=date('d-m-Y',strtotime($v->to_date));?></td>      
                            <td><?=$v->leave_days?></td>
                            <td><?=$v->reason_of_leave?></td>
                            <td><?=$v->status_n?></td>
                            <td>
                              <?php if($this->session->userdata('user')==1 || $this->session->userdata('leave_app')==1){?>
                              <a href="#" class="btn btn-sm user_invait_btn approve" data="<?=$v->leave_id?>">+ Approve</a>
                              <?php }if($this->session->userdata('user')==1 || $this->session->userdata('leave_rej')==1){?>
                              <a href="#" class="btn btn-sm user_invait_btn reject" data="<?=base_url('leave/reject_leave_dates/'.$v->leave_id)?>">+ Reject</a>
                              <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; } }?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
          </div>  
          <!--leaveend--> 
          <!--myleavestart--> 
          <div class="tab-pane fade <?=$my?>" id="pills-mytimesheet" role="tabpanel" aria-labelledby="pills-my-timesheet">
            <div class="row">
              <div class="col-lg-12 mt-1 pt-1" style="padding-right: 3%">
                <div class="row">
                  <div class="col-lg-12 card p-4 bn" style="border-top:2px solid #4fd1fe!important">
                    <?php if(is_array($users) || is_object($users)){ $i=0; foreach($users as $key => $v){if($this->session->userdata('id') == $v->user_id){?>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-2"></div> 
                          <div class="col-lg-3 text-center" style="background-color: #f5f5f5;">
                            <div class="row">
                              <div class="col-lg-12">
                                <?php if($v->img == null){ $img=base_url('uploads/users/default.png');}else{ $img=base_url('uploads/users/'.$v->img);} ?>
                                <img class="img-fluid rounded-circle" src="<?= $img ?>" style="width: 100px;">
                              </div>
                            </div>
                            <div class="row">  
                              <div class="col-lg-12">
                                <p class="Right_Togel_Drop_Item_1_Sub_3 m-0 text-dark" style="font-size: 9px;">(<?=$v->designation?>)</p>
                                <p class="light_color m-0 ml-2" style="font-size: 13px;font-weight: bold;">
                                  <?=$v->name?>
                                </p>
                              </div>
                            </div>
                            <div class="row mb-2">
                              <div class="col-lg-12">
                                <a class="Right_Togel_Drop_Item_1_Sub_3 bg-info text-white"><?=$v->status_n?></a>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-5" style="background-color: #f5f5f5;">
                            <div class="row mt-3">
                              <div class="col-lg-6">
                                <p class="text-info text-center m-0" style="font-size: 16px;font-weight: bold;">With Pay</p>
                                <p class="light_color text-center" style="font-size: 13px;font-weight: bold">
                                  <?=$t_leaves[$i][0]['with_pay']?>
                                </p>
                              </div>
                              <div class="col-lg-6">
                                <p class="text-info text-center m-0" style="font-size: 16px;font-weight: bold;">Without Pay</p>
                                <p class="light_color text-center" style="font-size: 13px;font-weight: bold">
                                  <?=$t_leaves[$i][0]['without_pay']?>
                                </p>
                              </div>
                            </div>
                            <div class="row mt-3">  
                              <div class="col-lg-6">
                                <p class="text-info text-center m-0" style="font-size: 16px;font-weight: bold;">Approve leave</p>
                                <p class="light_color text-center" style="font-size: 13px;font-weight: bold">
                                  <?=$t_leaves[$i][0]['app_leave']?>
                                </p>
                              </div>
                              <div class="col-lg-6">
                                <p class="text-info text-center m-0" style="font-size: 16px;font-weight: bold;">Reject Leave</p>
                                <p class="light_color text-center" style="font-size: 13px;font-weight: bold">
                                  <?=$t_leaves[$i][0]['rej_leave']?>
                                </p>
                              </div>
                            </div>
                          </div> 
                          <div class="col-lg-2"></div> 
                        </div>
                      </div>
                    </div>  
                    <?php }$i++;}} ?>  
                  </div>
                </div>
              </div>
            </div>
          </div>  
          <!--myleaveend--> 
      </div>

    </div>
  </div>
</div>        

<!--deletemodalstart-->
<div class="modal fade" id="viewleaves" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">Leaves</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>All leaves given below.</p>
      	<table class="table table-striped table-bordered" style="width:100%">
          <thead> 
        		<tr>
        			<th>SNo.</th>
        			<th>Date</th>
        			<th>Action</th>
        		</tr>
          </thead>
          <tbody id="viewAllLeaves">
          </tbody>
      	</table>
      </div>
      <div class="modal-footer float-left">     
        <button type="button" class="btn btn-sm user_invait_btn" data-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>
<!--deletemodalend-->
<!--approvedmodalstart-->
<div class="modal fade" id="appleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"> Approve Leave </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="<?=base_url('leave/approve_leave_dates')?>" method="post">
          <div class="modal-body">
         		<p>Checked your approved date leaves.</p>
  	      	<table class="table table-striped table-bordered" style="width:100%">
              <thead> 
                <tr>
                  <th>SNo.</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="allleavedates">
              </tbody>
            </table>
          </div>
          <div class="modal-footer"> 
            <input type="submit"  class="btn btn-sm user_invait_btn" value="submit">
            <button type="button" class="btn btn-sm user_invait_btn" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!--approvedmodalend-->
<!--rejectemodalstart-->
<div class="modal fade" id="rejectleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">  Are You Sure You Want to Reject ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">
      	<a href="" class="btn btn-sm user_invait_btn rjyes">Yes</a>   
        <button type="button" class="btn btn-sm user_invait_btn" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!--rejectmodalend-->
<script type="text/javascript">
  $('.approve').click(function(){
     var id = $(this).attr('data');
    //  alert(id);
     $('#appleave').modal('show');
     $.ajax({
        url : '<?=base_url('leave/get_leave_dates')?>',
        data : {id:id},
        method : 'post',
        dataType : 'json',
        success : function(data)
        {
          // document.write(data);
          console.log(data);
          var i;
          var html = '';
          var sno = 1;
          // alert(html);
          for (i=0;i<data.length;i++)
          {
            // console.log(data);
            html+='<tr>'+
                      '<td>'+sno+'</td>'+
                      '<td>'+data[i].leave_date+'</td>'+
                      '<td class="cltd">'+
                        '<input type="hidden" name="id[]" value="'+data[i].leave_date_id+'">'+
                        '<input type="text" value="without pay" class="form-control txtid text-center clicked btn-danger w-50" style="cursor:pointer;color:white;font-size:14px;background:#e74a3b;border:none;" readonly>'+
                        '<input type="hidden" class="stt" name="st[]" value="1">'+
                        '<input type="hidden" name="leave_id" value="'+data[i].leave_id+'">'+
                      '</td>'+
                    '</tr>'; 
            sno++;          
          }
          // alert(html);
          $('#allleavedates').html(html);
           
        }
     });
  });
  $(document).on('click','.txtid',function() {
    if($(this).hasClass("clicked"))
    {
        $(this).val("with pay");
        $(this).closest('.cltd').find('.stt').val('2');
        $(this).removeClass("clicked");
        $(this).removeClass("btn-danger");
        $(this).addClass("btn-success");
        $(this).css("background","#1cc88a");
    }
    else
    {
        $(this).val("without pay");
        $(this).closest('.cltd').find('.stt').val('1');
        $(this).addClass("clicked");
        $(this).removeClass("bg-success");
        $(this).addClass("btn-danger");
        $(this).css("background","#e74a3b");
    }
  });
  $('.reject').click(function(){

    var url = $(this).attr('data');
    $('#rejectleave').modal('show');
    $('.rjyes').prop('href',url);
  })
  $('.vleaves').click(function(){
    var id = $(this).attr('data');
    $('#viewleaves').modal('show');
    $.ajax({
      url : '<?=base_url('leave/getAllLeaveDates')?>',
      method : 'post',
      data : {id:id},
      dataType : 'json',
      success:function(data)
      {
        var l = data.leaves;
        var tl = data.t_leaves;
        var i,q;
        var html = '';
        if(l.length == null || l.length == '')
        {
           html+='<tr>'+
                      '<td>No record found</td>'+
                      '<td></td>'+
                      '<td></td>'+
                    '</tr>'; 
        }
        else
        {
          var sno=1;
          for(q=0;q<l.length;q++)
          {
            for(i=0;i<tl[q].length;i++)
            {
              if(tl[q][i].leave_date_status == 1)
              {
                  var st = 'without pay';
              }
              else
              {
                  var st = 'with pay';

              }
              html+='<tr>'+
                      '<td>'+sno+'</td>'+
                      '<td>'+tl[q][i].leave_date+'</td>'+
                      '<td>'+st+'</td>'+
                    '</tr>'; 
              sno++;
            }
          }
        }
          $('#viewAllLeaves').html(html);
      }
    });
  })
 
</script>