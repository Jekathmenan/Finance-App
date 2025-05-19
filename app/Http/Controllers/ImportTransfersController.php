<?php

namespace App\Http\Controllers;

use App\Models\Transfer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImportTransfersController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $rows = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_map('strtolower', array_shift($rows)); // use header row as keys

        $successCount = 0;
        $errors = [];

        foreach ($rows as $index => $row) {
            $data = array_combine($header, $row);
            //dd($data);
            $validator = Validator::make($data, [
                'type' => 'required|integer',
                'date' => 'required|date',
                'repeattype' => 'required|integer',
                'amount' => 'required|numeric',
                'category' => 'required|exists:transfer_categories,id',
                'account_from' => 'required|exists:accounts,id',
                'account_to' => 'required|exists:accounts,id',
                'note' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'user_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                $errors[] = "Row " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
                //dd('validator failed');
                continue;
            }

            Transfer::create([
                'type' => $data['type'],
                'date' => $data['date'],
                'repeattype' => $data['repeattype'],
                'amount' => $data['amount'] * 100,
                'category' => $data['category'],
                'account_from' => $data['account_from'],
                'account_to' => $data['account_to'],
                'note' => $data['note'] ?? null,
                'description' => $data['description'] ?? null,
                'user_id' => $data['user_id'] ?? null,
            ]);

            $successCount++;
        }

        return back()->with([
            'success' => "$successCount transfers imported.",
            'errors' => $errors,
        ]);
    }

    public function showForm()
    {
        return view('auth.transfers.importForm');
    }
}
