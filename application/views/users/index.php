<!-- User_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">User</span>
      </div>

      <div class="col-lg-6">

      </div>

    </div>
    <div class="row Project pt-3 pb-3">
      <div class="col-lg-6">
        <?php
        if ($this->session->userdata('user') == 1 || $this->session->userdata('user_create') == 1 || $this->session->userdata('user_add') == 1) {
        ?>
          <a href="<?= base_url('users/insert_form'); ?>" class="btn user_invait_btn" style="font-size: 13px">+ Add user
          </a>
        <?php } ?>
      </div>
      <div class="col-lg-6">

      </div>
    </div>
    <?php if ($this->session->flashdata('erroruser')) { ?>
      <div class="alert alert-primary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $this->session->flashdata('erroruser'); ?>
      </div>
    <?php } ?>
    <!-- secod_Row_Start -->
    <?php
    if ($this->session->userdata('user') == 1 || $this->session->userdata('user_searches') == 1) {
    ?>
      <form action="<?= base_url('users/getbycategory') ?>" method="post">
        <div class="row mt-2">
          
          <div class="col-3">
            <div class="form-group">
              <label>Category</label>
              <select class="form-control form-control-sm" name="category" required data-parsley-required-message="You must select at least one option.">
                <option selected disabled>select any category</option>
                <?php if (is_array($cat) || is_object($cat)) {
                  foreach ($cat as $key => $v) {
                    if ($v->cat_id != null) { ?>
                      <option value="<?= $v->cat_id ?>"><?= $v->cat_name ?></option>
                <?php }
                  }
                } ?>
              </select>
            </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <label>Skill</label>
              <select class="form-control form-control-sm" name="skill" required data-parsley-required-message="You must select at least one option.">
                <option selected disabled value="empty">Select any skill</option>
                <?php if (is_array($skills) || is_object($skills)) {
                  foreach ($skills as $key => $v) {
                    if ($v->is_skill_id != null) { ?>
                      <option value="<?= $v->is_skill_id ?>"><?= $v->is_skill_name ?></option>
                <?php }
                  }
                } ?>
              </select>
            </div>
          </div>

          <div class="col-3">
            <div class="col-2" style="margin-top: 28px!important;">
              <input type="submit" name="submit" class="btn btn-sm user_invait_btn confirm pop_up" value="Submit">
            </div>
          </div>
          <div class="col-3"></div>

        </div>
      </form>
    <?php
    }

    if ($this->session->userdata('user') == 1 || $this->session->userdata('user_show') == 1) {
    ?>
      <div class="row pt-5">
        <div class="col-lg-12">
          <!-- Id_Content_Start -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <!--All_Start  -->
              <div class="row">
                <?php if (is_array($users)  || is_object($users)) {
                  foreach ($users as $key => $v) : if ($v->img == null) {
                      $img = base_url('uploads/users/default.png');
                    } else {
                      $img = base_url('uploads/users/' . $v->img);
                    } ?>
                    <div class="col-xl-4 col-lg-6 Bg_Color mt-2" style="border: 20px solid #F2F4F7;">
                      <div style="">
                        <div class="row text-center pb-3">
                          <div class="col-lg-4">

                          </div>
                          <div class="col-lg-4 col-6 text-center">
                            <img class="rounded-circle User_Box_img" src="<?= $img ?>" width="80px">

                            <!--  <div class="row Page_Title_Color">
                                        <div class="col-lg-12">
                                            <p class="mb-0 Page_Title_Color Bold">Number of Projects</p>
                                        </div>                                    
                                        <div class="col-lg-12">
                                            <p class="mb-0 Page_Title_Color Bold"> 5</p>
                                        </div>
                                    </div> -->
                          </div>
                          <div class="col-lg-4 col-6">
                            <!--  <div class="row text-center">
                                        <div class="col-lg-12">
                                            <p class="mb-0 Page_Title_Color Bold">Number of Tasks</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="mb-0 Page_Title_Color Bold">0</p>
                                        </div>
                                    </div> -->
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-9 col-9">
                            <p class="User_Box_Txt" style="font-size: 11px;">
                              <span class="light_color User_Box_Txt_Name Bold"><?= $v->name ?></span>
                              <span>/ <?= $v->status_n ?></span>
                            </p>
                          </div>
                          <div class="col-lg-3 col-3 text-right">
                            <?php
                            if ($this->session->userdata('user') == 1 || $this->session->userdata('user_edit') == 1 || $this->session->userdata('user_del') == 1) {
                            ?>
                              <div class="btn-group User_Box_Icon">
                                <button type="button" class="btn btn-secondary dropdown-toggle Right_Togel_Btton_Drop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent;border: none;box-shadow: none;">
                                  <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right p-1">
                                  <button class="dropdown-item Right_Togel_Drop_Item_1 btn-lg btn-block pt-0" type="button">
                                    <?php
                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('user_edit') == 1) {
                                    ?>
                                      <button class="btn btn-primary" style="background-color: transparent;border: none;box-shadow: none;">
                                        <i class="fas fa-pencil-alt text-dark" style="font-size: 12px"></i>
                                        <a href="<?= base_url('users/edit/' . $v->user_id); ?>" class="text-dark" style="font-size: 12px"> Edit </a>
                                      </button>
                                      <br>
                                    <?php
                                    }
                                    if ($this->session->userdata('user') == 1 || $this->session->userdata('user_del') == 1) {
                                    ?>
                                      <button type="submit" href="#" data-toggle="modal" data-target="#exampleModalLong_remove" class="btn btn-primary delbtn" style="background-color: transparent;border: none;box-shadow: none;" data="<?= $v->user_id; ?>">
                                        <i class="fas fa-trash text-dark" style="font-size: 12px"></i>
                                        <a class="text-dark" style="font-size: 12px">
                                          Remove
                                        </a>
                                      </button>
                                    <?php } ?>
                                  </button>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>

                        <div class="row mb-1">
                          <div class="col-lg-12 pb-3">
                            <p class="User_Box_Txt">
                              <span class="light_color Bold">Email Address</span>
                              <span class="light_color">: <?= $v->email ?></span>
                            </p>
                            <p>
                              <?php
                              if ($this->session->userdata('user') == 1 || $this->session->userdata('user_showdeatails') == 1) {
                              ?>
                                <a class="uview" data="<?= $v->user_id ?>">
                                  <button class="btn user_invait_btn float-right" style="font-size: 13px">View details</button>
                                </a>
                              <?php } ?>
                            </p>
                          </div>
                        </div>

                      </div>
                    </div>
                  <?php endforeach;
                } else { ?>
                  <p class="User_Box_Txt">
                    <span class="light_color Bold">No record found...!</span>
                  </p>
                <?php } ?>
                <!--foreachend -->
              </div>
            </div>

          </div>
        </div>
      </div>
    <?php } ?>
    <!-- secod_Row_End -->
  </div>
</div>
<!--user_End-->

<!-- remove -->
<div class="modal fade" id="exampleModalLong_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"> Are You Sure You Want to Remove ?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer float-left">
        <form action="<?= base_url('users/delete') ?>" method="post">
          <input type="text" name="id2" class="idbtn" hidden>
          <input type="submit" value="Yes" class="btn user_invait_btn">
        </form>
        <button type="button" class="btn user_invait_btn" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- remove -->
<!-- userview -->
<div class="modal fade" id="modaluview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"> View Details</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="userdata"></div>
      </div>
      <div class="modal-footer float-left">
        <button type="button" class="btn user_invait_btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- userview -->
<script type="text/javascript">
  $('.delbtn').click(function() {
    var id = $(this).attr('data');
    $('.idbtn').val(id);
  });
  $('.uview').click(function() {
    var id = $(this).attr('data');
    $('#modaluview').modal('show');
    $.ajax({
      url: '<?= base_url('users/view_details') ?>',
      data: {
        id: id
      },
      method: 'Post',
      dataType: 'json',
      success: function(data) {
        var u = data['user'];
        var s = data['skills'];
        var q = data['qualification'];
        var c = data['cat'];
        var i;
        var html = '';
        if (u.img != '') {
          var img = u.img;

        } else {
          var img = 'default.png';
        }

        html += '<div class="row">' +
          '<div class="col-1"></div>' +
          '<div class="col-10 text-center">' +
          '<img class="img-fluid rounded-circle" src="<?= base_url('uploads/users/') ?>' + img + '" style="width: 100px;">' +
          '</div>' +
          '<div class="col-4"></div>' +
          '</div>' +
          '<div class="row pt-2">' +
          '<div class="col-lg-1"></div>' +
          '<div class="col-lg-10 text-center" style="">' +
          '<a href="#" class="Project_Title_Color">' + u.name + '</a>';
        if (c != '') {
          html += '<h6 class="light_color mb-1" style="font-size: 11px">(' + c.cat_name + ')</h6>';
        }
        html += '<p>' +
          '<span class="light_color" style="font-size: 11px">' + u.email + '</span>' +
          '</p>' +
          '</div>' +
          '<div class="col-lg-1"></div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-lg-12">' +
          '<h5>Personal Data</h5>' +
          '</div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-12">' +
          '<table class="table light_color" style="font-size: 13px;border-top-style: none;border-left-style: none; border-right-style: none;border-bottom-style: none;">' +
          '<tr>' +
          '<td>Password</td>' +
          '<td>' + u.password + '</td>' +
          '<td>Contact</td>' +
          '<td>' + u.contact_no + '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>DOB</td>' +
          '<td>' + u.dob + '</td>' +
          '<td>Status</td>' +
          '<td>' + u.status_n + '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>Designation</td>' +
          '<td>' + u.designation + '</td>' +
          '<td>Address</td>' +
          '<td>' + u.address + '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>CNIC</td>' +
          '<td>' + u.cnic + '</td>' +
          '<td>Salary</td>' +
          '<td>' + u.salary + '</td>' +
          '</tr>' +

          '</table>' +
          '</div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-lg-12">' +
          '<h5>Skills</h5>' +
          '</div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-12">' +
          '<table class="table light_color" style="font-size: 13px;border-top-style: none;border-left-style: none; border-right-style: none;border-bottom-style: none;">';
        if (s != '') {
          html += '<tr>';
          for (i = 0; i < s.length; i++) {
            if (i % 2 == 0) {
              var s1 = 'badge-success';
            } else {
              var s1 = 'badge-info';
            }

            html += '<td><span class="badge ' + s1 + '">' + s[i].skill_name + '</span></td>';
          }
          html += '</tr>';
        };
        html += '</table>' +
          '</div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-lg-12">' +
          '<h5>Qualification</h5>' +
          '</div>' +
          '</div>' +
          '<div class="row">' +
          '<div class="col-12">' +
          '<table class="table light_color" style="font-size: 13px;border-top-style: none;border-left-style: none; border-right-style: none;border-bottom-style: none;">' +
          '<tr>' +
          '<th>SNo.</th>' +
          '<th>Degree</th>' +
          '<th>Grade/CGPA</th>' +
          '<th>Year</th>' +
          '</tr>';
        if (q != '') {
          var sno = 1;
          for (p = 0; p < q.length; p++) {
            html += '<tr>' +
              '<th>' + sno + '</th>' +
              '<th>' + q[p].degree_name + '</th>' +
              '<th>' + q[p].grade_or_cgpa + '</th>' +
              '<th>' + q[p].passing_year + '</th>' +
              '</tr>';
            sno++;
          }
        };
        html += '</table>' +
          '</div>' +
          '</div>' +
          '</div>';

        $('.userdata').html(html);
      }
    });
  });
</script>