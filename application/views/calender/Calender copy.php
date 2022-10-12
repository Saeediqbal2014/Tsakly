<style type="text/css">
   .Category_Tabel #calendar .fc-right button{
    box-shadow: 0 2px 6px #a4e6fc;
    background-color: #4fd1fe;
    border-color: #3acbfc;
    color: white;
    font-size: 12px;
    cursor: pointer;
    padding: .4em .4em;;
   }
   .Category_Tabel #calendar .fc-right button:hover{
    color: white;
    background-color: #00bfff !important;
   }
   .fc-unthemed td.fc-today
   {
     background-color: #4fd1fe!important;
      border-color: #3acbfc!important;
   }
 </style>
 <!-- Calender_Start -->
<div class="pr-4 pl-4">
  <div class="container">
    <div class="row pt-1 pb-1">
      <div class="col-lg-6">
          <a class="" style=""></a><span class="Page_Title">Calendar</span>
      </div>
      <div class="col-lg-6">
          <!-- <a href="#" 
           class="btn user_invait_btn float-right">+ Add Date</a> -->
      </div>
    </div>
      <!-- secod_Row_Start -->
    <div class="row pt-5">
      <div class="col-lg-12  card pt-5 pb-5">
          <div class="row full-calendar">
              <div class="col-lg-12 Category_Tabel ">
              <div id='calendar'></div>
          </div>
         <!--  -->
      </div>
          </div>
      </div>
    </div> 
      <!-- secod_Row_End -->
  </div>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
<script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "<?= base_url('Calender/get_events')?>",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: '<?= base_url('Calender/add_event')?>',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: '<?= base_url('Calender/edit_event')?>',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Calender/delete_event')?>",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>