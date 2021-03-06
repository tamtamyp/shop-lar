<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    // public function collection(Collection $collection)
    // {
    //     //
    // }
    public function model(array $row)
    {
        $data = new ProductModel([
            'name'        => $row[0]!=='NULL'?$row[0]:NULL,
            'category_id' => $row[1]!=='NULL'?$row[1]:NULL,
            'description' => $row[2]!=='NULL'?$row[2]:NULL,
            'content'     => $row[3]!=='NULL'?$row[3]:NULL,
            'price'       => $row[4]!=='NULL'?$row[4]:NULL,
            'sale_price'  => $row[5]!=='NULL'?$row[5]:NULL,
            'thumb'       => $row[6]!=='NULL'?$row[6]:NULL,
            'thumb_list'  => $row[7]!=='NULL'?$row[7]:NULL,
            'status'      => $row[8]!=='NULL'?$row[8]:NULL,
            'type'        => $row[9]!=='NULL'?$row[9]:NULL,
            'created_by'  => session()->get('username'),
        ]);
        // dd($data);
        return $data;
    }
    public function startRow(): int
    {
        return 2;
    }
}
