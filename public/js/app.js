/**
 * Created by Morgan Lane on 24/08/2017.
 */
function notify(message, type) {
    switch (type) {
        case 1:
            toastr.success(message, 'Success', {timeOut: 5000})
            break;
        case 2:
            toastr.info(message, 'Info', {timeOut: 5000})
            break;
        case 3:
            toastr.error(message, 'Error', {timeOut: 5000})
            break;
    }
}

// Toastr options
toastr.options.progressBar = true;