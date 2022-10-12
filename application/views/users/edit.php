<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Edit_User_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">Edit User</span>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url('users'); ?>" class="btn user_invait_btn float-right">+ All Users</a>
      </div>

    </div>

    <form action="<?= base_url('users/update') ?>" method="post" id="validate_form" enctype="multipart/form-data">
      <div class="row pt-5">
        <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
          <div class="row">
            <div class="col-lg-10 m-auto">
              <div class="form-group">
                <input type="text" name="id" value="<?= $edit->user_id ?>" hidden>
                <input type="text" name="ex_detail" value="0" hidden>
                <label>Email</label>
                <input type="email" class="form-control form-control-sm" name="email" value="<?= $edit->email ?>" required data-parsley-type="email" data-parsley-trigger="keyup">
                <span><?= form_error('email'); ?></span>
              </div>

              <div class="form-group">
                <label>Password</label>
                <input type="Password" class="form-control form-control-sm" name="password" value="<?= $edit->password ?>" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup">
                <span><?= form_error('password'); ?></span>
              </div>

              <div class="form-group">
                <label>from</label>
                <input type="text" class="form-control form-control-sm" id="timepicker1" name="time" required value="<?= $edit->user_time ?>">
                <span><?= form_error('time') ?></span>
              </div>

              <div class="form-group">
                <label>Designation</label>
                <!--  <input type="text" class="form-control" name="designation" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters."> -->
                <select class="form-control form-control-sm js-example-basic-single" name="designation" id="exampleFormControlSelect1" required data-parsley-required-message="You must select at least one option.">
                  <option selected disabled>select or write any designation</option>
                  <?php if (is_array($cat) || is_object($cat)) {
                    foreach ($cat as $key => $v) {
                      if ($v->cat_id != null) { ?>
                        <option <?php if ($edit->designation == $v->cat_id) {
                                  echo 'selected="selected"';
                                } ?> value="<?= $v->cat_id ?>"><?= $v->cat_name ?></option>
                  <?php }
                    }
                  } ?>
                </select>
                <span><?= form_error('designation'); ?></span>
              </div>

              <div class="form-group">
                <label>Salary</label>
                <input type="number" value="<?= $edit->salary; ?>" name="salary" class="form-control" required>
                <?= form_error('salary') ?>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="status" required data-parsley-required-message="You must select at least one option.">
                  <?php foreach ($types as $key => $v) {  ?>
                    <option <?php if ($v->role_id == $edit->status) {
                              echo 'selected="selected"';
                            } ?> value="<?= $v->role_id ?>"><?= $v->role_name ?></option>
                  <?php } ?>
                </select>
                </select>
                <span><?= form_error('status') ?></span>
              </div>

              <?php if ($this->session->userdata('user') == 1 || $this->session->userdata('user_editdetails') == 1) { ?>
                <div class="row">
                  <div class="col-lg-12 m-auto text-right">
                    <a class="btn btn-sm user_invait_btn mtoggle text-white">More Details</a>
                  </div>
                </div>
              <?php } ?>
              <div class="mtogglediv">
                <div class="row">
                  <div class="col-lg-12">
                    <h3>Personal Data</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control form-control-sm" name="username" value="<?= $edit->name ?>" required data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters.">
                      <span><?= form_error('username'); ?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Contact No</label>
                      <input type="text" class="form-control form-control-sm" name="contact_no" value="<?= $edit->contact_no ?>" data-parsley-trigger="keyup" data-parsley-type="number">
                      <span><?= form_error('contact_no'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Date Of Birth</label>
                      <input type="text" class="form-control form-control-sm datepicker" name="dob" required placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY" value="<?= date('d/m/Y', strtotime($edit->dob)); ?>" />
                      <span><?= form_error('dob'); ?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-6">
                        <label>Image</label>
                        <div class="form-group">
                          <input type="file" name="user_img" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-lg-6 pt-3">
                        <?php
                        if ($edit->img == null) {
                          $img = base_url('uploads/users/default.png');
                        } else {
                          $img = base_url('uploads/users/' . $edit->img);
                        } ?>
                        <img class="rounded-circle User_Box_img" src="<?= $img ?> " width="60%" style="border: 5px solid #dee2e6;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>CNIC</label>
                      <input type="text" class="form-control form-control-sm" name="cnic" placeholder="Type your cnic number here" required data-parsley-trigger="keyup" data-parsley-required-message="Type your CNIC number." value="<?= $edit->cnic ?>">
                      <span><?= form_error('cnic') ?></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" placeholder="Type your address here" rows="3" name="address" required data-parsley-required-message="Type any description here."><?= $edit->address ?></textarea>
                      <span><?= form_error('address') ?></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <h3>Skills</h3>
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col-lg-6">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control form-control-sm" name="category" required data-parsley-required-message="You must select at least one option.">
                        <option selected disabled>select any category</option>
                        <php if (is_array($cat) || is_object($cat)) {
                          foreach ($cat as $key => $v) {
                            if ($v->cat_id != null) { ?>
                              <option <php if ($edit->cat_id == $v->cat_id) {
                                        echo 'selected="selected"';
                                      } ?> value="<= $v->cat_id ?>"><= $v->cat_name ?></option>
                        <php }
                          }
                        } ?>
                      </select>
                      <span><= form_error('category'); ?></span>
                    </div>
                  </div> -->
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Skills</label>
                      <select class="form-control form-control-sm js-example-basic-multiple1" name="skills[]" multiple="multiple" required data-parsley-required-message="You must select at least one option.">
                        <?php if (is_array($skills) || is_object($skills)) {
                          foreach ($skills as $key => $v) {
                            if ($v->is_skill_name != null) { ?>
                              <option <?php foreach ($uskills as $key => $v1) {
                                        if ($v1->skill_name == $v->is_skill_name) {
                                          echo 'selected="selected"';
                                        }
                                      } ?> value="<?= $v->is_skill_name ?>"><?= $v->is_skill_name ?></option>
                        <?php }
                          }
                        } ?>
                      </select>
                      <span><?= form_error('skills[]'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h3>Qualification</h3>
                  </div>
                </div>
                <?php if (is_array($qualification) || is_object($qualification)) { ?>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="text-white">Degree</label>
                        <input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." value="<?= @$qualification[0]->degree_name ?>">
                        <span><?= form_error('degree[]') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="text-white">Grade/CGPA</label>
                        <input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required value="<?= @$qualification[0]->grade_or_cgpa ?>">
                        <span><?= form_error('grade[]') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="text-white">Year</label>
                        <input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number" value="<?= @$qualification[0]->passing_year ?>">
                        <span><?= form_error('year[]') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <button type="button" class="btn btn-sm btn-success add_morebtn" style="margin-top: 94%;">
                        +
                      </button>
                    </div>
                  </div>
                <?php } ?>
                <?php if (is_array($qualification) || is_object($qualification)) {
                  for ($i = 1; $i < count($qualification); $i++) { ?>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Degree</label>
                          <input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." value="<?= $qualification[$i]->degree_name ?>">
                          <span><?= form_error('degree[]') ?></span>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="text-white">Grade/CGPA</label>
                          <input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required value="<?= $qualification[$i]->grade_or_cgpa ?>">
                          <span><?= form_error('grade[]') ?></span>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="text-white">Year</label>
                          <input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number" value="<?= $qualification[$i]->passing_year ?>">
                          <span><?= form_error('year[]') ?></span>
                        </div>
                      </div>
                      <div class="col-lg-1">
                        <button type="button" class="btn btn-sm btn-danger remove_morebtn" style="margin-top: 94%;">
                          -
                        </button>
                      </div>
                    </div>
                <?php }
                } ?>
                <div class="more_fields">

                </div>
              </div>

              <div class="row pt-4">
                <div class="col-lg-12 m-auto">
                  <input type="submit" name="submit" class="btn user_invait_btn" value="Submit">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- secod_Row_End -->
  </div>
</div>
<!--Edit_User_End-->
<script type="text/javascript">
  $(document).ready(function() {
    $('.mtogglediv').hide();
    $('.mtoggle').click(function() {
      var e = $('input[name=ex_detail]').val();
      if (e == '0') {
        $('.mtogglediv').show();
        $('input[name=ex_detail]').val(1);
      } else {
        $('.mtogglediv').hide();
        $('input[name=ex_detail]').val(0);
      }
    });
    // //select2
    $('.js-example-basic-single').select2({
      width: '100%',
      tags: true
    });
    $('.js-example-basic-multiple1').select2({
      width: '100%',
      tags: true,
      placeholder: 'select or write any skills'
    });

    $('.add_morebtn').click(function() {
      var html = '';
      html = '<div class="row">' +
        '<div class="col-lg-4">' +
        '<div class="form-group">' +
        '<label class="text-white">Degree</label>' +
        '<input type="text" class="form-control form-control-sm" name="degree[]" required placeholder="Type your degree/qualification name here" data-parsley-pattern="^[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-required-message="Type only Characters." >' +
        '<span><?= form_error('degree[]') ?></span>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-4">' +
        '<div class="form-group">' +
        '<label class="text-white">Grade/CGPA</label>' +
        '<input type="text" class="form-control form-control-sm" name="grade[]" placeholder="Type your grade here" required>' +
        '<span><?= form_error('grade[]') ?></span>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-3">' +
        '<div class="form-group">' +
        '<label class="text-white">Year</label>' +
        '<input type="number" class="form-control form-control-sm" step="any" id="budget" name="year[]" required placeholder="Type your passing year here" data-parsley-trigger="keyup" data-parsley-type="number">' +
        '<span><?= form_error('year[]') ?></span>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-1">' +
        '<button type="button" class="btn btn-sm btn-danger remove_morebtn" style="margin-top: 94%;">-' +
        '</button>' +
        '</div>' +
        '</div>';
      $('.more_fields').append(html);
    });
    $(document).on('click', '.remove_morebtn', function() {
      $(this).closest('.row').remove();
    });
  });
</script>