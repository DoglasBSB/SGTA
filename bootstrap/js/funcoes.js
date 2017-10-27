$(function() {
	$("span.nome_arquivo").text($("input[name=arquivo]").val());
	$("input[name=arquivo]").change(function(){
		$("span.nome_arquivo").text("");
		$("span.nome_arquivo").text($(this).val());
		});
	$(".res span").click(function(){
	   $(this).parent().hide("slow");	
	});
	// form
	$("input[name=arquivo]").hover(function(){
		$(this).siblings("span").children("img").attr("src","img/cam_hover.png");
		$(this).css("cursor","pointer");
	},function(){
		$(this).siblings("span").children("img").attr("src","img/cam.png");
   });
});
