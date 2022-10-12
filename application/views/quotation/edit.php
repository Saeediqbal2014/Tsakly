<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Ediit_Project_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a></a><span class="Page_Title">Edit Quotation</span>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url('quotation'); ?>" class="btn user_invait_btn float-right">+ All Quotations</a>
      </div>
    </div>
    <!-- secod_Row_Start -->
    <form action="<?= base_url('quotation/update') ?>" method="post" id="validate_form">
      <div class="row pt-3">
        <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Client Name</label>
                <input type="text" class="form-control" name="cname" value="<?= $client[0]->name ?>" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('cname') ?></span>
                <input type="hidden" name="cl_id" value="<?= $client[0]->id  ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" class="form-control" value="<?= $client[0]->contact ?>" name="contact" required />
                    <span><?= form_error('contact') ?></span>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?= $edit->project_name ?>" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('name') ?></span>
                <input type="hidden" name="quot_id" value="<?= $edit->id ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Duration</label>
                    <input type="text" class="form-control duration" value="<?= $edit->duration ?>" name="duration" required />
                    <span><?= form_error('duration') ?></span>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <!-- Select -->
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Employees</label>
                <select name="users[]" multiple="multiple" class="js-example-basic-multiple addSalary" id="exampleFormControlSelect1" required data-parsley-required-message="You must select at least one option.">

                  <?php
                  $edit_user = explode(",", $edit->users);
                  $totak_salary_ = 0;
                  foreach ($users as $key => $v) : ?>
                    <option <?php if (in_array($v->user_id, $edit_user)) {
                              echo 'selected="selected"';
                              $totak_salary_ += $v->salary;
                            } ?> value="<?= $v->user_id ?>"><?= $v->name ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="hidden" class='slry' value="<?= $totak_salary_ ?>"/>
                <span><?= form_error('users[]') ?></span>
              </div>
            </div>
          </div>
          <!-- Select -->

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Percentage</label>
                <input type="text" class="form-control prct" name="prct" value="<?= $edit->percentage ?>" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('name') ?></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Total Amount</label>
                    <input type="text" class="form-control t_amnt" value="<?= $edit->total_amnt ?>" name="amnt" required readonly />
                    <input type="hidden" class="salary_amnt" value="<?= $edit->amount ?>" name="salary_amnt">
                    <span><?= form_error('amnt') ?></span>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <!--  -->
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."><?= $edit->description ?></textarea>
                <span><?= form_error('description') ?></span>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="row pt-4">

            <div class="col-lg-12">
              <input type="submit" name="submit" class="btn user_invait_btn confirm pop_up" value="Submit">
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- secod_Row_End -->
  </div>
</div>
<!--Ediit_Project_End-->