<?php

namespace App\Http\Controllers;

use App\Services\BrevoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    protected $brevoService;

    public function __construct(BrevoService $brevoService)
    {
        $this->brevoService = $brevoService;
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required',
            'cv' => 'required|mimes:pdf|max:10240',
            'motivation' => 'required|mimes:pdf|max:10240',
        ]);

        try {
            
            $cvName = 'cv_'.time().'_'.$request->name.'.pdf';
            $motivationName = 'motivation_'.time().'_'.$request->name.'.pdf';

            
            $cvPath = $request->file('cv')->storeAs('public/uploads', $cvName);
            $motivationPath = $request->file('motivation')->storeAs('public/uploads', $motivationName);

            
            $publicUrls = [
                'cv' => asset(Storage::url(str_replace('public/', '', $cvPath))),
                'motivation' => asset(Storage::url(str_replace('public/', '', $motivationPath)))
            ];

            
            $subject = 'Nouvelle demande de stage - ' . $request->name;

            
            $attachments = [
                [
                    'content' => base64_encode(file_get_contents($request->file('cv')->getRealPath())),
                    'name' => $cvName
                ],
                [
                    'content' => base64_encode(file_get_contents($request->file('motivation')->getRealPath())),
                    'name' => $motivationName
                ]
            ];

            $htmlContent = view('emails.demande_stage', [
                'data' => $request->all(),
                'urls' => $publicUrls
            ])->render();
            $path = storage_path('app/email.txt');

            $emails = explode(',', trim(file_get_contents($path)));

            $validEmails = [];
            foreach ($emails as $email) {
                $cleanEmail = trim($email);
                if (filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
                    $validEmails[] = $cleanEmail;
                }
            }

            if (empty($validEmails)) {
                return back()->with('error', 'Aucun email valide trouvé dans email.txt');
            }
            
            $result = $this->brevoService->sendEmail($validEmails, $subject, $htmlContent, [
                'attachments' => $attachments
            ]);

            if($result['success']) {
                return back()->with('success', 'Demande envoyée avec succès !');
            }

            return back()->with('error', 'Erreur d\'envoi : ' . $result['error']);

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : '.$e->getMessage());
        }
    }
}