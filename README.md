# EduSpark

EduSpark is a PHP-based learning dashboard designed to support student study activities in a simple, organized web application. The project provides a login system, personalized dashboard, course material management, quizzes, practice exercises, study guides, and feedback submission features. It is built specifically for local development using XAMPP and a MySQL database.

## Description

EduSpark is intended to help learners manage their coursework and track academic progress in one place. Users can create accounts, sign in securely, explore learning materials, review study tips, complete quizzes, submit practice tasks, and communicate feedback to the system.

The application is designed as a lightweight educational platform for academic and demonstration purposes, with a focus on straightforward PHP development and database-backed workflows.

## Features

- User registration and login
- Personalized dashboard with learner progress summary
- Course material management (create, view, update, and delete)
- Quiz-based assessment and scoring
- Practice exercise submission workflow
- Study tips and learning guide pages
- Feedback form for user communication
- Session-based access control for authenticated users
- Automatic database and table initialization for local setup

## Technologies Used

- PHP 7+ / PHP
- MySQL / MariaDB
- XAMPP (Apache + MySQL)
- HTML5
- CSS3
- Prepared SQL statements for database interaction
- Server-side session management

## Installation and Setup

1. Install XAMPP or a similar local PHP + MySQL stack.
2. Clone or download this repository to your local machine.
3. Copy the `EduSpark` folder into your web server directory. For XAMPP, this is usually:
   - Windows: `C:\xampp\htdocs\EduSpark`
   - macOS/Linux: `/Applications/XAMPP/xamppfiles/htdocs/EduSpark`
4. Start Apache and MySQL from the XAMPP control panel.
5. Ensure the database settings in `EduSpark/loginpage/database.php` match your local MySQL setup.
6. Open your browser and navigate to the login page.

## How to Run the Program

Once the server is running, access the application in the browser at:

http://localhost/EduSpark/loginpage/login.php

From there:

- Register a new account, or
- Log in with an existing user account

After successful login, you will be redirected to the main dashboard where you can access study tools and learning modules.

## Usage Example

A typical user workflow:

1. Open the login page.
2. Register an account with a name, username, email, and password.
3. Log in to the system.
4. View the dashboard summary and academic progress.
5. Open the materials section to add or manage learning content.
6. Take a quiz to receive a score.
7. Submit practice answers for assigned exercises.
8. Read study guides and tips.
9. Send feedback through the contact form.

Example learning flow:

- Log in
- Open `subject-materials.php`
- Add a material titled "Application Development"
- Go to `quiz.php` and complete the quiz
- Submit a practice answer in `practice-exercises.php`
- Review results from the dashboard

## Input and Output Information

### Inputs

The application collects and processes the following user inputs:

- Full name, username, email, and password during registration
- Login credentials during sign-in
- Quiz answers and selected multiple-choice options
- Practice exercise text submissions
- Course or subject material details
- Feedback categories, subject, and message content

### Outputs

The application produces the following outputs:

- User dashboard summary and progress statistics
- Quiz scores and result tracking
- Stored learning materials and explanations
- Practice submission records
- Study guide content and learning tips
- Feedback messages saved in the database
- Session-based navigation and authentication feedback

## Project Structure

```text
EduSpark_repo/
├── README.md
├── EduSpark/
│   ├── account-dashboard.php
│   ├── app.php
│   ├── contact-feedback.php
│   ├── duodash.css
│   ├── learning-guide.php
│   ├── logout.php
│   ├── practice-exercises.php
│   ├── quiz.php
│   ├── study_tips.php
│   ├── subject-materials.php
│   ├── loginpage/
│   │   ├── database.php
│   │   ├── login.php
│   │   ├── login_process.php
│   │   ├── register.php
│   │   ├── register_process.php
│   │   ├── style.css
│   │   ├── image.png
│   │   └── bgimage.png
│   └── feedback and others/
│       └── supporting project files and alternate assets
└──
```

## Limitations

- This project is built for local development and not intended for production deployment without additional security hardening.
- Authentication is basic and does not include advanced user role management.
- There is no email verification or password reset flow.
- The interface is functional but relatively simple and does not include modern UI frameworks.
- Database schema and logic are directly tied to local XAMPP/MySQL usage.
- There is limited validation and sanitization beyond basic form checks.

## Possible Future Improvements

- Add admin and student roles with different permissions
- Implement stronger security measures, including password hashing validation and CSRF protection
- Add search and filtering for materials and submissions
- Improve analytics and reporting for learner performance
- Add a responsive modern UI with frameworks such as Bootstrap or Tailwind CSS
- Support file uploads for course content and assignments
- Integrate a REST API for mobile or web client access
- Add data export features for quiz scores and user activity
- Improve error handling and user-friendly validation messages
- Prepare the application for deployment on a cloud hosting environment

## Notes

This project automatically creates the required database and learning tables when initialized through the local PHP server. The system stores user data and educational activity in MySQL, making it suitable for academic demonstrations and local learning projects.

This project was developed for educational purposes.
