var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
function openPage(url){
	if (url.indexOf("?")== -1) {
		url = url + "?";
	}
	var encodedURL = encodedURL(url + "&userLoggedIn="+userLoggedIn);
	$("#mainContent").load(encodedURL);
}

function setTime(seconds){

	var time = Math.round(seconds);
	var minute = Math.floor(time / 60);
	var seconds =time - (minute * 60 );

	var extraZero;
	if (seconds < 10) {
		extraZero = "0";
	}
	else
	{
		extraZero = "";
	}
	return minute + ":" + extraZero +seconds;
}
function updateTimeProgressBar(audio){
	$(".progressTime.current").text(setTime(audio.currentTime));
	$(".progressTime.remaing").text(setTime(audio.duration-audio.currentTime));

	var progress =  audio.currentTime/audio.duration * 100 ;
	$(".playingbackbar .progress").css("width",progress + "%");
}
function updateVolumeProgressBar(audio){

	var progress =  audio.volume * 100 ;
	$(".volumeBars .progress").css("width",progress + "%");
}
function Audio(){
	this.currentlyPlaying;
	this.audio = document.createElement('audio');
	this.audio.addEventListener("ended",function(){
		nextSong();
	});

	this.audio.addEventListener("canplay",function(){
		//'this' refer to the object that the event was called on
		var duration = setTime(this.duration);
		$(".progressTime.remaing").text(duration);	
	});
	this.audio.addEventListener("timeupdate",function(){
		if (this.duration) {
			updateTimeProgressBar(this);
		}
		
	});
	this.audio.addEventListener("volume change",function(){
		updateVolumeProgressBar(this);
	});
	this.setTrack = function(track){
		this.currentlyPlaying = track;
		this.audio.src = track.paths;
	}
	
	this.play = function(){
		this.audio.play();
	}
	this.pause = function(){
		this.audio.pause();
	}
	this.settime = function(seconds){
		this.audio.currentTime = seconds;
	}
}
