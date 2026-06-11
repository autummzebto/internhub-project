<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::withCount('vacancies');

        if ($request->filled('search')) {
            $query->where('company_name', 'like', "%{$request->search}%");
        }

        $companies = $query->latest()->paginate(15);
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'bidang_industri' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'kontak_person' => 'required|string|max:255',
        ]);

        Company::create($request->only('company_name', 'bidang_industri', 'lokasi', 'deskripsi', 'kontak_person'));

        ActivityLog::log('admin_create_company', "Admin menambahkan perusahaan: {$request->company_name}");

        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'bidang_industri' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'kontak_person' => 'required|string|max:255',
            'status_aktif' => 'boolean',
        ]);

        $company->update($request->only('company_name', 'bidang_industri', 'lokasi', 'deskripsi', 'kontak_person', 'status_aktif'));

        ActivityLog::log('admin_update_company', "Admin memperbarui perusahaan: {$request->company_name}");

        return redirect()->route('admin.companies.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Company $company)
    {
        $name = $company->company_name;
        $company->delete();
        ActivityLog::log('admin_delete_company', "Admin menghapus perusahaan: {$name}");
        return redirect()->route('admin.companies.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
