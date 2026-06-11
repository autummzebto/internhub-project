# 🎓 InternHub — Sistem Informasi Manajemen Magang Mahasiswa

Aplikasi web untuk mengelola proses magang mahasiswa secara digital, mulai dari pendaftaran, plotting dosen pembimbing, logbook harian, hingga penilaian laporan akhir.

---

## 📦 Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 12 (PHP 8.2+) |
| **Frontend** | Blade Templating + Tailwind CSS v4 |
| **Database** | MySQL 8 (via MAMP) |
| **Auth** | RBAC Middleware (admin / dosen / mahasiswa) |

---

## 🗂️ Struktur Folder (Backend & Frontend)

```
internhub/
│
│ =============================================
│       BACKEND (Server-Side Logic)
│ =============================================
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                  ← Login, Register, Logout
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── LogoutController.php
│   │   │   ├── Admin/                 ← Admin CRUD controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── StudentController.php
│   │   │   │   ├── LecturerController.php
│   │   │   │   ├── CompanyController.php
│   │   │   │   ├── VacancyController.php
│   │   │   │   ├── ApplicationController.php
│   │   │   │   ├── PlottingController.php
│   │   │   │   ├── BroadcastController.php
│   │   │   │   └── ActivityLogController.php
│   │   │   ├── Mahasiswa/             ← Student controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProfileController.php
│   │   │   │   ├── VacancyController.php
│   │   │   │   ├── ApplicationController.php
│   │   │   │   ├── LogbookController.php
│   │   │   │   ├── FinalReportController.php
│   │   │   │   └── NotificationController.php
│   │   │   └── Dosen/                 ← Lecturer controllers
│   │   │       ├── DashboardController.php
│   │   │       ├── LogbookController.php
│   │   │       ├── GradingController.php
│   │   │       └── NotificationController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php     ← RBAC middleware
│   │
│   └── Models/                        ← 11 Eloquent Models
│       ├── User.php
│       ├── Student.php
│       ├── Lecturer.php
│       ├── Company.php
│       ├── Vacancy.php
│       ├── Application.php
│       ├── Plotting.php
│       ├── Logbook.php
│       ├── FinalReport.php
│       ├── AppNotification.php
│       └── ActivityLog.php
│
├── database/
│   ├── migrations/                    ← 12 migration files
│   └── seeders/
│       └── DatabaseSeeder.php         ← Demo data seeder
│
├── routes/
│   └── web.php                        ← All route definitions
│
├── config/
│   └── database.php                   ← MAMP MySQL config
│
│ =============================================
│       FRONTEND (Views & Assets)
│ =============================================
│
├── resources/
│   ├── css/
│   │   └── app.css                    ← Tailwind + design system
│   ├── js/
│   │   └── app.js                     ← Alpine.js & Vite entry
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php          ← Dashboard layout (sidebar + topbar)
│       │   └── guest.blade.php        ← Auth layout (login/register)
│       ├── partials/
│       │   ├── sidebar-admin.blade.php
│       │   ├── sidebar-dosen.blade.php
│       │   └── sidebar-mahasiswa.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── mahasiswa/                 ← 7 student pages
│       │   ├── dashboard.blade.php
│       │   ├── profile/edit.blade.php
│       │   ├── vacancies/index.blade.php
│       │   ├── vacancies/show.blade.php
│       │   ├── applications/index.blade.php
│       │   ├── logbooks/index.blade.php
│       │   ├── logbooks/create.blade.php
│       │   ├── final-report/create.blade.php
│       │   └── notifications/index.blade.php
│       ├── dosen/                     ← 4 lecturer pages
│       │   ├── dashboard.blade.php
│       │   ├── logbooks/index.blade.php
│       │   ├── grading/index.blade.php
│       │   ├── grading/show.blade.php
│       │   └── notifications/index.blade.php
│       └── admin/                     ← 15 admin pages
│           ├── dashboard.blade.php
│           ├── students/index|create|edit.blade.php
│           ├── lecturers/index|create|edit.blade.php
│           ├── companies/index|create|edit.blade.php
│           ├── vacancies/index|create|edit.blade.php
│           ├── applications/index.blade.php
│           ├── plottings/index|create.blade.php
│           ├── broadcast.blade.php
│           └── activity-log.blade.php
│
├── public/                            ← Public assets
├── .env                               ← Environment config
├── vite.config.js                     ← Vite build config
└── package.json                       ← NPM dependencies
```

---

## 🔐 Akun Demo (Seeder)

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@internhub.test` | `password` |
| **Dosen** | `fauzi@internhub.test` | `password` |
| **Dosen** | `nurjanah@internhub.test` | `password` |
| **Mahasiswa** | `rina@internhub.test` | `password` |
| **Mahasiswa** | `dimas@internhub.test` | `password` |
| **Mahasiswa** | `ayu@internhub.test` | `password` |

---

## 🚀 Cara Menjalankan

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MAMP (MySQL)

### Setup

```bash
# 1. Masuk ke folder proyek
cd internhub

# 2. Install dependencies
composer install
npm install

# 3. Pastikan MAMP MySQL berjalan, lalu buat database
/Applications/MAMP/Library/bin/mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS internhub"

# 4. Jalankan migrasi & seeder
php artisan migrate:fresh --seed

# 5. Buat symlink storage
php artisan storage:link

# 6. Build frontend assets
npm run dev

# 7. Jalankan server (di terminal terpisah)
php artisan serve
```

### Akses Aplikasi
- 🌐 **URL**: http://localhost:8000
- 📧 Login dengan akun demo di atas

---

## 👥 Fitur per Role

### Admin
- Dashboard statistik sistem
- CRUD Mahasiswa, Dosen, Perusahaan, Lowongan
- Verifikasi & approval lamaran magang
- Plotting dosen pembimbing
- Broadcast pengumuman
- Activity log audit trail

### Mahasiswa
- Dashboard personal & statistik
- Cari & lamar lowongan magang
- Isi logbook harian (dengan progress tracker)
- Upload laporan akhir (PDF)
- Terima notifikasi real-time

### Dosen Pembimbing
- Dashboard mahasiswa bimbingan
- Review & validasi logbook harian
- Beri penilaian & feedback laporan akhir
- Notifikasi logbook baru
