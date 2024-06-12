/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/dashboard/spps/script.js ***!
  \***********************************************/
function deleteForm(id) {
  Swal.fire({
    title: "Hapus data",
    text: "Anda akan menghapus data!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Batal!"
  }).then(function (result) {
    if (result.isConfirmed) {
      $("#delete-form-".concat(id)).submit();
    }
  });
}

function paySpp(id, month) {
  $("#modal-form-payment").modal("show");
  $('#modal-form-payment input[name="siswa_id"]').val(id); // simpan month dengan huruf kapital di awal untuk ditampilkan di modal

  var monthCapitalized = month.charAt(0).toUpperCase() + month.slice(1);
  $('#modal-form-payment input[name="bulan_dibayar"]').val(monthCapitalized);
  $('#modal-form-payment button[type="submit"]').click(function (e) {
    e.preventDefault();
    var nominal = $('#modal-form-payment input[name="nominal"]').val();
    var jumlah_bayar = $('#modal-form-payment input[name="jumlah_bayar"]').val();

    if (nominal !== jumlah_bayar) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Jumlah bayar tidak sesuaiss!"
      });
    }

    $('#form-payment').submit();
  });
  $("#modal-form-payment").on("hidden.bs.modal", function (e) {
    $('#modal-form-payment input[name="siswa_id"]').val("");
    $('#modal-form-payment input[name="bulan_dibayar"]').val("");
    $('#modal-form-payment input[name="jumlah_bayar"]').val("");
  });
}

$(document).ready(function () {
  $("#table-spp").DataTable({
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Cari Data",
      lengthMenu: "Menampilkan _MENU_ data",
      zeroRecords: "Data tidak ditemukan",
      infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
      infoFiltered: "(disaring dari _MAX_ data)",
      paginate: {
        previous: '<i class="fa fa-angle-left"></i>',
        next: "<i class='fa fa-angle-right'></i>"
      }
    },
    dom: "Bfrtip",
    buttons: [{
      extend: "pdfHtml5",
      title: "Data SPP Tahun " + new Date().getFullYear(),
      text: '<i class="fas fa-file-pdf"></i> PDF',
      className: "btn btn-sm btn-danger",
      // set alignment option
      customize: function customize(doc) {
        // jika value dari kolom bulan adalah bayar maka ganti dengan kata belum bayar dan dirender dengan warna merah
        doc.content[1].table.body.forEach(function (row, index) {
          row.forEach(function (cell, index) {
            cell.text = cell.text === "Bayar" ? "Belum Lunas" : cell.text;
          });
        }); // set warna text untuk data belum bayar

        doc.content[1].table.body.forEach(function (row, index) {
          row.forEach(function (cell, index) {
            if (cell.text === "Belum Lunas") {
              cell.color = "#e74a3b";
            }
          });
        }); // atur ukuran kertas menjadi a4

        doc.pageOrientation = "landscape";
        doc.pageSize = "A4";
      }
    }]
  });
  $(".btn-pay-spp").click(function () {
    var id = $(this).data("id");
    var month = $(this).data("month");
    paySpp(id, month);
  });
});
/******/ })()
;