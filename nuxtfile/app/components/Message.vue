<script setup lang="ts">
interface Props {
    post: {
    id: number;
    user_id: number;
    user: { name: string };
    content: string;
    likes_count: number;
    is_liked: boolean;
    }
}

const props = defineProps<Props>()
const emit = defineEmits(['refresh'])
const authUser = useState<any>('authUser')

const deletePost = async () => {
    if (!confirm('本当に削除しますか？')) return

    try {
    await $fetch(`http://localhost/api/index/${props.post.id}`, {
        method: 'DELETE',
        params: { user_id: Number(authUser.value.id) }
    })
    emit('refresh')
    } catch (e) {
    alert('削除に失敗しました')
    }
}

const toggleLike = async () => {
    if (!authUser.value || props.post.user_id === authUser.value.id) return
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
    <div class="message-content">
      <div class="message-header">
        <div class="user-info">
          <span class="user-name">{{ post.user.name }}</span>

          <div class="actions-group">
            <button @click="toggleLike" class="action-btn">
              <img src="/img/heart.png" alt="いいね" class="action-icon" />
              <span class="count">{{ post.likes_count }}</span>
            </button>

            <button @click="deletePost" class="action-btn">
              <img src="/img/cross.png" alt="削除" class="action-icon" />
            </button>

            <NuxtLink :to="`/posts/${post.id}`" class="action-btn">
              <img src="/img/detail.png" alt="詳細" class="action-icon detail-arrow" />
            </NuxtLink>
          </div>
        </div>
      </div>

      <div class="message-body">
        <p class="content-text">{{ post.content }}</p>
      </div>
    </div>
  </article>
</template>

<style scoped>
.message-card {
  border-bottom: 1px solid #38444D;
  padding: 15px 20px;
  color: white;
}
.user-info {
  display: flex;
  align-items: center;
  gap: 15px; /* 名前とアイコンの間隔 */
  margin-bottom: 10px;
}
.user-name {
  font-weight: bold;
  font-size: 18px;
}
.actions-group {
  display: flex;
  align-items: center;
  gap: 15px;
}
.action-btn {
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  display: flex;
  align-items: center;
  color: white;
}
.action-icon {
  width: 22px;
}
.detail-arrow {
  width: 25px; /* 右矢印を少し強調 */
}
.count {
  margin-left: 5px;
  font-size: 16px;
}
.content-text {
  font-size: 15px;
  line-height: 1.6;
}
</style>