# 🧘 Personalized Yoga & Meditation Planner

A web-based wellness application built using **Laravel MVC, PHP, MySQL, Blade, and Tailwind CSS**. The platform helps users create personalized yoga and meditation routines based on their goals, experience level, and available time.

The application also provides an immersive practice environment with fullscreen mode and calming background sounds to help users focus during yoga and meditation sessions.

## ✨ Features

### 🔐 Authentication and User Management
- User registration, login, and logout.
- Secure password hashing through Laravel authentication.
- Protected routes using authentication middleware.
- Role-based access for administrators and regular users.

### 🏠 Interactive Dashboard
- Personalized welcome dashboard.
- Quick navigation to preferences and daily plans.
- Easy access to yoga and meditation features.

### 👤 Personalized Preferences
Users can configure their wellness preferences, including:
- Age.
- Fitness or wellness goal.
- Experience level: Beginner, Intermediate, or Advanced.
- Available daily practice time.

Preferences are stored in the database and used to generate relevant recommendations.

### 🧘 Yoga Planner
- Browse yoga sessions based on user goals and experience level.
- View session names, descriptions, durations, and images.
- Discover routines suited to individual preferences.

### 🧠 Meditation Planner
- Meditation recommendations based on session categories.
- Descriptions and durations for meditation practices.
- Options for relaxation, focus, and sleep-related sessions.

### 🌿 Immersive Practice Experience
- Fullscreen practice interface for a distraction-free environment.
- Calming background music and ambient sounds.
- Nature-inspired audio options, including river and wind sounds.
- An interactive environment designed to support focus and relaxation.

### 📊 Progress Tracking
- Mark practice plans as completed.
- Store completion records against the logged-in user.
- Track daily practice activity.
- Display a daily streak to encourage consistency.

### 🛠️ Admin Panel
Administrators can manage the content available to users.

**Yoga management**
- View yoga sessions.
- Add new yoga sessions.
- Delete existing sessions.

**Meditation management**
- View meditation sessions.
- Add new meditation sessions.
- Delete existing sessions.

Admin routes are protected by custom admin middleware.

### 🎨 User Interface
- Responsive Blade templates.
- Tailwind CSS styling.
- Card-based layouts.
- Navigation links for dashboard, preferences, plans, and administration.

## 🧰 Technology Stack

| Technology | Purpose |
|---|---|
| PHP | Server-side programming |
| Laravel | Backend framework and MVC architecture |
| Blade | Frontend templating |
| MySQL | Relational database |
| Eloquent ORM | Database interaction |
| Tailwind CSS | UI styling |
| JavaScript | Interactive frontend behavior |
| Laravel Breeze | Authentication scaffolding |
| Vite | Frontend asset development and compilation |

## 🏗️ MVC Architecture

The project follows the Model-View-Controller pattern.

### Models
Located in `app/Models/`:

- `User` — user accounts and administrator roles.
- `Preference` — user wellness preferences.
- `YogaSession` — yoga session information.
- `MeditationSession` — meditation session information.
- `Progress` — practice completion records.

### Views
Located in `resources/views/`:

- Landing page and dashboard.
- Authentication pages.
- Preference form.
- Personalized plan page.
- Admin yoga and meditation pages.
- Immersive practice interface.

### Controllers
Located in `app/Http/Controllers/`:

- `PreferenceController` — preference creation, validation, and updates.
- `PlannerController` — retrieves preferences and generates recommendations.
- `ProgressController` — records completed practices.
- `Admin/YogaController` — yoga content management.
- `Admin/MeditationController` — meditation content management.

### Middleware
- `auth` — restricts access to authenticated users.
- `admin` — restricts administration routes to authorized administrators.

## 🗄️ Database Structure

The application uses MySQL with Laravel migrations.

| Table | Purpose |
|---|---|
| `users` | User accounts and admin role |
| `preferences` | Personalization settings |
| `yoga_sessions` | Yoga content and session metadata |
| `meditation_sessions` | Meditation content and categories |
| `progress` | Practice completion history |

Yoga sessions can include a name, goal, difficulty level, duration, description, and image URL.

## ⚙️ Installation and Setup

### Prerequisites

Install the following:

- PHP compatible with your Laravel version.
- Composer.
- MySQL or XAMPP.
- Node.js and npm.
- Git (optional).

### 1. Clone the repository

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
cd yoga_planner
```

Replace `YOUR_GITHUB_REPOSITORY_URL` with your actual repository URL.

Alternatively, open your existing project directory.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure the environment

Copy `.env.example` to `.env` if `.env` does not already exist.

```bash
php artisan key:generate
```

Configure the database settings in `.env`:

```env
APP_NAME="Yoga Planner"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yoga_planner
DB_USERNAME=root
DB_PASSWORD=
```

Update the database username and password to match your local MySQL configuration.

Create a MySQL database named `yoga_planner`.

### 4. Run database migrations

```bash
php artisan migrate
```

This creates the application's database tables.

### 5. Install frontend dependencies

```bash
npm install
```

### 6. Populate initial data

```bash
php artisan db:seed
```

This runs the seeders registered in `DatabaseSeeder.php`. Ensure the yoga and meditation seeders are registered before running this command.

### 7. Start the application

Open two terminals in the project directory.

**Terminal 1 — Laravel server**

```bash
php artisan serve
```

**Terminal 2 — Vite development server**

```bash
npm run dev
```

Open the application at:

http://127.0.0.1:8000

Use `npm run build` when you need to generate production frontend assets.

## 🚀 Application Workflow

1. A user registers or logs in.
2. The user configures personal wellness preferences.
3. Laravel validates and stores the preferences in MySQL.
4. The planner retrieves the user's saved preferences.
5. Eloquent queries filter yoga and meditation sessions.
6. Blade renders the recommended sessions.
7. The user enters the immersive practice environment and uses available audio controls.
8. The user marks practice as completed.
9. The application stores progress records and calculates a practice streak.

## 🔒 Security Considerations

- Authentication-protected routes.
- Role-based administrator access.
- Password hashing through Laravel authentication.
- CSRF protection on forms.
- Server-side request validation.
- Eloquent mass-assignment protection through `$fillable`.
- User-specific preference and progress records.

## 🔮 Future Enhancements

- Weekly and monthly practice calendar.
- Interactive progress charts.
- Favorite yoga and meditation sessions.
- BMI calculator and additional preference inputs.
- Practice reminders and notifications.
- Session timers and guided breathing animations.
- PDF progress reports.
- More advanced recommendation logic.

## 🎓 Academic Project

**Project Title:** Personalized Yoga and Meditation Planner

**Domain:** Web Development and Wellness Technology

**Framework:** Laravel MVC

**Purpose:** To provide a personalized, interactive platform for yoga planning, meditation, and practice tracking.

---

*Disclaimer: The application provides general wellness and exercise recommendations. Users should adapt practices to their abilities and seek qualified professional guidance when needed.*
