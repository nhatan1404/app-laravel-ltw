<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = ['code', 'type', 'value', 'status'];

    public static function getCountActiveVoucher()
    {
        $data = Voucher::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
