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
            // alert('Event: ' + event._id);
            // var x = JSON.stringify(event._id.$oid);
            // console.log(event);
            console.log("clidas");
            if(event._id.$oid === undefined){
                id = event._id
            }else{
                id = event._id.$oid
            }
            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            $('#modalTitle').html(event.title);

            $('#modalColor').html(event.color);

            $('#modalWhen').text(mywhen);
            $('#eventID').val(id);
            $('#calendarModal').modal();
        },
        //header and other values
        select: function(start, end, jsEvent) {
            console.log("hihii");
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
            if(event._id.$oid === undefined){
                id = event._id
            }else{
                id = event._id.$oid
            }

            console.log(id);
            $.ajax({
                url: 'mainpage/call.php',
                data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+id+'&color='+event.color +'&datestart='+moment(event.start).format()+'&dateend='+moment(event.end).format() ,
                type: "POST",
                success: function(json) {
                // alert("do");
                // $('#calendar').load("../call.php");
                // window.location.reload();
                }
            });
            console.log(event.start);
            // window.location.reload();
        },
        eventResize: function(event) {
            if(event._id.$oid === undefined){
                id = event._id
            }else{
                id = event._id.$oid
            }
            $.ajax({
                url: 'mainpage/call.php',
                data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+id+'&color='+event.color +'&datestart='+moment(event.start).format()+'&dateend='+moment(event.end).format(),
                type: "POST",
                success: function(json) {
                    // alert(json);
                    // $('#calendar').load();
                    // window.location.reload();
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
    // alert(id);
    $.ajax({
        url: 'mainpage/call.php',
        data: 'action=delete&id='+id,
        type: "POST",
        success: function(json) {
            $(this).parent().remove();
            if(json == 1){
                $("#calendar").fullCalendar('removeEvents',id);
            }
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
    // startTime = moment(startTime).format();
    // endTime = moment(endTime).format();
    $.ajax({
        url: 'mainpage/call.php',
        data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime+'&color='+color,
        type: "POST",
        success: function(json) {
            alert(json._id);
            $("#calendar").fullCalendar('renderEvent',
            {
                id: json._id,
                title: title,
                start: startTime,
                end: endTime,
                color: color,
            },
            true);
        }
    });
    
}