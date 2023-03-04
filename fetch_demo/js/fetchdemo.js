loaddata();
function loaddata() {
	fetch('showdata')
	  .then(function(response){ 
		return response.json()})
	  .then(function(data) {
	  var temp="";
	  temp += `<table>`;
	  for (var key in data.data) 
		{
		  if (data.data.hasOwnProperty(key)) {
			var val = data.data[key];
			  temp+="<tr>";
			  temp+="<td>"+val.id+"</td>";
			  temp+="<td>"+val.title+"</td>";
			  temp+=`<td><a id='delete-${val.id}' class='ajax-delete' href='javascript:void(0);' onclick='deleteData(${val.id}); return false;'>Delete</a></td>`;
			  temp+="</tr>";
		  }
		}
	  temp += `<table>`;
	  document.getElementById("result").innerHTML = temp; 
	});
}
	
function createData() {
loaddata();
	fetch("postdata", {
     
		// Adding method type
		method: "POST",
		 
		// Adding body or contents to send
		body: JSON.stringify({
			title: "anand phadnis",
			body: "bar",
			userId: 1
		}),
		 
		// Adding headers to the request
		headers: {
			"Content-type": "application/json; charset=UTF-8"
		}
	})
	 
	// Converting to JSON
	.then(response => response.json())
	 
	// Displaying results to console
	.then( loaddata() );
		loaddata();
}

function deleteData(id) {
  fetch('deletedata/'+id, { method: 'POST' })
    .then(() => loaddata());
}

document.getElementById('post').addEventListener("click", createData);