$(document).ready(function() {
    $('#myTable').DataTable();
    $('#Table').DataTable();
    $('#sent_messages_table').DataTable({
        processing:true,
        serverSide: true,
        autoWidth: false,
        ajax:"/sent-message-json",
        language:{ 
            loadingRecords: "&nbsp;",
            processing: "Loading, please wait..."
        },
        columns: [
            {"data": "branch_id", name: "branch_id", searchable: true},
            {"data": "number", name: "number", searchable: true},
            {"data": "message", name: "message", searchable: true},
            {"data": "created_at", name: "created_at", searchable: false}
        ]
    });
});
$('#example23').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
