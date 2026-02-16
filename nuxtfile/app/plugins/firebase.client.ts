import { initializeApp } from 'firebase/app'
import { getAuth, onAuthStateChanged } from 'firebase/auth'

export default defineNuxtPlugin((nuxtApp) => {
    const config = useRuntimeConfig()

    const firebaseConfig = {
    apiKey: config.public.firebaseApiKey,
    authDomain: config.public.firebaseAuthDomain,
    projectId: config.public.firebaseProjectId,
    storageBucket: config.public.firebaseStorageBucket,
    messagingSenderId: config.public.firebaseMessagingSenderId,
    appId: config.public.firebaseAppId,
    }

    const app = initializeApp(firebaseConfig)
    const auth = getAuth(app)
    const authUser = useState<any>('authUser')

    onAuthStateChanged(auth, async (user) => {
        if (user) {
            // Firebaseにはログインしているが、Nuxtの状態が空の場合
            if (!authUser.value) {
                try {
                    // FirebaseのUIDを使って、Laravelからユーザー情報を取得（IDを復元）
                    const data: any = await $fetch('http://localhost/api/user', {
                        params: { email: user.email }
                    })
                    authUser.value = data // Laravel側のIDを含むユーザー情報をセット
                } catch (e) {
                    console.error('ユーザー情報の復元に失敗しました')
                    authUser.value = null
                }
            }
        } else {
            authUser.value = null
        }
    })

    return {
        provide: {
            auth
        }
    }
})