<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\User;
use App\Models\Property;
use App\Models\Invoice;
use App\Models\Message;
use Illuminate\Support\Facades\Artisan;

class AccountController extends Controller
{
    /**
     * Display the user's profile form.
    */
    public function index(Request $request)
    {
        $isAdmin = auth()->user()->isSuperAdmin() || auth()->user()->isAdmin();
        $db_data['TotalUsersCount'] = $isAdmin ? User::count() : 0;
        $db_data['TotalPropertiesCount'] = $isAdmin ? Property::count() : 0;
        $invoiceCounts = Invoice::query()
            ->selectRaw("SUM(CASE WHEN i_status = 'unpaid' THEN 1 ELSE 0 END) AS open_count, SUM(CASE WHEN i_status = 'paid' THEN 1 ELSE 0 END) AS paid_count")
            ->when(!$isAdmin, function ($query) {
                $query->where('i_tenant_id', auth()->id());
            })
            ->first();
        $db_data['TotalInvoicesCount'] = (int) ($invoiceCounts->open_count ?? 0);
        $db_data['TotalPaidInvoicesCount'] = (int) ($invoiceCounts->paid_count ?? 0);
        $db_data['TotalUnReadMessages'] = Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
            
        $data = array(
                    'page_title'=>'Dashboard',
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
