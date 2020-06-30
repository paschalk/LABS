$(document).ready(function(){
	//Returns number of mins ahead or behind the GWM.
	var offset = new Date().getTimezoneOffset();

	//Return s the number of millisecpnds since 1970/01/01
	var timestamp = new Date().getTime();

	//we convert our time to Universal Time Coordinated/ Universla Coordinated Time

	var utc_timestamp = timestamp + (6000*offset);

	$('#time_zone_offset').val(offset);
	$('#utc_timestamp').val(utc_timestamp);
	
});