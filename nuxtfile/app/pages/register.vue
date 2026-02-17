<script setup>
import { createUserWithEmailAndPassword } from 'firebase/auth';

const { $auth } = useNuxtApp();
const router = useRouter();
const authUser = useState('authUser');

definePageMeta({
  middleware: undefined
})

const onRegister = async (values) => {
  try {
    const userCredential = await createUserWithEmailAndPassword(
      $auth,
      values['メールアドレス'],
      values['パスワード']
    );

    const userData = await $fetch('http://localhost/api/register', {
      method: 'POST',
      body: {
        firebase_uid: userCredential.user.uid,
        name: values['ユーザー名'],
        email: values['メールアドレス'],
      }
    });

    authUser.value = userData;
    alert('会員登録が完了しました！');
    router.push('/');

  } catch (error) {
    console.error(error);
    alert('登録に失敗しました。既に使われているメールアドレスかもしれません。');
  }
};
</script>

<template>
  <div class="auth-page">
    <AuthHeader />
    <main class="auth-container">
      <div class="auth-box register-box">
        <h2 class="auth-title">新規会員登録</h2>
        <Form @submit="onRegister" v-slot="{ errors }" class="form-content">
          <div class="input-group">
            <Field name="ユーザー名" rules="required" as="input" placeholder="ユーザー名" class="text-box" />
            <span class="error-msg">{{ errors['ユーザー名'] }}</span>
          </div>

          <div class="input-group">
            <Field name="メールアドレス" rules="required|email" as="input" type="email" placeholder="メールアドレス" class="text-box" />
            <span class="error-msg">{{ errors['メールアドレス'] }}</span>
          </div>

          <div class="input-group">
            <Field name="パスワード" rules="required|min:6" as="input" type="password" placeholder="パスワード" class="text-box" />
            <span class="error-msg">{{ errors['パスワード'] }}</span>
          </div>

          <button type="submit" class="primary-btn">登録する</button>
        </Form>
      </div>
    </main>
  </div>
</template>

<style scoped>
.auth-page {
  width: 100%;
  min-height: 100vh;
  background-color: #15202B;
  margin: 0 auto;
}

.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 50px;
}

/* テキストボックス (Register用サイズ) */
.auth-box {
  background-color: #FFFFFF;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px 0;
}

.register-box {
  width: 420px;
  height: 300px;
}

.auth-title {
  font-size: 16px;
  color: #0E0E0E;
  margin-bottom: 15px;
  font-weight: bold;
}

.form-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

.input-group {
  margin-bottom: 12px;
  width: 320px;
}

.text-box {
  width: 320px;
  height: 45px;
  border: 1px solid #5F5F5F;
  border-radius: 10px;
  padding: 0 15px;
  font-size: 12px;
  color: #000;
  box-sizing: border-box;
}

.text-box::placeholder {
  color: #A4A4A4;
}

.primary-btn {
  width: 106px;
  height: 43px;
  background-color: #5419DA;
  color: #FFFFFF;
  border: none;
  border-radius: 25px;
  font-size: 15px;
  cursor: pointer;
  margin-top: 10px;
  border-top: 2px solid #A4A4A4;
  border-left: 2px solid #A4A4A4;
  border-bottom: 2px solid #000000;
  transform: translateY(1px);
}

.error-msg {
  color: red;
  font-size: 10px;
  display: block;
}
</style>