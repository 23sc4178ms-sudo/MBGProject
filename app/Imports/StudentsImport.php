<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class StudentsImport implements ToArray
{
    public array $rows = [];

    public function array(array $array): void
    {
        $this->rows = $array;
    }
}
