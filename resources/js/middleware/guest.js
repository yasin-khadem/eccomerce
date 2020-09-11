export default function guest({ next, store }) {
    if (store.getters['auth/isLoggedIn']) {
        console.log('guest');
        return next({name: 'home'})
    }
    return next();
}