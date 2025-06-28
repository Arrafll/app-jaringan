function logoutConfirm(ele) {

    new swal({
         title: "Keluar dari aplikasi ?",
    text: "Anda akan keluar dari aplikasi",
    type: "warning",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Keluar',
    cancelButtonText: "Batal",
    closeOnConfirm: false,
    closeOnCancel: true,
          reverseButtons: true
    }).then(function(isConfirm) {
          $(ele).removeClass('menu-open');
      if (isConfirm.value) {
        window.location.href = "./config/logout.php"
      }
      
    });
}
