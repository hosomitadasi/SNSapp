export default defineNuxtRouteMiddleware((to, from) => {
    const { $auth } = useNuxtApp()
    const user = $auth.currentUser

    if (!user && to.path !== '/login' && to.path !== '/register') {
    return navigateTo('/login')
    }
})