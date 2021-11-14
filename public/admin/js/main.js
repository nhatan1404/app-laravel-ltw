$(document).ready(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.btnDelete').click(function(e) {
      const form = $(this).closest('form');
      const dataID = $(this).data('id');
      e.preventDefault();
      Swal.fire({
              title: "Bạn có muốn xoá?",
              text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Xác nhận',
              cancelButtonText: "Huỷ",
          })
          .then((result) => {
              if (result.isConfirmed) {
                  form.submit();
              }
          });
  })
})