$(document).ready(function() {
    selesai();
});
 
function selesai() {
	setTimeout(function() {
		update();
		selesai();
	}, 10);
}
 
function update() {
	$.getJSON("../../config/pr-show-count.php", function(data) {
		$("input").empty();
		$.each(data.result, function() {
			var hasil = this['Jml']
			$("input").attr("value", hasil);
		});
	});
	
}