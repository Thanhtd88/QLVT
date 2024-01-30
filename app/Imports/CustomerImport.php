<?php

namespace App\Imports;

use App\Models\administrator\Test;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $test = Test::where('email', $row['email'])->first();
            if($test){
                $test->update([
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                ]);

            }else{

                Test::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ]);
            }

        }
    }
}
