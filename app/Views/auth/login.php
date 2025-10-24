<?php
// app/Views/auth/login.php - Página de login
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<div class="min-h-screen bg-gradient-to-br from-primary-light via-secondary to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <span class="absolute top-20 left-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl animate-pulse-soft"></span>
    <span class="absolute bottom-20 right-10 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse-soft"></span>
    
    <div class="max-w-md w-full space-y-6 relative z-10">
        <div class="text-center animate-fade-in">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <span class="text-white text-3xl">🔐</span>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-3">
                Entrar na Rede Elas
            </h2>
            <p class="text-gray-600 text-lg">
                Acesse sua conta, entre como anônima ou crie uma conta opcional
            </p>
        </div>

        <!-- Alertas -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3 animate-slide-up">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['error']) ?></span>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3 animate-slide-up">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['success']) ?></span>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de Login -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 animate-slide-up">
            <form class="space-y-5" method="POST" action="/login">
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nome de usuário
                    </label>
                    <input 
                        id="username" 
                        name="username" 
                        type="text" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                        placeholder="Digite seu nome de usuário"
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Senha
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                        placeholder="Digite sua senha"
                    >
                </div>

                <div class="pt-2 space-y-3">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Entrar
                    </button>
                    <a href="/register" class="block w-full text-center border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Criar conta (opcional)
                    </a>
                </div>
            </form>
        </div>

        <!-- Login Anônimo -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 animate-slide-up">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Precisa de Apoio Imediato?
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Entre como anônima para acessar o chat de apoio sem criar uma conta
                </p>
                <form method="POST" action="/login/anonymous">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Entrar como Anônima
                    </button>
                </form>
            </div>
        </div>

        <!-- Informações de Segurança -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 animate-slide-up">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h4 class="text-sm font-bold text-blue-900 mb-2">
                        Sua Privacidade é Importante
                    </h4>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Todas as conversas são anônimas e seguras. Nunca compartilhamos suas informações pessoais.
                    </p>
                </div>
            </div>
        </div>

        <!-- Números de Emergência -->
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 animate-slide-up">
            <div class="flex gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-red-900 mb-2">
                        Emergência?
                    </h4>
                    <p class="text-sm text-red-700 mb-3 leading-relaxed">
                        Se você está em perigo imediato, ligue:
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="bg-red-100 text-red-900 font-bold px-3 py-1 rounded-md">190</span>
                            <span class="text-red-700">Polícia Militar</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="bg-red-100 text-red-900 font-bold px-3 py-1 rounded-md">180</span>
                            <span class="text-red-700">Central da Mulher</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>