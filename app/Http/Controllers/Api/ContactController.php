<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // =========================
            // 📧 SEND EMAIL
            // =========================
            Mail::raw(
                "New Contact Message\n\n" .
                "Name: {$validated['name']}\n" .
                "Phone: {$validated['phone']}\n" .
                "Email: {$validated['email']}\n" .
                "Subject: {$validated['subject']}\n" .
                "Message:\n{$validated['message']}",
                function ($mail) {
                    $mail->to('chauhandrycleaners05@gmail.com')
                         ->subject('New Contact Form Message');
                }
            );

            // =========================
            // 💬 SEND WHATSAPP (via API)
            // =========================
            // 👉 You MUST use a provider like:
            // Twilio / WhatsApp Cloud API / MSG91 / Gupshup

            // Example using WhatsApp Cloud API (Meta)
            $phoneNumberId = env('WHATSAPP_PHONE_ID');
            $token = env('WHATSAPP_TOKEN');

            $textMessage =
                "📩 *New Contact Message*\n\n" .
                "*Name:* {$validated['name']}\n" .
                "*Phone:* {$validated['phone']}\n" .
                "*Email:* {$validated['email']}\n" .
                "*Subject:* {$validated['subject']}\n" .
                "*Message:* {$validated['message']}";

            Http::withToken($token)->post(
                "https://graph.facebook.com/v18.0/$phoneNumberId/messages",
                [
                    "messaging_product" => "whatsapp",
                    "to" => "918534837704",
                    "type" => "text",
                    "text" => [
                        "body" => $textMessage
                    ]
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}