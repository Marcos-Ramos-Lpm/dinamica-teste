$(document).ready(function () {

    //DATATABLES
    $('#tabela-historico').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": Boot.baseURLdefault() + "modulo/usuario/table/table-historico-usuarios.php",
            "type": 'POST'
        },
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado!",
            "info": "Mostrando a página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "loadingRecords": "Carregando registros...",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Pesquisar por:",
            "processing": "Processando",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        },
        "columnDefs": [

            {
                // "targets": 5,
                // "orderable": false
            }

        ]
    });
});