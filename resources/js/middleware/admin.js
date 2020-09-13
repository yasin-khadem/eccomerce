export default function admin({ next, store }) {
    return store.dispatch('auth/getUser')
        .then(() => {
            let isAdmin = store.getters['auth/user'].is_admin;
            if (isAdmin !== undefined && !isAdmin) {
                return next({ name: 'access-denied' })
            }
            return next();
        }).catch(() => {
            return next({ name: 'access-denied' })
        })

}

