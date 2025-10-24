<?php 
$title = 'Atendimento - Voluntárias';
require_once __DIR__ . '/../layout/header.php'; 
?>

<main class="py-12 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-hover rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">Painel de Atendimento</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Gerencie filas de espera e chats em andamento</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow-lg border-2 border-yellow-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-yellow-800 mb-1">Em Espera</p>
                        <p class="text-4xl font-bold text-yellow-900"><?= count($waitingChats) ?></p>
                    </div>
                    <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg border-2 border-green-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-green-800 mb-1">Em Atendimento</p>
                        <p class="text-4xl font-bold text-green-900"><?= count($activeChats) ?></p>
                    </div>
                    <div class="w-16 h-16 bg-green-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chats em Espera -->
        <section class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-8 py-6 text-white">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Chats em Espera</h2>
                        <p class="text-white/90"><?= count($waitingChats) ?> usuária<?= count($waitingChats) !== 1 ? 's' : '' ?> aguardando atendimento</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <?php if (empty($waitingChats)): ?>
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum chat aguardando</h3>
                        <p class="text-gray-600 text-lg">Todas as conversas estão sendo atendidas.</p>
                    </div>
                <?php else: ?>
                    <div class="grid md:grid-cols-2 gap-6">
                        <?php foreach ($waitingChats as $chat): ?>
                            <div class="group bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-xl p-6 hover:border-yellow-400 hover:shadow-xl transition-all duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-yellow-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg">Chat #<?= $chat['id'] ?></h3>
                                            <div class="text-sm text-gray-700 font-medium">
                                                <?= htmlspecialchars($chat['user_name']) ?>
                                            </div>
                                            <div class="text-xs text-gray-600 flex items-center gap-1.5 mt-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <?= date('d/m/Y H:i', strtotime($chat['created_at'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="/conversa/<?= $chat['id'] ?>/accept">
                                    <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Atender Agora
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Chats Ativos -->
        <section class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6 text-white">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Chats em Atendimento</h2>
                        <p class="text-white/90"><?= count($activeChats) ?> conversa<?= count($activeChats) !== 1 ? 's' : '' ?> ativa<?= count($activeChats) !== 1 ? 's' : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <?php if (empty($activeChats)): ?>
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum chat ativo</h3>
                        <p class="text-gray-600 text-lg">Não há conversas em andamento no momento.</p>
                    </div>
                <?php else: ?>
                    <div class="grid md:grid-cols-2 gap-6">
                        <?php foreach ($activeChats as $chat): ?>
                            <div class="group bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 hover:border-green-400 hover:shadow-xl transition-all duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></span>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg">Chat #<?= $chat['id'] ?></h3>
                                            <div class="text-sm text-gray-700 font-medium">
                                                <?= htmlspecialchars($chat['user_name']) ?>
                                            </div>
                                            <div class="text-xs text-gray-600 flex items-center gap-1.5 mt-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Desde <?= date('d/m/Y H:i', strtotime($chat['created_at'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/conversa/<?= $chat['id'] ?>" class="block w-full bg-gradient-to-r from-primary to-primary-hover hover:shadow-lg text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 text-center shadow-md">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        Abrir Conversa
                                    </span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>