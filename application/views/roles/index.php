<style type="text/css">
    /*.Category_Tabel .dataTables_paginate{
        padding-top: 4%;
        padding-bottom: 4%;
    }*/
    .Category_Tabel .page-item.active .page-link{
        box-shadow: 0 2px 6px #a4e6fc;
    background-color: #4fd1fe;
    border-color: #3acbfc;
    color: white;
    }
    .Category_Tabel .page-item.active .page-link:hover{
    color: white;
    background-color: #00bfff !important;
    }
</style>
<!-- Category_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
          <a class="" style=""></a><span class="Page_Title">Roles</span>
      </div>
      <div class="col-lg-6">
          <a href="<?=base_url('roles/insert_form'); ?>" 
           class="btn user_invait_btn float-right">+ Create New Role</a>
      </div>
    </div>
      <!-- secod_Row_Start -->
    <div class="row pt-5">
      <div class="col-lg-12  card pt-5 pb-5">
          <div class="row">
              <div class="col-lg-12 Category_Tabel ">
                  <!--show alert-->
                    <?php if($this->session->flashdata('errorrole')){?>
                    <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?=$this->session->flashdata('errorrole');?>
                    </div>
                    <?php } ?>
          <table id="example" 
          class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Role Name</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($roles) || is_object($roles)){ $i=1; foreach($roles as $Key => $v):?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $v->role_name ?></td>
                <td class="d-flex justify-content-center mobile_view_setting-gap" style="gap:20px;">
                    <?=anchor("roles/edit/{$v->role_id} ",'<i class="fas fa-pencil-alt"></i>')?>
                    <a href="" data-toggle="modal" data-target="#myModalrole" class="delrole"  data="<?=$v->role_id?>"><i class="fas fa-trash"></i></a>
                    <a href=""data-toggle="modal" data-target="#myModalrolep" class="viewrole"  data="<?=$v->role_id?>"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
          <?php  $i++;endforeach;}?>
        </tbody>
    </table>
      </div>
          </div>
      </div>
    </div> 
      <!-- secod_Row_End -->
  </div>
</div>
            <!--Category_End-->


          <!-- Modal -->


<div class="modal fade" id="myModalrole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">  Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">

        <form action="<?=base_url('roles/delete')?>" method="post">        
            <input type="text" name="del" class="dels" hidden>
        <input type="submit" name="submit" value="Yes" class="btn user_invait_btn">
        </form>

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>            
<div class="modal fade" id="myModalrolep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">Permissions</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="viewPermissions"></div>
      </div>
      <div class="modal-footer float-left">

        <button type="button" class="btn user_invait_btn" data-dismiss="modal" >No</button>
      </div>
    </div>
  </div>
</div>            
<script type="text/javascript">
  $('.delrole').click(function(){
      var id = $(this).attr('data'); 
      $('.dels').val(id);
  });
   $('.viewrole').click(function(){
      var id = $(this).attr('data'); 
      $.ajax({
        url : '<?= base_url('roles/getPermissions')?>',
        method : 'post',
        data : {id:id},
        dataType : 'json',
        success:function(data)
        {
          console.log(data);
        
        //   return false;
          var i;
          var html ='';
            if(data[0].p_status == 0)
            {
              var v0 = 'No';
            }
            else
            {
              var v0 = 'Yes';
            }
            if(data[1].p_status == 0)
            {
              var v1 = 'No';
            }
            else
            {
              var v1 = 'Yes';
            }
            if(data[2].p_status == 0)
            {
              var v2 = 'No';
            }
            else
            {
              var v2 = 'Yes';
            }
            if(data[3].p_status == 0)
            {
             var v3 = 'No';
            }
            else
            {
              var v3 = 'Yes';
            }
            if(data[4].p_status == 0)
            {
              var v4 = 'No';
            }
            else
            {
              var v4 = 'Yes';
            }
            if(data[5].p_status == 0)
            {
             var v5 = 'No';
            }
            else
            {
              var v5 = 'Yes';
            }
            if(data[6].p_status == 0)
            {
              var v6 = 'No';
            }
            else
            {
              var v6 = 'Yes';
            }
            if(data[7].p_status == 0)
            {
              var v7 = 'No';
            }
            else
            {
              var v7 = 'Yes';
            }
            if(data[8].p_status == 0)
            {
             var v8 = 'No';
            }
            else
            {
              var v8 = 'Yes';
            }
            if(data[9].p_status == 0)
            {
             var v9 = 'No';
            }
            else
            {
              var v9 = 'Yes';
            }
            if(data[10].p_status == 0)
            {
              var v10 = 'No';
            }
            else
            {
              var v10 = 'Yes';
            }
            if(data[11].p_status == 0)
            {
              var v11 = 'No';
            }
            else
            {
              var v11 = 'Yes';
            }
            if(data[12].p_status == 0)
            {
              var v12 = 'No';
            }
            else
            {
              var v12 = 'Yes';
            }
            if(data[13].p_status == 0)
            {
              var v13 = 'No';
            }
            else
            {
              var v13 = 'Yes';
            }
            if(data[14].p_status == 0)
            {
              var v14 = 'No';
            }
            else
            {
              var v14 = 'Yes';
            }
            if(data[15].p_status == 0)
            {
              var v15 = 'No';
            }
            else
            {
              var v15 = 'Yes';
            }
            if(data[16].p_status == 0)
            {
             var v16 = 'No';
            }
            else
            {
              var v16 = 'Yes';
            }
            if(data[17].p_status == 0)
            {
              var v17 = 'No';
            }
            else
            {
              var v17 = 'Yes';
            }
            if(data[18].p_status == 0)
            {
              var v18 = 'No';
            }
            else
            {
              var v18 = 'Yes';
            }
            if(data[19].p_status == 0)
            {
              var v19 = 'No';
            }
            else
            {
              var v19 = 'Yes';
            }
            if(data[20].p_status == 0)
            {
              var v20 = 'No';
            }
            else
            {
              var v20 = 'Yes';
            }
            if(data[21].p_status == 0)
            {
              var v21 = 'No';
            }
            else
            {
              var v21 = 'Yes';
            }
            if(data[22].p_status == 0)
            {
             var v22 = 'No';
            }
            else
            {
              var v22 = 'Yes';
            }
            if(data[23].p_status == 0)
            {
             var v23 = 'No';
            }
            else
            {
              var v23 = 'Yes';
            }
            if(data[24].p_status == 0)
            {
             var v24 = 'No';
            }
            else
            {
              var v24 = 'Yes';
            }
            if(data[25].p_status == 0)
            {
             var v25= 'No';
            }
            else
            {
              var v25 = 'Yes';
            }
             if(data[26].p_status == 0)
            {
             var v26 = 'No';
            }
            else
            {
              var v26 = 'Yes';
            }
             if(data[27].p_status == 0)
            {
             var v27 = 'No';
            }
            else
            {
              var v27 = 'Yes';
            }
             if(data[28].p_status == 0)
            {
             var v28 = 'No';
            }
            else
            {
              var v28 = 'Yes';
            }
             if(data[29].p_status == 0)
            {
             var v29 = 'No';
            }
            else
            {
              var v29 = 'Yes';
            }
             if(data[30].p_status == 0)
            {
             var v30 = 'No';
            }
            else
            {
              var v30 = 'Yes';
            }
            if(data[31].p_status == 0)
            {
              var v31 = 'No';
            }
            else
            {
              var v31 = 'Yes';
            }
            if(data[32].p_status == 0)
            {
              var v32 = 'No';
            }
            else
            {
              var v32 = 'Yes';
            }
            if(data[33].p_status == 0)
            {
              var v33 = 'No';
            }
            else
            {
              var v33 = 'Yes';
            }
            if(data[34].p_status == 0)
            {
              var v34 = 'No';
            }
            else
            {
              var v34 = 'Yes';
            }
            if(data[35].p_status == 0)
            {
              var v35 = 'No';
            }
            else
            {
              var v35 = 'Yes';
            }
            if(data[36].p_status == 0)
            {
             var v36 = 'No';
            }
            else
            {
              var v36 = 'Yes';
            }
            if(data[37].p_status == 0)
            {
              var v37 = 'No';
            }
            else
            {
              var v37 = 'Yes';
            }
            if(data[38].p_status == 0)
            {
              var v38 = 'No';
            }
            else
            {
              var v38 = 'Yes';
            }
            if(data[39].p_status == 0)
            {
              var v39 = 'No';
            }
            else
            {
              var v39 = 'Yes';
            }
            if(data[40].p_status == 0)
            {
              var v40 = 'No';
            }
            else
            {
              var v40 = 'Yes';
            }
            if(data[41].p_status == 1)
            {
              var v41 = 'Yes';
            }
            else
            {
              var v41 = 'No';
            }
            if(data[42].p_status == 0)
            {
             var v42 = 'No';
            }
            else
            {
              var v42 = 'Yes';
            }
            if(data[43].p_status == 0)
            {
             var v43 = 'No';
            }
            else
            {
              var v43 = 'Yes';
            }
            if(data[44].p_status == 0)
            {
             var v44 = 'No';
            }
            else
            {
              var v44 = 'Yes';
            }
            if(data[45].p_status == 0)
            {
             var v45= 'No';
            }
            else
            {
              var v45 = 'Yes';
            }
             if(data[46].p_status == 0)
            {
             var v46 = 'No';
            }
            else
            {
              var v46 = 'Yes';
            }
             if(data[47].p_status == 0)
            {
             var v47 = 'No';
            }
            else
            {
              var v47 = 'Yes';
            }
             if(data[48].p_status == 0)
            {
             var v48 = 'No';
            }
            else
            {
              var v48 = 'Yes';
            }
             if(data[49].p_status == 0)
            {
             var v49 = 'No';
            }
            else
            {
              var v49 = 'Yes';
            }

            if(data[50].p_status == 0)
            {
             var v50 = 'No';
            }
            else
            {
              var v50 = 'Yes';
            }
            if(data[51].p_status == 0)
            {
             var v51 = 'No';
            }
            else
            {
              var v51 = 'Yes';
            }
            if(data[52].p_status == 0)
            {
             var v52 = 'No';
            }
            else
            {
              var v52 = 'Yes';
            }
            if(data[53].p_status == 0)
            {
             var v53 = 'No';
            }
            else
            {
              var v53 = 'Yes';
            }


            if(data[54].p_status == 0)
            {
             var v54 = 'No';
            }
            else
            {
              var v54 = 'Yes';
            }


            if(data[55].p_status == 0)
            {
             var v55 = 'No';
            }
            else
            {
              var v55 = 'Yes';
            }


            if(data[56].p_status == 0)
            {
             var v56 = 'No';
            }
            else
            {
              var v56 = 'Yes';
            }

            if(data[57].p_status == 0)
            {
             var v57 = 'No';
            }
            else
            {
              var v57 = 'Yes';
            }

            if(data[58].p_status == 0)
            {
             var v58 = 'No';
            }
            else
            {
              var v58 = 'Yes';
            }

            if(data[59].p_status == 0)
            {
             var v59 = 'No';
            }
            else
            {
              var v59 = 'Yes';
            }

            if(data[60].p_status == 0)
            {
             var v60 = 'No';
            }
            else
            {
              var v60 = 'Yes';
            }

            if(data[61].p_status == 0)
            {
             var v61 = 'No';
            }
            else
            {
              var v61 = 'Yes';
            }


            if(data[62].p_status == 0)
            {
             var v62 = 'No';
            }
            else
            {
              var v62 = 'Yes';
            }



            if(data[63].p_status == 0)
            {
             var v63 = 'No';
            }
            else
            {
              var v63 = 'Yes';
            }


            if(data[64].p_status == 0)
            {
             var v64 = 'No';
            }
            else
            {
              var v64 = 'Yes';
            }


            if(data[65].p_status == 0)
            {
             var v65 = 'No';
            }
            else
            {
              var v65 = 'Yes';
            }

            if(data[66].p_status == 0)
            {
             var v66 = 'No';
            }
            else
            {
              var v66 = 'Yes';
            }

            if(data[67].p_status == 0)
            {
             var v67 = 'No';
            }
            else
            {
              var v67 = 'Yes';
            }
            
            if(data[68].p_status == 0)
            {
             var v68 = 'No';
            }
            else
            {
              var v68 = 'Yes';
            }

            


             
            html +='<div class="row">'+
                      '<div class="col-lg-10 m-auto">'+
                        '<h6>Account Group</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see the Groups who belongs to this role?</td>'+
                            '<td>'+v0+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new Groups who belongs to this role?</td>'+
                            '<td>'+v1+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a Groups who belongs to this role?</td>'+
                            '<td>'+
                              v2+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a Groups who belongs to this role?</td>'+
                            '<td>'+
                             v3+
                            '</td>'+
                          '</tr>'+
                       ' </table>'+                        
                        '<h6>Account Sub Groups</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see the Sub Groups who belongs to this role?</td>'+
                            '<td>'+v4+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new Sub Groups who belongs to this role?</td>'+
                            '<td>'+v5+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a Sub Groups who belongs to this role?</td>'+
                            '<td>'+
                              v6+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a Sub Groups who belongs to this role?</td>'+
                            '<td>'+
                             v7+
                            '</td>'+
                          '</tr>'+
                       ' </table>'+
                        '<h6>Account Transaction</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see the Transaction who belongs to this role?</td>'+
                            '<td>'+v8+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new Transaction who belongs to this role?</td>'+
                            '<td>'+v9+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a Transaction who belongs to this role?</td>'+
                            '<td>'+
                              v10+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a Transaction who belongs to this role?</td>'+
                            '<td>'+
                             v11+
                            '</td>'+
                          '</tr>'+
                       ' </table>'+                                              
                       '<h6>Categories</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can show the categories who belongs to this role?</td>'+
                            '<td>'+v12+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new category who belongs to this role?</td>'+
                            '<td>'+v13+'</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a category who belongs to this role?</td>'+
                            '<td>'+
                              v14+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a category who belongs to this role?</td>'+
                            '<td>'+
                             v15+
                            '</td>'+
                          '</tr>'+
                       ' </table>'+                        
                        '<h6>Users</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can show the users who belongs to this role?</td>'+
                            '<td>'+
                              v16+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new user who belongs to this role?</td>'+
                            '<td>'+
                              v17+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can show details of users who belongs to this role?</td>'+
                            '<td>'+
                              v18+
                            '</td>'+
                          '</tr>'+                          
                          '<tr>'+
                            '<td width="84%">Users can edit users who belongs to this role?</td>'+
                            '<td>'+
                             v19+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete users who belongs to this role?</td>'+
                            '<td>'+
                              v20+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit details of users who belongs to this role?</td>'+
                            '<td>'+
                              v21+
                            '</td>'+
                          '</tr>'+
                           '<tr>'+
                            '<td width="84%">Users can search the users who belongs to this role?</td>'+
                            '<td>'+
                              v22+
                            '</td>'+
                          '</tr>'+
                        '</table>'+
                        '<h6>Quotations</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see the Quotation who belongs to this role?</td>'+
                            '<td>'+
                              v23+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new Quotations who belongs to this role?</td>'+
                            '<td>'+
                              v24+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a Quotations who belongs to this role?</td>'+
                            '<td>'+
                             v25+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a Quotations who belongs to this role?</td>'+
                            '<td>'+
                              v26+
                            '</td>'+
                          '</tr>'+
                        '</table>'+                        
                        '<h6>Projects</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can show the projects who belongs to this role?</td>'+
                            '<td>'+
                            v27+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new project who belongs to this role?</td>'+
                            '<td>'+
                             v28+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a project who belongs to this role?</td>'+
                            '<td>'+
                             v29+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a project who belongs to this role?</td>'+
                            '<td>'+
                             v30+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can show the parent itself a project who belongs to this role?</td>'+
                            '<td>'+
                              v31+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can change the projects leader who belongs to this role?</td>'+
                            '<td>'+
                              v32+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can manage users of projects who belongs to this role?</td>'+
                            '<td>'+
                              v33+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can see the budget of projects who belongs to this role?</td>'+
                            '<td>'+
                              v34+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit the budget of projects who belongs to this role?</td>'+
                            '<td>'+
                              v35+
                            '</td>'+
                          '</tr>'+                          
                        '</table>'+
                        '<h6>Tasks</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can show the tasks who belongs to this role?</td>'+
                            '<td>'+
                              v36+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can create a new tasks who belongs to this role?</td>'+
                            '<td>'+
                                v37+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a tasks who belongs to this role?</td>'+
                            '<td>'+
                                v38+
                            '</td>'+
                         '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can delete a tasks who belongs to this role?</td>'+
                            '<td>'+
                              v39+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can show the parent itself a tasks who belongs to this role?</td>'+
                            '<td>'+
                              v40+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can see the budget of tasks who belongs to this role?</td>'+
                            '<td>'+
                              v41+
                            '</td>'+
                          '</tr>'+                          
                          '<tr>'+
                            '<td width="84%">Users can manage the budget of tasks who belongs to this role?</td>'+
                            '<td>'+
                              v42+
                            '</td>'+
                          '</tr>'+
                       ' </table>'+
                        '<h6>Subtasks</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can show the subtasks who belongs to this role?</td>'+
                            '<td>'+
                              v43+
                            '</td>'+
                          '</tr>'+
                         ' <tr>'+
                            '<td width="84%">Users can create a new subtasks who belongs to this role?</td>'+
                            '<td>'+
                              v44+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can edit a subtasks who belongs to this role?</td>'+
                            '<td>'+
                              v45+
                            '</td>'+
                         ' </tr>'+
                          '<tr>'+
                           ' <td width="84%">Users can delete a subtasks who belongs to this role?</td>'+
                            '<td>'+
                             v46+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can show the parent itself a subtasks who belongs to this role?</td>'+
                            '<td>'+
                              v47+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can see the budget of subtasks who belongs to this role?</td>'+
                            '<td>'+v48+'</td>'+
                          '</tr>'+                          
                          '<tr>'+
                            '<td width="84%">Users can manage the budget of subtasks who belongs to this role?</td>'+
                            '<td>'+v49+'</td>'+
                          '</tr>'+
                        '</table>'+
                        ' </table>'+
                        '<h6>Reports</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see all users reports who belongs to this role?</td>'+
                            '<td>'+
                              v50+
                            '</td>'+
                          '</tr>'+
                         ' <tr>'+
                            '<td width="84%">Users can create a new reports who belongs to this role?</td>'+
                            '<td>'+
                              v51+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can see parent reports who belongs to this role?</td>'+
                            '<td>'+
                              v52+
                            '</td>'+
                         ' </tr>'+
                          '<tr>'+
                           ' <td width="84%">Users can search all users reports who belongs to this role?</td>'+
                            '<td>'+
                             v53+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can search all users working hours who belongs to this role?</td>'+
                            '<td>'+
                              v54+
                            '</td>'+
                          '</tr>'+
                        '</table>'+
                        ' </table>'+
                        '<h6>Leaves</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Users can see all users leaves who belongs to this role?</td>'+
                            '<td>'+
                              v55+
                            '</td>'+
                          '</tr>'+
                         ' <tr>'+
                            '<td width="84%">Users can request/create for new leaves who belongs to this role?</td>'+
                            '<td>'+
                              v56+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can see the requests of leaves who belongs to this role?</td>'+
                            '<td>'+
                              v57+
                            '</td>'+
                         ' </tr>'+
                          '<tr>'+
                           ' <td width="84%">Users can see parent leaves who belongs to this role?</td>'+
                            '<td>'+
                             v58+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can approve the request of leaves who belongs to this role?</td>'+
                            '<td>'+
                              v59+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Users can reject the request of leaves who belongs to this role?</td>'+
                            '<td>'+
                              v60+
                            '</td>'+
                          '</tr>'+
                        '</table>'+
                        ' </table>'+
                        '<h6>Notifications</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Project Deadline</td>'+
                            '<td>'+
                              v61+
                            '</td>'+
                          '</tr>'+
                         ' <tr>'+
                            '<td width="84%">Task deadline</td>'+
                            '<td>'+
                              v62+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">SubTask deadline</td>'+
                            '<td>'+
                              v63+
                            '</td>'+
                         ' </tr>'+
                          '<tr>'+
                           ' <td width="84%">Birthdays</td>'+
                            '<td>'+
                             v64+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Leave Request</td>'+
                            '<td>'+
                              v65+
                            '</td>'+
                          '</tr>'+
                          '<tr>'+
                            '<td width="84%">Approve/Reject SubTask</td>'+
                            '<td>'+
                              v66+
                            '</td>'+
                          '</tr>'+
                        '</table>'+
                        '<h6>Attendence</h6>'+
                        '<table class="table">'+
                          '<tr>'+
                            '<td width="84%">Show All Attendance</td>'+
                            '<td>'+
                              v67+
                            '</td>'+
                          '</tr>'+
                         ' <tr>'+
                            '<td width="84%">Show My Attendance</td>'+
                            '<td>'+
                              v68+
                            '</td>'+
                          '</tr>'+
                        '</table>'+                        
                      '</div>'+
                    '</div>';
              $('#viewPermissions').html(html);

        }
      });
  });
</script>