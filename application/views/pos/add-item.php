<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/error.css'); ?>" type="text/css">
<!-- Ediit_Project_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
        <a></a><span class="Page_Title">Create New Quotation</span>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url('pos'); ?>" class="btn user_invait_btn float-right">+ All Quotations</a>
      </div>
    </div>
    <!-- secod_Row_Start -->
    <form action="<?= base_url('store-item') ?>" method="post" id="validate_form">
      <div class="row pt-3">
        <div class="col-lg-10 m-auto card pt-5 pb-5" style="border:none">

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Client Name</label>
                <input type="text" class="form-control" name="cname" placeholder="Enter Client Name" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('cname') ?></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Contact No</label>
                    <input type="text" class="form-control" placeholder="Contact No" name="contact" required />
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
                <input type="text" class="form-control" name="name" placeholder="Enter Project Name" required data-parsley-required-message="Type only Characters.">
                <span><?= form_error('name') ?></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Duration</label>
                    <input type="text" class="form-control duration" placeholder="Duration" name="duration" required />
                    <span><?= form_error('duration') ?></span>
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
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required data-parsley-required-message="Type any description here."></textarea>
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