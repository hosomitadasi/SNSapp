<script setup lang="ts">
import { signOut } from 'firebase/auth'
const { $auth } = useNuxtApp()
const router = useRouter()
const authUser = useState<any>('authUser')
const content = ref('')
const emit = defineEmits(['post-success'])

const logout = async () => {
    try {
        await signOut($auth)
        authUser.value = null
        router.push('/login')
    } catch (e) {
    alert('ログアウトに失敗しました')
    }
}

const submitPost = async () => {
    if (!content.value) return alert('内容を入力してください')
    if (!authUser.value || !authUser.value.id) {
        return alert('ユーザー情報の取得に失敗しました。再ログインしてください。')
    }

    try {
    await $fetch('http://localhost/api/index', {
        method: 'POST',
        body: {
        user_id: authUser.value.id, // Laravel側のID
        content: content.value
        }
    })
    content.value = ''
    emit('post-success')
    } catch (e) {
    alert('投稿に失敗しました')
    }
}
</script>

<template>
    <aside class="side-nav">
    <div class="nav-container">
        <img src="/img/logo.png" alt="Share" class="logo" />

        <nav class="nav-menu">
        <NuxtLink to="/" class="nav-link">
            <img src="/img/home.png" alt="ホーム" class="nav-icon" />
            <span>ホーム</span>
        </NuxtLink>

        <button @click="logout" class="nav-link logout-btn">
            <img src="/img/logout.png" alt="ログアウト" class="nav-icon" />
            <span>ログアウト</span>
        </button>
        </nav>

        <div class="post-form-area">
        <p class="share-label">シェア</p>
        <form @submit.prevent="submitPost" class="post-form">
            <textarea
            v-model="content"
            class="post-textarea"
            rows="5"
            ></textarea>
            <div class="btn-wrapper">
            <button type="submit" class="share-btn">シェアする</button>
            </div>
        </form>
        </div>
    </div>
    </aside>
</template>

<style scoped>
.side-nav {
    padding: 20px;
}
.logo {
    width: 120px;
    margin-bottom: 20px;
}
.nav-link {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    margin-bottom: 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
    padding: 0;
}
.nav-icon {
    width: 25px;
    margin-right: 15px;
}
.share-label {
    color: white;
    margin-bottom: 10px;
    font-size: 16px;
}
.post-textarea {
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    background: transparent;
    border: 1px solid white;
    color: white;
    resize: none;
    box-sizing: border-box;
}
.btn-wrapper {
    display: flex;
    justify-content: flex-end;
}
.share-btn {
    background-color: #5419DA;
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 25px;
    margin-top: 15px;
    cursor: pointer;
    font-weight: bold;
    transition: opacity 0.2s;
}
.share-btn:hover {
    opacity: 0.8;
}
</style>