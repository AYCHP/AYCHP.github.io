$(document).ready(function() {
    DataManagementTable = $('#ProductionDepartmentManagementTable').DataTable( {
        "paging":   false,
        "fixedHeader": true,
        "language": { search: "",searchPlaceholder: "Search" }
    });
    $("#TableSearchContainer").html($(".dataTables_filter"));
    $('#ProductionDepartmentManagementTable_filter input').focus()
} );