moment.locale("id");

/* ADMIN */

// Admin - Menampilkan data Produk dari database ke DataTable
var tableProduk = $("#my-datatable-produk").DataTable({
    columnDefs: [
        {
            targets: 0,
            orderable: false,
            data: null,
            defaultContent: "",
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4, 5],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[3, "asc"]],
    deferRender: true,
    ajax: "/produk",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        { data: "nama", name: "nama" },
        { data: "ukuran", name: "ukuran" },
        { data: "mm_awal", name: "mm_awal", sortable: true, searchable: true },
        {
            data: "image",
            name: "image",
            render: function (data) {
                if (data == null) {
                    return data;
                } else {
                    return (
                        '<img src="/imgProduk/' +
                        data +
                        '" height="50" width="50" class="mx-auto d-block"/>'
                    );
                }
            },
        },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Admin - menampilkan data Produk dari database ke DataTable

// Admin - menampilkan data Distributor dari database ke DataTable
var tableDistributor = $("#my-datatable-distributor").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],

    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[0, "asc"]],
    deferRender: true,
    ajax: "/distributor",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        { data: "nama", name: "nama" },
        { data: "alamat", name: "alamat" },
        { data: "telp", name: "telp" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Admin - menampilkan data Distributor dari database ke DataTable

// Admin - Menampilkan data Klaim dari database ke DataTable
var tableKlaimAdmin = $("#my-datatable-listklaim").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
        {
            extend: "pdf",
            orientation: "landscape",
            title: "Data Klaim by Admin",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/listklaim",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        {
            data: "created_at",
            className: "text-center",
            render: function (data) {
                return moment(data).format("l");
            },
        },
        { data: "customerNama", name: "customer_nama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        {
            data: "kompensasi",
            name: "kompensasi",
            render: $.fn.dataTable.render.number(",", ".", 0, "Rp"),
        },
        { data: "hasil_pabrik", name: "hasil_pabrik" },
        {
            data: "hasil_klaim",
            className: "text-center",
            render: function (data) {
                return `<span class=\"fw-bold\">` + data + `</span>`;
            },
        },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Admin - Menampilkan data Klaim dari database ke DataTable

// Admin - Menampilkan data Kerusakan dari database ke DataTable
var tableKerusakan = $("#my-datatable-kerusakan").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],

    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/kerusakan",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        // {data : 'id', name: 'id'},
        { data: "nama", name: "nama" },
        { data: "kondisi", name: "kondisi" },
        { data: "jenis", name: "jenis" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Admin - Menampilkan data Kerusakan dari database ke DataTable

// Admin - Menampilkan data Customer dari database ke DataTable
var tableCustomer = $("#my-datatable-customer").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],

    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4, 5],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },

    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/customer",
    columns: [
        { data: 1, orderable: false, searchable: false },
        { data: "id", name: "id" },
        { data: "nama", name: "nama" },
        { data: "alamat", name: "alamat" },
        { data: "telp", name: "telp" },
        { data: "email", name: "email" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Admin - Menampilkan data Customer dari database ke DataTable

// Admin - Menampilkan data HasilKlaim dari database ke DataTable
var tableHasilKlaim = $("#my-datatable-hasilKlaim").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],

    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/hasil-klaim",
    columns: [
        {
            data: 1,
        },
        {
            data: "id",
            name: "id",
        },
        {
            data: "nama_hasil",
            name: "nama_hasil",
        },
        {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
        },
    ],
});
// Batas - Admin - Menampilkan data HasilKlaim dari database ke DataTable

/* BATAS ADMIN */

/* TEKNISI */

//Teknisi - menampilkan data Klaim Pending dari database ke dataTable
var tableKlaimPending = $("#my-datatable-klaim-pending").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/teknisi",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        {
            data: "created_at",
            className: "text-center",
            render: function (data) {
                return moment(data).format("l");
            },
        },
        { data: "customer_id" },
        { data: "customerNama", name: "customerNama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Teknisi - menampilkan data Klaim Pending dari database ke dataTable

// Teknisi - menampilkan data Klaim Approved dari database ke dataTable
var tableKlaimApproved = $("#my-datatable-klaim-approved").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            },
        },
        {
            extend: "pdf",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },
    order: [[1, "asc"]],
    deferRender: true,
    ajax: "/teknisi-approved",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        {
            data: "created_at",
            className: "text-center",
            render: function (data) {
                return moment(data).format("l");
            },
        },
        { data: "customer_id" },
        { data: "customerNama", name: "customerNama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Teknisi - menampilkan data Klaim Approved dari database ke dataTable

/* BATAS TEKNISI */

/* MANAGER */

// Manager - menampilkan data Klaim To Approve dari database ke dataTable
var tableKlaimToApprove = $("#my-datatable-toApprove").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
        {
            extend: "pdf",
            orientation: "landscape",
            title: "Data Klaim by Manager",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },

    order: [[1, "desc"]],
    deferRender: true,
    ajax: "/manager/to-approve",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        {
            data: "created_at",
            className: "text-center",
            render: function (data) {
                return moment(data).format("l");
            },
        },
        { data: "customerNama", name: "customerNama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        {
            data: "hasil_klaim",
            className: "text-center",
            render: function (data) {
                return `<span class=\"badge bg-warning\">` + data + `</span>`;
            },
        },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Manager - menampilkan data Klaim To Approve dari database ke dataTable

// Manager - menampilkan data Klaim dari database ke dataTable
var tableKlaimManager = $("#my-datatable-listklaim-manager").DataTable({
    columnDefs: [
        {
            targets: 0,
            data: null,
            defaultContent: "",
            orderable: false,
            className: "select-checkbox",
        },
    ],
    buttons: [
        {
            extend: "excel",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
        {
            extend: "pdf",
            orientation: "landscape",
            title: "Data Klaim by Manager",
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            },
        },
    ],
    dom:
        // "<'row'<'col-md-5'B><'col-md-7'f>>" +
        // "<'row'<'col-md-10'><'col-md-2'l>>"+
        "<'row'<'col-md-5'B><'col-md-2'l><'col-md-5'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
    select: {
        style: "multi",
        selector: "td:first-child",
    },

    order: [[1, "desc"]],
    deferRender: true,
    ajax: "/manager/listklaim",
    columns: [
        { data: 1 },
        { data: "id", name: "id" },
        {
            data: "created_at",
            className: "text-center",
            render: function (data) {
                return moment(data).format("l");
            },
        },
        { data: "customerNama", name: "customerNama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        {
            data: "kompensasi",
            name: "kompensasi",
            render: $.fn.dataTable.render.number(",", ".", 0, "Rp"),
        },
        { data: "hasil_pabrik", name: "hasil_pabrik" },
        {
            data: "hasil_klaim",
            className: "text-center",
            render: function (data) {
                return `<span class=\"fw-bold\">` + data + `</span>`;
            },
        },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
// Batas - Manager - menampilkan data Klaim dari database ke dataTable
/* BATAS MANAGER */

/* BAR CHART KLAIM */
async function dataChart() {
    let rawData;
    //mengambil data dari controller
    const res = await fetch("/data-chart");
    rawData = await res.json();
    length = rawData.length;

    thisName = [];

    var keyArr = [];
    var result = [];

    for (var key in rawData[0]) {
        keyArr.push(key);
    }

    let series = [];

    for (var i = 0; i < length; i++) {
        thisName.push(rawData[i].nama);

        var obj = rawData[i];
        var valueArray = [];

        for (var k = 1; k < keyArr.length - 1; k++) {
            valueArray.push(obj[keyArr[k]]);
        }
        result.push(valueArray);

        series.push({
            name: thisName[i],
            data: result[i],
        });
    }

    // data chart
    var option1 = {
        series: series,
        chart: {
            id: "mychart",
            type: "bar",
            height: 350,
            stacked: true,
            toolbar: {
                show: true,
            },
            zoom: {
                enabled: true,
            },
            toolbar: {
                show: true,
                tools: {
                    download: false,
                },
            },
        },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    legend: {
                        position: "bottom",
                        offsetX: -10,
                        offsetY: 0,
                    },
                },
            },
        ],
        plotOptions: {
            bar: {
                horizontal: false,
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: "13px",
                            fontWeight: 900,
                        },
                    },
                },
            },
        },
        xaxis: {
            categories: ["2017", "2018", "2019", "2020", "2021", "2022"],
        },
        yaxis: {
            title: {
                text: "Total Data",
            },
        },
        legend: {
            position: "right",
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Data";
                },
            },
        },
    };

    // inisialisasi chart
    var thisChart = new ApexCharts(
        document.querySelector("#columnChart"),
        option1
    );

    // membuat chart
    thisChart.render();

    //fungsi mengambil value dropdown Gruop by
    $("#filterChart").on("change", 'select[name="filterChart"]', function () {
        value = $(this).find(":selected").val();

        //mengubah tittle chart berdasarkan value
        $("#titleChart").text(
            "Chart Klaim Berdasarkan " +
                value +
                " pada setiap tahun Produksi Produk"
        );

        //mengubah text berdasarkan value
        $("#text").text(" | Berdasarkan " + value);

        //mengambil data yang akan ditampilkan pada chart berdasarkan value
        $.ajax({
            url: "/data-chart",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { value: value },
            type: "POST",
            success: function (response) {
                length = response.length;

                thisName = [];

                var keyArr = [];
                var result = [];

                for (var key in response[0]) {
                    keyArr.push(key);
                }

                let series = [];

                for (var i = 0; i < length; i++) {
                    thisName.push(response[i].nama);

                    var obj = response[i];
                    var valueArray = [];

                    for (var k = 1; k < keyArr.length - 1; k++) {
                        valueArray.push(obj[keyArr[k]]);
                    }
                    result.push(valueArray);

                    series.push({
                        name: thisName[i],
                        data: result[i],
                    });
                }

                //mengupdate data pada chart
                thisChart.updateSeries(series);
            },
            error: function (x) {
                console.log(x.responseText);
            },
        });
    });
}

dataChart();
