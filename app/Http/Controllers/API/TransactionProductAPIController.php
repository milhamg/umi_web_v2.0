<?php

namespace App\Http\Controllers\API;

use Response;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\TransactionProduct;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TransactionProductRepository;
use App\Http\Requests\API\CreateTransactionProductAPIRequest;
use App\Http\Requests\API\UpdateTransactionProductAPIRequest;
use App\Models\Cart;

/**
 * Class TransactionProductController
 * @package App\Http\Controllers\API
 */

class TransactionProductAPIController extends AppBaseController
{
    static function addProduct(Request $request, int $idTransaction)
    {
        try {
            foreach ($request->products as $value => $product) {
                    Cart::where('id', $product['id_cart']??null)->delete();
                
                TransactionProduct::create([
                    'id_transaksi_penjualan' => $idTransaction,
                    'id_produk' => $product['id_produk'],
                    'nama_produk' => $product['nama_produk'],
                    'photo_url_produk' => $product['photo_url_produk'],
                    'deskripsi_produk' => $product['deskripsi_produk'],
                    'harga_produk' => $product['harga_produk'],
                    'harga_diskon' => $product['harga_diskon'],
                    'jumlah_satuan' => $product['jumlah_satuan'],
                    'nama_satuan' => $product['nama_satuan'],
                    'kuantitas' => $product['kuantitas'],
                    'kondisi' => $product['kondisi']??null,
                    'preorder' => $product['preorder']??null,
                    'is_service'=>$product['is_service']??null,
                ]);
            }
        } catch (Exception $error) {
            throw new Exception("add product Transaction".$error->getMessage(), 1);

            return ResponseFormatter::error(
                [
                    'message' => $error->getMessage(),
                ],
                'Add Product Transaction Failed',
            );
        }
    }
}
