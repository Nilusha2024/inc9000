var xmlHttp
//show_participant
function show_customers(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_customers)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function show_newcustomers(str,icid,srch)
{  
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_customers)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
	 
} 


function stateChangedshow_customers() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_customers").innerHTML=xmlHttp.responseText 
	} 
}

function show_customers_check(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_customers_check)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function show_newcustomers_check(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_customers_check)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 


function stateChangedshow_customers_check() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_customers").innerHTML=xmlHttp.responseText 
	} 
}



function show_greetingText(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_greetingText)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 



function stateChangedshow_greetingText() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_greetingText").innerHTML=xmlHttp.responseText 
	} 
}

// end show_participant  

//show_overlimt
/*function show_overlimt(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch + "&tolpe=" + tolpe	
	showContactTimer8(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_overlimt)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_overlimt() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_overlimit").innerHTML=xmlHttp.responseText 
	} 
}*/
// end show_overlimt 

//show_policyType
function show_policytype(str,icid,srch)
{ //alert(str);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_policytype)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_policytype() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_ptype").innerHTML=xmlHttp.responseText 
	} 
}
// end show_policyType  

//show_packing
function show_packing(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	showContactTimer9(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_packing)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_packing() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_packing").innerHTML=xmlHttp.responseText 
	} 
}
// end show_packing  

//show_warrtocargopack
function show_warrtocargopack(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_warrtocargopack)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_warrtocargopack() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_warranty").innerHTML=xmlHttp.responseText 
	} 
}
// end show_warrtocargopack  

//show_claustocargopack
function show_claustocargopack(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_claustocargopack)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_claustocargopack() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_clauses").innerHTML=xmlHttp.responseText 
	} 
}
// end show_claustocargopack  

//show_warrtocargopack1
function show_warrtocargopack1(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_warrtocargopack1)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_warrtocargopack1() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_warranty1").innerHTML=xmlHttp.responseText 
	} 
}
// end show_warrtocargopack  1

//show_claustocargopack1
function show_claustocargopack1(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	//showContactTimer7(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_claustocargopack1)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_claustocargopack1() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_clauses1").innerHTML=xmlHttp.responseText 
	} 
}
// end show_claustocargopack 1 


//show_clauses
function show_clauses(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	showContactTimer8(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_clauses)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_clauses() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_clauses").innerHTML=xmlHttp.responseText 
	} 
}
// end show_clauses 

//show_marksnom
function show_marksnom(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	showContactTimer8(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_marksnom)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_marksnom() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_marksno").innerHTML=xmlHttp.responseText 
	} 
}
// end show_participant 

//show_containerized
function show_containerized(str,icid,srch,tolpe,curval)
{ //alert(tolpe);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe + "&curval=" + curval
	showContactTimer3(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_containerized)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_containerized() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_containerized").innerHTML=xmlHttp.responseText 
	} 
}
// end show_containerized  

//show_sumwithtolerance
function show_sumwithtolerance(str,icid,srch,tolpe,curval,tlo)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe + "&curval=" + curval + "&tlo=" + tlo
	showContactTimer6(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_sumwithtolerance)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_sumwithtolerance() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_policyvalue").innerHTML=xmlHttp.responseText 
	} 
}
// end show_participant 

//show_sumdetails
function show_sumdetails(str,icid,srch,tolpe,curval,tlo)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe + "&curval=" + curval + "&tlo=" + tlo
	showContactTimer2(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_sumdetails)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_sumdetails() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_sumcoverd").innerHTML=xmlHttp.responseText 
	} 
}
// end show_sumdetails 

//show_claimservers
function show_claimservers(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_claimservers)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_claimservers() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_claimservers").innerHTML=xmlHttp.responseText 
	} 
}
// end show_claimservers


//show_brokers
function show_brokers(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_brokers)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_brokers() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_brokeris").innerHTML=xmlHttp.responseText 
	} 
}
// end show_brokers

//show_warehouse
function show_warehouse(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_warehouse)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_warehouse() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_warehouse").innerHTML=xmlHttp.responseText 
	} 
}
// end show_warehouse



//show_certino
function show_certino(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	showContactTimer1();  // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_certino)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_certino() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_cerificateNo").innerHTML=xmlHttp.responseText 
	} 
}
// end show_certino


//show_seavoageport
function show_seavoageport(str,icid,srch,tolpe,curval)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe + "&curval=" + curval
	showContactTimer4 () // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_seavoageport)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_seavoageport() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_seavoage").innerHTML=xmlHttp.responseText 
	} 
}
// end show_seavoageport

//show_claimserver
function show_claimserver(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_claimserver)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_claimserver() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_clserag").innerHTML=xmlHttp.responseText 
	} 
}
// end show_claimserver

//show_settagent
function show_settagent(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_settagent)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_settagent() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_claimsetagent").innerHTML=xmlHttp.responseText 
	} 
}
// end show_settagent 

//show_settagentdetails
function show_settagentdetails(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_settagentdetails)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_settagentdetails() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_clsetiag").innerHTML=xmlHttp.responseText 
	} 
}
// end show_settagent



//show_consignee
function show_consignee(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	//showContactTimer(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_consignee)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_consignee() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_consignee").innerHTML=xmlHttp.responseText 
	} 
}
// end show_consignee

//show_sumdetailscurrency
function show_sumdetailscurrency(str,icid,srch,tolpe)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	+ "&tolpe=" + tolpe
	showContactTimer5(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedshow_sumdetailscurrency)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedshow_sumdetailscurrency() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_currencysum").innerHTML=xmlHttp.responseText 
		//show_sumwithtolerance('sumwithtolerance','5','500',icid,tolpe,'100');
	} 
}
// end show_sumdetailscurrency



//Efficiency
function getEfficiency(str,icid,srch,iNoOfEmp,dWorkingHours,aed,iProduct)
{ 
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch + "&iNoOfEmp=" + iNoOfEmp + "&dWorkingHours=" + dWorkingHours + "&aed=" + aed + "&iProduct=" + iProduct		
	//showContactTimer1(); // quickly begin the load bar
	xmlHttp=GetXmlHttpObject(stateChangedEfficiency)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateChangedEfficiency() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txtEfficiency").innerHTML=xmlHttp.responseText 
	} 
}
// end Efficiency
//
function GetXmlHttpObject(handler)
{ 
var objXmlHttp=null

if (navigator.userAgent.indexOf("Opera")>=0)
{
alert("This example doesn't work in Opera") 
return 
}
if (navigator.userAgent.indexOf("MSIE")>=0)
{ 
var strName="Msxml2.XMLHTTP"
if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
{
strName="Microsoft.XMLHTTP"
} 
try
{ 
objXmlHttp=new ActiveXObject(strName)
objXmlHttp.onreadystatechange=handler 
return objXmlHttp
} 
catch(e)
{ 
alert("Error. Scripting for ActiveX might be disabled") 
return 
} 
} 
if (navigator.userAgent.indexOf("Mozilla")>=0)
{
objXmlHttp=new XMLHttpRequest()
objXmlHttp.onload=handler
objXmlHttp.onerror=handler 
return objXmlHttp
}
} 

function showContactTimer () {
	var loader = document.getElementById('loadBar');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer()",1000);
}
function hideContactTimer () {
	var loader = document.getElementById('loadBar');
	loader.style.display = "none";
}

function showContactTimer1 () {
	var loader = document.getElementById('loadBar1');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer1()",1000);
}
function hideContactTimer1 () {
	var loader = document.getElementById('loadBar1');
	loader.style.display = "none";
}

function showContactTimer2 () {
	var loader = document.getElementById('loadBar2');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer2()",1000);
}
function hideContactTimer2 () {
	var loader = document.getElementById('loadBar2');
	loader.style.display = "none";
}
function showContactTimer3 () {
	var loader = document.getElementById('loadBar3');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer3()",1000);
}
function hideContactTimer3 () {
	var loader = document.getElementById('loadBar3');
	loader.style.display = "none";
}

function showContactTimer4 () {
	var loader = document.getElementById('loadBar4');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer4()",1000);
}
function hideContactTimer4 () {
	var loader = document.getElementById('loadBar4');
	loader.style.display = "none";
}

function showContactTimer5 () {
	var loader = document.getElementById('loadBar5');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer5()",1000);
}
function hideContactTimer5 () {
	var loader = document.getElementById('loadBar5');
	loader.style.display = "none";
}

function showContactTimer6 () {
	var loader = document.getElementById('loadBar6');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer6()",1000);
}
function hideContactTimer6 () {
	var loader = document.getElementById('loadBar6');
	loader.style.display = "none";
}

function showContactTimer7 () {
	var loader = document.getElementById('loadBar7');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer7()",1000);
}
function hideContactTimer7 () {
	var loader = document.getElementById('loadBar7');
	loader.style.display = "none";
}

function showContactTimer8 () {
	var loader = document.getElementById('loadBar8');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer8()",1000);
}
function hideContactTimer8 () {
	var loader = document.getElementById('loadBar8');
	loader.style.display = "none";
}

function showContactTimer9 () {
	var loader = document.getElementById('loadBar9');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer9()",1000);
}
function hideContactTimer9 () {
	var loader = document.getElementById('loadBar9');
	loader.style.display = "none";
}
