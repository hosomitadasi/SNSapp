<script setup lang="ts">
defineProps({
post: {
    type: Object,
    // 仮の初期値（デザイン確認用）
    default: () => ({
    id: 1,
    user: { name: 'テストユーザー' },
    content: 'これが投稿内容です。ここにユーザーが入力したテキストが表示されます。長い文章が入ってもレイアウトが崩れないようにCSSで調整しています。',
    likes_count: 12,
    })
}
})
</script>

<template>
<article class="message-card">
    <div class="message-header">
    <span class="user-name">{{ post.user.name }}</span>

    <div class="actions-group">
        <button class="action-btn like-btn">
        <img src="/img/icon_heart.svg" alt="いいね" class="action-icon" />
        <span class="like-count">{{ post.likes_count }}</span>
        </button>

        <button class="action-btn delete-btn">
        <img src="/img/icon_delete.svg" alt="削除" class="action-icon" />
        </button>

        <NuxtLink :to="`/posts/${post.id}`" class="action-btn comment-link">
        <img src="/img/icon_arrow.svg" alt="コメントへ" class="action-icon" />
        </NuxtLink>
    </div>
    </div>

    <div class="message-body">
    <p class="content-text">{{ post.content }}</p>
    </div>
</article>
</template>

<script setup>
definePageMeta({
    middleware: 'auth'
})
</script>

<style scoped>
</style>