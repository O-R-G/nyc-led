// setting up title
for(i=0;i<title.length;i++){
	// $("#top .loop1").append("<a></a>");
	$("#top .loop1").append("<div class = 'title'><h1>"+title[i]+"</h1></div><div class = 'title glyphs'><img src = '"+topGlyphUrl[i%2]+"'></div>");
}
// setting up runningText
for(i = 0;i<runningText.length;i++){
	$("#top2 .loop1").append("<div class = 'runningText'><h1>"+runningText[i]+"</h1></div>");
}
// setting up showcase

for(i=0;i<coolKidz.length;i++){
	if(coolKidz[i].workUrl[0] == "cip"){
		$("#mid .loop1").append("<div class = 'showcase cip'></div>");
	}else if(coolKidz[i].workUrl[0] == "pic"){
		$("#mid .loop1").append("<div class = 'showcase pic'></div>");
	}
	$("div.showcase:last-of-type").append("<div class = 'showcase_title'><a href = '"+coolKidz[i].website+"' target = '_blank'><h3>"+coolKidz[i].name+"</h3></a></div>");
	$("div.showcase:last-of-type").append("<div class = 'work'><img src = '"+coolKidz[i].workUrl[2]+"'></div>");
	$("div.showcase:last-of-type").append("<div class = 'bookLink'><a href = '"+coolKidz[i].bookLink[1]+"' target = '_blank'><h3>"+coolKidz[i].bookLink[0]+"</h3></a></div>");
	if(coolKidz[i].name == 'Joel Kern'&&wW<=1000){
		$("div.showcase:last-of-type").removeClass('cip').addClass('pic');
	}
	
}

if(wW>1000){
	$(".showcase").each(function(i){
		var thisTitle = $(this).find(".showcase_title");
		var thisTitleW = thisTitle.width(),
			thisTitleH = thisTitle.height();
		thisTitle.css({'top':(midH-thisTitleH)/2+'px','left':midMargin-thisTitleW/2+'px'});
		var thisBook = $(this).find(".bookLink");
		var thisBookW = thisBook.width(),
			thisBookH = thisBook.height();
		thisBook.css({'top':(midH-thisBookH)/2+'px','right':thisBookH-thisBookW/2+midMargin+'px'});
	});
}
// setting up statement
$("#mid .loop1").prepend("<div id = 'statement' class = 'showcase pic'></div>");
	$("#statement").append("<div id = 'showTitle' class = 'wallText'></div><div id = 'showBody' class = 'wallText'></div>");
	for(i = 0;i<wallText.t.length;i++){
		$("#showTitle").append("<div><div><h1>"+wallText.t[i]+"</h1></div><div><img src = '"+stateGlyphUrl[i%2]+"'></div></div>");
	}
	for(i = 0;i<wallText.body.length;i++){
		$("#showBody").append("<div><h4>"+wallText.body[i]+"</br></br></h4></div>");
	}
	$('.imgHolder').each(function(i){
		$(this).append("<img src = '"+stateGlyphUrl[(i+1)%2]+"'>")
	});
if(wW>1000){
	
	
}else{
	
}


// setting up names 
for(i = 0; i<coolKidz.length;i++){
	$("#bottom .loop1").append("<div class = ckCtner></div>");
	$("#bottom .loop1 .ckCtner:last-of-type").append("<div class = 'names'><h2>"+coolKidz[i].name+"</h2></div>");
	$("#bottom .loop1 .ckCtner:last-of-type").append("<div class = 'glyphs'><img src = '"+botGlyphUrl[i%2]+"'></div>");
}

$("#top img").on('load', function(){
	topImgStatus++;
	if(topImgStatus == $("#top img").length){
		topLoopingW = $("#top .loop1").width();
		var topMarqueee = new marqueee("#top .movingCtner", topLoopingW, 20000);
		topMarqueee.run();
		if(wW>1000){
			$("#top").hover(function(){
				topMarqueee.pause();
				topStatus = 1;
			},function(){
				if(topStatus == 1){
					topStatus = 0;
					topMarqueee.run();
				}
			});
		}
	}
	$("#top").click(function(){
		$("#mid .movingCtner").stop().animate({'margin-left':-midLoopingW+"px"},1000,function(){
			$("#mid .movingCtner").css("margin-left",0+"px");
		});
		
	});

});

top2LoopingW = $("#top2 .loop1").width();
var top2Marqueee = new marqueee("#top2 .movingCtner", top2LoopingW, 25000);
	top2Marqueee.run();

if(wW>1000){
	$("#top2").hover(function(){
		top2Marqueee.pause();
		top2Status = 1;
	},function(){
		if(top2Status == 1){
			top2Status = 0;
			top2Marqueee.run();
		}
	});
}



$("#bottom img").on('load', function(){
	botImgStatus++;
	if(botImgStatus == coolKidz.length){
		var ckUnit = $("#bottom .loop1").html();
		$('.ckCtner').each(function(){
			botLoopingW+=$(this).width();
		});
		// botLoopingW += loopAdjust;
		$("#bottom .loop").css('width', botLoopingW+'px');
		var botMarqueee = new marqueee("#bottom .movingCtner",botLoopingW, 50000);
		botMarqueee.run();

		if(wW>1000){
			$("#bottom").hover(function(){
				botMarqueee.pause();
				botStatus = 1;
			},function(){
				if(botStatus == 1){
					botStatus = 0;
					botMarqueee.run();
				}
			});
		}
	}

	$(".names").each(function(i){
	$(this).click(function(){
		clickNow = ((parseInt((i+1)/showcaseNum)+1)+i)%showcaseNum;
		
		if(clickNow>showcaseViewing){
			if(Math.abs(clickNow-showcaseViewing)<4){
				var sec = 500;
			}else if(Math.abs(clickNow-showcaseViewing)<10){
				var sec = 1000;
			}else{
				var sec = 1500;
			}
			showcaseViewing = clickNow;
			$("#mid .movingCtner").stop().animate({"margin-left": -clickNow*wW+"px"},sec);
		}else if(clickNow<showcaseViewing){
			showcaseViewing = clickNow;
			if(Math.abs(clickNow-showcaseViewing)<4){
				var sec = 1666;
			}else if(Math.abs(clickNow-showcaseViewing)<10){
				var sec = 1000;
			}else{
				var sec = 500;
			}
			$("#mid .movingCtner").stop().animate({"margin-left": (-clickNow-showcaseNum)*wW+"px"},1000,function(){
				var recali = parseInt($(this).css("margin-left"))+midLoopingW;
				$(this).css("margin-left",recali+"px");
			});
		}
	});
});
});
$(".work img").on('load',function(){
	if(midStatus == 0){
		midStatus++;
		var workH = $(this).height(),
			workW = $(this).width();
		var workT = (midH-workH)/2;
		console.log(workH);
		$('.work img').css('margin-top',workT+'px');

	}

});
	
$(document).ready(function(){
	$(window).resize(function(){
		nowW = $(window).width();
		noeH = $(window).height();
		midH = nowH-0.12775*nowW;
		$('#mid').css('height',midH+"px");
		console.log('resizing: '+midH,nowW);

		var workH = $('.work img:first-of-type').height(),
			workW = $('.work img:first-of-type').width();
		var workT = (midH-workH)/2;
		$('.work img').css('margin-top',workT+'px');
	});
});
	

	
	

var midMarqueee = new marqueee("#mid .movingCtner",midLoopingW, 30000);




	
	

	