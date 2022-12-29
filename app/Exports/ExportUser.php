<?php

namespace App\Exports;
use App\Models\Seashell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Carbon\Carbon;

class ExportUser implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Name',
            'Phone',
            'IP',
            'Date',
        ];
    } 
    public function collection()
    {
        //return Seashell::select('name','phone','ip','date')->get(); 
        if (request()->start_date || request()->end_date) {

            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Seashell::Select('name','phone','ip','date')->whereBetween('created_at',[$start_date,$end_date])->get();
        } else {
            $data = Seashell::Select('name','phone','ip','date')->latest()->get();
        }
        return $data;
    }
}
