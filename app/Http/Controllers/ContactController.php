<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function send(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Di sini nanti bisa tambahkan: 
        // - Kirim email ke admin
        // - Simpan ke database
        // - Kirim notifikasi
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim! Kami akan merespon dalam 24 jam.');
    }
}