

//check off specific todos by clicking
$("ul").on("click", "li",function(){
	$(this).toggleClass("completed");
});
// Click on X to delete Todo
$("ul").on("click", "span",function(event){
	$(this).parent().fadeOut(1000, function(){
		$(this).remove()
	});
	console.log("clicked");
	event.stopPropagation();
});

$(".fa-plus").click(function(){
	$("input[type='text']").fadeToggle();
})
var myVar;

function myFunction() {
  myVar = setTimeout(alertFunc, 1800000);
}

function alertFunc() {
  alert("Hello!");
}

$("#tododay").keypress(function(event){
	// the event.which===13 is the keyprees enter
	if(event.which===13){
		//grabbing new todo text
		var todoText=$(this).val();
		$(this).val("")//give an empty box
		// borrow the ajax to seen the data to php database
			$.ajax({
                    url: 'mainpage.php',
                    type: 'POST',
                    data: {
                    	// the save is the name that the same name of input such as submit
                        'save': 1,
                        // this is stote the value that have type in
                        'tododay': todoText,
                    },
                    success: function(){
                        
                    }
                    });

$("ul#tdo").append("<li class ='todo' ><span class = 'halo' ><i class='fa fa-trash'></i></span> "+ todoText +"</li>")
	}
});
// for tododay
$("span.halo").on("click",function(){
     var idstr = this.id;
  console.log(idstr);
  if(confirm("You done this task today, it will show back tommorrow.\n Congratulations!"))
 	{
    $.ajax({
        url: 'mainpage.php',
        type: 'POST',
        data: {
          'update':1,
          'id':idstr,
        },
        success: function(){
			
        }
    });$(this).parent().remove();

 	}
  });
// for specialtodo
  $("span.special").on("click",function(){
	var idstr = this.id;
 console.log(idstr);
 if(confirm("You done this task today.\n Congratulations!"))
	{
   $.ajax({
	   url: 'mainpage.php',
	   type: 'GET',
	   data: {
		 'delete':1,
		 'id':idstr,
	   },
	   success: function(){
		$(this).parent().remove();
	   }
   });
   
	}
 });


// ===========this is for the clock===================================================
	setInterval(setClock, 1000)
	const hourHand = document.querySelector('[data-hour-hand]')
	const minuteHand = document.querySelector('[data-minute-hand]')
	const secondHand = document.querySelector('[data-second-hand]')
	 function setClock(){
	 	const currentDate = new Date()
	 	const secondsRatio = currentDate.getSeconds()/60
	 	const minutesRatio = (secondsRatio+currentDate.getMinutes())/60
	 	const hoursRatio = (minutesRatio+currentDate.getHours())/12
	 	setRotation(secondHand,secondsRatio)
	 	setRotation(minuteHand,minutesRatio)
	 	setRotation(hourHand,hoursRatio)
	 }
	 function setRotation(element, rotationRatio){
	 	element.style.setProperty('--rotation', rotationRatio*360)
	 }
	 setClock();
// =================================================================================

// ==========================calender==================================================

