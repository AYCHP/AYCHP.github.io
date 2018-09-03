$(document).ready(function() {
    DataManagementTable = $('#ProductionLineManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#ProductionLineManagementTable_filter input').focus()
} );