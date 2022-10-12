<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Ediit_Project_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a class="" style=""></a><span class="Page_Title">Create New Project</span>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url('projects'); ?>" class="btn user_invait_btn float-right">+ All Projects</a>
      </div>
    </div>
    <!-- secod_Row_Start -->
    <form action="<?= base_url('projects/add') ?>" method="post" id="validate_form" enctype="multipart/form-data">
      <div class="row pt-3">
        <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?= @$edit->project_name ?>" placeholder="Enter Project Name" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('name') ?></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Advance</label>
                    <input type="number" class="form-control" id="exampleFormControlSelect1" name="advance" required>
                    <span><?= form_error('advance') ?></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Budget</label>
                    <div class="input-group">
                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">PKR</span></span>
                      <input type="number" class="form-control" step="any" id="budget" name="budget" value="<?= @$edit->total_amnt ?>" placeholder="Project Budget" required data-parsley-trigger="keyup" data-parsley-type="number">
                      <span><?= form_error('budget') ?></span>
                      <input type="hidden" name="quot_id" value="<?= @$edit->id ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="row">
           <div class="col-lg-6">
              <div class="form-group">
                <label>Images</label>
                <input type="file" class="form-control" name="images[]" required  multiple/>
                <span><?= form_error('images') ?></span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control datepicker" name="startDate" required placeholder="MM/DD/YYYY" data-date-format="DD/MM/YYYY" />
                <span><?= form_error('startDate') ?></span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control datepicker" name="endDate" required placeholder="MM/DD/YYYY" data-date-format="DD/MM/YYYY">
                <span><?= form_error('endDate') ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Notify(Product notification before end date)</label>
                <select name="notify_days" class="form-control" required data-parsley-required-message="You must select at least one option.">
                  <option></option>
                  <?php for ($i = 1; $i <= 30; $i++) { ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                  <?php } ?>
                </select>
                <span><?= form_error('notify_days') ?></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" id="exampleFormControlSelect1" name="status" required data-parsley-required-message="You must select at least one option.">
                  <option selected disabled>select your project status</option>
                  <option value="pending">Pending for Aproval</option>
                  <option value="incomplete">Incomplete</option>
                  <option value="complete">Complete</option>
                </select>
                <span><?= form_error('status') ?></span>
              </div>
            </div>
          </div>
          <!-- Select -->
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Employees</label>
                <select name="users[]" multiple="multiple" class="js-example-basic-multiple" id="exampleFormControlSelect1" required data-parsley-required-message="You must select at least one option.">
                  <?php foreach ($users as $key => $v) : ?>
                    <option value="<?= $v->user_id ?>"><?= $v->name ?></option>
                  <?php endforeach; ?>
                </select>
                <span><?= form_error('users[]') ?></span>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="form-group">
                <label>Priority</label>
                <select class="form-control" id="exampleFormControlSelect1" name="priority" required data-parsley-required-message="You must select at least one option.">
                  <option selected disabled>select your project priority</option>
                  <option value="high">High</option>
                  <option value="medium">Medium</option>
                  <option value="low">Low</option>
                </select>
                <span><?= form_error('priority') ?></span>
              </div>
            </div>
          </div>
          <!-- Select -->
          <!--  -->
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."><?= @$edit->description ?></textarea>
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
<script>
$("#validate_form").on("submit",function(e){
  var budget = $("#budget").val();
  if(budget <= 0)
  {
    e.preventDefault();
    alert("Budget Can't be 0");
  }
})
</script>