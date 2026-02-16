export default defineNuxtRouteMiddleware(async (to, from) => {
    if (process.server) return
    const { $auth } = useNuxtApp()
    const authUser = useState<any>('authUser')

    await $auth.authStateReady()
    const user = $auth.currentUser

    if (to.path === '/login' || to.path === '/register') return

    if (user && !authUser.value) {
        let attempts = 0
        while (!authUser.value && attempts < 20) {
            await new Promise(resolve => setTimeout(resolve, 100))
            attempts++
        }
    }

    if (!authUser.value) {
        return navigateTo('/login')
    }
})