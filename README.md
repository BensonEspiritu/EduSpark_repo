# 📖 About

EduSpark is a simple PHP learning dashboard built for XAMPP. It includes user authentication, course materials management, quizzes, practice exercises, study tips, and feedback submission.

## 🔎 Overview

- `account-dashboard.php` — main logged-in dashboard with user stats, XP, progress, and navigation.
- `app.php` — shared application helpers, authentication checks, database query wrappers, navigation rendering, and learning table initialization.
- `contact-feedback.php` — feedback form page for logged-in users with saved messages.
- `duodash.css` — dashboard layout and styling.
- `learning-guide.php` — learning guide page.
- `logout.php` — logs out the user and redirects to login.
- `practice-exercises.php` — practice exercise submission page.
- `quiz.php` — quiz question page and results recording.
- `study_tips.php` — study tips page.
- `subject-materials.php` — CRUD page for managing learning materials.
- `loginpage/` — login and registration forms plus database bootstrap.

## 💾 loginpage folder

- `login.php` — user login form.
- `register.php` — new user registration form.
- `login_process.php` — login request handler.
- `register_process.php` — registration request handler.
- `database.php` — database connection and user table bootstrap.
- `style.css` — login/registration page styling.
- `image.png`, `bgimage.png` — layout images used by login pages.

## 📄 Requirements

- PHP 7.x or later
- MySQL / MariaDB
- XAMPP or equivalent local web server

## 🛠 Setup

1. Copy the `EduSpark` folder into your web root. For XAMPP the path is typically `C:\xampp\htdocs\EduSpark`.
2. Start Apache and MySQL from the XAMPP control panel.
3. Open `http://localhost/EduSpark/loginpage/login.php` in your browser.
4. Register a new user or log in with an existing account.

## ⚙️ Database

- `loginpage/database.php` creates the `eduspark_db` database and the `users` table automatically.
- `app.php` contains `ensure_learning_tables()` which creates the following tables if they do not exist:
  - `materials`
  - `quiz_questions`
  - `quiz_attempts`
  - `practice_exercises`
  - `practice_submissions`
  - `feedback_messages`

## 🤝 Usage

- Log in at `loginpage/login.php`.
- Access the dashboard at `account-dashboard.php`.
- Add and manage course materials using `subject-materials.php`.
- Take quizzes on `quiz.php`.
- Submit written practice answers on `practice-exercises.php`.
- Send feedback through `contact-feedback.php`.
- View study tips and guides via `study_tips.php` and `learning-guide.php`.

## 📝 Notes

- The app stores user login data and learning activity in MySQL.
- If you move the folder, update PHP includes accordingly.
- The project is designed for local development and is not production hardened.

## 👥 Developers

- Benson Espiritu
- Jao, John Michael
- Gray, Henrich
- Ahmed, Weseem

## 📄 License
This project was developed for academic purposes.



## File reference

| File                             | Purpose                                                                                   | Key features                                                                                                                            |
| -------------------------------- | ----------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| `account-dashboard.php`          | Display the main logged-in dashboard with user stats, progress, and navigation.           | loads `app.php`, calls `require_login()`, fetches totals with `db_value()` and `db_all()`, and renders the sidebar with `render_nav()`. |
| `app.php`                        | Provide shared authentication helpers, database utility functions, and layout components. | defines `db_execute()`, `db_all()`, `db_one()`, `flash()`, `current_user()`, and `ensure_learning_tables()` for app bootstrap.          |
| `contact-feedback.php`           | Allow users to submit feedback and view recent messages.                                  | validates POST input, inserts into `feedback_messages`, and selects recent entries with `db_all()`.                                     |
| `subject-materials.php`          | Manage learning materials with create, read, update, and delete actions.                  | routes `$_POST["action"]`, uses prepared SQL for insert/update/delete, and renders editable material cards.                             |
| `quiz.php`                       | Show quiz questions, submit answers, and record quiz attempts.                            | loops question records, checks `correct_option`, inserts quiz results, and displays recent attempts.                                    |
| `practice-exercises.php`         | Present practice exercises and save user answer submissions.                              | inserts new submissions into `practice_submissions`, loads exercises, and displays recent answers with a JOIN.                          |
| `study_tips.php`                 | Display study tip topics with links to guide pages.                                       | defines a topic array, loops through cards, and links items to `learning-guide.php?topic=`.                                             |
| `learning-guide.php`             | Render a selected study guide with tips and summary content.                              | reads `$_GET["topic"]`, loads guide content from an array, and loops through tip items.                                                 |
| `logout.php`                     | Clear the current session and redirect users to the login page.                           | calls `session_unset()`, `session_destroy()`, and sends a Location header.                                                              |
| `duodash.css`                    | Style the dashboard, page layout, cards, and navigation.                                  | provides responsive UI styling for dashboards, forms, tables, and widgets.                                                              |
| `loginpage/database.php`         | Connect to MySQL and ensure the `eduspark_db` database and `users` table exist.           | uses `mysqli_connect()`, `CREATE DATABASE IF NOT EXISTS`, and `CREATE TABLE IF NOT EXISTS`.                                             |
| `loginpage/login.php`            | Render the user login form.                                                               | provides HTML email/password inputs and submits to `login_process.php`.                                                                 |
| `loginpage/login_process.php`    | Authenticate users and start a session on successful login.                               | performs a prepared SELECT, checks `password_verify()`, and sets session variables.                                                     |
| `loginpage/register.php`         | Render the account registration form.                                                     | provides full name, username, email, and password inputs and submits to `register_process.php`.                                         |
| `loginpage/register_process.php` | Validate registration data and insert new users.                                          | checks duplicate username/email, hashes passwords with `password_hash()`, and inserts a new user record.                                |
| `loginpage/style.css`            | Style the login and register pages.                                                       | defines form layout, input styling, and responsive page appearance.                                                                     |
| `feedback and others/`           | Contains an alternate login/register flow, supporting files, and shared assets.           | includes a second database connection, style sheet, login/register pages, and related scripts for legacy or extended flows.            

