<template>
    <header class="auth-header">
    <div class="logo">
        <img src="/img/logo.png" alt="Share" />
    </div>
    <nav class="nav-links">
        <NuxtLink to="/register" class="link-item">新規登録</NuxtLink>
        <NuxtLink to="/login" class="link-item">ログイン</NuxtLink>
    </nav>
    </header>
</template>

<style scoped>
.auth-header {
    width: 100%;
    height: 150px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    background-color: #15202B;
}

.logo {
    margin-left: 24px;
    margin-top: 20px;
}

.logo img {
    width: 140px;
    height: 36px;
}

.nav-links {
    margin-right: 40px;
    margin-top: 30px;
    display: flex;
    gap: 20px;
}

.link-item {
    color: #FFFFFF;
    font-size: 16px;
    text-decoration: none;
    font-weight: bold;
}

</style>