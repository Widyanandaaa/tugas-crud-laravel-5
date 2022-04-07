const url = 'http://127.0.0.1:8000/';

// DATATABLE
$(document).ready(function() {
    $('#table-mapel').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${url}/mapel`,
            type: 'GET'
        },
        columns: [{
                data: 'nama',
                name: 'nama'
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
    var table = $('#table-mapel').DataTable();
    
    $('#tombol-tambah').on('click', function () {
        $('#modal-tambah').modal('show');
    });

    table.on('click', '#tombol-edit', function () {
        var tr = $(this).closest('tr');
        if( $(tr).hasClass('child') ) {
            tr = tr.prev('.parent');
        }
        
        var data = table.row(tr).data();

        $('#edit-nama').val(data.nama);
        
        $('#form-edit').attr('action', `/mapel/${data.id}`);
        $('#modal-edit').modal('show');
    });

    table.on('click', '#tombol-hapus', function() {
        var tr = $(this).closest('tr');
        if( $(tr).hasClass('child') ) {
            tr = tr.prev('.parent');
        }
        
        var data = table.row(tr).data();

        $('#teks-hapus').text(`Yakin hapus mapel ${data.nama}?`);
        $('#form-hapus').attr('action', `/mapel/${data.id}`);
        $('#modal-hapus').modal('show');
    });
});