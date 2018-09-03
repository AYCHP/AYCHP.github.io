$(document).ready(function() {
    DataManagementTable = $('#ProductionBusinessUnitManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#ProductionGroupManagementTable_filter input').focus()
} );