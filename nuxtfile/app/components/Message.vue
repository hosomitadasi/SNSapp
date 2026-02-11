<script setup lang="ts">
interface Props {
    post: {
    id: number;
    user: { name: string };
    content: string;
    likes_count: number;
    }
}

const props = defineProps<Props>()
const emit = defineEmits(['refresh'])
const authUser = useState<any>('authUser')

const deletePost = async () => {
    if (!confirm('本当に削除しますか？')) return

    try {
    await $fetch(`http://localhost/api/index/${props.post.id}`, {
        method: 'DELETE'
    })
    emit('refresh')
    } catch (e) {
    alert('削除に失敗しました')
    }
}

const toggleLike = async () => {
    if (!authUser.value) return alert('ログインが必要です')
    try {
    await $fetch('http://localhost/api/likes', {
        method: 'POST',
        body: {
        user_id: authUser.value.id,
        post_id: props.post.id
        }
    })
    emit('refresh')
    } catch (e) {
    console.error(e)
    }
}
</script>

<template>
<article class="message-card">
    <div class="message-header">
    <span class="user-name">{{ post.user.name }}</span>

    <div class="actions-group">
        <button @click="toggleLike" class="action-btn like-btn">
        <img src="/img/heart.png" alt="いいね" class="action-icon" />
        <span class="like-count">{{ post.likes_count }}</span>
        </button>

        <button @click="deletePost" class="action-btn delete-btn">
        <img src="/img/cross.png" alt="削除" class="action-icon" />
        </button>

        <NuxtLink :to="`/posts/${post.id}`" class="action-btn comment-link">
                <img src="/img/detail.png" alt="コメントへ" class="action-icon" />
        </NuxtLink>
    </div>
    </div>

    <div class="message-body">
        <p class="content-text">{{ post.content }}</p>
    </div>
</article>
</template>

<style scoped>
.message-card {
    border-bottom: 1px solid #38444D;
    padding: 15px 0; color: white;
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.user-name {
    font-weight: bold;
}

.action-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: white;
    display: flex;
    align-items: center;
}

.action-icon {
    width: 20px;
    margin-right: 5px;
}

.content-text {
    font-size: 14px;
    line-height: 1.5;
}
</style>