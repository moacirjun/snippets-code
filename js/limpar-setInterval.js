//setInterval() returns an interval ID, which you can pass to clearInterval():
var refreshIntervalId = setInterval(fname, 10000);

/* later */
clearInterval(refreshIntervalId);