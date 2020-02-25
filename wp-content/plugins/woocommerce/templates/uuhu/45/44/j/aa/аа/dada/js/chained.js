var ajax = new Array();

function getCityList(sel)
{
	getVuzList(sel);
	var countryCode = sel.options[sel.selectedIndex].value;
	
	document.getElementById('dhtmlgoodies_city').options.length = 0;	// Empty city select box
	if(countryCode.length>0){
		var index = ajax.length;
		ajax[index] = new sack();
		
		ajax[index].requestFile = 'http://mvplan.ru/wp-content/themes/bimproject/js/getcities.php?countryCode='+countryCode;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createCities(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
	 $("#city_baku").val($("#dhtmlgoodies_city option:selected").text()) ;
}







function getVuzList(sel)
{
	var countryCodeVuz = sel.options[sel.selectedIndex].value;
	document.getElementById('dhtmlgoodies_vuz').options.length = 0;	// Empty city select box
	if(countryCodeVuz.length>0){
		var index = ajax.length;
		ajax[index] = new sack();
		
		ajax[index].requestFile = 'http://mvplan.ru/wp-content/themes/bimproject/js/getvuz.php?countryCodeVuz='+countryCodeVuz;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createVuz(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}



function createVuz(index)
{
	var obj = document.getElementById('dhtmlgoodies_vuz');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code	
}






function createCities(index)
{
	var obj = document.getElementById('dhtmlgoodies_city');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code	
}


function getSubCategoryList(sel)
{
	var category = sel.options[sel.selectedIndex].value;
	document.getElementById('dhtmlgoodies_subcategory').options.length = 0;	// Empty city select box
	if(category.length>0){
		var index = ajax.length;
		ajax[index] = new sack();
		
		ajax[index].requestFile = 'getSubCategories.php?category='+category;	// Specifying which file to get
		ajax[index].onCompletion = function(){ createSubCategories(index) };	// Specify function that will be executed after file has been found
		ajax[index].runAJAX();		// Execute AJAX function
	}
}
function createSubCategories(index)
{
	var obj = document.getElementById('dhtmlgoodies_subcategory');
	eval(ajax[index].response);	// Executing the response from Ajax as Javascript code	
}		