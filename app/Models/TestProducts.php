<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestProducts extends Model
{
        // test_productsテーブルからデータを取得
        public function getProductList() {

            // productsテーブルとcompaniesを連結
            // productsのcompany_idをcompaniesのcompany_nameとする
            $data = DB::table('test_products')
            ->select('test_products.id',
                    'test_products.img_path',
                    'test_products.product_name',
                    'test_products.price',
                    'test_products.stock',
                    'test_companies.company_name as company_name')
            ->join('test_companies','test_products.company_id','=','test_companies.id')
            ->get();
    
            return $data;
        }
    
        // test_productsテーブルからデータを取得
        public function searchProductList($product_name,$company_name) {

            // productsテーブルとcompaniesを連結
            // productsのcompany_idをcompaniesのcompany_nameとする
            $data = DB::table('test_products')
            ->select('test_products.id',
                    'test_products.img_path',
                    'test_products.product_name',
                    'test_products.price',
                    'test_products.stock',
                    'test_companies.company_name as company_name')
            ->where('test_products.product_name', 'LIKE', '%'. $product_name .'%')
            ->where('company_name', 'LIKE', '%'. $company_name .'%')
            ->join('test_companies','test_products.company_id','=','test_companies.id')
            ->get();
    
            return $data;
        }
    
        // test_companiesテーブルからデータを取得
        public function getCompanyList() {
            $company_name = DB::table('test_companies')->get();
    
            return $company_name;
        }

        public function insertProductList($data,$filename) {
            DB::table('test_products')->insert([
                'company_id' => $data->drpFaddcompany,
                'product_name' => $data->txtFaddproduct,
                'price' => $data->txtFaddprice,
                'stock' => $data->txtFaddstock,
                'comment' => $data->txtFaddcomment,
                'img_path' => $filename,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
}
