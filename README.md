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

