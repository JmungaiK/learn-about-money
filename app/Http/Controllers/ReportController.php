<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;



class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report.index');
    }

    /**
     * 
     * Generate the specified report and provide a downloadable CSV file.
     */
    public function generate(string $type)
    {
        switch ($type) {
            case 'modules':
                // Generate report for modules
                $modules = Module::all(['name', 'description']);
                $csv = Writer::createFromString('');
                $csv->insertOne(['Name', 'Description']);
                foreach ($modules as $module) {
                    $csv->insertOne([$module->name, $module->description]);
                }
                return Response::make($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="modules.csv"',
                ]);

            case 'videos':
                // Generate report for videos
                $videos = Video::all(['title', 'description']);
                $csv = Writer::createFromString('');
                $csv->insertOne(['Title', 'Description']);
                foreach ($videos as $video) {
                    $csv->insertOne([$video->title, $video->description]);
                }
                return Response::make($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="videos.csv"',
                ]);

            case 'users':
                // Generate report for users
                $users = User::all(['name', 'email']);
                $csv = Writer::createFromString('');
                $csv->insertOne(['Name', 'Email']);
                foreach ($users as $user) {
                    $csv->insertOne([$user->name, $user->email]);
                }
                return Response::make($csv->toString(), 200, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="users.csv"',
                ]);

            default:
                // Invalid report type
                return "Invalid report type.";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
