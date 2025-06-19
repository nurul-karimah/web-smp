<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use App\Models\DataAkademikPaud;
use App\Models\Orantua;
use App\Models\Siswa;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;


class ExportRaportSiswa extends Controller
{
    public function exportDataAkademik($id)
    {

        $tanggal_sekarang = Carbon::now()->format('d-m-Y');
        $data = DataAkademikPaud::with('siswa', 'guru')
            ->where('id', $id)
            ->first();


        // cek apakah data ditemukan 





        if (!$data) {
            return redirect('/dataakademik')->with('error', 'Data tidak ditemukan');
        }


        $orangtua_id = $data->siswa->orangtua_id;
        $orantua = Orantua::where('id', $orangtua_id)->first();

        //buat spreadsheetbaru 

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        //menambahkan logo
        $logo = public_path('img/logo.png');
        $drawing = new Drawing();
        $drawing->setName('Logo PAUD');
        $drawing->setDescription('Log PAUD');
        $drawing->setPath($logo);
        $drawing->setHeight(80);
        $drawing->setCoordinates('B3');
        $drawing->setWorksheet($sheet);

        // Menambahkan judul
        $sheet->setCellValue('C3', 'PENDIDIKAN ANAK USIA DINI');
        $sheet->mergeCells('C3:I3');

        // Menambahkan sub-judul
        $sheet->setCellValue('C4', 'PAUD PLAMBOYAN');
        $sheet->mergeCells('C4:I4');

        $sheet->setCellValue('C5', 'RAPORT SISWA');
        $sheet->MergeCells('C5:I5');

        $sheet->setCellValue('C6', 'Perkembangan Anak Didik');
        $sheet->MergeCells('C6:I6');

        $sheet->setCellValue('C7', 'Usia 4-5 Tahun');
        $sheet->MergeCells('C7:I7');


        // Mengatur gaya font untuk judul dan sub-judul dengan ukuran yang sama
        $fontSize = 16;
        $fontSize2 = 14;
        $sheet->getStyle('C3:I3')->getFont()->setBold(true)->setSize($fontSize);
        $sheet->getStyle('C4:I4')->getFont()->setBold(true)->setSize($fontSize);
        $sheet->getStyle('C5:I5')->getFont()->setBold(true)->setSize($fontSize);
        $sheet->getStyle('C6:I6')->getFont()->setBold(true)->setSize($fontSize2);
        $sheet->getStyle('C7:I7')->getFont()->setBold(true)->setSize($fontSize2);

        // Mengatur perataan teks agar berada di tengah sel
        $sheet->getStyle('C3:I4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C3:I4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('C5:I5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('C5:I5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C6:I6')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('C6:I6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('C7:I7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('C7:I7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $styleborder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ],
            ],
        ];


        // // Menambahkan header kolom
        $sheet->setCellValue('A8', 'Nama Siswa :');
        $sheet->mergeCells('A8:B8');
        $sheet->setCellValue('A9', 'Nis :');
        $sheet->mergeCells('A9:B9');
        $sheet->setCellValue('A10', 'Jenis Kelamin :');
        $sheet->mergeCells('A10:B10');
        $sheet->setCellValue('A11', 'Semester :');
        $sheet->mergeCells('A11:B11');
        $sheet->setCellValue('A12', 'Tahun AJaran :');
        $sheet->mergeCells('A12:B12');
        $sheet->setCellValue('A13', 'Orantua Wali :');
        $sheet->MergeCells('A13:B13');

        // // Menambahkan data ke kolom
        $sheet->setCellValue('C8', $data->siswa->nama);
        $sheet->mergeCells('C8:D8');
        $sheet->setCellValue('C9', $data->siswa->nis);
        $sheet->mergeCells('C9:D9');
        $sheet->setCellValue('C10', $data->siswa->jenis_kelamin);
        $sheet->mergeCells('C10:D10');
        $sheet->setCellValue('C11', $data->semester);
        $sheet->mergeCells('C11:D11');
        $sheet->setCellValue('C12', $data->tahun_ajaran);
        $sheet->mergeCells('C12:D12');
        $sheet->setCellValue('C13', $orantua->nama);
        $sheet->mergeCells('C13:D12');

        $sheet->setCellValue('A15', 'REKAP BELAJAR SISWA');
        $sheet->mergeCells('A15:I15');
        $sheet->getStyle('A15')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A16', 'NO');
        $sheet->getStyle('A16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B16', 'Kegiatan Belajar');
        $sheet->mergeCells('B16:E16');
        $sheet->getStyle('B16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('F16', 'Nilai');
        $sheet->getStyle('F16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('G16', 'Deskripsi');
        $sheet->getStyle('G16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('H16', 'GRADE');
        $sheet->getStyle('H16')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $sheet->setCellValue('A17', '1');
        $sheet->getStyle('A17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B17', 'Perkembangan Fisik');
        $sheet->mergeCells('B17:E17');

        $sheet->setCellValue('F17', $data->nilai_fisik);
        $sheet->getStyle('F17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $grade = '';

        if ($data->nilai_fisik > 80) {
            $grade = 'A';
        } elseif ($data->nilai_fisik > 70) {
            $grade = 'B';
        } elseif ($data->nilai_fisik > 60) {
            $grade = 'C';
        } elseif ($data->nilai_fisik > 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $sheet->setCellValue('G17', $data->perkembangan_fisik);
        $sheet->getStyle('G17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H17', $grade);
        $sheet->getStyle('H17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A18', '2');
        $sheet->getStyle('A18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B18', 'Perkembangan Kognitif');
        $sheet->mergeCells('B18:E18');

        $sheet->setCellValue('F18', $data->nilai_kognitif);
        $sheet->getStyle('F18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $grade = '';

        if ($data->nilai_kognitif > 80) {
            $grade = 'A';
        } elseif ($data->nilai_kognitif > 70) {
            $grade = 'B';
        } elseif ($data->nilai_kognitif > 60) {
            $grade = 'C';
        } elseif ($data->nilai_kognitif > 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $sheet->setCellValue('G18', $data->perkembangan_kognitif);
        $sheet->getStyle('G18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H18', $grade);
        $sheet->getStyle('H18')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A19', '3');
        $sheet->getStyle('A19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B19', 'Perkembangan Sosial dan Emosional');
        $sheet->mergeCells('B19:E19');

        $sheet->setCellValue('F19', $data->nilai_sosial);
        $sheet->getStyle('F19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $grade = '';

        if ($data->nilai_sosial > 80) {
            $grade = 'A';
        } elseif ($data->nilai_sosial > 70) {
            $grade = 'B';
        } elseif ($data->nilai_sosial > 60) {
            $grade = 'C';
        } elseif ($data->nilai_sosial > 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $sheet->setCellValue('G19', $data->perkembangan_sosial_emosional);
        $sheet->getStyle('G19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H19', $grade);
        $sheet->getStyle('H19')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $sheet->setCellValue('A20', '4');
        $sheet->getStyle('A20')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B20', 'Perkembangan Bahasa');
        $sheet->mergeCells('B20:E20');

        $sheet->setCellValue('F20', $data->nilai_bahasa);
        $sheet->getStyle('F20')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $grade = '';

        if ($data->nilai_bahasa > 80) {
            $grade = 'A';
        } elseif ($data->nilai_bahasa > 70) {
            $grade = 'B';
        } elseif ($data->nilai_bahasa > 60) {
            $grade = 'C';
        } elseif ($data->nilai_bahasa > 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $sheet->setCellValue('G20', $data->perkembangan_bahasa);
        $sheet->getStyle('G20')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H20', $grade);
        $sheet->getStyle('H20')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $sheet->setCellValue('A21', '5');
        $sheet->getStyle('A21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('B21', 'Kegiatan Belajar');
        $sheet->mergeCells('B21:E21');

        $sheet->setCellValue('F21', $data->nilai_belajar);
        $sheet->getStyle('F21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $grade = '';

        if ($data->nilai_belajar > 80) {
            $grade = 'A';
        } elseif ($data->nilai_belajar > 70) {
            $grade = 'B';
        } elseif ($data->nilai_belajar > 60) {
            $grade = 'C';
        } elseif ($data->nilai_belajar > 50) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $sheet->setCellValue('G21', $data->kegiatan_belajar);
        $sheet->getStyle('G21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H21', $grade);
        $sheet->getStyle('H21')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A22', 'Perolehan Nilai :');
        $sheet->mergeCells('A22:E22');
        $sheet->setCellValue('F22', $data->jumlah);
        $sheet->getStyle('F22')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('A23', 'Grade Hasil :');
        $sheet->mergeCells('A23:G23');
        $sheet->setCellValue('H23', $data->grade);
        $sheet->getStyle('H23')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A22:E22')->getFont()->setBold(true);
        $sheet->getStyle('A23:H23')->getFont()->setBold(true);




        $sheet->getStyle('A16:H16')->applyFromArray($styleborder);
        $sheet->getStyle('A17:H17')->applyFromArray($styleborder);
        $sheet->getStyle('A18:H18')->applyFromArray($styleborder);
        $sheet->getStyle('A19:H19')->applyFromArray($styleborder);
        $sheet->getStyle('A20:H20')->applyFromArray($styleborder);
        $sheet->getStyle('A21:H21')->applyFromArray($styleborder);
        $sheet->getStyle('A22:F22')->applyFromArray($styleborder);
        $sheet->getStyle('A23:H23')->applyFromArray($styleborder);

        $sheet->setCellValue('A25', 'Bandung ,' . $tanggal_sekarang);
        $sheet->mergeCells('A25:C25');
        $sheet->setCellValue('A26', 'Guru Paud,');
        $sheet->mergeCells('A26:C26');
        $sheet->setCellValue('A30', $data->guru->nama);
        $sheet->mergeCells('A30:C30');
        $sheet->setCellValue('A31', 'NIP.' . $data->guru->nip);
        $sheet->mergeCells('A31:C31');

        $sheet->getStyle('A30:C30')->getFont()->setBold(true)->setUnderline(true)->setSize(12);
        $sheet->getStyle('C31:C31')->getFont()->setBold(true)->setSize(12);

        $writer = new Xlsx($spreadsheet);

        // Nama file yang akan di-download
        $fileName = $data->siswa->nis . '_' . $data->siswa->nama . '.xlsx';

        // Redirect output ke klien browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
