<div class="container-fluid">
  <br><br><br><br><br><br><br><br><br><br>
  <!-- <footer class="pt-4 pb-2 pl-4" style="border-top:1px solid rgba(0,0,0,.125);font-size: 13px">
    <p class="">Copyright © <?php echo date("Y") . "-" . date("y"); ?> Design By <span class="Footer_link">G B S</span></p>
  </footer> -->
  <footer class="main-footer mobile-view-align-center-footer pt-4 pb-2 pl-4" style="border-top:1px solid rgba(0,0,0,.125);font-size: 13px">
    <strong>Copyright &copy; <?php echo date("Y") . "-" . date("y"); ?> .</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <p class=""> Coded with
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="rgba(231, 81, 90, 0.4196078431)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
          <path style="color:#e7515a;" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
          </path>
        </svg>
      </p>
    </div>
  </footer>
  <!-- </div> -->
  <div id="overlay" onclick="off()"></div>
</div><!-- Content_Box -->
</div><!-- Wrapper -->
</div><!-- Main_Container -->

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Are you sure to want to delete..?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <a class="btn user_invait_btn del_btn">Yes</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>

<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>
<!-- data table -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<!-- data table -->

<!-- Select_2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Select_2 -->

<!-- Calender -->
<!-- <script src="https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js"></script> -->
<!-- Calender -->
<!--mdtimepicker-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker/mdtimepicker.js"></script>
<!--mdtimepicker-->


<!--datetimepickerend-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!--jquery ui min -->
<!-- Pusher Cdn for realtime notification starts here -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('7fbdecba1e9ae72cccd1', {
    cluster: 'us2'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    var dd = JSON.stringify(data);
    toastr.options = {
      timeOut: 8000,
      extendedTimeOut: 0,
      fadeOut: 500,
      fadeOut: 500
    };
    toastr.info(dd);

    // var dd = JSON.stringify(data);
    // var df = JSON.stringify(dd);
    //  document.getElementById('TL').addEventListener('click',function(){

    //   data = JSON.stringify();

  });
</script>
<!-- Pusher Cdn for realtime notification ends here -->
<!-- <script>
       $('#TL').click(function(){
        toastr.success("Leave has been submitted!");
      });
    </script> -->
<!--myscript-->
<script type="text/javascript">
  $(document).ready(function() {


    function UpdateLog() {
      $.ajax({
        url: '<?= base_url("Login/UpdateLogoutTime") ?>',
        data: {
          action: "UpdateTimeLog"
        },
        type: "post",
        success: function(response) {
          // Perform operation on the return value
        }
      });
    }

    setInterval(UpdateLog, 300000);

    $('#example').DataTable();
    $('#example1').DataTable();


    $('#sidebarCollapse').on('click', function() {

      $('#sidebar').toggleClass('active');

      $("#overlay").css("display", "block");
    });



  });

  function off() {

    document.getElementById("overlay").style.display = "none";
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
  }
</script>


<script type="text/javascript">
  $('.del').click(function() {
    var id = $(this).attr('data');
    $('.del_btn').prop('href', id);
  });
</script>
<script>
  $(document).ready(function() {
    $('.del_quot').click(function() {
      var id = $(this).attr('data-id');
      $('.del_quot_id').val(id);
      // alert(id);
    });
    $("#exampleFormControlSelect1").change(function() {
      $this = $(this).val();
      if ($this == '') {
        $(".slry").val('');
      }
      var t = 0;
      var slry = 0;
      $('.edit').click(function() {
        var id = $(this).attr("data-sid");
        alert(id);
        $.ajax({
          url: '<?= base_url("Quotation/get_salary") ?>',
          dataType: "json",
          data: {
            id: id
          },
          method: "post",
          success: function(res) {
            console.log(res);
            var d = $(".duration").val();
            t += Number(res[0].salary * d);
            slry += Number(res[0].salary);
            $(".t_amnt").val(t);
            $(".salary_amnt").val(t);
            $(".slry").val(slry);

          }
        });
      });


      // console.warn(t);

    });

    $(document).on('change', 'select.addSalary', function() {
      let sall = 0;
      let duration = $(document).find('input.duration').val();
      $(this).children('option:selected').each(function(index, value) {
        let emp_id = $(this).val();
        $.ajax({
          url: '<?= base_url("Quotation/get_salary") ?>',
          dataType: "json",
          data: {
            id: emp_id
          },
          method: "post",
          success: function(res) {
            sall += Number(res[0].salary * duration);
            $(document).find('input.t_amnt').val(sall);
            $(document).find('input.salary_amnt').val(sall);
          }
        });
      });
    });

    $(document).on('change', 'select.changeGroups', function() {
      let group_id = $(this).children('option:selected').val();
      let group_name = $(this).children('option:selected').text();
      let data = "";
      if (group_name == "Projects") {
        $(document).find('div.projectsss').removeClass("d-none");
        $(document).find('select.projectss').attr('required', true);
        $.ajax({
          type: "GET",
          url: "<?= site_url('Transactions/get_SubGroups_By_Group_Id') ?>" + "/" + group_id,
          success: function(data) {
            groups = $.parseJSON(data)
            // console.log(groups.length);
            $(document).find('div.sub_g').removeClass('d-none');
            for (var i = 0; i < groups.length; i++) {
              data += "<option value='" + groups[i].id + "'>" + groups[i].name + "</option>";
            }
            // console.log(data);
            $(document).find('select.subg_groupss').html(data);
          }
        });
      } else {
        $(document).find('div.projectsss').addClass("d-none");
        $(document).find('select.projectss').attr('required', false);
        $.ajax({
          type: "GET",
          url: "<?= site_url('Transactions/get_SubGroups_By_Group_Id') ?>" + "/" + group_id,
          success: function(data) {
            groups = $.parseJSON(data)
            // console.log(groups.length);
            $(document).find('div.sub_g').removeClass('d-none');
            for (var i = 0; i < groups.length; i++) {
              data += "<option value='" + groups[i].id + "'>" + groups[i].name + "</option>";
            }
            // console.log(data);
            $(document).find('select.subg_groupss').html(data);
          }
        });
      }
    });

    $(".prct").keyup(function() {
      var t = $(".salary_amnt");
      var p = $(this).val();
      const a = Number(t.val() / 100);
      var pm = Number(p * a);

      $(".t_amnt").val(Number(pm + parseInt(t.val())));
      // t.val(Number(p * a));
    })
    $(".duration").keyup(function() {
      var t = $(".slry").val();
      var d = $(this).val();

      //   alert(t);
      //   alert(d);
      //   t += Number(res[0].salary * d);
      var pm = Number(t) * Number(d);
      // console.log(pm);
      $(".t_amnt").val(Number(pm));
      // t.val(Number(p * a));
    })

    //validate form
    $('#validate_form').parsley();
    //datepicker
    $('.datepicker').datepicker({
      dropupAuto: false
    });

    //select2
    $('.js-example-basic-multiple').select2({
      width: '100%'
    });

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //delete modal
    $('.del').click(function() {
      var del = $(this).attr('data');
      $('.del_btn').prop('href', del);
    });

    $('#timepicker1,#timepicker2').mdtimepicker({
      // format of the time value (data-time attribute)
      timeFormat: 'hh:mm:ss.000',

      // format of the input value
      format: 'h:mm tt',

      // theme of the timepicker
      // 'red', 'purple', 'indigo', 'teal', 'green','blue'
      theme: 'blue',
      // determines if input is readonly
      readOnly: false,

      // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
      hourPadding: false

    }); //Initializes the time picker
  });
</script>