<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;   // ✅ ADD THIS LINE
use App\Models\Program;
use App\Models\Staff;
use App\Models\module;
use App\Models\Paper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) 
        {
        // Program combobox
        $programs = Program::select('id', 'program_name')
            ->whereNull('deleted_at')
            ->orderBy('program_name')
            ->get();

        // Staff combobox
        $staffs = Staff::select('id', 'name')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->get();

         // TFaculty combobox
        $faculties = Staff::select('id', 'name')
            ->where('staff_type', 'Faculty')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->get();
        
         // Editor combobox
        $editors= Staff::select('id', 'name')
            ->where('staff_type', 'Non-Teaching')
            ->where('designation', 'like', '%Video%Edi%')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->get();

         // Paper combobox
        $papers = Paper::select('id', 'paper_name')
            ->whereNull('deleted_at')
            ->orderBy('paper_name')
            ->get();

        // Module combobox
        $modules= module::select('slno', 'moduleNo')
            ->orderBy('moduleNo')
            ->get();

        $view->with([
            'programs'  => $programs,
            'staffs'     => $staffs,
            'papers'     => $papers,
            'modules'    => $modules,
            'faculties'  => $faculties,
            'editors'    => $editors,
            ]);

        });


    }
}
