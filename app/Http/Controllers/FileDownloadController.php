<?php

namespace App\Http\Controllers;

use App\Models\Pemas;
use App\Models\FormPemas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileDownloadController extends Controller
{
    // Method to download image

    // Method to download LPJ
    public function downloadLpj($slug)
    {
        $pemas = Pemas::where('slug', $slug)->firstOrFail();
        $filePath = 'lpj/' . $pemas->lpj;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            // Menampilkan halaman 404 bawaan Laravel
            abort(404, 'File not found.');
        }
    }
    public function downloadProposal($slug)
    {
        $pemas = FormPemas::where('slug', $slug)->firstOrFail();
        $filePath = 'proposals/' . $pemas->proposal;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            // Menampilkan halaman 404 bawaan Laravel
            abort(404, 'File not found.');
        }
    }
}
