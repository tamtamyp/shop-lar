<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Excel;
use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\WithEvents;

class ProductExport implements WithEvents
{
    private $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(storage_path('app/public/file/export_template/exportProduct.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(0);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(0)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet($sheet){

        $query = ProductModel::query();
        $status = $this->filters['status'];
        if (!empty($this->filters['status'])) {
            $query->where('status', $status);
        }

        // Create the collection based on received ids
        $products = $query->orderBy('id','desc')->get();
        // dd($products);

        // Party starts at row 3
        $iteration = 9;

        foreach ($products as $product) {

            // Create cell definitions
            $A = "A".($iteration);
            $B = "B".($iteration);
            $C = "C".($iteration);
            $D = "D".($iteration);
            $E = "E".($iteration);

            // Populate dynamic content
            $sheet->setCellValue($A, $product->name);
            $sheet->setCellValue($B, $product->price);
            $sheet->setCellValue($C, $product->sale_price);
            $sheet->setCellValue($D, $product->status);
            $sheet->setCellValue($E, $product->type=="normal"?'Bình thường':'Nổi bật');
            $iteration++;
        }

    }
}
