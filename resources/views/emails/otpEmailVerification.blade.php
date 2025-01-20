<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify your identity </title>

  <style>
    /* General reset */
* {
  margin: 5px;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  background: #eee;
  color: #333;
}

/* Container */
.container {
  max-width: 700px;
  margin: 40px auto;
  background-color: #fff;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  overflow: hidden;
}

/* Header */
.header {
  background-color: #f9fafc;
  display: flex;
  margin:5px;
  justify-content: space-between;
  align-items: center;
  padding: 5px 10px;
  border-bottom: 1px solid #e0e0e0;
}

.logo {
  font-size: 20px;
  font-weight: bold;
  color: #3a092b;
}

.logo span {
  color: #571041;
  font-size: 14px;
}

.header nav a {
  margin-left: 15px;
  color: #873A70;
  padding:10px;
  text-decoration: none;
  font-size: 14px;
  float:right;
}

.header nav a:hover {
  text-decoration: underline;
}

/* Candidate Card */
.candidate-card {
  padding: 10px;
}

.candidate-card h1 {
  font-size: 22px;
  line-height: 1.4;
  color: #333;
}

.view-candidate {
  background-color: #2557a7;
  color: #fff;
  border: none;
  padding: 10px 10px;
  margin-top: 0px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.view-candidate:hover {
  background-color: #1d4b8f;
}

.details {
  margin-top: 20px;
  font-size: 15px;
}

.highlight {
  font-weight: bold;
  color: #333;
}

.qualifications {
  margin-top: 15px;
  font-weight: bold;
}

.interview {
  margin: 10px 0;
  color: #333;
}

.green-text {
  color: #b98409;
}

.applied-to {
  margin-top: 15px;
  font-weight: bold;
}

.view-resume {
  display: inline-block;
  color: #2557a7;
  text-decoration: none;
  margin: 15px 0 5px;
}

.view-resume:hover {
  text-decoration: underline;
}

.note {
  font-size: 12px;
  color: #777;
  margin-top: 5px;
}

  </style>
</head>
<body style="background:#eee; padding:20px">
  <div class="container">
    <!-- Header Section -->
    <header class="header">
      <div class="logo">Portrec  <span> For Candidates</span></div>
      <nav >
        <a href="https://portrec.ng/for-talent">Search jobs</a>
        <a href="https://portrec.ng/contact">Contact Us</a>
      </nav>
    </header>

    <!-- Candidate Section -->
    <section class="candidate-card">
    
      <div class="details">
        <p>Hi {{$data['name']}},</p>  <p>{{__('We received a request to reset your password for your account associated with this email address. To proceed, please verify your email address with the OTP below')}}</p>
        <p class="qualifications" style="padding:6px; background:#dad7d7;color:#000; text-align:center "> {{$data['otp']}}</p>
       <p> {{__('If you didn’t request a password reset, you can safely ignore this email. Your account will remain secure, and no changes will be made.')}}</p>
       
      </div>
    </section>
  </div>
  <footer style="text-align:center">
    <div style><img src="https://portrec.ng/images/site_logo.png" width="100px"></div>
    <p style="font-size: 12px;margin: 0;padding: 0;">Copyright © {{date('Y')}} Portrec.ng. All rights reserved. <br> 1, Adeola Adeoye Street, Off Toyin Street, Ikeja, Lagos State.</p>
    <ul style="list-style: none;  text-align:center; display:inline"> 
      <li style="display:inline-block;"> <a href="https://portrec.ng/" > Home </a></li>
      <li  style="display:inline-block;"> <a href="https://portrec.ng/about-us" >  About Us </a></li>
      <li style="display:inline-block;"> <a href="https://portrec.ng/contact" > Contact Us </a></li>
    </ul>
  </footer>
</body>
</html>



