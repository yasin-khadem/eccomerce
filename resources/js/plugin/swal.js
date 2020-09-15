import Swal from 'sweetalert2'

class sweetalert {
    message(title = 'با موفقیت انجام شد', type = 'success') {
        Swal.fire({
            position: 'center',
            icon: type,
            title,
            showConfirmButton: false,
            timer: 1500
        })
    }
    error(title = 'به مشکل خوردیم', type = 'error') {
        this.message(title, type)
    }
    confirm(title = 'آیا مطمئن هستید؟',type = "warning",text = "قادر به بازیابی نیستید!") {
        return Swal.fire({
            title,
            text,
            icon: type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'تایید',
            cancelButtonText: 'لغو'
        })
    }
}

const swal = new sweetalert();

export default swal;