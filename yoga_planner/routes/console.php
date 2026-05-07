<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:grant {email}', function (string $email) {
    $user = User::where('email', $email)->first();

    if (! $user) {
        $this->error("No user found with email {$email}.");

        return Command::FAILURE;
    }

    if ($user->is_admin) {
        $this->info("{$email} is already an admin.");

        return Command::SUCCESS;
    }

    $user->forceFill(['is_admin' => true])->save();

    $this->info("Granted admin access to {$email}.");

    return Command::SUCCESS;
})->purpose('Grant admin access to an existing user by email');
