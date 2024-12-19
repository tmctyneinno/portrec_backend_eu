<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Application</title>

  <style>
    /* General reset */
* {
  margin: 10px;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  background-color: #eee;
  color: #333;
}

/* Container */
.container {
  max-width: 700px;
  margin: 30px auto;
  background-color: #fff;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  overflow: hidden;
}

/* Header */
.header {
  background-color: #f9fafc;
  display: flex;
  margin:10px;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
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
  padding:20px;
  text-decoration: none;
  font-size: 14px;
  float:right;
}

.header nav a:hover {
  text-decoration: underline;
}

/* Candidate Card */
.candidate-card {
  padding: 20px;
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
  padding: 10px 20px;
  margin-top: 10px;
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
  color: #28a745;
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
<body>
  <div class="container">
    <!-- Header Section -->
    <header class="header">
      <div class="logo">Portrec Resourcing <span> For Employers</span></div>
      <nav >
        <a href="#">Jobs</a>
        <a href="#">Candidates</a>
        <a href="#">Post a Job</a>
      </nav>
    </header>

    <!-- Candidate Section -->
    <section class="candidate-card">
      <h1>{{$data['user']}} applied for<br> <strong>{{$data['position']}}</strong></h1>
      <button class="view-candidate">View candidate</button>

      <div class="details">
        <p><strong>Relevant experience:</strong> <span class="highlight">{{$data['relevant_experiece']}}</span></p>
        <p><strong>Located in:</strong> <span class="highlight">{{$data['location']}}</span></p>

        <p class="qualifications">
          {{-- <strong>All applicant qualifications met</strong> --}}
        </p>
        {{-- <div class="interview">
          ✅ <span class="green-text">Interview availability:</span> <strong>13th, 16th, 17th December 2024 9am-5pm</strong>
        </div> --}}

        <p class="applied-to">
          ↔️ <strong>Applied to 1 of your other jobs</strong>
        </p>
        <a href="#" class="view-resume">View Resume</a>
        {{-- <p class="note">This link is shareable and sign in is not required.</p> --}}
      </div>
    </section>
  </div>
  <footer>
    <p class="email-copyright-text" style="font-size: 12px;margin: 0;padding: 0;">Copyright © {{date('Y')}} Portrec.ng. All rights reserved. <br> 1, Adeola Adeoye Street, Off Toyin Street, Ikeja, Lagos State.</p>
  </footer>
</body>
</html>
