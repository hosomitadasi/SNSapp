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
    width: 100%;
    margin: 0 auto;
    background-color: #15202B;
    min-height: 100vh;
}
.left-content {
    width: 300px;
}
.right-content {
    flex: 1;
    border-left: 1px solid #38444D;
    padding: 20px;
}
.no-posts {
    color: white;
    text-align: center;
    margin-top: 50px;
}
</style>