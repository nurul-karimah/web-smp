namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin.');
        }

        return $next($request);
    }
}
