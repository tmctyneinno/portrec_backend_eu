<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Interview </title>

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
  margin: 20px auto;
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
      <div class="logo">Portrec <span> For Employers</span></div>
      <nav >
        <a href="https://portrec.ng/search-talent">Search Talents</a>
        <a href="https://portrec.ng/contact">Contact Us</a>
      </nav>
    </header>

    <!-- Candidate Section -->
    <section class="candidate-card">
      <h1>Your interview request has been sent to <span style="text-transform: uppercase; color:#3a092b"> <a href="{{$data['resume']}}"> {{$data['user']}}</a>   </span>  </h1>
     
      <div class="details">
        <span style="font-size:20px; font-weight:bolder; text-transform:uppercase">{{$data['position']}}</span>
        <p><strong>Date:</strong> <span class="highlight">{{date('D d M, Y', strtotime($data['interview_date']))}}</span></p>
        <p><strong>Time:</strong> <span class="highlight">{{date('h:ia', strtotime($data['interview_date']))}}</span></p>
        <p><strong>Location :</strong> <span class="highlight">{{$data['location']}}</span></p>
        <p><strong>Duration :</strong> <span class="highlight">{{$data['duration']}} minutes</span></p>

        <p class="qualifications">
          @if(isset($data['host_url']))
         Click Here to Join:  <strong> {{substr($data['host_url'], 0,100)}}..</strong>
          @endif
        </p>
        <div class="interview">
          ↔️  <span class="warning-text" style="background:#b98409; padding:5px; color:#fff; border-radius:10px">Awaiting Candiate Confirmation </strong>
        </div>

        {{-- <p class="applied-to">
          ↔️ <strong>Applied to 1 of your other jobs</strong>
        </p> --}}
        <a href="{{$data['resume']}}" class="view-resume">View Resume</a>
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
