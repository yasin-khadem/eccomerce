export default function admin({ next, store}){
    console.log('admin middleware');
    
    if (store.getters['auth/user'].is_admin){
        console.log('admin hast');
        return next();
    }
    return next({ name: 'access-denied'});
}
