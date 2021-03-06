/*refreshed.js*/
heights = []

function getHeight(self){
	var id = self.attr('data-to').substring(1);
	var numid = self.attr('data-numid');
	var to = $(document.getElementById(id));
	console.log(id);
	var heightTo = to.offset().top - 50;
	//self.attr({'data-height', heightTo});
	heights[numid] = heightTo;
	return heightTo;
}

function moveBoxTo(height){
	var heightAbove = 0;
	var idAbove;
	heights.forEach(function(elem, index){
		if(elem <= height){
			console.log("height:"+height+", this elem("+index+"):"+elem);
			heightAbove = elem;
			idAbove = index;
		}
	});
	var idBelow = idAbove + 1;
	var heightBelow = heights[idBelow];
	
	var heightDiff = heightBelow - heightAbove;
	var heightMeRelative = height - heightAbove;
	var fractMe = heightMeRelative / heightDiff;
	console.log(heightAbove + " heightAbove");
	console.log(heightBelow + " heightBelow");
	console.log(heightMeRelative + " heightMeRelative");
	console.log(heightDiff + " heightDiff");
	console.log(fractMe + " fractMe");

	var elemAbove = $("a[data-numid="+idAbove+"]");
	console.log(elemAbove);
	var elemAboveOffset = elemAbove.position().top;
	console.log(elemAboveOffset + " elemAboveOffset");
	var elemBelow = $("a[data-numid="+idBelow+"]");
	console.log(elemBelow);
	var elemBelowOffset = elemBelow.position().top;
	console.log(elemBelowOffset + " elemBelowOffset");
	var elemOffsetDiff = elemBelowOffset - elemAboveOffset;
	console.log(elemOffsetDiff + " elemOffsetDiff");
	var goTo = elemAboveOffset + (elemOffsetDiff * fractMe);
	console.log(goTo + " goTo");
	
	$("#toc-box").stop().animate({'top': goTo}, 200);
	//$("#toc-box").css({'top': goTo});
}

i = 0;
//t = false
$("#refreshed-toc a").each(function(){
	var href = $(this).attr('href');
	$(this).attr({'data-to': href});
	$(this).attr({'data-numid': i});
	i++;
});

$("#refreshed-toc a").each(function(){
	getHeight($(this));
})

$("#refreshed-toc a").click(function(){
	event.preventDefault();
	var heightTo = getHeight($(this));
	$("html, body").animate({scrollTop: heightTo}, 800);
	return false;
});

$(window).scroll(function(){
	moveBoxTo($(this).scrollTop());
});

$("#refreshed-toc a").each(function(){
		//$(this).attr({'href': 'javascript:;'});
});
