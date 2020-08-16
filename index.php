<?php
session_start();
$_SESSION['score']=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TEST BOOK</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .msg-node{    
	width: 85%;
    height: auto;
    display: block;
    border: 1px solid #808080;
    border-radius: 0px 30px 30px 30px;
    padding: 12px 20px;
	margin: 20px 0px;
	background:#fff;
	}
	.msg-node-cli{
		margin-left:15%;
		border-radius:30px 30px 0px 30px;
	}
	#bg-red{
		border:1px solid #d43f3a;
		background:#f2dede;
	}
	#bg-green{
		border-radius: 30px 0px 30px 30px;
		margin-top:0px;
		border:1px solid #4cae4c;
		background:#dff0d8;
	}
	#bg-primary{
		border:1px solid #2e6da4;
		background:#337ab7;
		color:#fff;
	}
	.option-btn{
		width:max-content;
		max-width: 200px;
		padding: 8px 12px;
		margin: 10px 0px;
		border: 1px solid;
		border-radius: 30px;
		display: block;
		word-break: break-word;
	}
	body{
		background:#D0E0DF;
	}
	</style>
	<script>
<?php 
if(isset($_POST['sbmt'])){
			$sname= $_POST['sbmt'];
			$_SESSION['parti_name']=$sname;
			$loc=$_SERVER['PHP_SELF'];
			header("Location: ".$loc."?testid=".$_SESSION['testid']);
			//echo $tmp_test_id;
		}
if(!isset($_GET["testid"])){
	  echo 'var promptid = prompt("Please enter Test Id", "");';
	  echo 'if (promptid != null) {window.location.href = window.location.href+"?testid="+promptid;}';
	  }
	  else{
		  $_SESSION['testid']=$_GET['testid'];
	  }
  ?>
  </script>
</head>
<body onload="dummy()">
<?php 
if(isset($_SESSION['parti_name'])){
?>
<footer style="bottom:0;left:0;width:100%;background:#fff;"><br><div class="container"><?php if(isset($_SESSION['parti_name'])){echo "You are logged in as : ".$_SESSION['parti_name'];} ?>  <span style="float:right"><?php if(isset($_SESSION['parti_name'])){ ?><a href="logout.php">LOG OUT</a><?php } ?></span></div><hr></footer>
<div class="container">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6">
  <div style="background:#fff;padding:20px">Topic: <h3 id="test-title">Test Title Loading...</h3></div>
  <div id="appRoot">
  <div id="msg-container"></div>
  </div>
  </div>
  <div class="col-sm-3"></div>
  </div>
</div>
<?php } else{ ?>
<center><img src="https://scontent.fdel11-1.fna.fbcdn.net/v/t1.0-9/102661809_2749433105276558_3956886679754672404_n.jpg?_nc_cat=101&_nc_sid=8024bb&_nc_ohc=7pQsvfkUBzgAX80t_tN&_nc_ht=scontent.fdel11-1.fna&oh=0418633264bfe6f2172042a233eb659c&oe=5F019EC6" style="max-width:100%; height:auto"></center>
<div class="jumbotron">
<div class="container">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return true">
  <div class="form-group">
    <label for="email">What is you Name:</label>
    <input type="text" class="form-control input-lg" id="name"name="sbmt" placeholder="Enter Your Name">
  </div>
  <input type="submit" class="btn btn-danger" value="START">
</form></div>
<div class="col-sm-3"></div>
</div>
</div></div>
<div class="container">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6">
<h4>Instructions</h4>
<ul>
<li>Do Not Refresh The Page During Test.</li>
<li>Always Enter your real name.</li>
<li>There are no function to update any data. So be Carefull; Never Enter Wrong Data</li>
</ul>
<br>
<center><button class="btn  btn-lg" onclick="location.href = 'doc.php';">Documentation <small>(Landing Page)</small></button>
<button class="btn  btn-lg" onclick="location.href = 'home.php';">Create Test</button>
<button class="btn  btn-lg" onclick="location.href = 'login.php';">Log In</button>
</center>
</div>
<div class="col-sm-3"></div>
</div>
</div>

<?php } ?>
  <script>
  function dummy(){
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange= function(){
		  if(this.readyState == 4 && this.status == 200){
			  //document.getElementById("appRoot").innerHTML=this.responseText;
			  if(scheduleCheck(this.responseText)){
				  var qObj = JSON.parse(this.responseText);
				  document.getElementById("test-title").innerHTML=qObj.t;
				  document.title=qObj.t;
			  }
			  else{
			  main(this.responseText);
			  }
		  }
	  };
	  xhttp.open("GET","main.php?testid=<?php echo $_GET['testid'] ?>",true);
	  xhttp.send();
  }
//Gloabal Variable
var qObj;
var qu=0; 
 function main(str){
	  qObj = JSON.parse(str);
	  document.getElementById("test-title").innerHTML=qObj.t;
	  document.title=qObj.t;
	  qu=0;
	  showQuestion(qu,qObj);
	  
  }
  function scheduleCheck(responseTxt){
	  //This function chek secheduled time of test and return true if it allow to execute and return false if not allowed also add message return by scheduled function from server
	  try{
		  var qObj=JSON.parse(responseTxt);
	  if(qObj.sechEr=="true"){
		  computerReply(qObj.erMsg);
		  return true;
	  }
	  else{
		  return false;
	  }
	  }
	  catch(err){
		  alert("error returned: "+err);
	  }
  }
  function showQuestion(qu, qObj){
	  if(qu<qObj.q.length){
		  var msgNode=document.createElement("div");
		  msgNode.setAttribute("class","msg-node");
		  msgNode.setAttribute("id","q_"+qu);
		  msgNode.innerHTML="<p>"+qObj.q[qu].question.question+"</p>";
		  document.getElementById("msg-container").appendChild(msgNode);
		  for(i in qObj.q[qu].question.options){
			  var qOption=document.createElement("a");
			  qOption.setAttribute("class","option-btn");
			  qOption.setAttribute("href","javascript:showResult("+qu+",'"+qObj.q[qu].question.options[i]+"','appRoot',"+qu+")");
			  qOption.innerHTML=qObj.q[qu].question.options[i];
			  document.getElementById("q_"+qu).appendChild(qOption);
		  }
	  }
	  else{
		 // alert("The End");
		 	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange= function(){
		  if(this.readyState == 4 && this.status == 200){
			  var resultObj=this.responseText;
		 computerReply("Great!<br>"+resultObj);
		  }
	  };
	  xhttp.open("GET","result-mail.php?tm="+qObj.q.length,true);
	  xhttp.send();
	  }
	  }
	function computerReply(str){
		var endResultNode=document.createElement("div");
		 endResultNode.setAttribute("class","msg-node");
		 //endResultNode.setAttribute("id","bg-primary");
		 endResultNode.innerHTML=str;
		 document.getElementById("msg-container").appendChild(endResultNode);
		 window.scrollTo(0, 500000);
	}
  function showResult(op, rs, apid,qn){
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange= function(){
		  if(this.readyState == 4 && this.status == 200){
			  var resultObj=JSON.parse(this.responseText);
			  var msgReply=document.createElement("div");
			  var msgRight=document.createElement("div");
			  msgReply.setAttribute("class","msg-node msg-node-cli");
			  msgRight.setAttribute("class","msg-node msg-node-cli");
			  if(resultObj.result=="false"){
				  msgReply.setAttribute("id","bg-red");
				  msgRight.setAttribute("id","bg-green");
				  msgReply.innerHTML="Wrong Answer!";
				  msgRight.innerHTML="Right Option is: "+resultObj.rightAns;
				  				  document.getElementById("msg-container").appendChild(msgReply);
				  document.getElementById("msg-container").appendChild(msgRight);
			  }
			  else{
				  msgReply.setAttribute("id","bg-green");
				msgReply.innerHTML="Very Good!<br> Your Answer: "+resultObj.rightAns+" is Right";
				document.getElementById("msg-container").appendChild(msgReply);
			  }
			  var qid=document.getElementById("q_"+qn);
			  qid.style.cursor="default";
			  qid.style.pointerEvents="none";
			  qid.style.opacity="0.6";
			  qu++;
			  setTimeout(function(){showQuestion(qu,qObj);window.scrollTo(0, 50000);}, 1000);
		  }
	  };
	  xhttp.open("GET","check.php?qno="+op+"&ans="+rs+"&testid=<?php echo $_GET['testid'] ?>",true);
	  xhttp.send();
  }
  </script>
</body>
</html>