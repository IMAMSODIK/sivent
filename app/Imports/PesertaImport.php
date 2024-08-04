<?php

namespace App\Imports;

use App\Models\Peserta;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class PesertaImport implements ToModel
{
    protected $id_event;

    public function __construct($id_event){
        $this->id_event = $id_event;
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

        $existingUser = User::where('username', $row[2])->first();
        if(!$existingUser){
            User::create([
                'name' => $row[0],
                'username' => $row[2],
                'password' => bcrypt($row[2]),
                'role' => 'peserta'
            ]);
        }

        return new Peserta([
            'event_id' => $this->id_event,
            'nama' => $row[0],
            'jenis_kelamin' => $row[1],
            'nip' => $row[2],
            'golongan' => $row[3],
            'jabatan' => $row[4],
            'no_rek' => $row[5],
            'bank' => $row[6],
            'is_narsum' => false
        ]);
    }
}
