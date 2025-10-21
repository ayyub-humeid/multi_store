(() => {
    var t;
    (t = jQuery)(".item-quantity").on("change", function (a) {
        t.ajax({
            url: "/cart/" + t(this).data("id"),
            method: "put",
            data: {
                quantity: t(this).val(),
                _token: csrf_token,
            },
            success: () => {
                console.log("success");
            },
        });
    }),
        t(".remove-item").on("click", function (a) {
            var c = t(this).data("id");
            t.ajax({
                url: "/cart/" + c,
                method: "delete",
                data: {
                    _token: csrf_token,
                },
                success: function (a) {
                    t("#".concat(c)).remove();
                },
            });
        }),
        t(".add-to-cart").on("click", function (a) {
            let product_id = t(this).data("id");
            let getQuantity = t(this).data("quantity");

            if (!getQuantity) {
                getQuantity = document.getElementById("quantity").value;
                console.log(getQuantity);
            }
            // console.log(quantity);
            createItem("/cart", {
                product_id: product_id,
                quantity: getQuantity,
                _token: csrf_token,
            });
            // t.ajax({
            //     url: "/cart",
            //     method: "post",
            //     data: {
            //         product_id: t(this).data("id"),
            //         quantity: t(this).data("quantity"),
            //         _token: csrf_token,
            //     },
            //     success: function (t) {
            //         alert("product added");
            //     },
            // });
        });
})();
