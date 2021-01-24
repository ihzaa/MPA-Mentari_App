$(document).ready(function () {
    $("#lists").DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: true,
        responsive: true,
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
                        console.log(data);
                    })
                    .catch((err) => console.log(err));
            }
        });
    });
});
