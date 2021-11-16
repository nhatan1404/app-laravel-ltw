const notyf = new Notyf({
    position: {
        x: "right",
        y: "top",
    },
    types: [
        {
            type: "info",
            background: "#82ae46",
        },
    ],
    duration: 3000,
});

function addCart(id) {
    const cart_count = $("#cart_count");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "get",
        data: {
            quantity: 1,
        },
        url: `${window.location.origin}/cart/${id}`,
        success: function (response) {
            const { total, isUpdate } = response;
            if (isUpdate) {
                cart_count.html(
                    `<span class="icon-shopping_cart"></span>[${total}]`
                );
            }
            notyf.open({
                type: "info",
                message: "Thêm vào giỏ hàng thành công",
            });
        },
        error: function (error) {
            notyf.open({
                type: "error",
                message: "Có lỗi xảy ra!",
                duration: 3000,
            });
            //console.log(error.responseJSON);
        },
    });
}

(function updateCart() {
    const input = $("input.quantity[name='quantity']");
    input.donetyping(function () {
        const id = input.data("id");
        const quantity = parseInt(input.val());
        if (quantity == 0) return false;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                quantity: quantity,
            },
            type: "put",
            url: `${window.location.origin}/cart/${id}`,
            success: function (response) {
                const total = $(`[data-price="${id}"]`);
                total.text(
                    response.total.toLocaleString("it-IT", {
                        style: "currency",
                        currency: "VND",
                    })
                );
                notyf.open({
                    type: "info",
                    message: "Cập nhật giỏ hàng thành công!",
                });
            },
            error: function (error) {
                notyf.open({
                    type: "error",
                    message: "Có lỗi xảy ra!",
                    duration: 3000,
                });
                //console.log(error.responseJSON);
            },
        });
    }, 1000);
})();

function removeCart(id) {
    const cart_count = $("#cart_count");
    const row = $(`[data-row="${id}"]`);
    if (row.hasClass("disabled")) return;
    row.addClass("fadeOutRightBig disabled");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "delete",
        url: `${window.location.origin}/cart/${id}`,
        success: function (response) {
            let total = parseInt(cart_count.text().replace(/[^0-9]/g, "_"));
            total = total > 1 ? total - 1 : 0;
            row.fadeOut(400, function () {
                row.remove();
            });
            cart_count.html(
                `<span class="icon-shopping_cart"></span>[${total}]`
            );
            notyf.open({
                type: "info",
                message: "Cập nhật giỏ hàng thành công!",
            });
            console.log(response);
        },
        error: function (error) {
            notyf.open({
                type: "error",
                message: "Có lỗi xảy ra!",
                duration: 3000,
            });
            console.log(error.responseJSON);
        },
    });
}
