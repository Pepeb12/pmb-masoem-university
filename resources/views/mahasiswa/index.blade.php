<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            {{ __('Data Mahasiswa - Masoem University') }}
        </h2>
    </x-slot>

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <style>
        /* Header Tabel: Biru Navy */
        table.dataTable thead th {
            background-color: #1e3a8a !important; /* Navy-900 */
            color: #ffffff !important;
            border-bottom: 2px solid #172554 !important;
            padding: 15px !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        
        /* Baris Tabel */
        table.dataTable tbody tr {
            background-color: white;
            transition: background-color 0.2s;
        }
        table.dataTable tbody tr:hover {
            background-color: #eff6ff !important; /* Blue-50 */
        }
        
        /* Input Search Bulat */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 9999px; /* Full Rounded */
            padding: 6px 15px;
            margin-left: 10px;
            outline: none;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
        }

        /* Pagination Biru */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #1e3a8a !important;
            color: white !important;
            border: 1px solid #1e3a8a !important;
            border-radius: 8px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #bfdbfe !important;
            color: #1e3a8a !important;
            border: 1px solid #1e3a8a !important;
            border-radius: 8px;
        }
    </style>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-t-4 border-blue-900">
                <div class="p-8">
                    
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Daftar Pendaftar</h3>
                            <p class="text-sm text-gray-500">Kelola data akademik mahasiswa baru.</p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button id="createNewMahasiswa" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:-translate-y-1 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Tambah Data
                            </button>
                            
                            <a href="{{ route('mahasiswa.exportExcel') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:-translate-y-1 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Excel
                            </a>
                            
                            <a href="{{ route('mahasiswa.cetakLaporan') }}" target="_blank" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:-translate-y-1 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                PDF
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="table w-full border-collapse data-table">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th>NIM</th>
                                    <th>Nama Lengkap</th>
                                    <th>Program Studi</th>
                                    <th>Status</th>
                                    <th width="20%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700"></tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-blue-900">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Import Data Masal</h4>
                        <p class="text-sm text-blue-700">Upload file Excel/CSV untuk input cepat.</p>
                    </div>
                </div>
                <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 w-full md:w-auto">
                    @csrf
                    <input type="file" name="file" required class="block w-full text-sm text-blue-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-200 file:text-blue-900 hover:file:bg-blue-300">
                    <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full shadow transition">Upload</button>
                </form>
            </div>

        </div>
    </div>

    <div id="ajaxModel" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 hidden z-50 transition-opacity backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden transform transition-all scale-100">
            <div class="px-6 py-4 bg-blue-900 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <span id="modelHeading">Form Data</span>
                </h3>
                <button id="closeModalX" class="text-blue-200 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 bg-gray-50">
                <form id="mahasiswaForm" name="mahasiswaForm">
                    <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-blue-900 uppercase tracking-wide mb-1">NIM / No Daftar</label>
                            <input type="text" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900 transition" id="nim" name="nim" required placeholder="Contoh: 250001">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-blue-900 uppercase tracking-wide mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900 transition" id="nama" name="nama" required placeholder="Nama Mahasiswa">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-blue-900 uppercase tracking-wide mb-1">Pilihan Prodi</label>
                            <select id="prodi" name="prodi" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900 transition">
                                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                <option value="S1 Bisnis Digital">S1 Bisnis Digital</option>
                                <option value="S1 Agribisnis">S1 Agribisnis</option>
                                <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" id="closeModal" class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-full font-bold hover:bg-gray-300 transition">Batal</button>
                        <button type="submit" id="saveBtn" class="px-6 py-2.5 bg-blue-900 text-white rounded-full font-bold shadow hover:bg-blue-800 transition transform hover:scale-105" value="create">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mahasiswa.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center font-bold text-gray-500'},
                    {data: 'nim', name: 'nim', className: 'font-bold text-blue-900'},
                    {data: 'nama', name: 'nama'},
                    {data: 'pilihan_prodi_1', name: 'pilihan_prodi_1'},
                    {data: 'status_badge', name: 'status_badge', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Cari Nama / NIM...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Hal _PAGE_ dari _PAGES_",
                    paginate: { next: "Next &rarr;", previous: "&larr; Prev" }
                }
            });

            // --- 1. LOGIC TOMBOL VERIFIKASI (BARU) ---
            $('body').on('click', '.verifikasi-btn', function () {
                var mahasiswa_id = $(this).data("id");
                
                // Konfirmasi dulu biar gak kepencet
                if(confirm("Apakah Anda yakin ingin MEMVERIFIKASI mahasiswa ini?")) {
                    // Tampilkan loading di tombol (opsional)
                    $(this).html('...'); 

                    $.ajax({
                        type: "POST", // Kita pakai POST
                        // Pastikan route ini ada di web.php
                        url: "/mahasiswa/" + mahasiswa_id + "/verifikasi", 
                        success: function (data) {
                            // Reload tabel otomatis tanpa refresh halaman
                            table.draw();
                            // Optional: Alert sukses
                            // alert(data.success); 
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            alert('Gagal verifikasi.');
                        }
                    });
                }
            });
            // ------------------------------------------

            // LOGIC MODAL TAMBAH
            $('#createNewMahasiswa').click(function () {
                $('#saveBtn').val("create-mahasiswa");
                $('#mahasiswa_id').val('');
                $('#mahasiswaForm').trigger("reset");
                $('#modelHeading').html("Tambah Mahasiswa");
                $('#ajaxModel').removeClass('hidden'); 
            });

            // LOGIC MODAL EDIT
            $('body').on('click', '.edit', function () {
                var mahasiswa_id = $(this).data('id');
                $.get("{{ route('mahasiswa.index') }}" +'/' + mahasiswa_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Data Mahasiswa");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').removeClass('hidden'); 
                    $('#mahasiswa_id').val(data.id);
                    $('#nim').val(data.nim);
                    $('#nama').val(data.nama);
                    $('#prodi').val(data.pilihan_prodi_1);
                })
            });

            // SIMPAN DATA
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Menyimpan...').prop('disabled', true);
                $.ajax({
                    data: $('#mahasiswaForm').serialize(),
                    url: "{{ route('mahasiswa.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#mahasiswaForm').trigger("reset");
                        $('#ajaxModel').addClass('hidden');
                        table.draw();
                        $('#saveBtn').html('Simpan Data').prop('disabled', false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Simpan Data').prop('disabled', false);
                        alert('Gagal menyimpan.');
                    }
                });
            });

            // HAPUS DATA
            $('body').on('click', '.delete', function () {
                var mahasiswa_id = $(this).data("id");
                if(confirm("Yakin ingin menghapus data ini secara permanen?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('mahasiswa.store') }}"+'/'+mahasiswa_id,
                        success: function (data) { table.draw(); },
                        error: function (data) { console.log('Error:', data); }
                    });
                }
            });

            $('#closeModal, #closeModalX').click(function() { $('#ajaxModel').addClass('hidden'); });
        });
    </script>
</x-app-layout>