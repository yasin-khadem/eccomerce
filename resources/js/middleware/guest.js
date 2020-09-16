import swal from "../plugin/swal";

export default function guest({ next, store }) {
    if (store.getters['auth/isLoggedIn']) {
        swal.message('شما قبلا وارد شده اید','warning');
        return next({name: 'home'})
    }
    return next();
}