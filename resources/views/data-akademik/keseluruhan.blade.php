<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Raport Siswa</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}"
    />
    <!-- DataTables -->
    <link
      rel="stylesheet"
      href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
      .wrapper {
          margin-right: 100px;
      }
      .header-content {
          margin-bottom: 30px;
      }
      .logo {
          margin-right: 20px;
          height: 100px;
          width: 100px;
      }
      .signature-section {
    display: flex;
    justify-content: space-around; /* Menyebar ruang secara merata di antara item */
    align-items: flex-start; /* Menyelaraskan elemen di bagian atas */
    margin-top: 50px;
    text-align: center;
  }

  .signature {
    flex: 1; /* Memastikan kolom tanda tangan memiliki lebar yang sama */
    margin: 0 20px; /* Menambahkan jarak horizontal antara kolom */
  }

  .signature img {
    width: 150px;
    height: auto;
  }
  
      @media print {
    .content-header {
          display: block !important; /* Pastikan elemen ditampilkan */
          visibility: visible !important; /* Pastikan elemen terlihat */
          position: static !important; /* Pastikan elemen tidak diatur dengan posisi yang mungkin menyebabkan masalah */
    }
      .no-print {
           display: none;
      }
          
      .signature-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 50px;
    }

    .signature-section .col-md-6 {
      flex: 1;
      text-align: center;
      margin-left: 200px;
    }

    .signature-section img {
      width: 150px;
      height: auto;
    }

    body {
      font-size: 12pt;
    }
    .content-header {
      display: block;
    }
      }
  </style>
    
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
     <button onclick="window.print()" style="margin: 20px;" class="no-print">Cetak Raport</button>
     <a href="{{ url('/export-data/'. $data->id) }}" class="btn btn-primary no-print">export</a>

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-left: 250px;">
          <div class="d-flex">
            <img src="{{ asset('img/logo.png') }}" class="logo me-3">

          <div class="text-center">
            <h1>PENDIDIK ANAK USIA DINI</h1>
            <h2>PAUD PLAMBOYAN</h2>
            <h2>RAPORT SISWA</h2>
          </div>

          </div>
          
        </section>

        <!-- Main content -->
        <section class="content" style="margin-right:">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header" style="margin-left: 300px;">
                    <h2 class="card-title" style="text-align: center; font-size: 25px; font-weight: bold;">
                      Perkembangan Anak Didik <br/>
                      Usia 4-5 Tahun
                    </h2>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table
                      id="example1"
                      class="table"
                    >
                      <thead style="border: none;">
                        <tr>
                          <th>Nama Siswa</th>
                          <th>{{ $data->siswa->nama }}</th>
                          
                        </tr>
                        <tr>
                          <th>Nis</th>
                          <th>{{ $data->siswa->nis }}</th>
                        </tr>
                        <tr>
                          <th>Jenis Kelamin</th>
                          <th>{{ $data->siswa->jenis_kelamin }}</th>
                        </tr>
                        <tr>
                          <th>Semester</th>
                          <th>{{ $data->semester }}</th>
                        </tr>
                        <tr>
                          <th>Tahun Ajaran</th>
                          <th>{{ $data->tahun_ajaran }}</th>
                        </tr>

                      </thead>
                    

                      <thead style="margin-top: 20px;">
                        <tr><th colspan="5"><p style="font-weight: bold; text-align:center;">REKAP BELAJAR SISWA</p></th></tr>
                        <tr>
                          <th>No</th>
                          <th>Kegiatan</th>
                          <th>Nilai</th>
                          <th>Deskripsi</th>
                          <th>Grade</th>
                        </tr>

        

                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Perkembangan Fisik</td>
                          <td>{{ $data->nilai_fisik }}</td>
                          <td>{{ $data->perkembangan_fisik }}</td>
                          <td>@if ($data->nilai_fisik > 80)
                            A
                            @elseif ($data->nilai_fisik > 70)
                            B
                            @elseif ($data->nilai_fisik > 60)
                            C
                            @elseif ($data->nilai_fisik >=0)
                            D
                            @else
                            E
                              
                          @endif
                        </td>
                        </tr>

                        <tr>
                          <td>2</td>
                          <td>Perkembangan Kognotif</td>
                          <td>{{ $data->nilai_kognitif }}</td>
                          <td>{{ $data->perkembangan_kognitif }}</td>
                          <td>@if ($data->nilai_kognitif > 80)
                            A
                            @elseif ($data->nilai_kognitif > 70)
                            B
                            @elseif ($data->nilai_kognitif > 60)
                            C
                            @elseif ($data->nilai_kognitif >=0)
                            D
                            @else
                            E
                              
                          @endif
                        </td>
                        <tr>
                          <td>3</td>
                          <td>Perkembangan Sosial</td>
                          <td>{{ $data->nilai_sosial }}</td>
                          <td>{{ $data->perkembangan_sosial_emosional }}</td>
                          <td>@if ($data->nilai_sosial > 80)
                            A
                            @elseif ($data->nilai_sosial > 70)
                            B
                            @elseif ($data->nilai_sosial > 60)
                            C
                            @elseif ($data->nilai_sosial >=0)
                            D
                            @else
                            E
                              
                          @endif
                        </td>
                          
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Perkembangan Bahasa</td>
                          <td>{{ $data->nilai_bahasa }}</td>
                          <td>{{ $data->perkembangan_bahasa }}</td>
                          <td>@if ($data->nilai_bahasa > 80)
                            A
                            @elseif ($data->nilai_bahasa > 70)
                            B
                            @elseif ($data->nilai_bahasa > 60)
                            C
                            @elseif ($data->nilai_bahasa >=0)
                            D
                            @else
                            E
                              
                          @endif
                        </td>
                          
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Kegiatan Belajar</td>
                          <td>{{ $data->nilai_belajar }}</td>
                          <td>{{ $data->kegiatan_belajar }}</td>
                          <td>@if ($data->nilai_belajar > 80)
                            A
                            @elseif ($data->nilai_belajar > 70)
                            B
                            @elseif ($data->nilai_belajar > 60)
                            C
                            @elseif ($data->nilai_belajar >=0)
                            D
                            @else
                            E
                              
                          @endif
                        </td>

                          
                        </tr>
                        <tr>
                          <td colspan="2">Perolehan Nilai :</td>
                          <td>{{ $data->jumlah }}</td>


                        </tr>
                        <tr>
                          <td colspan="4">Grade Hasil :</td>
                          <td>{{ $data->grade }}</td>


                        </tr>
                      </tbody>

                    </table>
                  </div>
                  <!-- /.card-body -->

                  <div class="signature-section">
                    <div class="signature">
                      <p>Guru</p>
                      <img src="{{ asset('img/ttd.png') }}" alt="Tanda Tangan Guru">
                      <p><u>{{ $data->guru->nama }}</u><br>
                      <b>NIP.{{ $data->guru->nip }}</b></p>
                    </div>
                    <div class="signature">
                      <p>Ketua Yayasan</p>
                      <img src="{{ asset('img/ttd.png') }}" alt="Tanda Tangan Ketua Yayasan">
                      <p>Yayat Nurahmat</p>
                    </div>
                  </div>
                </div>
                <!-- /.card -->

                
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
     
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lte/}plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('lte/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <script>
      document.getElementById('exportBtn').addEventListener('click', function() {
        var ws = XLSX.utils.table_to_sheet(document.getElementById('example1'));
    
        // Menambahkan header dengan gaya
        ws['!merges'] = [
          {s: {r: 0, c: 0}, e: {r: 0, c: 4}}, // Merge header
          {s: {r: 1, c: 0}, e: {r: 1, c: 4}}, // Merge Nama Siswa, Nis, dll
        ];
    
        ws['A1'].v = 'Perkembangan Anak Didik Usia 4-5 Tahun';
        ws['A1'].s = {
          font: {bold: true, sz: 16},
          alignment: {horizontal: 'center'},
          fill: {fgColor: {rgb: "FFFF00"}}
        };
    
        ws['A2'].v = 'Nama Siswa: {{ $data->siswa->nama }}';
        ws['A3'].v = 'Nis: {{ $data->siswa->nis }}';
        ws['A4'].v = 'Jenis Kelamin: {{ $data->siswa->jenis_kelamin }}';
        ws['A5'].v = 'Semester: {{ $data->semester }}';
        ws['A6'].v = 'Tahun Ajaran: {{ $data->tahun_ajaran }}';
    
        // Menambahkan data tabel
        var rows = [
          ["No", "Kegiatan", "Nilai", "Deskripsi", "Grade"],
          ["1", "Perkembangan Fisik", "{{ $data->nilai_fisik }}", "{{ $data->perkembangan_fisik }}", getGrade({{ $data->nilai_fisik }})],
          ["2", "Perkembangan Kognitif", "{{ $data->nilai_kognitif }}", "{{ $data->perkembangan_kognitif }}", getGrade({{ $data->nilai_kognitif }})],
          ["3", "Perkembangan Sosial", "{{ $data->nilai_sosial }}", "{{ $data->perkembangan_sosial_emosional }}", getGrade({{ $data->nilai_sosial }})],
          ["4", "Perkembangan Bahasa", "{{ $data->nilai_bahasa }}", "{{ $data->perkembangan_bahasa }}", getGrade({{ $data->nilai_bahasa }})],
          ["5", "Kegiatan Belajar", "{{ $data->nilai_belajar }}", "{{ $data->kegiatan_belajar }}", getGrade({{ $data->nilai_belajar }})],
          ["", "Perolehan Nilai :", "{{ $data->jumlah }}"],
          ["", "Grade Hasil :", "{{ $data->grade }}"]
        ];
    
        // Add data rows to worksheet
        XLSX.utils.sheet_add_aoa(ws, rows, {origin: "A8"});
    
        // Add more custom formatting if needed
        ws['!cols'] = [{wch: 10}, {wch: 30}, {wch: 15}, {wch: 50}, {wch: 10}]; // Adjust column widths
    
        // Create workbook and save
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        var wbout = XLSX.write(wb, {bookType:'xlsx', type: 'binary'});
    
        function s2ab(s) {
          var buf = new ArrayBuffer(s.length);
          var view = new Uint8Array(buf);
          for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
          return buf;
        }
    
        var blob = new Blob([s2ab(wbout)], {type: "application/octet-stream"});
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'report.xlsx';
        link.click();
      });
    
      function getGrade(score) {
        if (score > 80) return 'A';
        if (score > 70) return 'B';
        if (score > 60) return 'C';
        if (score >= 0) return 'D';
        return 'E';
      }
    </script>
    
    
  </body>
</html>
