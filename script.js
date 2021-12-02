var time = setInterval(time, 1);
var startime = new Date().getTime;

function time() {
  var time = new Date();
  document.getElementById("time").innerHTML = time.toLocaleTimeString();
}
