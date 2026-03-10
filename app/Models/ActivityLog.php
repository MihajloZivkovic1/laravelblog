<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'description', 'ip_address'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function storeLog($action, $description){
        return self::create([
            'user_id' => auth()->user()->id,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip()
        ]);
    }


    public function getAllPaginated($perPage=20){
        return ActivityLog::with('user')->orderBy('created_at', 'DESC')->paginate($perPage);
    }


    public function filterByDate($from, $to){
        return ActivityLog::with('user')
            ->whereBetween('created_at', [$from, $to])
            ->whereDate('created_at', '<=', $to)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
