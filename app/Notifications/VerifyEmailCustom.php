<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerifyEmailCustom extends VerifyEmail{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable){
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Vérification de votre adresse email - Culture Bénin')
            // Intégration du logo en haut du mail
            ->greeting('Bonjour ' . $notifiable->prenom . ' ' . $notifiable->nom . ',')
            ->line('Nous vous remercions de votre intérêt pour Culture Bénin, la plateforme officielle dédiée à la promotion et à la préservation du patrimoine culturel béninois.')
            ->line('Pour finaliser la création de votre compte et garantir la sécurité de vos données, une validation de votre adresse email est nécessaire.')
            ->action('Confirmer mon adresse email', $verificationUrl)
            ->line('Ce lien de sécurité expirera dans 60 minutes.')
            ->line('Si vous n\'êtes pas à l\'origine de cette demande, vous pouvez ignorer ce message en toute sécurité.')
            ->salutation("Cordialement,\nL'équipe Culture Bénin");
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}