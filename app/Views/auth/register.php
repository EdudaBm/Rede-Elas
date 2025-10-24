<?php
// app/Views/auth/register.php - Página de cadastro opcional / upgrade
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<div class="min-h-screen bg-gradient-to-br from-primary-light via-secondary to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <span class="absolute top-20 left-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl animate-pulse-soft"></span>
    <span class="absolute bottom-20 right-10 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse-soft"></span>
    
    <div class="max-w-md w-full space-y-6 relative z-10">
        <div class="text-center animate-fade-in">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <span class="text-white text-3xl">✨</span>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-3">
                Criar conta opcional
            </h2>
            <p class="text-gray-600 text-lg">
                Salve e recupere seus chats anteriores com segurança
            </p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3 animate-slide-up">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['error']) ?></span>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 animate-slide-up">
            <form class="space-y-5" method="POST" action="/register">
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Nome de usuário</label>
                    <input id="username" name="username" type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Escolha um nome" value="<?= htmlspecialchars($_POST['username'] ?? (((isset($_SESSION['is_anonymous']) && $_SESSION['is_anonymous']) && !empty($_SESSION['username'])) ? $_SESSION['username'] : '')) ?>">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Senha</label>
                    <input id="password" name="password" type="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Crie uma senha segura">
                </div>
                <div>
                    <label for="password2" class="block text-sm font-semibold text-gray-700 mb-2">Confirmar senha</label>
                    <input id="password2" name="password2" type="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Repita a senha">
                </div>
                
                <!-- Termo de Consentimento -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <input id="consent" name="consent" type="checkbox" required 
                               class="mt-1 h-4 w-4 text-primary border-gray-300 rounded focus:ring-2 focus:ring-primary cursor-pointer" />
                        <div class="flex-1">
                            <label for="consent" class="text-sm text-gray-700 cursor-pointer">
                                Eu concordo com os 
                                <a href="/termos" target="_blank" class="text-primary hover:text-primary-hover underline font-medium">
                                    Termos de Uso e Política de Privacidade
                                </a>
                                da Rede Elas
                            </label>
                            <div class="mt-2 flex flex-col sm:flex-row gap-2 text-xs text-gray-600">
                                <a href="/public/TERMO%20DE%20USO%20%E2%80%93%20REDE%20ELAS.pdf" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 text-primary hover:text-primary-hover">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Termo de Uso (PDF)
                                </a>
                                <a href="/public/TERMO%20DE%20CONSENTIMENTO%20%E2%80%93%20REDE%20ELAS.pdf" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 text-primary hover:text-primary-hover">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Termo de Consentimento (PDF)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="pt-2 space-y-3">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Criar conta e salvar histórico
                    </button>
                    <a href="/login" class="block w-full text-center border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>


