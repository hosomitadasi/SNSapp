<template>
  <div class="auth-page">
    <AuthHeader></AuthHeader>

    <main class="auth-container">
      <div class="auth-box login-box">
        <h2 class="auth-title">ログイン</h2>
        <Form @submit="onLogin" v-slot="{ errors }" class="form-content">
          <div class="input-group">
            <Field
              name="メールアドレス"
              rules="required|email"
              as="input"
              type="email"
              placeholder="メールアドレス"
              class="text-box">
            </Field>
            <span class="error-msg">{{ errors['メールアドレス'] }}</span>
          </div>

          <div class="input-group">
            <Field
              name="パスワード"
              rules="required|min:6"
              as="input"
              type="password"
              placeholder="パスワード"
              class="text-box">
            </Field>
            <span class="error-msg">{{ errors['パスワード'] }}</span>
          </div>

          <button type="submit" class="primary-btn">ログイン</button>
        </Form>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { signInWithEmailAndPassword } from 'firebase/auth';

const { $auth } = useNuxtApp();
const router = useRouter();

const onLogin = async (values: any) => {
  try {
    const userCredential = await signInWithEmailAndPassword(
      $auth,
      values['メールアドレス'],
      values['パスワード']
    );

    const firebase_uid = userCredential.user.uid;
    const user = await $fetch('http://localhost/api/user', {
      method: 'GET',
      params: { firebase_uid: firebase_uid } // クエリパラメータとして送信
    });

    console.log('Laravel側のユーザー情報:', user);
    alert('ログイン成功！');
    router.push('/');

  } catch (error: any) {
    console.error(error);
    alert('ログインに失敗しました。');
  }
};
</script>

<style scoped>
.auth-page {
  width: 1025px;
  min-height: 570px;
  background-color: #15202B;
  margin: 0 auto;
}

.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 50px;
}

.auth-box {
  background-color: #FFFFFF;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px 0;
}

.login-box {
  width: 420px;
  height: 240px;
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
}

.error-msg {
  color: red;
  font-size: 10px;
  display: block;
}
</style>