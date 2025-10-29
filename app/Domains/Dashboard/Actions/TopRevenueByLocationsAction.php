<?php

namespace App\Domains\Dashboard\Actions;

use App\Exceptions\UserException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Domains\Orders\Models\orders;
use App\Domains\user\Models\User;

class TopRevenueByLocationsAction
{
    public function handle()
    {
        try{
 
        $User = Auth::guard('users')->user();
        if (!$User) {
            throw UserException::unauthorized();
        }
        $tenant_id = $User->tenant_id;
        $location_id = $User->loaction_id;
        $ordersByLocation = orders::with('location')
            ->select('location_id', DB::raw('SUM(total_amount) as total_revenue'), DB::raw('COUNT(*) as transaction_count'))
            ->where('tenant_id', $tenant_id)
            ->where('status', 'completed')
            ->groupBy('location_id')
            ->get();
        $totalRevenue = $ordersByLocation->sum('total_amount');
        $totalTransaction = $ordersByLocation->sum('transaction_count');
        $user = User::select('location_id', DB::raw('COUNT(*) as user_count'))->where('tenant_id', $tenant_id)->groupBy('location_id')->pluck('user_count', 'location_id')->toArray();
        return $ordersByLocation->map(function ($item) use ($user, $totalRevenue, $totalTransaction) {
            $userCount = $user[$item->location_id] ?? 0;
            return [
                'location_id' => $item->location_id,
                'location_name' => $item->location->name,
                'total_amount' => $item->total_amount,
                'revenue_percentage' => $totalRevenue ? round(($item->total_revenue / $totalRevenue) * 100, 2) . '%' : '0%',
                'transaction_count' => $item->transaction_count,
                'user_count' => $userCount,
                'Transaction_percentage' => $totalTransaction ? round(($item->transaction_count / $totalTransaction) * 100, 2) . '%' : '0%',
            ];
        });
    }catch(UserException $e){
        throw $e;
    }
    catch(\Exception $e){
        throw new UserException($e->getMessage());
    }
    }
}
