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
    try {
    await $fetch('http://localhost/api/index', {
        method: 'POST',
        body: {
        user_id: authUser.value.id, // Laravel側のID
        content: content.value
        }
    })
    content.value = '' // 入力欄を空にする
    emit('post-success') // 親（index.vue）に通知して一覧を更新
    } catch (e) {
    alert('投稿に失敗しました')
    }
}
</script>

<template>
<aside class="side-nav">
    <div class="nav-container">
    <img src="/img/logo.png" alt="Share" class="nav-icon" />

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
        <h2 class="form-title">シェア</h2>

        <form @submit.prevent="submitPost" class="post-form">
        <textarea
            v-model="content"
            class="post-textarea"
            placeholder="投稿内容を入力"
            rows="5"
        ></textarea>
        <button type="submit" class="share-btn">シェアする</button>
        </form>
    </div>
    </div>
</aside>
</template>

<style scoped>
.logo {
    width: 100px;
    margin-bottom: 20px;
}

.nav-link {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    margin-bottom: 15px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.nav-icon {
    width: 25px;
    margin-right: 10px;
}

.post-textarea {
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    background: transparent;
    border: 1px solid white;
    color: white;
}

.share-btn {
    background-color: #5419DA;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    margin-top: 10px;
    cursor: pointer;
    float: right;
}
</style>