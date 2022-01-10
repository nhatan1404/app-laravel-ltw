<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = ['code', 'type', 'value', 'status', 'time'];

    public static function getCountActiveVoucher()
    {
        $data = Voucher::where('status', 'active')->where('time', '>', 0)->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
