$(document).ready(function() {
	$("body").on('click',".icon-upload",function() {
		var $selectedTr = $(this).parent().parent();
		var $trAbove = $selectedTr.prev();
		if (typeof $trAbove.attr('id') == 'undefined') {
			alert("Diese Spalte kann nicht weiter nach oben verschoben werden");
		} else {
			switchColumns($selectedTr.attr('id'), $trAbove.attr('id'));
		}
	});
	
	$("body").on('click',".icon-download",function() {
		var $selectedTr = $(this).parent().parent();
		var $trAbove = $selectedTr.next();
		if (typeof $trAbove.attr('id') == 'undefined') {
			alert("Diese Spalte kann nicht weiter nach unten verschoben werden");
		} else {
			switchColumns($selectedTr.attr('id'), $trAbove.attr('id'));
		}
	});
});

function switchColumns(c1,c2) {
	var cID1 = c1.split("_")[1];
	var cID2 = c2.split("_")[1];
	var requestUrl = document.URL.split("/columns")[0] + "/columns/switchOrder/" + cID1 + "/" + cID2;
	$.ajax( {
		type: 'POST',
		url: requestUrl,
		content: "ajax=1",
		success: function(response) {
			if (response == "200") {
				var temp = $("#column_"+cID1).html();
				$("#column_"+cID1).html($("#column_"+cID2).html());
				$("#column_"+cID2).html(temp);
				var newID1 = 'column_' + cID2;
				var newID2 = 'column_' + cID1;
				$("#column_"+cID1).attr('id',newID1);
				$("#column_"+cID2).attr('id',newID2);
			} else if (response == "500") {
				alert("Ein unbekannter Fehler ist aufgetreten");
			}
		},
		error: function(response) {
			alert("Ein unbekannter Fehler ist aufgetreten");
		}
	});
}
