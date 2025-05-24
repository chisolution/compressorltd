<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Newsletter::query();

        if ($status === 'active') {
            $query->where('active', true);
        } elseif ($status === 'inactive') {
            $query->where('active', false);
        }

        $subscribers = $query->latest('subscribed_at')->paginate(15);

        return view('admin.newsletters.index', compact('subscribers', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        Newsletter::create([
            'email' => $request->email,
            'active' => true,
            'subscribed_at' => now()
        ]);

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Subscriber added successfully.');
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
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'active' => 'required|boolean'
        ]);

        $newsletter->update([
            'active' => $request->active,
            'unsubscribed_at' => $request->active ? null : now()
        ]);

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Subscriber status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Subscriber removed successfully.');
    }

    /**
     * Import subscribers from CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $count = 0;
        $errors = [];

        foreach ($data as $row) {
            if (isset($row[0]) && !empty($row[0])) {
                $email = trim($row[0]);

                $validator = Validator::make(['email' => $email], [
                    'email' => 'required|email|unique:newsletters,email'
                ]);

                if ($validator->fails()) {
                    $errors[] = $email . ' - ' . $validator->errors()->first('email');
                    continue;
                }

                Newsletter::create([
                    'email' => $email,
                    'active' => true,
                    'subscribed_at' => now()
                ]);

                $count++;
            }
        }

        $message = $count . ' subscribers imported successfully.';
        if (count($errors) > 0) {
            $message .= ' ' . count($errors) . ' errors occurred.';
            session()->flash('import_errors', $errors);
        }

        return redirect()->route('admin.newsletters.index')
            ->with('success', $message);
    }
}
