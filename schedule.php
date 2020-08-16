<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><i class="fa fa-clipboard-list"></i></h1>
				<a href="javascript:void(0)"><?=$_SESSION['parti_name']?></a>
				<a href="home.php"><i class="fa fa-home"></i> Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2> &nbsp; Schedule Test</h2><br>
		</div>
		<div class="container">
		<div class="jumbotron" style="background:#fff">
			<form method="post" onsubmit="jsonEncode(); return false">
				<div class="form-group">
			  <label for="testTitle">Title:</label>
			  <input type="text" class="form-control form-control-lg" id="testTitle" placeholder="Title of Test" name="testTitle" required autofocus>
			</div>
			<div class="form-group">
			  <label for="scheduleDate">Start:</label>
			  <input type="datetime-local" class="form-control-sm" id="scheduleTime" placeholder="Enter password" name="scheduleDate" required>
			  <label for="duration">Duration:</label>
			  <input type="number" maxlength="4" class="form-control-sm" id="duration" placeholder="15" name="duration" style="width:100px" value="30" required> Minute
			</div>
			<hr>
			<div class="question-block" id="question-id">
			</div>
			<br>
			<button type="button" class="btn btn-warning" onclick="addQuestion()" style="border-radius:0px"><i class="fa fa-plus"></i> Add Question</button><hr>
			<button type="submit" class="btn btn-primary">Schedule</button> &nbsp;
			<a href="home.php"><button class="btn btn-secondary">Cancel</button></a>
			</form><br>
			If you are confused with any term Please <a href="doc.php">Read Documentation</a>
			<script>
			function jsonEncode(){
				var testTitle=document.getElementById("testTitle").value;
				var testDate=document.getElementById("scheduleTime").value;
				var testDuration=document.getElementById("duration").value;
				var questionElement=document.getElementsByClassName("questions");
				var q='[';
				for(var i=1; i<=questionElement.length; i++){
					if(i==1){
						q+='{"question":{ "question":"'+questionElement[i-1].value+'"';
					}
					else{
						q+=', {"question":{ "question":"'+questionElement[i-1].value+'"';
					}
					
					var optionElement=document.getElementsByClassName("q"+i+"op");
					var op='[';
					//alert(optionElement.length);
					for(j=1; j<=optionElement.length; j++){
						if(j==1){
							op+='"'+optionElement[j-1].value+'"';
						}
						else{
						op+=',"'+optionElement[j-1].value+'"';
						}
					}
					op+=']';
					q+=', "Options":'+op;
					try{
						var rightOp = document.querySelector('input[name="r'+i+'"]:checked').nextSibling.value;
					}catch(e){
						alert(e);
					}
					q+=', "right":"'+rightOp+'" }}';
				}
				q+=']';
				var json='{"testTitle":"'+testTitle+'","scheduledTime":"'+testDate+'","testDuration":"'+testDuration+' Minute","q":'+q+'}';
				
				var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange= function(){
					  if(this.readyState == 4 && this.status == 200){
							  console.log(this.responseText);
							  var outerResDiv=document.createElement("div");
							  outerResDiv.setAttribute("class","");
							  var resTextarea=document.createElement("textarea");
							  resTextarea.setAttribute("id","invite");
							  resTextarea.setAttribute("rows","10");
							  resTextarea.setAttribute("cols","40");
							  resTextarea.innerHTML=this.responseText;
							  outerResDiv.appendChild(resTextarea);
							  outerResDiv.appendChild(document.createElement("br"));
							
							  var copybtn=document.createElement("button");
							  copybtn.setAttribute("class","btn btn-outline-primary ml-2");
							  copybtn.setAttribute("onclick","var cpy=document.getElementById('invite');cpy.select();cpy.setSelectionRange(0, 99999);document.execCommand('copy'); alert('Copied!')")
							  copybtn.innerHTML="<i class='fa fa-copy'></i> Copy";
							  //copybtn.addEventListener("click", function(){ alert("Hello World!"); });
							  outerResDiv.appendChild(copybtn);
		
							  var wabtn=document.createElement("button");
							  wabtn.setAttribute("class","btn btn-outline-primary ml-2");
							  wabtn.innerHTML="<a href='whatsapp://send?text="+this.responseText+"' data-action='share/whatsapp/share'><i class='fab fa-whatsapp'></i> Whatsapp</a>";
							  outerResDiv.appendChild(wabtn);
		
							  var patt1 = /(https?:\/\/[^\s]+)/g;
								var testlink = this.responseText.match(patt1);
							  
							  document.getElementsByClassName("jumbotron")[0].innerHTML=outerResDiv.innerHTML;
					  }
				  };
				  xhttp.open("POST","scheduleRes.php",true);
				  xhttp.send(json);

				//alert(json);
			}
			var qno=1;
			function addQuestion(){
				if(qno>50){
					alert("Cant add more than 50 Question");
					location.href("home.php");
				}
				var outerDiv=document.createElement("div");
				var questionDiv=document.createElement("div");
				var questionLabel=document.createElement("label");
				questionLabel.setAttribute("for", "question");
				questionLabel.innerHTML="<hr>Question No: "+qno;
				questionDiv.appendChild(questionLabel);
				var questionInput=document.createElement("input");
				questionInput.setAttribute("type","text");
				questionInput.setAttribute("class","questions");
				questionInput.setAttribute("id","q"+qno);
				questionInput.setAttribute("name","q"+qno);
				questionInput.setAttribute("placeholder","Enter Your Question Here");
				questionInput.setAttribute("required","");
				questionDiv.appendChild(questionInput);
				
				outerDiv.appendChild(questionDiv);
				for(var i=0;i<4;i++){
					var optionDiv=document.createElement("div");
					var optionInputRadio=document.createElement("input");
					optionInputRadio.setAttribute("type","radio");
					optionInputRadio.setAttribute("name","r"+qno);
					optionInputRadio.setAttribute("required","");
					optionDiv.appendChild(optionInputRadio);
					var optionInputText=document.createElement("input");
					optionInputText.setAttribute("type","text");
					optionInputText.setAttribute("class","q"+qno+"op options");
					optionInputText.setAttribute("placeholder","Option "+(i+1));
					optionInputText.setAttribute("required","");
					optionDiv.appendChild(optionInputText);
					outerDiv.appendChild(optionDiv);
				}
				document.getElementById("question-id").appendChild(outerDiv);
				qno++;
			}
			document.addEventListener("load", addQuestion());
			</script>
		</div>
		</div>
	</body>
</html>