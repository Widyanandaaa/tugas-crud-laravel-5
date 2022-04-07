const url = 'http://127.0.0.1:8000/';

// DATATABLE
$(document).ready(function() {
    $('#table-guru').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${url}/guru`,
            type: 'GET'
        },
        columns: [{
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'JK',
                name: 'Jenis Kelamin'
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
    var table = $('#table-guru').DataTable();
    
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
        $('#edit-alamat').val(data.alamat);
        $('#edit-JK').val(data.JK);
        
        $('#form-edit').attr('action', `/guru/${data.id}`);
        $('#modal-edit').modal('show');
    });

    table.on('click', '#tombol-hapus', function() {
        var tr = $(this).closest('tr');
        if( $(tr).hasClass('child') ) {
            tr = tr.prev('.parent');
        }
        
        var data = table.row(tr).data();

        $('#teks-hapus').text(`Yakin hapus data ${data.nama}?`);
        $('#form-hapus').attr('action', `/guru/${data.id}`);
        $('#modal-hapus').modal('show');
    });
});