<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\AppNotification;
use App\Models\Company;
use App\Models\Lecturer;
use App\Models\Logbook;
use App\Models\Plotting;
use App\Models\Student;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ──────────────────────────────────────────
        // 1. ADMIN
        // ──────────────────────────────────────────
        User::create([
            'name' => 'Admin InternHub',
            'email' => 'admin@internhub.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // ──────────────────────────────────────────
        // 2. DOSEN (Lecturers)
        // ──────────────────────────────────────────
        $dosenData = [
            ['name' => 'Dr. Ahmad Fauzi', 'email' => 'fauzi@internhub.test', 'nidn' => '0101198001', 'nama_dosen' => 'Dr. Ahmad Fauzi, M.Kom'],
            ['name' => 'Prof. Siti Nurjanah', 'email' => 'nurjanah@internhub.test', 'nidn' => '0202197802', 'nama_dosen' => 'Prof. Siti Nurjanah, M.T'],
            ['name' => 'Dr. Budi Santoso', 'email' => 'budi@internhub.test', 'nidn' => '0303198203', 'nama_dosen' => 'Dr. Budi Santoso, M.Sc'],
        ];

        $lecturers = [];
        foreach ($dosenData as $d) {
            $user = User::create([
                'name' => $d['name'],
                'email' => $d['email'],
                'password' => 'password',
                'role' => 'dosen',
            ]);
            $lecturers[] = Lecturer::create([
                'user_id' => $user->id,
                'nidn' => $d['nidn'],
                'nama_dosen' => $d['nama_dosen'],
            ]);
        }

        // ──────────────────────────────────────────
        // 3. MAHASISWA (Students)
        // ──────────────────────────────────────────
        $mhsData = [
            ['nim' => '2023101001', 'nama' => 'Rina Puspita', 'email' => 'rina@internhub.test', 'jurusan' => 'Teknik Informatika'],
            ['nim' => '2023101002', 'nama' => 'Dimas Prasetyo', 'email' => 'dimas@internhub.test', 'jurusan' => 'Teknik Informatika'],
            ['nim' => '2023102001', 'nama' => 'Ayu Lestari', 'email' => 'ayu@internhub.test', 'jurusan' => 'Sistem Informasi'],
            ['nim' => '2023102002', 'nama' => 'Bagas Saputra', 'email' => 'bagas@internhub.test', 'jurusan' => 'Sistem Informasi'],
            ['nim' => '2023103001', 'nama' => 'Citra Dewi', 'email' => 'citra@internhub.test', 'jurusan' => 'Bisnis Digital'],
        ];

        $students = [];
        foreach ($mhsData as $m) {
            $user = User::create([
                'name' => $m['nama'],
                'email' => $m['email'],
                'password' => 'password',
                'role' => 'mahasiswa',
            ]);
            $students[] = Student::create([
                'user_id' => $user->id,
                'nim' => $m['nim'],
                'nama_lengkap' => $m['nama'],
                'jurusan' => $m['jurusan'],
            ]);
        }

        // ──────────────────────────────────────────
        // 4. PERUSAHAAN (Companies)
        // ──────────────────────────────────────────
        $companies = [];
        $companyData = [
            [
                'company_name' => 'PT Tokopedia Indonesia',
                'bidang_industri' => 'E-Commerce & Technology',
                'lokasi' => 'Jakarta Selatan, DKI Jakarta',
                'deskripsi' => 'Tokopedia adalah perusahaan e-commerce terbesar di Indonesia yang menghubungkan jutaan penjual dan pembeli.',
                'kontak_person' => 'HR Team - hr@tokopedia.com',
            ],
            [
                'company_name' => 'PT Gojek Indonesia',
                'bidang_industri' => 'Transportation & Technology',
                'lokasi' => 'Jakarta Pusat, DKI Jakarta',
                'deskripsi' => 'Gojek adalah platform layanan on-demand terdepan di Asia Tenggara.',
                'kontak_person' => 'Talent Acquisition - talent@gojek.com',
            ],
            [
                'company_name' => 'PT Bank Central Asia',
                'bidang_industri' => 'Perbankan & Fintech',
                'lokasi' => 'Jakarta, DKI Jakarta',
                'deskripsi' => 'BCA adalah salah satu bank swasta terbesar di Indonesia dengan inovasi digital banking terdepan.',
                'kontak_person' => 'HR Development - hrd@bca.co.id',
            ],
            [
                'company_name' => 'PT Telkom Indonesia',
                'bidang_industri' => 'Telekomunikasi',
                'lokasi' => 'Bandung, Jawa Barat',
                'deskripsi' => 'Telkom Indonesia adalah BUMN telekomunikasi terbesar di Indonesia.',
                'kontak_person' => 'Internship Program - intern@telkom.co.id',
            ],
        ];

        foreach ($companyData as $c) {
            $companies[] = Company::create($c);
        }

        // ──────────────────────────────────────────
        // 5. LOWONGAN (Vacancies)
        // ──────────────────────────────────────────
        $vacancies = [];
        $vacancyData = [
            [
                'company_id' => $companies[0]->id,
                'posisi' => 'Backend Developer Intern',
                'deskripsi_tugas' => "- Mengembangkan REST API menggunakan Go/Java\n- Menulis unit test dan integration test\n- Code review bersama senior engineer\n- Berpartisipasi dalam daily standup",
                'persyaratan' => "- Mahasiswa semester 6-8 jurusan Informatika/SI\n- Familiar dengan salah satu: Go, Java, atau Python\n- Memahami konsep RESTful API\n- Nilai IPK minimal 3.0",
                'durasi_bulan' => 6,
                'kuota' => 3,
            ],
            [
                'company_id' => $companies[0]->id,
                'posisi' => 'Frontend Developer Intern',
                'deskripsi_tugas' => "- Membangun UI menggunakan React/Vue.js\n- Implementasi responsive design\n- Optimasi performa web\n- Kolaborasi dengan tim design",
                'persyaratan' => "- Mahasiswa jurusan IT/SI/DKV\n- Menguasai HTML, CSS, JavaScript\n- Familiar dengan React atau Vue.js\n- Memiliki portfolio (GitHub/website)",
                'durasi_bulan' => 6,
                'kuota' => 2,
            ],
            [
                'company_id' => $companies[1]->id,
                'posisi' => 'Data Analyst Intern',
                'deskripsi_tugas' => "- Analisis data bisnis dan operasional\n- Membuat dashboard menggunakan tools BI\n- Menyusun report insights mingguan\n- Kolaborasi dengan tim product",
                'persyaratan' => "- Mahasiswa jurusan SI/Statistika/Informatika\n- Menguasai SQL dan Excel\n- Familiar dengan Python/R\n- Teliti dan detail-oriented",
                'durasi_bulan' => 4,
                'kuota' => 2,
            ],
            [
                'company_id' => $companies[2]->id,
                'posisi' => 'IT Security Intern',
                'deskripsi_tugas' => "- Melakukan vulnerability assessment\n- Monitoring security systems\n- Membantu incident response\n- Membuat laporan keamanan",
                'persyaratan' => "- Mahasiswa jurusan Teknik Informatika\n- Memahami dasar networking & security\n- Familiar dengan Linux\n- Sertifikasi CompTIA+ menjadi nilai plus",
                'durasi_bulan' => 6,
                'kuota' => 1,
            ],
            [
                'company_id' => $companies[3]->id,
                'posisi' => 'UI/UX Designer Intern',
                'deskripsi_tugas' => "- Merancang wireframe dan mockup\n- Melakukan user research\n- Membuat prototype interaktif\n- Usability testing",
                'persyaratan' => "- Mahasiswa jurusan IT/DKV/Bisnis Digital\n- Menguasai Figma atau Adobe XD\n- Memahami design thinking\n- Memiliki portfolio design",
                'durasi_bulan' => 3,
                'kuota' => 2,
            ],
        ];

        foreach ($vacancyData as $v) {
            $vacancies[] = Vacancy::create($v);
        }

        // ──────────────────────────────────────────
        // 6. LAMARAN (Applications)
        // ──────────────────────────────────────────
        $apps = [];
        $apps[] = Application::create([
            'student_id' => $students[0]->id,
            'vacancy_id' => $vacancies[0]->id,
            'tanggal_apply' => now()->subDays(15),
            'status_lamaran' => 'accepted_by_company',
        ]);
        $apps[] = Application::create([
            'student_id' => $students[1]->id,
            'vacancy_id' => $vacancies[1]->id,
            'tanggal_apply' => now()->subDays(12),
            'status_lamaran' => 'verified_by_admin',
        ]);
        Application::create([
            'student_id' => $students[2]->id,
            'vacancy_id' => $vacancies[2]->id,
            'tanggal_apply' => now()->subDays(5),
            'status_lamaran' => 'pending',
        ]);
        Application::create([
            'student_id' => $students[3]->id,
            'vacancy_id' => $vacancies[3]->id,
            'tanggal_apply' => now()->subDays(3),
            'status_lamaran' => 'pending',
        ]);
        Application::create([
            'student_id' => $students[4]->id,
            'vacancy_id' => $vacancies[4]->id,
            'tanggal_apply' => now()->subDays(1),
            'status_lamaran' => 'pending',
        ]);

        // ──────────────────────────────────────────
        // 7. PLOTTING Dosen Pembimbing
        // ──────────────────────────────────────────
        Plotting::create([
            'student_id' => $students[0]->id,
            'lecturer_id' => $lecturers[0]->id,
            'tahun_akademik' => '2025/2026 Genap',
        ]);
        Plotting::create([
            'student_id' => $students[1]->id,
            'lecturer_id' => $lecturers[0]->id,
            'tahun_akademik' => '2025/2026 Genap',
        ]);
        Plotting::create([
            'student_id' => $students[2]->id,
            'lecturer_id' => $lecturers[1]->id,
            'tahun_akademik' => '2025/2026 Genap',
        ]);

        // ──────────────────────────────────────────
        // 8. LOGBOOK Entries (Rina - accepted student)
        // ──────────────────────────────────────────
        $logbookActivities = [
            ['days_ago' => 14, 'kegiatan' => 'Orientasi dan pengenalan tim backend. Setup environment development (Go, Docker, PostgreSQL).', 'progress' => 5, 'validasi' => true, 'komentar' => 'Good start! Pastikan catat semua tools yang digunakan.'],
            ['days_ago' => 13, 'kegiatan' => 'Mempelajari arsitektur microservices yang digunakan perusahaan. Membaca dokumentasi internal API.', 'progress' => 10, 'validasi' => true, 'komentar' => null],
            ['days_ago' => 12, 'kegiatan' => 'Mulai develop endpoint GET /products dengan pagination. Belajar cara menulis unit test di Go.', 'progress' => 18, 'validasi' => true, 'komentar' => 'Progress bagus, lanjutkan ke POST endpoint.'],
            ['days_ago' => 11, 'kegiatan' => 'Implementasi endpoint POST /products dengan validasi input. Code review dari mentor.', 'progress' => 25, 'validasi' => false, 'komentar' => null],
            ['days_ago' => 10, 'kegiatan' => 'Refactor kode berdasarkan feedback code review. Menambahkan error handling yang lebih baik.', 'progress' => 30, 'validasi' => false, 'komentar' => null],
        ];

        foreach ($logbookActivities as $l) {
            Logbook::create([
                'student_id' => $students[0]->id,
                'tanggal' => now()->subDays($l['days_ago']),
                'kegiatan_harian' => $l['kegiatan'],
                'progress_persen' => $l['progress'],
                'validasi_dosen' => $l['validasi'],
                'komentar_dosen' => $l['komentar'],
            ]);
        }

        // Logbook for Dimas
        Logbook::create([
            'student_id' => $students[1]->id,
            'tanggal' => now()->subDays(3),
            'kegiatan_harian' => 'Setup project React dengan Vite. Membuat komponen Header dan Sidebar.',
            'progress_persen' => 10,
            'validasi_dosen' => false,
        ]);

        // ──────────────────────────────────────────
        // 9. NOTIFICATIONS
        // ──────────────────────────────────────────
        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $students[0]->user_id,
            'type' => 'application_accepted',
            'title' => 'Lamaran Diterima! 🎉',
            'message' => 'Selamat! Lamaran Anda untuk posisi Backend Developer Intern di PT Tokopedia Indonesia telah diterima.',
            'is_read' => true,
        ]);

        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $students[2]->user_id,
            'type' => 'broadcast',
            'title' => 'Pengumuman Penting',
            'message' => 'Batas akhir pengumpulan laporan magang semester ini adalah 30 Juni 2026. Pastikan semua dokumen sudah lengkap.',
            'is_read' => false,
        ]);

        AppNotification::create([
            'id' => Str::uuid(),
            'user_id' => $lecturers[0]->user_id,
            'type' => 'logbook_submitted',
            'title' => 'Logbook Baru',
            'message' => 'Rina Puspita telah mengisi logbook harian. Mohon review dan validasi.',
            'is_read' => false,
        ]);

        echo "✅ Seeder selesai!\n";
        echo "📧 Login credentials (semua password: 'password'):\n";
        echo "   Admin  : admin@internhub.test\n";
        echo "   Dosen  : fauzi@internhub.test, nurjanah@internhub.test, budi@internhub.test\n";
        echo "   Mahasiswa: rina@internhub.test, dimas@internhub.test, ayu@internhub.test, bagas@internhub.test, citra@internhub.test\n";
    }
}
