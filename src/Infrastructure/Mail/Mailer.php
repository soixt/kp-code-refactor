<?php

namespace App\Infrastructure\Mail;

use App\Infrastructure\Enums\ApplicationEnvironment;

class Mailer {
    public function send (string $subject, string $message, array|string $participants) {
        // Send confirmation email in production environment
        if (config('app.env') === ApplicationEnvironment::PROD) {
            $participants = is_string($participants) ? [$participants] : $participants;

            try {
                foreach ($participants as $participant) {
                    mail(
                        $participant,
                        $subject,
                        $message
                    );
                }
            } catch (\Throwable $th) {
                // Log $th
                throw new \Exception('Mail was not sent.');
            }
        }
    }
}