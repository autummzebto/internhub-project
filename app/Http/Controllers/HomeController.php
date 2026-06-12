<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Student;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacancy::with('company', 'applications')
            ->where('status_aktif', true);

        // Search by position name
        if ($request->filled('search')) {
            $query->where('posisi', 'like', '%' . $request->search . '%');
        }

        // Filter by company
        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
        }

        // Filter by location (through company)
        if ($request->filled('lokasi')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('lokasi', 'like', '%' . $request->lokasi . '%');
            });
        }

        // Filter by industry (through company)
        if ($request->filled('industri')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('bidang_industri', $request->industri);
            });
        }

        $vacancies = $query->latest()->paginate(9);

        // Data for filters
        $companies = Company::where('status_aktif', true)->orderBy('company_name')->get();
        $industries = Company::where('status_aktif', true)->distinct()->pluck('bidang_industri');
        $locations  = Company::where('status_aktif', true)->distinct()->pluck('lokasi');

        // Stats
        $stats = [
            'vacancies'   => Vacancy::where('status_aktif', true)->count(),
            'companies'   => Company::where('status_aktif', true)->count(),
            'students'    => Student::count(),
        ];

        return view('home', compact('vacancies', 'companies', 'industries', 'locations', 'stats'));
    }
}
