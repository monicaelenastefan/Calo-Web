startList = function() {
	if (document.all&&document;.getElementById){
		navRoot = document.getElementById(".list");
		for (i=0; i;
		if (node.nodeName=="li") {
			node.onmouseover=function() {
				this.className+=" over";
  			}
  			node.onmouseout=function() {
  				this.className=this.className.replace»
				(" over", "");
   			}
   		}
  	}
}
}

window.onload=startList;