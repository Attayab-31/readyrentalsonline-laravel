<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class AccountController extends Controller
{
    /**
     * Display the user's profile form.
    */
    public function index(Request $request)
    {
        $db_data['TotalUsersCount'] = User::count();
            
        $data = array(
                    'page_title'=>'Control Panel Dashboard',
                    );
        return view('Account.dashboard',compact('db_data'))->with($data);
    }


    public function clearAppCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('vendor:publish --tag=log-viewer-assets --force');
            // Artisan::call('optimize');
            return redirect('/accounts')->with('success', 'Application cache memory has been cleared!');
        } catch (\Exception $e) {
            return redirect('/accounts')->with('error', 'Failed to clear application cache: ' . $e->getMessage());
        }
    }

    public function cacheContentCache()
    {
        Cache::flush();
        return redirect('/accounts')->with('success', 'All content related cache cleared successfully.');
    }

}