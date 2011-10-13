(function(global){
	
	var _ ={};
	_.regExpLib = {};
	_.regExpLib['email'] = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
	if (!global['SUABC']) {
		global['SUABC'] = _; 
	}
})(this);
