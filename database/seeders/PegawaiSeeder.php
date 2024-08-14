<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawaiData = [
            ['nama' => 'Prof. Dr. Muhammad Syukri Albani Nst, M.A', 'nip' => '198407062009121006', 'golongan' => 'IV/c', 'jabatan' => 'Dekan', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Muhammad Yafiz, M.Ag.', 'nip' => '197604232003121002', 'golongan' => 'IV/b', 'jabatan' => 'Ketua LPM UINSU', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Marliyah, M.Ag.', 'nip' => '197601262003122003', 'golongan' => 'III/d', 'jabatan' => 'Wakil Dekan Bidang Kemahasiswaan dan Kerjasama', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Fauzi Arif Lubis, M.A.', 'nip' => '198412242015031004', 'golongan' => 'III/d', 'jabatan' => 'Wakil Dekan Bidang Administrasi Umum, Perencanaan dan Keuangan', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Prof. Dr. Mustapa Khamal Rokan, M.H.', 'nip' => '197807252008011006', 'golongan' => 'IV/b', 'jabatan' => 'Kepala Pusat Pendampingan dan Pengembangan Mutu Mahasiswa LPM', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Prof. Dr. Andri Soemitra, M.A.', 'nip' => '197605072006041002', 'golongan' => 'IV/b', 'jabatan' => 'Ka. Prodi Ekonomi Syariah (S3)', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Maryam Batubara, M.A., Ph.D.', 'nip' => '197207162007012023', 'golongan' => 'III/c', 'jabatan' => 'Ka. Prodi Ekonomi Syariah (S2)', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Muhamad Arif, S.E.I., M.A', 'nip' => '198501122023211023', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Imsar, M.Si.', 'nip' => '198703032015031004', 'golongan' => 'III/d', 'jabatan' => 'Ka. Prodi Ekonomi Islam', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Tri Inda Fadhilarahma, M.E.I.', 'nip' => '199101292015032008', 'golongan' => 'III/d', 'jabatan' => 'Ka. Prodi Asuransi Syari\'ah', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Hj. Yenni Samri Juliati Nasution, S.H.I., M.A.', 'nip' => '197907012009122003', 'golongan' => 'IV/a', 'jabatan' => 'Ka. Prodi Akuntansi Syari\'ah', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Nurbaiti, M.Kom.', 'nip' => '197908082015032001', 'golongan' => 'III/d', 'jabatan' => 'Ka. Prodi Manajemen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Tuti Anggraini, M.Ag.', 'nip' => '197705312005012007', 'golongan' => 'III/d', 'jabatan' => 'Ka. Prodi Perbankan Syari\'ah', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Sugianto, M.A.', 'nip' => '196706072000031003', 'golongan' => 'III/d', 'jabatan' => 'Kajur. Prodi Perbankan Syariah (S2)', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Yusrizal, S.E., M.Si.', 'nip' => '197505222009011006', 'golongan' => 'III/d', 'jabatan' => 'Sek. Prodi Ekonomi Syariah (S3)', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Ahmad Amin Dalimunthe, S.S., M.Hum. Ph.D.', 'nip' => '198407122011011004', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Rahmat Daim Harahap, M.Ak.', 'nip' => '199009262018031001', 'golongan' => 'III/d', 'jabatan' => 'Kepala Pusat Pengembangan Bisnis', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Rahmi Syahriza, S.Th.I., M.A.', 'nip' => '198501032011012011', 'golongan' => 'III/d', 'jabatan' => 'Sek. Prodi Ekonomi Syari\'ah (S2)', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Hendra Harmain, S.E., M.Pd.', 'nip' => '197305101998031003', 'golongan' => 'III/d', 'jabatan' => 'Sek. Prodi Akuntansi Syari\'ah (S2)', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Muhammad Ikhsan Harahap, M.E.I.', 'nip' => '198901052018011001', 'golongan' => 'III/c', 'jabatan' => 'Sek. Prodi Ekonomi Islam', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Muhammad Lathief Ilhamy Nasution M.E.', 'nip' => '198904262019031007', 'golongan' => 'III/c', 'jabatan' => 'Sek. Prodi Perbankan Syari\'ah (S2)', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Kamilah, S.E., M.Si.', 'nip' => '197910232008012014', 'golongan' => 'IV/a', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Muhammad Syahbudi, S.E.I, M.A', 'nip' => 'BLU1100000094', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Ahmad Perdana Indra, M.Ag', 'nip' => '197627012005011008', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Ahmad Syakir, M.A.', 'nip' => '197504292009011006', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Annio Indah Lestari Nasution, S.E., M.Si.', 'nip' => '197403092011012003', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Arnida Wahyuni Lubis, S.E, M.Si', 'nip' => 'BLU1100000089', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Atika M.A.', 'nip' => '198703062019032009', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Prof. Dr. Azhari Akmal Tarigan, M.Ag', 'nip' => '197212041998031002', 'golongan' => 'IV/c', 'jabatan' => 'Wakil Rektor Bidang Akademik', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Chuzaimah Batubara, M.A.', 'nip' => '197007061996032003', 'golongan' => 'IV/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Isnaini Harahap, M.Ag.', 'nip' => '197507202003122002', 'golongan' => 'IV/a', 'jabatan' => 'Wakil Dekan Bidang Akademik dan Kelembagaan', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Muhammad Habibi Siregar, S.Ag., M.A.', 'nip' => '197507252007101002', 'golongan' => 'IV/a', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Prof. Dr. Muhammad Ramadhan, S.Ag., M.A', 'nip' => '196901031998031004', 'golongan' => 'IV/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. M. Ridwan, M.Ag', 'nip' => '197608202003121004', 'golongan' => 'III/d', 'jabatan' => 'Wakil Dekan Bidang Akademik dan Kelembagaan FST', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Prof. Dr. Nurhayati, M.Ag.', 'nip' => '197405172003122003', 'golongan' => 'IV/d', 'jabatan' => 'Rektor', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Nurlaila, S.E., M.A.', 'nip' => '197505212001122002', 'golongan' => 'IV/b', 'jabatan' => 'Ka. Prodi Akuntasi Syariah (S2)', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Saparuddin, S.E., Ak., M.Ag.', 'nip' => '196307182001121001', 'golongan' => 'IV/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Sri Sudiarti, M.A.', 'nip' => '195911121990032002', 'golongan' => 'IV/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Prof. Dr. Zainul Fuad, M.A.', 'nip' => '196704231994031004', 'golongan' => 'IV/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Zuhrinal M. Nawawi, S.Ag., M.A.', 'nip' => '197608182007101001', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dra. Zainarti, M.M.', 'nip' => '196012141993032001', 'golongan' => 'IV/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Drs. Ahmad Riadi Daulay, M.Ag.', 'nip' => '196504141995031001', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Hotbin Hasugian, S.E., M.Si.', 'nip' => '197405062011011001', 'golongan' => 'III/c', 'jabatan' => 'Kepala SPI', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Juliana Nasution, M.E.', 'nip' => '199207202019032023', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Khairina Tambunan M.E.I.', 'nip' => '198501122019032014', 'golongan' => 'III/c', 'jabatan' => 'Kepala Pusat Audit dan Pengendalian Mutu Pada LPM', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Kusmilawaty, M.Ak.', 'nip' => '198006142015032001', 'golongan' => 'III/d', 'jabatan' => 'Anggota Komisi Disiplin Mahasiswa', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Laylan Syafina, M.Si.', 'nip' => '199108272018012002', 'golongan' => 'III/c', 'jabatan' => 'Sek. Akuntansi Syariah S1', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Maidalena, S.T., M.M.', 'nip' => '198105252011012009', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Mawaddah Irham, S.E.I., M.E.I', 'nip' => '198604142023212039', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Muhammad Irwan Padli Nasution, S.T., M.M.', 'nip' => '197502132006041003', 'golongan' => 'IV/b', 'jabatan' => 'Kepala Pusat Penelitian dan Penerbitan LP2M', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Nikmah Dalimunthe, S.Ag., M.H.', 'nip' => 'BLU1100000117', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nuri Aslami M.Si.', 'nip' => '199302192019032021', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nursantri Yanti M.E.I.', 'nip' => '199005282019032022', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nurul Inayah M.E.', 'nip' => '199212032019032018', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nurul Jannah M.E.', 'nip' => '199202172019032018', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nurwani M.Si.', 'nip' => '198903262019032010', 'golongan' => 'III/c', 'jabatan' => 'Ketua UPM FEBI', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Nur Ahmadi Bi Rahmani, S.E., M.Si.', 'nip' => 'BLU1100000093', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Nur Fadhilah Ahmad Hasibuan, S.E., M.Ak.', 'nip' => '198907112023212028', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Reni Ria Armayani Hasibuan M.E.I.', 'nip' => '198809072019032011', 'golongan' => 'III/c', 'jabatan' => 'Sekretalis LP2M', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Risyad Fakar Lubis, S.H., M.A.P.', 'nip' => '198405082023211000', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Sri Ramadhani, M.M.', 'nip' => '197510152005012004', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Suhairi, S.T., M.M.', 'nip' => '197706112007101001', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Waizul Qarni, M.A.', 'nip' => '196703111996031004', 'golongan' => 'III/d', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Ahmad Muhaisin B. Syarbaini, M.Ag.', 'nip' => '199009172020121012', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Aqwa Naser Daulay, S.E.I, M.Si', 'nip' => '198812242020121009', 'golongan' => 'III/c', 'jabatan' => 'Sekretaris Prodi Asuransi Syariah', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Budi Dharma, M.M.', 'nip' => '198604012020121006', 'golongan' => 'III/b', 'jabatan' => 'Sek. Prodi Manajemen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Budi Harianto, M.A.', 'nip' => '198811252020121012', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Khaidar Rahmaini Jamila, M.Si., IBF.', 'nip' => '199311062020122019', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Rizqa Amelia, M.Ag.', 'nip' => '199012092020122016', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Siti Aisyah M.M.', 'nip' => '199202162019032022', 'golongan' => 'III/b', 'jabatan' => 'Kepala Laboratorium', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Wahyu Syarvina, M.A.', 'nip' => '198605212019082001', 'golongan' => 'III/c', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Purnama Ramadhani Silalahi, M.E.I', 'nip' => '199502142022032001', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Ataina Zulfa Nasution, M.E', 'nip' => 'BLU 1100000168', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Arsyadona, M.M', 'nip' => 'BLU 1100000174', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Ahmad Wahyudi Zein, M.E.I', 'nip' => 'BLU 1100000169', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Sri Wahyuni Br Ginting, M.Ak', 'nip' => 'BLU 1100000171', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Dr. Dini Vientianty, M.A', 'nip' => 'BLU 1100000167', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Rahima Kumala, M.E', 'nip' => 'BLU 1100000175', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Widya Susanty, M.Ak', 'nip' => 'BLU 1100000170', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Murdifin Azhar, S.Ak.,M.Ak', 'nip' => '199612252024031001', 'golongan' => 'III/b', 'jabatan' => 'Dosen', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dr. Bambang Lesmono, M.E', 'nip' => '198007072009011018', 'golongan' => 'III/d', 'jabatan' => 'Kabag TU', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Cahaya Br Ginting, S.Pd.I.', 'nip' => '197402102002122001', 'golongan' => 'III/d', 'jabatan' => 'PPK/Analis Pengelola Keuangan APBN Ahli Muda', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Nurhani, S.E., M.Si.', 'nip' => '197305242006042002', 'golongan' => 'IV/a', 'jabatan' => 'Pengembang Teknologi Pembelajaran Ahli Muda', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Irwanto, SE', 'nip' => '197909082009101002', 'golongan' => 'III/a', 'jabatan' => 'Bendahara Pengeluaran Pembantu', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Nurliadi, S.E.', 'nip' => '196703032003021001', 'golongan' => 'III/d', 'jabatan' => 'Pengadministrasi /Pelaksana', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Sapiah Rangkuti', 'nip' => '198407272014122000', 'golongan' => 'III/a', 'jabatan' => 'Pengadministrasi /Pelaksana', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Etika Norsam Ritonga, S.Pd', 'nip' => '199612062023212037', 'golongan' => 'III/a', 'jabatan' => 'Arsiparis', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Titin Ariati, A.Md.Kom', 'nip' => 'BLU1100000050', 'golongan' => 'III/a', 'jabatan' => 'Penyusun Laporan', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'Khairani, S.E', 'nip' => 'BLU1100000005', 'golongan' => 'III/a', 'jabatan' => 'Pengadministrasi Akademik', 'jenis_kelamin' => 'Perempuan'],
            ['nama' => 'M. Ganda Alfaridzi Nasution, S,.E', 'nip' => '199711262024211017', 'golongan' => 'III/a', 'jabatan' => 'Analis Sumber Daya Manusia', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Amila Ibna, S.Pd.I', 'nip' => 'BLU1100000015', 'golongan' => 'III/b', 'jabatan' => 'Pengadministrasi Akademik', 'jenis_kelamin' => 'Laki - Laki'],
            ['nama' => 'Dewi Kartika Sari, S.H.I', 'nip' => 'BLU1100000128', 'golongan' => 'III/a', 'jabatan' => 'Pengadministrasi Akademik', 'jenis_kelamin' => 'Perempuan'],
        ];

        foreach ($pegawaiData as $data) {
            Pegawai::create([
                'pegawai_id' => Str::random(6),
                'nama' => $data['nama'],
                'nip' => $data['nip'],
                'golongan' => $data['golongan'],
                'jabatan' => $data['jabatan'],
                'jenis_kelamin' => $data['jenis_kelamin'],
            ]);
        }
    }
}
