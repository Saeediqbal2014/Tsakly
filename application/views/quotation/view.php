<style>
  .q_logo {
    padding: 20rem;
  }

  .q_logo div {
    margin: 5rem auto;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-sm-12 text-right">


      <a href="#" id="pdf" class="btn btn-dark btn-sm mr-1">Print or save pdf</a>
      <a href="<?= base_url('quotation'); ?>" class="btn user_invait_btn btn-sm float-right">+ All Quotations</a>
    </div>
  </div>
</div>
<div class="container" id="quotation" style="background: url('<?= base_url("asset/img/qt_bg.png") ?>');background-size: contain; background-repeat: no-repeat;">

  <div class="row q_logo">
    <div class="col-md-4" >
      <a href="http://gbsinn.com">
        <img src="<?= base_url('asset/img/qt_logo.png') ?>" alt="GBS" class="img-fluid">
      </a>
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-sm-12 text-center">
      <h5>QUOTATION FOR __________</h5>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-sm-12 text-center">
      <p>Prepared For</p>
      <h5><?= $client[0]->name ?></h5>
      <h5><?= $client[0]->contact ?></h5>
    </div>
  </div>


  <div class="row mt-4 p-5">
    <div class="col-sm-12 text-center">
      <p>Prepared by </p>
      <h5>GBS INN</h5>
      <h5><?= date("D-m-Y H:i A") ?></h5>
    </div>
  </div>


  <div class="row mt-5 pl-5 pt-5 mb-5" style="margin-top:100px;">
    <div class="col-sm-12">
      <h5>Subject __________</h5>
    </div>
  </div>


  <div class="row pl-5 mb-2">
    <div class="col-sm-12">
      <h5>Respect Sir,</h5>
    </div>
  </div>


  <div class="row p-5 mb-5">
    <div class="col-sm-12 text-center">
      <h5>As per the discussion we have quoted the details for the proposed project.</h5>
    </div>
  </div>

  <div class="row mt-3 pl-5 mb-5">
    <div class="col-sm-12">
      <!-- <php print_r($edit); die(); ?> -->
    <h6 class="mb-4">Project Name: <u><?= $edit->project_name ?></u></h6>
      <h6 class="mb-4">Project Duration: <u><?= $edit->duration ?> Months</u></h6>
      <h6>Project Amount: <u>RS.<?= $edit->total_amnt ?> </u></h6>
    </div>
  </div>


  <div class="row mt-3 pl-5 mb-5">
    <div class="col-sm-12">
      <h5>Terms & Conditions</h5>
      <p>_________________________</p>
      <p>___________________________</p>
    </div>
  </div>

  <div class="row mt-3 pl-5 mb-5">
    <div class="col-sm-12">
      <h6>Regards</h6>
      <h5>GBS INN</h5>
    </div>
  </div>

  <div class="row mt-3 pl-5 mb-5">
    <div class="col-sm-12">
      <p class="mb-4"><?= $edit->description ?></p>
      <p>To accept this quotation, sign here and return: _____________________________________</p>
    </div>
  </div>


  <div class="row mt-3 pl-5 mb-5">
    <div class="col-sm-12 text-center">
      <blockquote>Thank you for your business!</blockquote>
    </div>
  </div>




</div>
<script src="<?= base_url('asset/js/jQuery.print.js') ?>"></script>
<script type="text/javascript">
  $(function() {
    $("#pdf").click(function() {
      $('#quotation').print();
    })
  })
</script>