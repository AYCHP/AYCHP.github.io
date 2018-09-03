$(document).ready(function() {
    DataManagementTable = $('#UserManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#UserManagementTable_filter input').focus()
} );