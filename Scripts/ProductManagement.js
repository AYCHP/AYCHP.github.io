$(document).ready(function() {
    DataManagementTable = $('#DataManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#DataManagementTable_filter input').focus()
} );