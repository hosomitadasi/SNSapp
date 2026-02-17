<script setup lang="ts">
definePageMeta({
    middleware: 'auth'
})

const route = useRoute()
const postId = route.params.id
const authUser = useState<any>('authUser')
const commentContent = ref('')

const { data: post, refresh: refreshPost } = await useFetch(`http://localhost/api/comments/${postId}`)

const submitComment = async () => {
    if (!commentContent.value) return alert('コメントを入力してください')
    if (!authUser.value) return alert('ログインが必要です')

    try {
        await $fetch('http://localhost/api/comments', {
            method: 'POST',
            body: {
                user_id: authUser.value.id,
                post_id: postId,
                content: commentContent.value
            }
        })
        commentContent.value = '' // 入力欄をクリア
        refreshPost() // 一覧を再取得して反映
    } catch (e) {
        alert('コメントの投稿に失敗しました')
    }
}
</script>

<template>
  <div class="home-layout">
    <div class="left-content">
      <SideNav @post-success="refreshPost" />
    </div>

    <main class="right-content">
      <div class="page-header">
        <h2 class="header-title">コメント</h2>
      </div>

      <div v-if="post" class="post-detail-container">
        <Message :post="post" @refresh="refreshPost" />

        <div class="comment-section">
          <div class="comment-label">コメント</div>
          
          <div class="comments-list">
            <div v-for="comment in post.comments" :key="comment.id" class="comment-item">
              <div class="comment-user">{{ comment.user.name }}</div>
              <div class="comment-text">{{ comment.content }}</div>
            </div>
          </div>

          <form @submit.prevent="submitComment" class="comment-form">
            <input
              v-model="commentContent"
              class="comment-input"
              type="text"
            />
            <div class="btn-wrapper">
              <button type="submit" class="comment-btn">コメント</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.home-layout {
  display: flex;
  width: 1025px;
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
}

.page-header {
  border-bottom: 1px solid #38444D;
  padding: 15px 20px;
}
.header-title {
  font-size: 20px;
  font-weight: bold;
  color: white;
}
.comment-section {
  border-bottom: 1px solid #38444D;
}
.comment-label {
  text-align: center;
  color: white;
  padding: 10px;
  border-bottom: 1px solid #38444D;
  font-size: 14px;
}
.comment-item {
  padding: 15px 20px;
  border-bottom: 1px solid #38444D;
}
.comment-user {
  font-weight: bold;
  margin-bottom: 5px;
  color: white;
}
.comment-text {
  font-size: 14px;
  color: white;
}
.comment-form {
  padding: 20px;
}
.comment-input {
  width: 100%;
  background: transparent;
  border: 1px solid white;
  border-radius: 10px;
  padding: 10px;
  color: white;
  margin-bottom: 15px;
  box-sizing: border-box;
}
.comment-btn {
  background-color: #5419DA;
  color: white;
  border: none;
  border-radius: 20px;
  padding: 8px 25px;
  cursor: pointer;
  font-weight: bold;
  border-top: 2px solid #A4A4A4;
  border-left: 2px solid #A4A4A4;
  border-bottom: 2px solid #000000;
  transform: translateY(1px);
}
</style>