<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Feedback;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FeedbackExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }


    public function headings(): array
    {
        return ["textFeedback"];
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $items = Feedback::FirstCommand();

        // $data = [];
        // foreach($items as $item){
        //     $data[] =  Feedback::select('textFeedback')
        //     ->where('id', $item)
        //     ->get();
        // }

        // return $data;

        return DB::table('feedback')
        ->select('textFeedback')
        ->where(function($query) use ($items)
        {
            foreach($items as $item)
            {
               $query->where('id',$item);
            }
        })->get();
    }
}
