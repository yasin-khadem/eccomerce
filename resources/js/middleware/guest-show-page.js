import swal from "../plugin/swal";

export default function guest({ next, store }) {
    if (store.getters['auth/isLoggedIn']) {
        swal.message('عضو هستید','warning','3500','آدرس قبل برای مهمان هاست');
        return next({ name: 'home'});
    }
    return next();
}
