<template>
    <div class="auth-page">
    <AuthHeader />
    <main class="auth-container">
        <div class="auth-box">
        <h2 class="auth-title">新規登録</h2>
        <VForm @submit="onRegister" v-slot="{ errors }">
            <div class="input-group">

            <VField name="ユーザーネーム" rules="required|max:20" as="input" placeholder="ユーザーネーム" />
            <span class="error">{{ errors['ユーザーネーム'] }}</span>
            </div>

            <div class="input-group">
            <VField name="メールアドレス" rules="required|email" as="input" type="email" placeholder="メールアドレス" />
            <span class="error">{{ errors['メールアドレス'] }}</span>
            </div>

            <div class="input-group">
            <VField name="パスワード" rules="required|min:6" as="input" type="password" placeholder="パスワード" />
            <span class="error">{{ errors['パスワード'] }}</span>
            </div>

            <button type="submit" class="primary-btn">新規登録</button>
        </VForm>
        </div>
    </main>
    </div>
</template>