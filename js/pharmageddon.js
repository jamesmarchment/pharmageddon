// PHARMAGEDDON v0.6
// A js project by James Marchment 

// ... going to revisit/recode all of this sometime later, but for now just trying to get it operational...
// to do: check up on the vars 'p' and 'pz' (lines 34, 153, 160, 175) and maybe just get rid of them. newPill isn't too important.


// how often to create new pills and how many to create (issues with large numbers, can only initiate throwable about 20 times)
var pillPace = 1500;
var maxPills = 4;

// direction and strength of gravity
var xGrav = 0;
var yGrav = 0.15;

// how bouncy pills are
var bounce = 0.2;

// coords: x1, y1, x2, y2
// defines relevant area to fire event on object entry

//array stuff
function randomFrom(array) {
  return array[Math.floor(Math.random() * array.length)];
}

var shapeArray = ['capsule', 'round', 'square', 'oval'];
var splitArray = ['mono','dicot'];
var sizeArray = ['sm','md', 'lg'];

//need to make this dynamic based on doc sizeToContent
var coordArray = [0,1000,1900,1400]; 

function checkPillFeed(p) {
	if (p<maxPills) {
		newPill();
		} else {
		clearInterval(window.pillfeed);
		console.log("turned off");
		}
}


var palette = ["#aed6f1", "#daf7a6", "#ff5733", 
"#fad7a0", "#bb8fce", "#85929e", "#2ecc71", "#ff99ff", "#85c1e9", "#d0d3d4", "#70ac0d", 
"#fcf3cf", "#ed9529", "#28a9e0", "#8fc651", "#F8B195", "#F67280", "#C06C84", "#6C5B7B", "#355C7D", "#99B898", "#FECEAB", "#FF847C", "#E84A5F", "#A8E6CE", "#DCEDC2", "#FFD3B5", "#FFAAA6", "#FF8C94", "#E1F5C4", "#EDE574", "#F9D423", "#FC913A", "#FF4E50", "#E5FCC2", "#9DE0AD", "#45ADA8", "#547980", "#FE4365", "#FC9D9A", "#F9CDAD", "#C8C8A9", "#83AF9B", "#ffffff", ];
function randColor(obj){
	
	var thisID = $(obj).attr('id');
	console.log('coloring ' + thisID);
	
	if ($(obj).hasClass('dicot')){
		var rand = palette[Math.floor(Math.random() * palette.length)];
		$(obj).children().css( "background-color", rand);
	} else {}
	var rand = palette[Math.floor(Math.random() * palette.length)];
	$(obj).css("background-color",  rand);
	
};

//window.reInitThrowable = reInitThrowable;


// begin docready
$( document ).ready(function() {
console.log("Pharmageddon v.0.8.1");	

// tooltip
$("#instructions").hide();
// if no clicks
 // doing this by starting a timer and canceling on click
 var timeout = setTimeout(function()
    {        
$("#instructions").fadeIn(1500);
    }, 8000);
// and on click, fade away
$(".pill").mousedown(function(){
$("#instructions").fadeOut(1500);
clearTimeout(timeout);
});


// modal switch on/off
$(".settings-switch").click(function(){
  $("#settings-modal").toggle("slow");
});
	
	// Setting the height of div #wrapper to the height of content, so that absolute positioned elements can push footer down
	// why did content need to be absolute again?
	 // something to do with how throwable.js works... whatever position is set to, it changes to absolute so  that x and y position can be calculated dynamically
	 // ran into some trouble with where the throwable area would be. Need to put invisible walls. 



// moving the footer down and sizing up the wrapper
$("#footer").css("top", $('#content').outerHeight());
$("#wrapper").css("height", $('#content').outerHeight());
$("#wrapper").css("max-width", $('body').outerWidth());

	 
// vars currently useless, trying to get them to set the array below	 
var bodywidth = $('body').outerWidth();
var bodyheight = $('body').outerHeight();

var coordArray = [0,(bodyheight-300),bodywidth,bodyheight]; 

// color pills 
$( ".pill" ).each(function( index ) {
			 var thisID = $(this).attr('id');
			 randColor( $(this));
});

	 
// init throwable... 
		
$( ".pill:not(.round)" ).throwable({
	            		containment:"parent",
                        drag:true,
                        gravity:{x:xGrav,y:yGrav},
                        impulse:{
                            f:0,
                            p:{x:0,y:0}
                        },
                        shape: "box",
                        autostart:false,
                        bounce: bounce,
                        damping:0,
						areaDetection:[coordArray],
                        collisionDetection: false
                    });
$( ".round" ).throwable({
	            		containment:"parent",
                        drag:true,
                        gravity:{x:xGrav,y:yGrav},
                        impulse:{
                            f:0,
                            p:{x:0,y:0}
                        },
                        shape: "circle",
                        autostart:false,
                        bounce:bounce,
                        damping:0,
						areaDetection:[coordArray],
                        collisionDetection: false
                    });
$(".wall").throwable({
	            		containment:"parent",	
                        bounce:0.6,
						});
		 

// trying to set up a loop to drop new pills every couple seconds... this should be inside of a function that calls itself, setinterval to check, clearintercal if check fails
var pz = 0;
pillfeed = setInterval(function(){checkPillFeed(pz); pz++;}, pillPace);
    console.log("turned on");
		  $("#loader").fadeOut(400);
//end of docready
});

var p = 0;

var destruction = false;
// what to do when obj enters area
$(document).on("inarea",function (event,data){
							var pillId = $(data[0]).attr('id');
                            console.log( pillId + " enter the area");
							
							if ( destruction === true ) {
							$('#' + pillId).detach();
							newPill();} else {}
							   });

							   
// create new pills -- this one creates some trouble if it runs too many times
function newPill() {
			p++;
		   var newPill = document.createElement('div');
		   $("#wrapper").append(newPill);
	newPill.classList.add('pill');
	// here's where we'd begin an if statement to choose the shape, and mono or di
	newPill.classList.add(randomFrom(shapeArray));
	newPill.classList.add(randomFrom(splitArray));
	newPill.classList.add(randomFrom(sizeArray));		
	newPill.id = 'pill_' + p;
	newPill.innerHTML = "<span></span>";
	newPill.style.top = "-100px";
	newPill.style.left = Math.floor(Math.random() * 19) + 41 + "%";		
	randColor( newPill );
	if ($(this).hasClass('round')){var shapeType = "circle"; }else{ var shapeType = "box";} 
  $(newPill).throwable({
	            		containment:"parent",
                        drag:true,
                        gravity:{x:xGrav,y:yGrav},
                        impulse:{
                            f:0,
                            p:{x:0,y:0}
                        },
                        shape: shapeType,
                        autostart:false,
                        bounce:0.15,
                        damping:0,
						areaDetection:[coordArray],
                        collisionDetection: false
                    });
	console.log("pill_" + p + " created");
					return;
}
						