<!DOCTYPE html>
<html>
<title>TEST BOOK | Documentation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body class="w3-content" style="max-width:1300px">

<!-- First Grid: Logo & About -->
<div class="w3-row">
  <div class="w3-half w3-black w3-container w3-center" style="height:700px">
    <div class="w3-padding-64">
      <h1>TEST BOOK</h1>
    </div>
    <div class="w3-padding-64">
      <a href="signup.php" class="w3-button w3-black w3-block w3-hover-blue-grey w3-padding-16">Sign Up</a>
      <a href="login.php" class="w3-button w3-black w3-block w3-hover-teal w3-padding-16">Log in</a>
      <a href="index.php" class="w3-button w3-black w3-block w3-hover-dark-grey w3-padding-16">Take Test</a>
      <a href="#contact" class="w3-button w3-black w3-block w3-hover-brown w3-padding-16">Contact</a>
    </div>
  </div>
  <div class="w3-half w3-blue-grey w3-container" style="height:700px">
    <div class="w3-padding-64 w3-center">
      <h1>About</h1>
      <img src="https://scontent.fdel11-1.fna.fbcdn.net/v/t1.0-9/102661809_2749433105276558_3956886679754672404_n.jpg?_nc_cat=101&_nc_sid=8024bb&_nc_ohc=7pQsvfkUBzgAX80t_tN&_nc_ht=scontent.fdel11-1.fna&oh=0418633264bfe6f2172042a233eb659c&oe=5F019EC6" class="w3-margin" alt="Person" style="width:80%">
      <div class="w3-left-align w3-padding-large">
        <p><b>Q: </b>What This Sotware Do?</p>
		<p><b>Ans: </b>This software allow users to Conduct and Schedule Tests.</p>
		<p>This software only allow Optional Question Answers.</p>
		<p>You can also Conduct Fill in the blanks by giving options.</p>
		</div>
    </div>
  </div>
</div>

<!-- Second Grid: Work & Resume -->
<div class="w3-row">
  <div class="w3-half w3-light-grey w3-center" style="min-height:800px" id="work">
    <div class="w3-padding-64">
      <h2>Quick Start</h2>
		<p>How to Schecule a Test?</p>
		<ol style="text-align:left !important" class="w3-ul">
		<li> <b>Sign Up/Log In</b></li>
		<li><b>Click on Schedule Test</b></li>
		<li><b>Enter:</b></li>
		<ul>
	<li><b>Title:</b> of Test (eg. General Knowledge Test for Students)</li>
	<li><b>Start Date:</b> is the date and time when your test starts and allow your audinece to give answers.</li>
	<li><b>Duration:</b> is Time duration in Minute after this Minute your test will expire.</li>
	<li><b>Question:</b> Enter Your Questions</li>
	<li><b>Options:</b> There are four options for each question</li>
	<li><b>Right Option:</b> Admin Need to tick the (radio button) which one is right options</li>
	<li><b>Add Question:</b> button will allow you to add more questions in yout tests (Note: you can only add upto 50 questions)</li>
	<li><b>Schedule:</b> button will Schedule your test and provie test id and link to share with your audinece</li>
	<li><b>Cancel:</b> button will cancel your Schedulation and transfer you on home page</li>
	</ul>
	</ol>
    </div>
  </div>
  <div class="w3-half w3-indigo w3-container" style="min-height:800px">
    <div class="w3-padding-64 w3-center">
      <h2>How to take test:</h2>
	  </div>
	  <div>
	  <p>To Teke test <a href="index.php">Click here</a> or go to Website</p>
	  <ul class="w3-ul w3-border">
      <li>If you come through the test link you need to enter you name and just GO :)</li>
		<li>If you come dont come through test link you need to provide test id and name and then GO :)</li>
		</ul>
      </div>
	  <div class="w3-padding-64 w3-center">
	  <p>Its Awesome</p>
	  </div>
    </div>
  </div>
</div>

<!-- Third Grid: Swing By & Contact -->
<div class="w3-row" id="contact">
  <div class="w3-half w3-dark-grey w3-container w3-center" style="height:700px">
    <div class="w3-padding-64">
      <h1>Swing By</h1>
    </div>
    <div class="w3-padding-64">
      <p>..for a cup of coffee, or whatever.</p>
      <p>Gurugram, India</p>
      <p>+91 9810932480</p>
      <p>scn.arn@gmail.com</p>
    </div>
  </div>
  <div class="w3-half w3-teal w3-container" style="height:700px">
    <div class="w3-padding-64 w3-padding-large">
      <h1>Contact</h1>
      <p class="w3-opacity">GET IN TOUCH</p>
      <form class="w3-container w3-card w3-padding-32 w3-white" action="/action_page.php" target="_blank">
        <div class="w3-section">
          <label>Name</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Name" disabled>
        </div>
        <div class="w3-section">
          <label>Email</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Email" disabled>
        </div>
        <div class="w3-section">
          <label>Message</label>
          <input class="w3-input" style="width:100%;" type="text" required name="Message" disabled>
        </div>
        <button type="submit" class="w3-button w3-teal w3-right" onclick="window.open('https://www.instagram.com/sachinarayans', '_blank')">Instagram</button>
      </form>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-black w3-padding-16">
  <p>Powered by <a href="https://www.sachinthakur.in/" target="_blank">Sachin Thakur</a></p>
</footer>

</body>
</html>
