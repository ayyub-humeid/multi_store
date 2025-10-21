// Start Create Item
function createItem(url, data) {
    axios
        .post(url, data)
        .then(function (response) {
            // handle success
            // console.log(response.data.message);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            // handle error
            toastr.error(error.response.data.message);
        });
}
// End Create Item

// Start Update Item
function updateItem(url, data) {
    axios
        .put(url, data)
        .then(function (response) {
            // handle success
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            // handle error
            toastr.error(error.response.data.message);
        });
}
// End Update Item

// Start Delete Item
function confirmDestroy(url, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItem(url, id);
        }
    });
}

function deleteItem(url, id) {
    axios
        .delete(url + "/" + id)
        .then(function (response) {
            // handle success
            // showMessage(response.data);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            // handle error
            // showMessage(error.response.data);
            toastr.error(response.data.message);
        });
}

function showMessage(data) {
    Swal.fire({
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: 1500,
    });
}
// End Delete Item
