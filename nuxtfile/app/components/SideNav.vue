<script setup lang="ts">
// ログアウト処理や投稿処理の関数は後でここに書きます
const logout = () => {
    console.log('ログアウト処理を実行')
}
const submitPost = () => {
    console.log('投稿処理を実行')
}
</script>

<template>
<aside class="side-nav">
    <div class="nav-container">
    <img src="/img/icon_share.svg" alt="Share" class="nav-icon" />

    <nav class="nav-menu">
        <NuxtLink to="/" class="nav-link">
        <img src="/img/icon_home.svg" alt="ホーム" class="nav-icon" />
        <span>ホーム</span>
        </NuxtLink>

        <button @click="logout" class="nav-link logout-btn">
        <img src="/img/icon_logout.svg" alt="ログアウト" class="nav-icon" />
        <span>ログアウト</span>
        </button>
    </nav>

    <div class="post-form-area">
        <h2 class="form-title">シェア</h2>

        <form @submit.prevent="submitPost" class="post-form">
        <textarea
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

<script setup>
definePageMeta({
    middleware: 'auth'
})
</script>

<style scoped>
</style>