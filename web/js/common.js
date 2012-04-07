/**
* Alejandro Lechuga
**/

(function(global){
	var 
	_ = {},
	namespace = "SUABC";
	
	_.regExpLib = {};
	_.regExpLib.email = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
	
	_.set = function (key, object) {
        if (!_[key]) {
            _[key] = object;
            return true;
        } else {
            return false;
        }
	};
	
	if (!global[namespace]) {
		global[namespace] = _; 
	}
})(this);

