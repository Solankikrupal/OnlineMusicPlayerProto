$(document).ready(function(){
	console.log("Ready");
	$("#hidelogin").click(function(){
	console.log("pressed log in");
		$("#registerform").show();
		$("#loginForm").hide();
	});

	$("#hideregister").click(function(){
		console.log("pressed reg in");
		$("#registerform").hide();
		$("#loginForm").show();
	});
});