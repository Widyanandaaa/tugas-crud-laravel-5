const url = 'http://127.0.0.1:8000/';

// DATATABLE
$(document).ready(function() {
    $('#table-siswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${url}/siswa-mapel`,
            type: 'GET'
        },
        columns: [{
                data: 'student_id',
                name: 'ID Siswa'
            },
            {
                data: 'Nama Siswa',
                name: 'Nama Siswa'
            },
            {
                data: 'subject_id',
                name: 'ID Mapel'
            },
            {
                data: 'mapel',
                name: 'mapel'
            },
            {
                data: 'aksi',
                name: 'aksi'
            }
        ],
        order: [
            [0, 'asc']
        ]
    });

    // MODAL
    var table = $('#table-siswa').DataTable();
    
    $('#tombol-tambah').on('click', function () {
        $('#modal-tambah').modal('show');
    });

    table.on('click', '#tombol-edit', function () {
        var tr = $(this).closest('tr');
        if( $(tr).hasClass('child') ) {
            tr = tr.prev('.parent');
        }
        
        var data = table.row(tr).data();

        $('#edit-nama').val(data.student_id);
        $('#edit-mapel').val(data.subject_id);
        
        $('#form-edit').attr('action', `/siswa-mapel/${data.id}`);
        $('#modal-edit').modal('show');
    });

    table.on('click', '#tombol-hapus', function() {
        var tr = $(this).closest('tr');
        if( $(tr).hasClass('child') ) {
            tr = tr.prev('.parent');
        }
        
        var data = table.row(tr).data();

        $('#form-hapus').attr('action', `/siswa-mapel/${data.id}`);
        $('#modal-hapus').modal('show');
    });
});