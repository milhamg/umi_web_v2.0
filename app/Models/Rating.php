<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Rating",
 *      required={"id_produk", "id_transaksi_penjualan", "rating", "ulasan"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_produk",
 *          description="id_produk",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_transaksi_penjualan",
 *          description="id_transaksi_penjualan",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="rating",
 *          description="rating",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ulasan",
 *          description="ulasan",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Rating extends Model
{

    use HasFactory, SoftDeletes;

    public $table = 'ratings';

    public $fillable = [
        'id_produk',
        'id_transaksi_penjualan',
        'id_transaksi_produk',
        'id_user_author',
        'is_show_name_author',
        'rating',
        'ulasan',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_produk' => 'integer',
        'id_transaksi_penjualan' => 'integer',
        'id_user_author' => 'integer',
        'is_show_name_author' => 'boolean',
        'rating' => 'integer',
        'ulasan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_produk' => 'required',
        'id_transaksi_penjualan' => 'required',
        'rating' => 'required|numeric',
        'ulasan' => 'required'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function products()
    {
        return $this->belongsTo(\App\Models\Product::class, 'id_produk', 'id');
    }
    public function transaction_product()
    {
        return $this->belongsTo(\App\Models\TransactionProduct::class, 'id_transaksi_produk', 'id');
    }

    public function user_author()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user_author', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sales_transactions()
    {
        return $this->belongsTo(\App\Models\SalesTransaction::class, 'id_transaksi_penjualan', 'id');
    }
}
