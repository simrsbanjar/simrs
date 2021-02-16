x=document.getElementById("tree").querySelectorAll("li span");

for(i=0;i<x.length;i++){
    ul=x[i].parentElement.querySelector("ul");
    if(ul!=null){
        ul.style.display="none";
        x[i].onclick=function(e){
        var ortu=this.parentElement;
        var teman=ortu.parentElement.children;
        var ul;
            for(i=0;i<teman.length;i++){
	        ul=teman[i].querySelector("ul");
                if(ul!=null && teman[i]!=ortu)ul.style.display="none";
	    }
	    ul=ortu.querySelector("ul");
	    if(ul.style.display=="none")ul.style.display="block";
	    else ul.style.display="none";
	    this.classList.toggle("dipilih");
        }
    }
}