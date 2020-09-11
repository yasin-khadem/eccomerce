export default function auth({ next, store }) {
    console.log('auth')
    if(!store.getters['auth/isLoggedIn']) {
        return next({name: 'auth', params:{url: 'login'}})
    }

    return next();
}