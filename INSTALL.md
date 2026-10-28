# EduSpark Installation Guide

This guide explains how to install and run EduSpark on a local machine for development or testing.

## Overview

EduSpark is a PHP-based learning dashboard that allows users to:
- register and log in,
- view a dashboard,
- access learning materials,
- take quizzes,
- submit practice answers,
- read study tips and feedback pages.

The application is designed for local use with XAMPP or a similar PHP + MySQL environment.

## System requirements

Before installing EduSpark, make sure your machine has:
- Windows, macOS, or Linux
- XAMPP or a similar local web server stack
- Apache enabled
- MySQL enabled
- PHP available through the server stack
- A modern web browser

## Download and extract the project

1. Download the repository to your computer.
2. Extract the files if they are in a ZIP archive.
3. Locate the project folder.

The project folder should contain a top-level `EduSpark` directory and a `README.md` file.

## Place the project in the web server folder

Copy the project folder into your local web server directory:

- Windows: `C:\xampp\htdocs\EduSpark`
- macOS/Linux: `/Applications/XAMPP/xamppfiles/htdocs/EduSpark`

If the project is already inside a folder named `EduSpark_repo`, make sure the application is served from the correct path in the browser.

## Start the required services

1. Open the XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.
4. Leave the services running while using the app.

## Database configuration

The application expects a local MySQL server and uses the database name `eduspark_db`.

The database connection information is defined in:

- `EduSpark/loginpage/database.php`

Check that the settings match your local environment:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "eduspark_db";
```

If your MySQL setup uses a different username or password, update the values before running the app.

## Run the application

Open your browser and go to:

`http://localhost/EduSpark/loginpage/login.php`

If the project is stored in a different folder name, use the correct local path instead.

## First-time database setup

On first run, the application automatically creates the required database and tables if they do not already exist. This includes tables such as:
- `users`
- `materials`
- `quiz_questions`
- `quiz_attempts`
- `practice_exercises`
- `practice_submissions`
- `feedback_messages`

This means you typically do not need to create the database manually.

## Registration and login

1. On the login page, choose the option to register.
2. Enter:
   - full name,
   - username,
   - email,
   - password
3. Submit the form.
4. Log in with the same email and password.

After successful login, you will be redirected to the dashboard.

## Common installation issues

### Apache is not running
- Start Apache in XAMPP.
- Make sure the folder is in the correct web root directory.

### MySQL is not running
- Start MySQL from XAMPP.
- Check whether another application is already using the default MySQL port.

### Database connection error
- Confirm your MySQL username and password match the values in `database.php`.
- Ensure the local MySQL service is active.

### Page not found
- Confirm the URL matches the actual application path.
- Use the correct folder name if the app was copied into a different directory.

### Login does not work
- Make sure the account was registered successfully.
- Check whether the email and password were entered exactly as created.

## Known limitations

- This project is intended for local testing and learning, not production deployment.
- It uses a basic local database setup.
- There is no password reset workflow.
- There is no email verification feature.
- Security measures are minimal compared to production-ready applications.
- The project assumes a local XAMPP-style environment.

## Recommended next step

Once the app is running successfully, open the login page and create a test account. From there, you can explore the dashboard, add materials, take quizzes, and submit practice answers.

## Support

If you are unable to run the application, verify the following before troubleshooting further:
- XAMPP is installed correctly,
- Apache and MySQL are running,
- the project folder is in the correct htdocs location,
- the database settings match your local MySQL configuration,
- the user is accessing the correct local URL.

