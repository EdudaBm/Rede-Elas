<?php
$title = 'Sobre - Rede Elas';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<main class="py-12 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-20">
            <div class="w-24 h-24 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                <span class="text-white text-4xl">💜</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 tracking-tight">
                Sobre a Rede Elas
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Uma plataforma dedicada a apoiar mulheres em situação de violência, 
                oferecendo suporte emocional, informação e uma rede de apoio segura.
            </p>
        </div>

        <!-- Missão -->
        <section class="mb-20">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-primary-hover p-8 text-white">
                    <h2 class="text-3xl font-bold mb-2">Nossa Missão</h2>
                    <p class="text-white/90">O que nos move todos os dias</p>
                </div>
                <div class="p-12">
                    <p class="text-xl text-gray-700 leading-relaxed mb-6">
                        A Rede Elas nasceu com o propósito de criar um espaço seguro e acolhedor 
                        para mulheres que enfrentam situações de violência doméstica, psicológica ou qualquer 
                        forma de abuso.
                    </p>
                    <p class="text-xl text-gray-700 leading-relaxed">
                        Acreditamos que nenhuma mulher deve enfrentar essas situações sozinha. 
                        Por isso, oferecemos uma rede de apoio composta por voluntárias treinadas, 
                        recursos informativos e uma comunidade solidária.
                    </p>
                </div>
            </div>
        </section>

        <!-- Valores -->
        <section class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Nossos Valores</h2>
                <p class="text-xl text-gray-600">Os princípios que guiam nosso trabalho</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        <span class="text-white text-2xl">🔒</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Privacidade</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Garantimos total anonimato e segurança em todas as interações
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        <span class="text-white text-2xl">🤝</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Empatia</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Acolhemos cada história com respeito e compreensão
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        <span class="text-white text-2xl">💪</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Empoderamento</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Fortalecemos mulheres para que retomem o controle de suas vidas
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-xl flex items-center justify-center mx-auto mb-6 shadow-md">
                        <span class="text-white text-2xl">🌟</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Esperança</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Acreditamos na possibilidade de recomeço e superação
                    </p>
                </div>
            </div>
        </section>

        <!-- Como Funciona -->
        <section class="mb-20">
            <div class="bg-gradient-to-br from-primary-light to-secondary rounded-2xl shadow-xl border border-gray-200 p-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Como Funciona</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                            <span class="text-primary text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Acesse a Plataforma</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Entre de forma anônima ou crie uma conta segura para acessar todos os recursos
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                            <span class="text-primary text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Busque Apoio</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Converse com voluntárias treinadas, leia depoimentos ou acesse informações úteis
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                            <span class="text-primary text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Encontre Força</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Conecte-se com outras mulheres e descubra que você não está sozinha
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-gradient-to-br from-primary to-primary-hover rounded-2xl shadow-xl p-12 text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Faça Parte da Rede</h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
                Seja você uma mulher buscando apoio ou uma voluntária querendo ajudar, 
                há espaço para você na Rede Elas.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/login" class="bg-white hover:bg-gray-100 text-primary font-bold px-10 py-4 rounded-lg transition-all duration-200 text-lg shadow-lg hover:shadow-xl">
                    Buscar Apoio
                </a>
                <a href="/conversa" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary font-bold px-10 py-4 rounded-lg transition-all duration-200 text-lg shadow-lg hover:shadow-xl">
                    Iniciar Chat
                </a>
            </div>
        </section>
    </div>
</main>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>