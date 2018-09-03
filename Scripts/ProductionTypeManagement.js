$(document).ready(function() {
    DataManagementTable = $('#ProductionTypeManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#ProductionTypeManagementTable_filter input').focus()
} );