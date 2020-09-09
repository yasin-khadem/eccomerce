export default function auth({ next, store }) {
    if (!store.getters['auth/isLoggedIn']) {
        console.log('yessss')
        return next({name: 'auth', params:{url: 'login'}})
    }

    return next();
}