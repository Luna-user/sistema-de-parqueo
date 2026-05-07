<?php
// SCRIPT DE REPARACIÓN DE ROLES Y PERMISOS
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

try {
    // 1. Restaurar al Super Admin
    $u = User::withTrashed()->where('email', 'superadmin@gmail.com')->first();
    
    if($u) {
        $u->restore();
        $u->estado = true;
        $u->contraseña = Hash::make('12345678');
        $u->save();
        
        // 2. Asegurar que el Rol existe
        $role = Role::where('name', 'SUPER ADMIN')->first();
        if(!$role) {
            $role = Role::create(['name' => 'SUPER ADMIN']);
        }
        
        // 3. Asignar el rol al usuario (Limpiando roles previos para evitar conflictos)
        DB::table('model_has_roles')->where('model_id', $u->id_usuario)->delete();
        $u->assignRole('SUPER ADMIN');
        
        // 4. Forzar cierre de sesión para limpiar el error 403
        Auth::logout();
        session()->flush();

        echo "<div style='font-family: sans-serif; text-align: center; padding: 50px; background: #fff; border: 2px solid #27ae60; border-radius: 10px; max-width: 600px; margin: 50px auto;'>";
        echo "<h1 style='color: #27ae60;'>¡PERMISOS RESTABLECIDOS!</h1>";
        echo "<p style='font-size: 1.1rem;'>Se ha restaurado tu usuario y se te ha vuelto a asignar el rango de <b>SUPER ADMIN</b>.</p>";
        echo "<p>Hemos cerrado tu sesión anterior para limpiar los errores.</p>";
        echo "<hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>";
        echo "<p><b>Email:</b> superadmin@gmail.com</p>";
        echo "<p><b>Clave:</b> 12345678</p>";
        echo "<br><a href='login' style='background: #27ae60; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>ENTRAR AL SISTEMA AHORA</a>";
        echo "</div>";
    } else {
        echo "<h1>Error: No se encontró el usuario Super Admin.</h1>";
    }
} catch (\Exception $e) {
    echo "<h1>Error técnico:</h1>" . $e->getMessage();
}
