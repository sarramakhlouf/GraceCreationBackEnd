<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required!phone',
            'message' => 'required|string',
        ]);

        /*$details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];*/

        Mail::raw("Nom: {$data['nom']}\nEmail: {$data['email']}\nTéléphone: {$data['phone']}\n\nMessage:\n{$data['message']}", function ($message) use ($data) {
            $message->to('sarrahmakhlouf2022@gmail.com') // Adresse de réception
                    ->subject('Nouveau message de contact')
                    ->from($data['email'], $data['nom']);
        });

        return response()->json(['message' => 'Votre message a été envoyé avec succès !']);
    }
}
