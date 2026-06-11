<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacancy::with('company')->withCount('applications');

        if ($request->filled('search')) {
            $query->where('posisi', 'like', "%{$request->search}%");
        }

        $vacancies = $query->latest()->paginate(15);
        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        $companies = Company::where('status_aktif', true)->orderBy('company_name')->get();
        return view('admin.vacancies.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'posisi' => 'required|string|max:255',
            'deskripsi_tugas' => 'required|string',
            'persyaratan' => 'required|string',
            'durasi_bulan' => 'required|integer|min:1|max:12',
            'kuota' => 'required|integer|min:1',
        ]);

        Vacancy::create($request->only('company_id', 'posisi', 'deskripsi_tugas', 'persyaratan', 'durasi_bulan', 'kuota'));

        ActivityLog::log('admin_create_vacancy', "Admin menambahkan lowongan: {$request->posisi}");

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Vacancy $vacancy)
    {
        $companies = Company::where('status_aktif', true)->orderBy('company_name')->get();
        return view('admin.vacancies.edit', compact('vacancy', 'companies'));
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'posisi' => 'required|string|max:255',
            'deskripsi_tugas' => 'required|string',
            'persyaratan' => 'required|string',
            'durasi_bulan' => 'required|integer|min:1|max:12',
            'kuota' => 'required|integer|min:1',
            'status_aktif' => 'boolean',
        ]);

        $vacancy->update($request->only('company_id', 'posisi', 'deskripsi_tugas', 'persyaratan', 'durasi_bulan', 'kuota', 'status_aktif'));

        ActivityLog::log('admin_update_vacancy', "Admin memperbarui lowongan: {$request->posisi}");

        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Vacancy $vacancy)
    {
        $posisi = $vacancy->posisi;
        $vacancy->delete();
        ActivityLog::log('admin_delete_vacancy', "Admin menghapus lowongan: {$posisi}");
        return redirect()->route('admin.vacancies.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}
