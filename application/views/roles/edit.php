<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<style>
  .grr {
    background-color: #1CC88A !important;
  }

  .rdd {
    background-color: red !important;
  }

  .on {
    color: whitesmoke !important;
    /*font-size: 100px;*/
    transform: translateX(27px) !important;
    transition: 0.9s ease-in-out !important;
    cursor: pointer !important;
  }

  .off {
    color: whitesmoke !important;
    transform: translateX(0px) !important;
    transition: 0.9s ease-in-out !important;
    cursor: pointer !important;
  }

  .on:hover {
    transition: 0.9s ease-in-out !important;
  }

  .off:hover {
    transition: 0.9s ease-in-out !important;
  }

  .chn {
    background-color: red;
    border: none;
    width: 60%;
    border-radius: 30px !important;
  }

  input[name='label[]'] {
    border: none !important;
    background: none !important;
  }

  input[name='label[]']:focus {
    outline: none !important;
  }
</style>
<!-- Invite_User_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">Edit Role</span>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url('roles'); ?>" class="btn user_invait_btn float-right">+ All Roles</a>
      </div>
    </div>
    <!-- secod_Row_Start -->
    <form action="<?= base_url('roles/update') ?>" method="post" id="validate_form">
      <input type="hidden" name="id" value="<?= $edit->role_id ?>">
      <div class="row pt-5">
        <div id="divtoshow" style="position: fixed;display:none;z-index:9999" class="alert alert-info col-2 ml-auto mr-auto mb-2" role="alert">

        </div>
        <div class="col-lg-10 m-auto card pt-3 pb-3" style="border:none">
          <div class="row">
            <div class="col-lg-10 m-auto">
              <div class="form-group">
                <label>Role Name</label>
                <input type="text" class="form-control form-control-sm" value="<?= $edit->role_name ?>" name="role_name" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters.">
                <span><?= form_error('role_name'); ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-10 m-auto">
              <h6>Account Groups</h6>
              <table class="table">
                <tr>
                  <td width="84%">Users can see the Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="group_show" hidden>
                    <div class="chn ">
                      <div class="deal " data="gr1" data-dependent="gr4,gr3,sgr2,tr2" data-msg="Users can see the Groups Permission is required">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can create a new Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="group_add" hidden>
                    <div class="chn">
                      <div class="deal" data="gr2">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                </tr>
                <tr>
                  <td width="84%">Users can edit a Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="group_edit" hidden>
                    <div class="chn ">
                      <div class="deal " data="gr3" data-on="gr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can delete a Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="group_delete" hidden>
                    <div class="chn ">
                      <div class="deal " data="gr4" data-on="gr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                  </td>
                </tr>
              </table>


              <h6>Account Sub Groups</h6>
              <table class="table">
                <tr>
                  <td width="84%">Users can see the Sub Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="subgroup_show" hidden>
                    <div class="chn ">
                      <div class="deal " data="sgr1" data-dependent="sgr4,sgr3,tr2" data-msg="Users can see the Sub Groups Permission is required">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can create a new Sub Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="subgroup_add" hidden>
                    <div class="chn">
                      <div class="deal" data="sgr2" data-on="gr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                </tr>
                <tr>
                  <td width="84%">Users can edit a Sub Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="subgroup_edit" hidden>
                    <div class="chn ">
                      <div class="deal " data="sgr3" data-on="sgr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can delete a Groups who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="subgroup_delete" hidden>
                    <div class="chn ">
                      <div class="deal " data="sgr4" data-on="sgr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                  </td>
                </tr>
              </table>


              <h6>Account Transaction</h6>
              <table class="table">
                <tr>
                  <td width="84%">Users can see the Transaction who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="tran_show" hidden>
                    <div class="chn ">
                      <div class="deal " data="tr1" data-dependent="tr4,tr3" data-msg="Users can see the Transaction Permission is required">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can create a new Transaction who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="tran_add" hidden>
                    <div class="chn">
                      <div class="deal" data="tr2" data-on="gr1,sgr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                </tr>
                <tr>
                  <td width="84%">Users can edit a Transaction who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="tran_edit" hidden>
                    <div class="chn ">
                      <div class="deal " data="tr3" data-on="tr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can delete a Transaction who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="tran_delete" hidden>
                    <div class="chn ">
                      <div class="deal " data="tr4" data-on="tr1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                  </td>
                </tr>
              </table>



              <h6>Categories</h6>
              <table class="table">
                <tr>
                  <td width="84%">Users can see the categories who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="cat_show" hidden>
                    <div class="chn ">
                      <div class="deal " data="c1" data-dependent="c4,c3" data-msg="Users can see the categories Permission is required">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can create a new category who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="cat_add" hidden>
                    <div class="chn ">
                      <div class="deal " data="c2">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                </tr>
                <tr>
                  <td width="84%">Users can edit a category who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="cat_edit" hidden>
                    <div class="chn ">
                      <div class="deal " data="c3" data-on="c1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Users can delete a category who belongs to this role?</td>
                  <td>
                    <input type="text" name="label[]" value="cat_del" hidden>
                    <div class="chn ">
                      <div class="deal " data="c4" data-on="c1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                  </td>
                </tr>
              </table>

            
            <h6>Users</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see the users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="u1" data-on="" data-dependent="u3,u4,u5,u6,u7" data-msg="Users can see the Users Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new user who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_add" hidden>
                  <div class="chn ">
                    <div class="deal " data="u2" data-on="" data-dependent="c1" data-msg="Users can create a new user Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see details of users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_showdeatails" hidden>
                  <div class="chn ">
                    <div class="deal " data="u6" data-on="u1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
              <tr>
                <td width="84%">Users can edit users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_edit" hidden>
                  <div class="chn ">
                    <div class="deal " data="u3" data-on="u1" data-dependent="" data-msg="yeh o chaye">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can delete users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_del" hidden>
                  <div class="chn ">
                    <div class="deal " data="u4" data-on="u1" data-msg="yeh o chaye">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can edit details of users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_editdetails" hidden>
                  <div class="chn ">
                    <div class="deal " data="u5" data-on="u1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              
                <td width="84%">Users can search the users who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="user_searches" hidden>
                  <div class="chn ">
                    <div class="deal " data="u7" data-on="u1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
            </table>

            <h6>Quotations</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see the Quotation who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="quot_show" hidden>
                  <div class="chn ">
                    <div class="deal off " data="q1" data-dependent="q2,q3,q4" data-msg="Users can see the Quotation who belongs to this role">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new Quotations who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="quot_add" hidden>
                  <div class="chn ">
                    <div class="deal off" data="q2">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can edit a Quotations who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="quot_edit" hidden>
                  <div class="chn ">
                    <div class="deal off" data="q3" data-on="q1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can delete a Quotations who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="quot_del" hidden>
                  <div class="chn ">
                    <div class="deal off" data="q4" data-on="q1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
            </table>
            <h6>Projects</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see the projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_show" hidden>
                  <div class="chn ">
                    <div class="deal  p_see" data="p1" data-dependent="p3,p4,p6,p7,p8,p9,t1,t2,n1" data-msg="Users can see the projects Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_add" hidden>
                  <div class="chn ">
                    <div class="deal " data="p2">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can edit a projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_edit" hidden>
                  <div class="chn ">
                    <div class="deal " data="p3" data-on="p1||p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can delete a projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_del" hidden>
                  <div class="chn ">
                    <div class="deal " data="p4" data-on="p1||p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see the parent itself a projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_p_show" hidden>
                  <div class="chn ">
                    <div class="deal  p_see" data="p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can change the projects leader who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_leader" hidden>
                  <div class="chn ">
                    <div class="deal " data="p6" data-on="p1" data-dependent="t2" data-msg="Users can change the projects leader Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can manage users of projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_mu" hidden>
                  <div class="chn ">
                    <div class="deal " data="p7" data-on="p1||p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see the budget of projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_b_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="p8" data-on="p1||p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can Edit the budget of projects who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="proj_b_edit" hidden>
                  <div class="chn ">
                    <div class="deal " data="p9" data-on="p1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>              
            </table>
            <h6>Tasks</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see the tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_show" hidden>
                  <div class="chn ">
                    <div class="deal t_see" data="t1" data-on="p1||p5" data-dependent="t3,t4,t7,st1,st2,st5,n2" data-msg="Users can see the tasks Permission required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_add" hidden>
                  <div class="chn ">
                    <div class="deal " data="t2" data-on="p6,p1||p5" data-msg="Users can create a new tasks Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can edit a tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_edit" hidden>
                  <div class="chn">
                    <div class="deal " data="t3" data-on="t1" data-dependent="t6" data-msg="Users can edit a tasks Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can delete a tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_del" hidden>
                  <div class="chn ">
                    <div class="deal " data="t4" data-on="t1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr class="">
                <td width="84%">Users can see the parent itself a tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_p_show" hidden>
                  <div class="chn ">
                    <div class="deal t_see" data="t5" data-on="p5||p1" data-dependent="t3,t4,st1,st2,st5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see the budget of tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_b_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="t7" data-on="t1" data-dependent="t6" data-msg="Users can see a the budget of task Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>              
              <tr>
                <td width="84%">Users can manage the budget of tasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="task_mb" hidden>
                  <div class="chn">
                    <div class="deal" data="t6" data-on="t3,t7">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
            </table>
            <h6>Subtasks</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see the subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_show" hidden>
                  <div class="chn ">
                    <div class="deal s_see" data="st1" data-on="t1" data-dependent="st3,st4,st7,n3" data-msg="Users can see the subtasks Permission required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_add" hidden>
                  <div class="chn ">
                    <div class="deal" data="st2" data-on="t1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can edit a subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_edit" hidden>
                  <div class="chn">
                    <div class="deal" data="st3" data-on="st1" data-dependent="st6" data-msg="Users can edit a subtasks Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can delete a subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_del" hidden>
                  <div class="chn">
                    <div class="deal " data="st4" data-on="st1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see the parent itself a subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_p_show" hidden>
                  <div class="chn ">
                    <div class="deal s_see" data="st5" data-on="t1" data-dependent="st3,st4,st7">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
               <tr>
                <td width="84%">Users can see the budget of subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_b_show" hidden>
                  <div class="chn">
                    <div class="deal" data="st7" data-on="st1" data-dependent="st6" data-msg="Users can see the budget of subtasks Permission is required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>              
              <tr>
                <td width="84%">Users can manage the budget of subtasks who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="subtask_mb" hidden>
                  <div class="chn ">
                    <div class="deal" data="st6" data-on="st3,st7">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              
            </table>

            <h6>Reports</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see all users reports who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="report_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="r1" data-dependent="r4,r5" data-msg="Users can see all users reports Permission required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can create a new reports who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="report_add" hidden>
                  <div class="chn ">
                    <div class="deal " data="r2">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see parent reports who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="report_p_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="r3">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can search all users reports who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="report_search" hidden>
                  <div class="chn ">
                    <div class="deal " data="r4" data-on="r1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can search all users working hours who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="report_wh" hidden>
                  <div class="chn ">
                    <div class="deal " data="r5" data-on="r1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
            </table>
            <h6>Leaves</h6>
            <table class="table">
              <tr>
                <td width="84%">Users can see all users leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="l1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can request/create for new leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_add" hidden>
                  <div class="chn ">
                    <div class="deal " data="l2">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see the requests of leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_r_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="l3" data-dependent="l5,l6" data-msg="Users can the requests of leaves Permission required">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can see parent leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_p_show" hidden>
                  <div class="chn ">
                    <div class="deal " data="l4">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can approve the request of leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_app" hidden>
                  <div class="chn ">
                    <div class="deal " data="l5" data-on="l3">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Users can reject the request of leaves who belongs to this role?</td>
                <td>
                  <input type="text" name="label[]" value="leave_rej" hidden>
                  <div class="chn ">
                    <div class="deal " data="l6" data-on="l3">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
            </table>
            <h6>Notifications</h6>
            <table class="table">
              <tr>
                <td width="84%">Project Deadline</td>
                <td>
                  <input type="text" name="label[]" value="proj_notify" hidden>
                  <div class="chn ">
                    <div class="deal " data="n1" data-on="p1||p5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Task deadline</td>
                <td>
                  <input type="text" name="label[]" value="task_notify" hidden>
                  <div class="chn ">
                    <div class="deal " data="n2" data-on="t1">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">SubTask deadline</td>
                <td>
                  <input type="text" name="label[]" value="subtask_notify" hidden>
                  <div class="chn ">
                    <div class="deal " data="n3">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Birthdays</td>
                <td>
                  <input type="text" name="label[]" value="birthday_notify" hidden>
                  <div class="chn ">
                    <div class="deal " data="n4">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Leave Request</td>
                <td>
                  <input type="text" name="label[]" value="leave_notify" hidden>
                  <div class="chn ">
                    <div class="deal " data="n5">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>
              <tr>
                <td width="84%">Approve/Reject SubTask</td>
                <td>
                  <input type="text" name="label[]" value="subtask_notify_" hidden>
                  <div class="chn ">
                    <div class="deal " data="n6">
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                    </div>
                  </div>
                  <div class="ranking">
                    <input type="text" name="rank[]" value="0" hidden />
                  </div>
                </td>
              </tr>

            </table>
              <h6>Attendance</h6>
              <table class="table">
                <tr>
                  <td width="84%">Show All Attendance</td>
                  <td>
                    <input type="text" name="label[]" value="attendance_show" hidden>
                    <div class="chn ">
                      <div class="deal " data="at1">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="84%">Show My Attendance</td>
                  <td>
                    <input type="text" name="label[]" value="attendance_p_show" hidden>
                    <div class="chn">
                      <div class="deal" data="at2">
                        <i class="fa fa-circle" aria-hidden="true" style="font-size:22px;margin-top:1px "></i>
                      </div>
                    </div>
                    <div class="ranking">
                      <input type="text" name="rank[]" value="0" hidden />
                    </div>
                </tr>
              </table>




          </div>
        </div>
        <div class="row pt-4">
          <div class="col-lg-10 m-auto">
            <input type="submit" name="submit" value="Add" class="btn user_invait_btn">
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
  $('.deal').on('click', function(event) {


    var depend = $(this).attr("data-on");
    var dependent = $(this).attr('data-dependent');
    var haveToBeOff = [];
    var haveToBeOn = [];
    if (depend != undefined) {
      depend = depend.split(',');
      if (depend != "")
        $.each(depend, function() {
          if (checkDependeny(this)) {
            if (this.indexOf("||") > 0)
              haveToBeOn.push(this.substring(0, this.indexOf("||")));
            else {
              haveToBeOn.push(this);
            }
          }
        });
    }

    if (dependent != undefined) {
      dependent = dependent.split(',');

      if (dependent != "")
        $.each(dependent, function() {
          if (!checkDependeny(this))
            haveToBeOff.push(this);
        });
    };

    if (haveToBeOn.length != 0 && !$(this).hasClass("on")) {

      hoverdiv(event, 'divtoshow', haveToBeOn);

    } else {

      var id = $(this).attr('data');

      if ($(this).hasClass("on")) {
        $(this).removeClass("on");
        $(this).addClass("off");
        $(this).closest(".chn").removeClass("grr");
        $(this).closest(".chn").addClass("rdd");
        var deal = '0';
      } else {
        $(this).removeClass("off");
        $(this).addClass("on");
        $(this).closest('.chn').removeClass("rdd");
        $(this).closest('.chn').addClass("grr");
        var deal = '1';
      }
      $(this).closest("td").find("input[name='rank[]']").val(deal);


      if ($(this).attr("data-getOn") != undefined) {
        var getOn = $(this).attr("data-getOn").split(',');
        $.each(getOn, function() {
          toogleOn($("div").find("[data='" + this + "']"));
        });
      }


      if (haveToBeOff.length > 0 && !$(this).hasClass("on"))
        $.each(haveToBeOff, function() {
          toogleOffWithDepend($("div").find("[data='" + this + "']"));
        });

    };
  });

  $(".p_see").on('click', function() {
    toogleOff($('.p_see').not($(this)));
  })
  $(".t_see").on('click', function() {
    toogleOff($('.t_see').not($(this)));
  })
  $(".s_see").on('click', function() {
    toogleOff($('.s_see').not($(this)));
  })


  function toogleOn(tag) {
    $(tag).removeClass("off");
    $(tag).addClass("on");
    $(tag).closest('.chn').removeClass("rdd");
    $(tag).closest('.chn').addClass("grr");
    $(tag).closest("td").find("input[name='rank[]']").val(1);

  }

  function toogleOff(tag) {
    $(tag).removeClass("on");
    $(tag).addClass("off");
    $(tag).closest('.chn').removeClass("grr");
    $(tag).closest('.chn').addClass("rdd");
    $(tag).closest("td").find("input[name='rank[]']").val(0);
  }

  function toogleOffWithDepend(tag) {

    $(tag).removeClass("on");
    $(tag).addClass("off");
    $(tag).closest('.chn').removeClass("grr");
    $(tag).closest('.chn').addClass("rdd");
    $(tag).closest("td").find("input[name='rank[]']").val(0);

    if ($(tag).attr("data-dependent") != undefined) {

      var toBeoff = [];
      var dependent2 = $(tag).attr("data-dependent");
      dependent2 = dependent2.split(',');

      if (dependent2 != "")
        $.each(dependent2, function() {
          if (!checkDependeny(this))
            toogleOff($("div").find("[data='" + this + "']"));
        });

    }
  }



  function checkDependeny(btn) {
    console.log(btn.indexOf("||"));
    if (btn.indexOf("||") < 0) {
      if (!$("div").find("[data='" + btn + "']").hasClass("on")) {
        return true;
      } else {
        return false;
      }
    } else {
      btn = btn.split("||");
      console.log(btn);
      if (!$("div").find("[data='" + btn[0] + "']").hasClass("on") && !$("div").find("[data='" + btn[1] + "']").hasClass("on")) {
        console.log(true);
        return true;
      } else {
        return false;
      }
    }

  }

  function hoverdiv(e, divid, msgs) {

    var left = e.clientX + "px";
    var top = e.clientY + "px";

    var div = document.getElementById(divid);

    div.style.left = left;
    div.style.top = top;
    $(div).html("");
    $.each(msgs, function() {
      console.log(this.toString());
      $(div).append("&#10033;" + $("div").find("[data='" + this.toString() + "'").attr("data-msg") + "<br>");
    });

    $("#" + divid).toggle();
    $("#" + divid).delay(1500).fadeOut()
    return false;
  }


  function setval() {
    var perm = <?php echo json_encode($perm); ?>;
    console.log(perm);
    $('.chn').each(function(i) {
      var cls = (perm[i] != undefined) ? ((perm[i].p_status == 0) ? "rdd" : "grr") : "rdd";
      var cls2 = (perm[i] != undefined) ? ((perm[i].p_status == 0) ? "off" : "on") : "off";
      $(this).addClass(cls);
      $(this).children('.deal').addClass(cls2);
      $(this).siblings('.ranking').children('input').attr('value', (perm[i] != undefined) ? perm[i].p_status : 0);
    })
  }

  $(document).ready(function() {
    setval();
  });
</script>