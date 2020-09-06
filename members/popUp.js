var newWindow = null;
var cart = [];
function popItUp(win) 
{
	var windowFile = win + ".php"
	newWindow = open(windowFile, win,
	"scrollbars,resizable,width=500,height=700");
}

function add(val)
{
	cart.push("val");
}