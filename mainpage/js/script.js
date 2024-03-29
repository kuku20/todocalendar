// ========================================================================================================================================
     

$(document).ready(function(){
            var calendar = $('#calendar').fullCalendar({
                header:{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                editable: true,
                selectable: true,
                allDaySlot: false,
                
                events: "mainpage/call.php?view=1",
    
                
                eventClick:  function(event, jsEvent, view) {
                    endtime = $.fullCalendar.moment(event.end).format('h:mm');
                    starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
                    var mywhen = starttime + ' - ' + endtime;
                    $('#modalTitle').html(event.title);

                    $('#modalColor').html(event.color);

                    $('#modalWhen').text(mywhen);
                    $('#eventID').val(event.id);
                    $('#calendarModal').modal();
                },
                
                //header and other values
                select: function(start, end, jsEvent) {
                    endtime = $.fullCalendar.moment(end).format('h:mm');
                    starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
                    var mywhen = starttime + ' - ' + endtime;
                    start = moment(start).format();
                    end = moment(end).format();
                    $('#createEventModal #startTime').val(start);
                    $('#createEventModal #endTime').val(end);
                    $('#createEventModal #when').text(mywhen);
                    $('#createEventModal').modal('toggle');
            },
            eventDrop: function(event, delta){
                $.ajax({
                    url: 'mainpage/call.php',
                    data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id+'&color='+event.color +'&datestart='+moment(event.start).format()+'&dateend='+moment(event.end).format() ,
                    type: "POST",
                    success: function(json) {
                    //alert(json);
                    }
                });
            },
            eventResize: function(event) {
                $.ajax({
                    url: 'mainpage/call.php',
                    data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id+'&color='+event.color +'&datestart='+moment(event.start).format()+'&dateend='+moment(event.end).format(),
                    type: "POST",
                    success: function(json) {
                        //alert(json);
                    }
                });
            }
            });
                
       
        
    });



// ========================================================================================================================================
$('#submitButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doSubmit();
});

$('#deleteButton').on('click', function(e){
    // We don't want this to act as a link so cancel the link action
    e.preventDefault();
    doDelete();
});

function doDelete(){
    $("#calendarModal").modal('hide');
    var eventID = $('#eventID').val();
    $.ajax({
        url: 'mainpage/call.php',
        data: 'action=delete&id='+eventID,
        type: "POST",
        success: function(json) {
            if(json == 1)
                    $("#calendar").fullCalendar('removeEvents',eventID);
            else
                    return false;
                
            
        }
    });
}
function doSubmit(){
    $("#createEventModal").modal('hide');
    var title = $('#title').val();
    var color = $('#color').val();
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    
    $.ajax({
        url: 'mainpage/call.php',
        data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime+'&color='+color,
        type: "POST",
        success: function(json) {
            $("#calendar").fullCalendar('renderEvent',
            {
                id: json.id,
                title: title,
                start: startTime,
                end: endTime,
                color: color,
            },
            true);
        }
    });
    
}