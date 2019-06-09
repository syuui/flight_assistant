/**
 * navi.js: jQuery二级菜单
 */
$(function() {
	$('#navi .nav li').hover(function() {
		$(this).find('ul').css('display', 'block');
	}, function() {
		$(this).find('ul').css('display', 'none');
	});
});