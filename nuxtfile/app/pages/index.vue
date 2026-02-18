<script setup>
definePageMeta({
    middleware: 'auth'
})

const authUser = useState('authUser')
const { data: posts, refresh: refreshPosts } = await useFetch('http://localhost/api/index', {
    params: { user_id: computed(() => authUser.value?.id) }, // computedでラップすると安全です
    watch: [authUser] // authUserが変わったら再取得するようにする
})

</script>

<template>
    <div class="home-layout">
    <div class="left-content">
        <SideNav @post-success="refreshPosts" />
    </div>

    <main class="right-content">
        <div class="page-header">
        <h2 class="header-title">ホーム</h2>
        </div>
        <div v-if="posts && posts.length > 0">
        <Message
            v-for="post in posts"
            :key="post.id"
            :post="post"
            @refresh="refreshPosts"
        />
        </div>
        <div v-else class="no-posts">
        投稿がありません。
        </div>
    </main>
    </div>
</template>

<style scoped>
.home-layout {
    display: flex;
    align-items: flex-start;
    width: 100%;
    margin: 0 auto;
    background-color: #15202B;
    min-height: 100vh;
}
.left-content {
    width: 300px;
    height: 100vh;
    position: sticky;
    top: 0;
}
.right-content {
    flex: 1;
    border-left: 1px solid #EEEEEE;
}

.page-header {
    border-bottom: 1px solid #EEEEEE;
    padding: 15px 20px;
}
.header-title {
    font-size: 20px;
    font-weight: bold;
    color: white;
}

.no-posts {
    color: white;
    text-align: center;
    margin-top: 50px;
}
</style>