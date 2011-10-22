var placeholderer = function(jq) {
return function(dimmed_colour) {
if (!!('placeholder' in document.createElement('input'))) {
return;
}
dimmed_colour = dimmed_colour || '#DDD';
var _set = function (element, text_colour, value) {
element.css('color', text_colour).val(value);
};
jq(function() {
jq('input[placeholder]').each(function() {
var element = jq(this);
var placeholder = element.attr('placeholder');
var original_colour = element.css('color');
var value = jq.trim(element.val());
if (value === '' || value === placeholder) {
_set(element, dimmed_colour, placeholder);
}
element.focus(function() {
_set(element, original_colour, '');
}).blur(function() {
var value = jq.trim(element.val());
if (value === '') {
_set(element, dimmed_colour, placeholder);
}
});
// Update in response to comments
element.parent('form').submit(function() {
var value = jq.trim(element.val());
if (value === '' || value === placeholder) {
_set(element, original_colour, '');
}
});
// End update
});
});
};
}(jQuery);

placeholderer('#ccc');

$(document).ready(function(){

$("h1[page]").click(function(){
getPage($(this).attr('page'));
});

$("#list").html(function(){
	if (window.location.hash) getPage(window.location.hash.replace('#','')+".php");
	else getPage("converted.php");
})
});

function getPage(page){
$("#list").html("");
$("<img/>").attr({
src: "images/ajax-loader.gif",
id: "loader"}).prependTo("#list");
window.location.hash = page.replace('.php','');
$( "#dl-preview").animate({height: "0px"},500,function(){$("#dl-preview-container").html("");$( "#progressbar" ).css('display','none');});
$.get("pages/"+page,function(data){
	$("#loader").remove();
	$("#list").html(data);
	
	$("a[vidid]").each(function(){
		$(this).bind('click',function(){
			var ts = Math.round((new Date()).getTime() / 1000);
			document.cookie="startStamp"+"="+ts+";path=/";
			var fin = $(this).attr('filename');
			var vid = $(this).attr('vidid');
			var pat = $(this).attr('part');
			var file = fin+"_part"+pat+"_"+vid+".asf";
			$( "#progressbar" ).css('display','block');
			$("html, body").animate({scrollTop: $("#logo").offset().top},'slow');
			$( "#dl-preview").animate({height: "0px"},500,function(){$("#dl-preview-container").html("");});

			$.get('convert.php',{ id:vid, part:pat }, function(){
				clearInterval(progress);
				document.title = 'twitch.tv2asf';
				$( "#progress-percent" ).html('');
				$( "#progress-seconds" ).html('');
				setTimeout(function(){
				$.get("pages/dl-preview.php", { filename: 'converted/'+file.replace('.asf','') }, function(data){
					$("#dl-preview-container").html(data);
					$( "#dl-preview").animate({
						height: "600px"
						},3000);
					});
				},2500);
			});
			progress = setInterval(function(){ getProgress(file) },1000);
			
			return false;
			
		});
	});
	$('.delete').each(function(){
		$(this).bind('click',function(){
			var sure = confirm('Are you sure you\nwant to delete this video?');
			var id = $(this).parent().attr('id');
			if (sure) {
				$.post('pages/forms.php',{file:id,remove:'yes'});
				$(this).parent().fadeOut('slow');
			}
		})
	})
});
$("h1[page]").css('background-color','#202020');
$("#"+page.replace(".php","")).css('background-color','orange');
}
    
function getProgress(file){
$.get("pages/time.php", { filename: 'converted/'+file }, function(data){
	var response = data.split('::');
	$( "#progressbar" ).css('width',response[0]+'%');
	$( "#progress-percent" ).html(response[0]+'%');
	$( "#progress-seconds" ).html(response[1]);
	document.title = 'twitch.tv2asf | '+response[0]+'%';
});
}