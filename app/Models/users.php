use App\Models\User;

User::create([
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'password' => bcrypt('yourpassword'), // Menggunakan bcrypt untuk hashing password
]);
