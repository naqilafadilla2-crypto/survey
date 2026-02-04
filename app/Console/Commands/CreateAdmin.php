<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                            {--email= : Email admin}
                            {--password= : Password admin}
                            {--name= : Nama admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat user admin baru untuk aplikasi survei';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email') ?: $this->ask('Email admin');
        $name = $this->option('name') ?: $this->ask('Nama admin', 'Administrator');
        $password = $this->option('password') ?: $this->secret('Password admin');

        // Validasi email
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            $this->error('Email sudah digunakan atau format email tidak valid!');
            return 1;
        }

        // Validasi password
        if (strlen($password) < 6) {
            $this->error('Password minimal 6 karakter!');
            return 1;
        }

        // Cek apakah email sudah ada
        if (User::where('email', $email)->exists()) {
            $this->error('User dengan email ini sudah ada!');
            return 1;
        }

        // Buat user admin
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info('✓ Admin berhasil dibuat!');
        $this->table(
            ['Field', 'Value'],
            [
                ['ID', $user->id],
                ['Nama', $user->name],
                ['Email', $user->email],
                ['Password', '***' . substr($password, -3)],
            ]
        );

        $this->info("\nAnda dapat login di: " . route('admin.login'));
        $this->warn('Jangan lupa untuk mengubah password default setelah login pertama!');

        return 0;
    }
}
