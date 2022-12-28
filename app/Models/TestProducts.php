<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestProducts extends Model
{
    /////////////////////////////////////////////////////////////////
    // test_productsテーブルから検索データをもとにデータ取得(部分一致) //
    /////////////////////////////////////////////////////////////////
    public function searchProductListDB($product_name,$company_name) {
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

    //////////////////////////////////////////
    // test_companiesテーブルからデータを取得 //
    //////////////////////////////////////////
    public function getCompanyListDB() {
        $data = DB::table('test_companies')->get();
        return $data;
    }

    /////////////////////////////////////
    // 詳細ボタンから必要情報のデータ取得 //
    /////////////////////////////////////
    public function getProductDetailDB($id){
        $data = DB::table('test_products')
        ->where('test_products.id', $id)
        ->join('test_companies','test_products.company_id','=','test_companies.id')
        ->get();
        
        return $data;
    }

    ////////////////////////////////////////
    // test_companiesテーブルにデータを挿入 //
    ////////////////////////////////////////
    public function insertProductListDB($data,$filename) {
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

    ////////////////////////////////////////
    // test_companiesテーブルのデータを更新 //
    ////////////////////////////////////////
    public function editProductDB($data,$filename) {
        DB::table('test_products')
        ->where('test_products.id', $data->txtFeditproductid)
        ->update([
            'company_id' => $data->drpFeditcompany,
            'product_name' => $data->txtFeditproduct,
            'price' => $data->txtFeditprice,
            'stock' => $data->txtFeditstock,
            'comment' => $data->txtFeditcomment,
            'img_path' => $filename,
            'updated_at' => NOW(),
        ]);
    }

    ///////////////////////////////////////
    //  DBから今登録されている画像URL取得  //
    ///////////////////////////////////////
    public function getimgDB($id) {
        $data = DB::table('test_products')
        ->where('test_products.id', $id)
        ->first();
        
        return $data;
    }

    //////////////////////////////
    //  DBから指定のデータを削除  //
    //////////////////////////////
    public function deteleDB($id) {
        $data = DB::table('test_products')
        ->where('test_products.id', $id)
        ->delete();
    }
}
