moment.locale("id");
// //menampilkan data produk dari database ke dataTable
var table = $(".my-datatable-produk").DataTable({
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

//Admin - Distributor
var table = $(".my-datatable-distributor").DataTable({
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

//Teknisi - menampilkan data produk dari database ke dataTable
moment.locale("id");
var table = $("#klaimTable-pending").DataTable({
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
        { data: "customer_nama", name: "customer_nama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});

//teknisi approved list data klaim
var table = $("#klaimTable-approved").DataTable({
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
        { data: "customer_nama", name: "customer_nama" },
        { data: "product_nama", name: "product_nama" },
        { data: "damage_id", name: "damage_id" },
        { data: "no_seri", name: "no_seri" },
        { data: "tahun_produksi", name: "tahun_produksi" },
        { data: "sisa_td", name: "sisa_td" },
        { data: "action", name: "action", orderable: false, searchable: false },
    ],
});
//Manager - menampilkan data produk dari database ke dataTable

var table = $(".my-datatable-toApprove").DataTable({
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
        { data: "customer_nama", name: "customer_nama" },
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
var table = $(".my-datatable-listklaim-manager").DataTable({
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
        { data: "customer_nama", name: "customer_nama" },
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
//menampilkan data produk dari database ke dataTable
var table = $(".my-datatable-listklaim").DataTable({
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

//show data kerusakan from db
var table = $(".my-datatable-kerusakan").DataTable({
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

//show datatable halaman pelanggan from db
var table = $(".my-datatable-pelanggan").DataTable({
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

//show data from db
var table = $("#hasilKlaimTable").DataTable({
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

/* BAR CHART KLAIM */
async function dataChart() {
    let rawData;
    const res = await fetch("/chart-produk");
    rawData = await res.json();
    // console.log(data)
    length = rawData.length;
    // console.log(length)

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
    // console.log(result);

    new ApexCharts(document.querySelector("#columnChart"), {
        series: series,
        // [
        // {
        //     name: thisName,
        //     data: result,
        // },
        // {
        //     name: "Kesalahan Pabrik",
        //     data: [4, 1, 7, 9, 1, 2],
        // },
        // {
        //     name: "Kesalahan siapa",
        //     data: [3, 4, 1, 0, 0, 0],
        // },
        // ],
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
    }).render();
}
dataChart();

//update Series
// if ($('#IsJobRunning').val() === 'true') {
//     window.setInterval(function () {
//       chart.updateOptions({
//         xaxis: {
//           categories: stackObject.vmNames
//         },
//         series: [{
//           name: 'Inbound',
//           data: stackObject.inboundValues
//         }, {
//           name: 'Outbound',
//           data: stackObject.outboundValues
//         }],
//       })
//     }, 5000)
//   }
