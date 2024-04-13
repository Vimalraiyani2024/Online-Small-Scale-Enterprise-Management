function isNumberKey(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && (charCode<96||charCode>106))
	return false;

 return true;		
}
function isNumberKey1(evt){	  	
 var charCode = (evt.which) ? evt.which : event.keyCode
//alert(charCode);
 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && charCode!=189 && (charCode<96||charCode>106))
	return false;

 return true;		
}
function FixNumber(evt,no)
{
		 if(evt.length >no)
			return false;
		return true;
}
function disableElement(obj){
     obj.value = ' - N.A. - ';
     obj.disabled = true;
}
 
function enableElement(obj){
     obj.value = '';
     obj.disabled = false;
}
function CheckAlert(element,o1,o2){	
	if (element.checked)
	{
		enableElement(o1);		
		enableElement(o2);
	}				
	else 
	{
		disableElement(o1);
		disableElement(o2);
	}		
}