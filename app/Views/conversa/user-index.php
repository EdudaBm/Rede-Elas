<?php
// app/Views/conversa/user-index.php - Página de chat para usuárias
$title = 'Chat de Apoio';
require_once __DIR__ . '/../layout/header.php';
?>

<!-- Hero Section -->
<section class="relative py-16 px-4 bg-gradient-to-br from-primary/5 via-white to-secondary/10 overflow-hidden">
    <span class="absolute top-10 right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></span>
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                Chat de Apoio
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Converse anonimamente com voluntárias treinadas. 
                <span class="text-primary font-semibold">Estamos aqui para te apoiar.</span>
            </p>
            
            <!-- CTA Button -->
            <form method="POST" action="/conversa/create" class="inline-block">
                <button type="submit" class="group bg-gradient-to-r from-primary to-primary-hover text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center gap-3 mx-auto text-lg">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Iniciar Novo Chat de Apoio
                </button>
            </form>
        </div>
    </div>
</section>

<main class="py-12 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <!-- Informações de Segurança -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-sm border border-green-200 p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Sua Conversa é Segura</h4>
                    <p class="text-gray-700 leading-relaxed">
                        Todas as mensagens são anônimas e criptografadas. Nenhuma informação pessoal é armazenada ou compartilhada.
                    </p>
                </div>
            </div>
        </div>

        <!-- Lista de Chats -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Minhas Conversas</h2>
                            <p class="text-sm text-gray-600"><?= count($chats) ?> chat<?= count($chats) !== 1 ? 's' : '' ?> no total</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <?php if (empty($chats)): ?>
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum chat ainda</h3>
                        <p class="text-gray-600 mb-8 text-lg">Inicie um novo chat para conversar com nossas voluntárias.</p>
                        <form method="POST" action="/conversa/create" class="inline-block">
                            <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2 mx-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Iniciar Primeiro Chat
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="grid md:grid-cols-2 gap-6">
                        <?php foreach ($chats as $chat): ?>
                            <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-xl p-6 hover:border-primary hover:shadow-lg transition-all duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg">
                                                Chat #<?= $chat['id'] ?>
                                            </h3>
                                            <div class="text-sm text-gray-500 flex items-center gap-1.5 mt-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <?= date('d/m/Y H:i', strtotime($chat['created_at'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <?php if ($chat['status'] === 'waiting'): ?>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <svg class="w-3.5 h-3.5 mr-1.5 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                Aguardando
                                            </span>
                                        <?php elseif ($chat['status'] === 'active'): ?>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Ativo
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Encerrado
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if ($chat['status'] === 'active' && $chat['volunteer_name']): ?>
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <span class="text-sm text-blue-900 font-medium">
                                                Voluntária: <?= htmlspecialchars($chat['volunteer_name']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php elseif ($chat['status'] === 'waiting'): ?>
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-yellow-600 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm text-yellow-900 font-medium">
                                                Aguardando uma voluntária se conectar...
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex gap-3">
                                    <a href="/conversa/<?= $chat['id'] ?>" class="flex-1 bg-primary hover:bg-primary-hover text-white text-center px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <?= $chat['status'] === 'closed' ? 'Ver Histórico' : 'Abrir Chat' ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informações Adicionais -->
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Como Funciona</h3>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-primary text-xs font-bold">1</span>
                        </div>
                        <span class="text-gray-700 leading-relaxed">Clique em "Iniciar Chat" para começar</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-primary text-xs font-bold">2</span>
                        </div>
                        <span class="text-gray-700 leading-relaxed">Uma voluntária treinada se conectará</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-primary text-xs font-bold">3</span>
                        </div>
                        <span class="text-gray-700 leading-relaxed">Converse com total privacidade</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-primary text-xs font-bold">4</span>
                        </div>
                        <span class="text-gray-700 leading-relaxed">Encerre quando se sentir melhor</span>
                    </li>
                </ul>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg border border-green-200 p-8 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Nossas Voluntárias</h3>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 leading-relaxed">Profissionais treinadas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 leading-relaxed">Experiência em apoio emocional</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 leading-relaxed">Disponibilidade 24/7</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700 leading-relaxed">Compromisso com sua segurança</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>