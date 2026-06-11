<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $query = Vacancy::with('company')
            ->where('status_aktif', true)
            ->whereHas('company', fn($q) => $q->where('status_aktif', true));

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'like', "%{$search}%")
                  ->orWhereHas('company', fn($q2) => $q2->where('company_name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('lokasi')) {
            $query->whereHas('company', fn($q) => $q->where('lokasi', 'like', "%{$request->lokasi}%"));
        }

        if ($request->filled('posisi')) {
            $query->where('posisi', 'like', "%{$request->posisi}%");
        }

        $vacancies = $query->latest()->paginate(12);

        return view('mahasiswa.vacancies.index', compact('vacancies'));
    }

    public function show(Vacancy $vacancy)
    {
        $vacancy->load('company', 'applications');
        $hasApplied = auth()->user()->student
            ->applications()
            ->where('vacancy_id', $vacancy->id)
            ->exists();

        return view('mahasiswa.vacancies.show', compact('vacancy', 'hasApplied'));
    }
}
