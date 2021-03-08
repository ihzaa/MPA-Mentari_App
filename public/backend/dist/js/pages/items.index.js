$(document).ready(function () {
    $(function () {
        $("#list").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });

    $(document).on("click", ".btn-hapus", function () {
        let id = $(this).data("id");
        let nama = $(this).data("name");
        Swal.fire({
            icon: "question",
            title: "Yakin ingin menghapus item " + nama + "?",
            showCancelButton: true,
            confirmButtonText: `Ya, Hapus!`,
            cancelButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                let tempUrl = URL.delete;
                fetch(tempUrl.replace("wadadidaw", id))
                    .then((resp) => resp.json())
                    .then((data) => {
                        location.reload();
                    })
                    .catch((err) => console.log(err));
            }
        });
    });
});
