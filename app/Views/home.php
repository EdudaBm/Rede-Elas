<?php
// app/Views/home.php - Página inicial
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<!-- Hero Section -->
<section class="relative hero-section bg-gradient-to-br from-secondary via-white to-primary-light py-20 px-4 overflow-hidden">
    <span class="absolute top-10 left-10 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse-soft"></span>
    <span class="absolute bottom-10 right-10 w-80 h-80 bg-primary/5 rounded-full blur-3xl animate-pulse-soft"></span>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-6 animate-fade-in tracking-tight">
                Rede Elas
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Uma rede segura e confiável de apoio para mulheres em situação de violência. 
                <span class="text-primary font-bold">Você não está sozinha.</span>
            </p>
            
            <?php if ($user): ?>
                <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md mx-auto mb-12 animate-slide-up border border-gray-100">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <span class="text-white text-3xl">👋</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            Bem-vinda, <?= htmlspecialchars($user['username']) ?>!
                        </h3>
                        <p class="text-gray-600 mb-6">Como podemos te ajudar hoje?</p>
                        
                        <div class="space-y-3">
                            <?php if ($user['role'] === 'admin'): ?>
                                <a href="/admin" class="block w-full bg-gradient-to-r from-primary to-primary-hover text-white px-6 py-3 rounded-lg text-center font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                    Painel Administrativo
                                </a>
                            <?php endif; ?>
                            <a href="/conversa" class="block w-full bg-gradient-to-r from-primary to-primary-hover text-white px-6 py-3 rounded-lg text-center font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                Iniciar Chat de Apoio
                            </a>
                            <a href="/depoimentos" class="block w-full border-2 border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg text-center font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Ver Depoimentos
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12 animate-slide-up">
                    <a href="/login" class="px-10 py-4 text-lg bg-gradient-to-r from-primary to-primary-hover text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Entrar na Rede
                    </a>
                    <a href="/depoimentos" class="px-10 py-4 text-lg border-2 border-gray-300 bg-white hover:bg-gray-50 text-gray-700 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Ver Depoimentos
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Como Funciona Nossa Rede
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Oferecemos múltiplas formas de apoio, sempre priorizando sua segurança e privacidade
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    <span class="text-white text-3xl">💬</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Chat de Apoio</h3>
                <p class="text-gray-600 leading-relaxed">
                    Converse anonimamente com voluntárias treinadas e especializadas em apoio emocional. 
                    Disponível 24/7 com total privacidade.
                </p>
            </div>
            
            <div class="text-center bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    <span class="text-white text-3xl">📝</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Depoimentos</h3>
                <p class="text-gray-600 leading-relaxed">
                    Compartilhe sua história de forma anônima e inspire outras mulheres. 
                    Leia experiências de superação e encontre força na comunidade.
                </p>
            </div>
            
            <div class="text-center bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-20 h-20 bg-gradient-to-br from-gray-500 to-gray-700 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                    <span class="text-white text-3xl">🤝</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Rede de Apoio</h3>
                <p class="text-gray-600 leading-relaxed">
                    Conecte-se com outras mulheres que passaram por situações similares. 
                    Uma comunidade unida pela força e pela esperança.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Trust Indicators -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Sua Segurança é Nossa Prioridade
            </h2>
            <p class="text-xl text-gray-600">
                Implementamos as melhores práticas de segurança e privacidade
            </p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-green-600 text-2xl">🔒</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Conexão Segura</h3>
                <p class="text-sm text-gray-600">SSL/TLS para proteger seus dados</p>
            </div>
            
            <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-primary text-2xl">👤</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Anonimato</h3>
                <p class="text-sm text-gray-600">Nunca compartilhamos sua identidade</p>
            </div>
            
            <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-purple-600 text-2xl">🤝</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Profissionais</h3>
                <p class="text-sm text-gray-600">Voluntárias treinadas e especializadas</p>
            </div>
            
            <div class="text-center bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-yellow-600 text-2xl">⏰</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">24/7</h3>
                <p class="text-sm text-gray-600">Apoio disponível a qualquer hora</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-gradient-to-br from-primary to-primary-hover relative overflow-hidden">
    <span class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></span>
    <span class="absolute -bottom-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></span>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Precisa de Apoio Agora?
        </h2>
        <p class="text-xl text-primary-light mb-10 leading-relaxed">
            Nossa equipe está pronta para te ouvir e apoiar. 
            Não hesite em buscar ajuda - você merece ser feliz e segura.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/conversa" class="bg-white hover:bg-gray-100 text-primary font-bold px-10 py-4 rounded-lg transition-all duration-200 text-lg shadow-lg hover:shadow-xl">
                Iniciar Chat de Apoio
            </a>
            <a href="/depoimentos" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary font-bold px-10 py-4 rounded-lg transition-all duration-200 text-lg shadow-lg hover:shadow-xl">
                Ver Histórias de Superação
            </a>
        </div>
    </div>
</section>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>