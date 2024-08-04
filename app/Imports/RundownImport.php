<?php

namespace App\Imports;

use App\Models\Rundown;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class RundownImport implements ToModel
{
    protected $id_event;

    public function __construct($id_event){
        $this->id_event = $id_event;
    }

    private function convertDate($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->toDateString();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        static $isFirstRow = true;
        if ($isFirstRow) {
            $isFirstRow = false;
            return null;
        }

        $tanggal = $this->convertDate($row[0]);

        return new Rundown([
            'event_id' => $this->id_event,
            'tanggal_kegiatan' => $tanggal,
            'waktu_kegiatan' => $row[1],
            'keterangan_kegiatan' => $row[2],
            'aktor' => $row[3]
        ]);
    }
}
