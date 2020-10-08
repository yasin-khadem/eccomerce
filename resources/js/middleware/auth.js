import swal from "../plugin/swal";

// export default function auth({ next, store }) {
//     return store.dispatch('auth/getUser')
//         .then(() => {
//             let isLoggedIn = store.getters['auth/isLoggedIn'];
//             if (isLoggedIn !== undefined && !isLoggedIn) {
//                 store.dispatch('auth/logout');
//                 swal.message('ابتدا وارد سایت شوید.', 'warning')
//                 return next({ name: 'auth', params: { url: 'login' } });
//             }
//             return next();
//         }).catch(()=>{
//         })
// }
export default function auth({ next, store }) {
    if (!store.getters['auth/isLoggedIn']) {
        swal.message('ابتدا وارد سایت شوید.', 'warning')

        return next({ name: 'auth', params: { url: 'login' } });
    }

    return next();
}
