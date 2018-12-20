/* "scripts.js" */
 function swap ()
{
	 x= document.getElementById("x").value;
	 y= document.getElementById("y").value;
	 x=parseInt(x);
	 y=parseInt(y);
	 console.log("x"+x);
	 console.log("y"+y);
	 x=x+y;
	 y=x-y;
	 x=x-y;
  document.getElementById("x").value= x;
  document.getElementById("y").value= y;

  
 }
