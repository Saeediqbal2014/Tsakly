<div class="container-fluid">
    <br><br><br><br><br><br><br><br><br><br>
<footer class="pt-4 pb-2 pl-4" style="border-top:1px solid rgba(0,0,0,.125);font-size: 13px">
    <p class="">Copyright © 2020  Design  By <span class="Footer_link">G B S</span></p>
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

  
      <!--mdtimepicker-->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/dmuy/MDTimePicker/mdtimepicker.js"></script>
  <!--mdtimepicker-->
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <!--datetimepickerend-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!--jquery ui min -->
      <!-- Calender -->
  <script src="https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
<script src="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js"></script>


    <!-- Calender -->


    <!--myscript-->
<script type="text/javascript">
        $(document).ready(function () {
            
            $('#example').DataTable();
            $('#example1').DataTable();
            

            $('#sidebarCollapse').on('click', function () {
               
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
     $(document).ready(function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['interaction', 'dayGrid', 'timeGrid'],
      defaultView: 'dayGridMonth',
     
      header: {
        left: 'title',
        center: 'addEventButton',
        right: 'today prev,next' },
        customButtons: {
      addEventButton: {
        text: 'add event...',
        click: function() {
          var dateStr = prompt('Enter a date in YYYY-MM-DD format');
          // var title = prompt('Title of Event');
          var date = moment(dateStr);

          if (date.isValid()) {
            // alert(date);
            var event = {
              title: "title",
              start: date,
              allDay: true
            };
            $('#calendar').fullCalendar('renderEvent', event, true);
            // alert('Great. Now, update your database...');
          } else {
            alert('Invalid date.');
          }
        }
      }
    }
});
    calendar.render();
    $('.nav-tabs li a').click(function(){
      calendar.render();
    });
}); 
</script>
<script type="text/javascript">
  $('.del').click(function(){
      var id=$(this).attr('data');
      $('.del_btn').prop('href',id);
  });
</script>  
<script>  
$(document).ready(function(){
  $('.del_quot').click(function(){
      var id = $(this).attr('data-id'); 
      $('.del_quot_id').val(id);
      // alert(id);
  });
$("#exampleFormControlSelect1").change(function(){
  $this = $(this).val();
  var t = 0;
    for(a=0;a<$this.length;a++){
      id = $this[a];
      $.ajax({
        url:'<?= base_url("quotation/get_salary")?>',
        dataType:"json",
        data:{id:id},
        method:"post",
        success:function(res){
          var d = $(".duration").val();
          t += Number(res[0].salary * d);
          $(".t_amnt").val(t);
          $(".salary_amnt").val(t);
        }
      })
      
    }
    // console.warn(t);
    
})

$(".prct").keyup(function(){
  var t = $(".salary_amnt");
  var p = $(this).val();
  const a = Number(t.val() / 100);
  var pm = Number(p * a);

  $(".t_amnt").val(Number(pm+ parseInt(t.val())));
  // t.val(Number(p * a));
})

  //validate form
    $('#validate_form').parsley();
    //datepicker
    $('.datepicker').datepicker({dropupAuto: false}); 

    //select2
    $('.js-example-basic-multiple').select2({ width: '100%' });

    //tooltip
    $('[data-toggle="tooltip"]').tooltip(); 

    //delete modal
    $('.del').click(function(){
      var del=$(this).attr('data');
      $('.del_btn').prop('href',del);
    });

    $('#timepicker1,#timepicker2').mdtimepicker({
       // format of the time value (data-time attribute)
  timeFormat:'hh:mm:ss.000',
 
  // format of the input value
  format:'h:mm tt',     
 
  // theme of the timepicker
  // 'red', 'purple', 'indigo', 'teal', 'green','blue'
  theme:'blue',       
  // determines if input is readonly
  readOnly:false,      
 
  // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
  hourPadding:false    

    }); //Initializes the time picker
 });   
</script>
