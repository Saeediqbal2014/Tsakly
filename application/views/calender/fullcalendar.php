<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <?php if ($this->session->flashdata('added')) { ?>
        <script>
            toastr.success("<?php echo $this->session->flashdata('added') ?>");
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        <script>
            toastr.error("<?php echo $this->session->flashdata('error') ?>");
        </script>
    <?php } ?>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title, description',
                    right: 'month,agendaWeek,agendaDay'
                },
                timeFormat: {
                    agenda: 'H(:mm)' //h:mm{ - h:mm}'
                },
                events: "<?php echo base_url(); ?>fullcalendar/load",
                eventRender: function(event, element, view) {
                    element.find('.fc-content').html('<span class="fc-time"><div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Time : ' + $.fullCalendar.formatDate(event.start, "h:mm:ss") + '</b></span></div></span>');
                    element.find('.fc-content').append('<br><span class="fc-title"><div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Title : ' + event.title + '</b></span></div></span>');
                    element.find('.fc-content').append('<br><span class="fc-desc"><div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Desc : ' + event.description + '</b></span></div></span>');
                    // element.find('.fc-content').html('<span class="fc-time"><div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Time : </b>' + $.fullCalendar.formatDate(event.start, "hh:ss") + '</span></div></span>');
                    // element.find('.fc-time').html('<div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Time : </b>' + $.fullCalendar.formatDate(event.start, "hh:ss") + '</span></div>\n');
                    // element.find('.fc-title').html('<div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Title :</b> ' + event.title + '</span></div>');
                    // element.find('.fc-title').html('<div class="hr-line-solid-no-margin"></div><span style="font-size: 13px"><b>Desc : </b>' + event.description + '</span></div><br/>');
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    $("#userDetailModal").modal("show");
                    // var title = prompt("Enter Event Title");
                    // var description = prompt("Enter Event Description");
                    // // var start_time      =   prompt("<input type='datetime' name='start'>");  
                    // if (title) {
                    //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    //     $.ajax({
                    //         url: "<?php echo base_url(); ?>fullcalendar/insert",
                    //         type: "POST",
                    //         data: {
                    //             title: title,
                    //             description: description,
                    //             start: start,
                    //             end: end
                    //         },
                    //         success: function() {
                    //             calendar.fullCalendar('refetchEvents');
                    //             alert("Added Successfully");
                    //         }
                    //     })
                    // }
                },
                editable: true,
                eventResize: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    var title = event.title;
                    var description = event.description;

                    var id = event.id;

                    $.ajax({
                        url: "<?php echo base_url(); ?>fullcalendar/update",
                        type: "POST",
                        data: {
                            title: title,
                            description: description,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Update");
                        }
                    })
                },
                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    //alert(start);
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    //alert(end);
                    var title = event.title;
                    var description = event.description;
                    var id = event.id;
                    $.ajax({
                        url: "<?php echo base_url(); ?>fullcalendar/update",
                        type: "POST",
                        data: {
                            title: title,
                            description: description,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    })
                },
                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "<?php echo base_url(); ?>fullcalendar/delete",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert('Event Removed');
                            }
                        })
                    }
                },
                timeFormat: 'H:mm',
            });
        });
    </script>

</head>

<body>
    <div class="pr-4 pl-4">
        <div class="container">
            <div class="row pt-1 pb-1">
                <div class="col-lg-6">
                    <a class=""></a><span class="Page_Title">Calendar</span>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-lg-12  card pt-5 pb-5">
                    <div class="row full-calendar">
                        <div class="col-lg-12 Category_Tabel ">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" class="userDetailModal" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Event Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= site_url("fullcalendar/insert") ?>" method="post">
                        <div class="modal-body">
                            <!-- Username -->
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="first_name">Event Name</label>
                                    <input type="text" name="title" class="form-control fname">
                                </div>
                            </div>

                            <br>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="last_name">Start Date</label>
                                    <input type="datetime-local" name="start_event" class="form-control lname">
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">End Date</label>
                                    <input type="datetime-local" name="end_event" class="form-control email">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="email">Description</label>
                                    <textarea rows="10" cols="30" name="description" class="form-control"></textarea>
                                </div>
                            </div>

                            <br>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Add">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>