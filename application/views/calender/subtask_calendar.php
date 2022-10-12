<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>

    $(document).ready(function(){
        var calendar = $('#calendar').fullCalendar({
            header:{
                left:'prev,next today',
                center:'title, description',
                right:'month,agendaWeek,agendaDay'
            },
            events:"<?= site_url('fullcalendar/getSubTasks'); ?>",
            eventRender: function (event, element, view) {
                element.find('.fc-time').text('');
                element.find('.fc-title').html('<div class="hr-line-solid-no-margin"></div><span style="font-size: 13px;white-space: break-spaces;"><b>Title :</b> ' + event.title + '</span></div>');
                element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 13px;white-space: break-spaces;"><b>Desc :</b>' + event.description + '</span></div>');
            },
            eventClick:function(event)
            {
                
                let id = event.id;
                
                $.ajax({
                    url : '<?=site_url('fullcalendar/getSubtaskDetails/')?>'+id,
                    dataType : 'json',
                    success:function (data)
                    {
                        
                        window.location = "<?= site_url('projects/subtask_view/')?>"+id+"/"+data.project_id;
                    
                        
                    }
                })
                
            }
        });
    });
             
    </script>
    
</head>
    <body>
        <div class="pr-4 pl-4">
            <div class="container">
                <div class="row pt-1 pb-1">
                    <div class="col-lg-6">
                        <a class="" style=""></a><span class="Page_Title"><?=$title?></span>
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
        </div>
    </body>
</html>