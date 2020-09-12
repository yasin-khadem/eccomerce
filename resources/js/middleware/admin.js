export default function admin({ next, store }) {
    if (!store.getters['auth/user'].is_admin) {
        return next({ name: 'access-denied' });
    }
    return next();
}
