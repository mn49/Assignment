function tes(){
		var myObj, txt, x;
		var request = new XMLHttpRequest();

			request.open('GET', 'https://private-anon-ca2e046192-ceritaperut.apiary-mock.com/toplist?limit=&offset=&category=');

			request.onreadystatechange = function () {
			  if (this.readyState === 4) {
				  
				myObj = JSON.parse(this.responseText);
				txt="";
				for (x in myObj.data){
				
				txt += "<div class='well' align='center'>" + "<h1 align='center'>" + myObj.data[x].toplistName + "   <img src='"+ myObj.data[x].avatar +"'></img>" +"</h1><hr>" + "   <img src='"+ myObj.data[x].toplistImage +"'></img><hr> <p>Read more of this at :</p>" + "<a href='" + myObj.data[x].toplistUrl + "' class= 'btn btn-warning'>" + myObj.data[x].toplistUrl + "</a></div>";
				
				}
				
				document.getElementById("hasil").innerHTML = txt;
			  }
			};

		request.send();
}

function tes2(){
		var myObj, txt, x;
		var request = new XMLHttpRequest();

			request.open('GET', 'https://private-anon-ca2e046192-ceritaperut.apiary-mock.com/stories?limit=&offset=&category=&author=');

			request.onreadystatechange = function () {
			  if (this.readyState === 4) {
				  
				myObj = JSON.parse(this.responseText);
				txt="";
				for (x in myObj.data){
				
				txt += "<div class='well' align='center'>" + "<h1 align='center'>" + myObj.data[x].storyTitle +"</h1><hr>" + "<img src='"+ myObj.data[x].storyImage +"'></img><hr> <p>"+ myObj.data[x].storyExcerpt +"</p> <hr> <p> About Author: </p>" + "<img src='"+ myObj.data[x].storyAuthorImage +"'></img><hr><p>" + myObj.data[x].storyAuthorName + "</p><hr><small> Created At : " + myObj.data[x].storyDate + "</small></div>" ;
				
				}
				
				document.getElementById("hasil").innerHTML = txt;
			  }
			};

		request.send();
}
