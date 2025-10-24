<?php $title = 'Painel Administrativo';require_once BASE_PATH . '/app/Views/layout/header.php'; ?>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-secondary to-white py-16 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-2xl mb-6 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Painel Administrativo
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Gerencie o sistema de apoio e modere o conteúdo
            </p>
        </div>
    </div>
</section>

<main class="py-12 px-4 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Mensagens -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 px-6 py-4 rounded-lg shadow-sm animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-emerald-800 font-medium"><?= htmlspecialchars($_SESSION['success']) ?></span>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Ações Rápidas -->
        <div class="flex items-center justify-end gap-4">
            <a href="/admin/register" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                Cadastrar Usuário
            </a>
            <a href="/admin/articles" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Gerenciar Artigos
            </a>
        </div>

        <!-- Estatísticas -->
        <div class="grid md:grid-cols-4 gap-6">
            <!-- Depoimentos Pendentes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-amber-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                        Pendente
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Depoimentos Pendentes</p>
                <p class="text-3xl font-bold text-gray-900"><?= count($pendingTestimonials) ?></p>
            </div>

            <!-- Chats Ativos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                        Ativo
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Chats Ativos</p>
                <p class="text-3xl font-bold text-gray-900"><?= count($activeChats) ?></p>
            </div>

            <!-- Chats em Espera -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-cyan-100 text-cyan-700">
                        Aguardando
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Chats em Espera</p>
                <p class="text-3xl font-bold text-gray-900"><?= count($waitingChats) ?></p>
            </div>

            <!-- Total de Depoimentos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-gray-400 to-gray-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                        Total
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total de Depoimentos</p>
                <p class="text-3xl font-bold text-gray-900"><?= count($approvedTestimonials) ?></p>
            </div>
        </div>

        <!-- Moderação de Depoimentos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors duration-200" onclick="toggleSection('testimonials-pending')">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-500 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-900">Moderação de Depoimentos</h2>
                        <p class="text-sm text-gray-600 mt-0.5">
                            <span class="font-semibold text-amber-600"><?= count($pendingTestimonials) ?></span> depoimentos pendentes
                        </p>
                    </div>
                </div>
                <svg class="dropdown-arrow w-6 h-6 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
                        
            <div id="testimonials-pending" class="collapsible-content hidden border-t border-gray-200">
                <div class="p-6">
                    <?php if (empty($pendingTestimonials)): ?>
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Nenhum depoimento pendente</h3>
                            <p class="text-gray-600">Todos os depoimentos foram moderados.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($pendingTestimonials as $testimonial): ?>
                                <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center shadow-md">
                                                <span class="text-white font-bold text-sm">
                                                    <?= strtoupper(substr($testimonial['author_name'], 0, 2)) ?>
                                                </span>
                                            </div>
                                            <div>
                                                <span class="font-semibold text-gray-900 text-lg"><?= htmlspecialchars($testimonial['author_name']) ?></span>
                                                <div class="text-sm text-gray-500 flex items-center gap-1 mt-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <?= date('d/m/Y H:i', strtotime($testimonial['created_at'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                            Pendente
                                        </span>
                                    </div>
                                                        
                                    <div class="bg-white rounded-lg p-4 mb-4 border border-gray-100">
                                        <p class="text-gray-800 leading-relaxed"><?= nl2br(htmlspecialchars($testimonial['content'])) ?></p>
                                    </div>
                                                        
                                    <div class="flex gap-3">
                                        <form method="POST" action="/admin/testimonials/<?= $testimonial['id'] ?>/approve" class="inline">
                                            <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Aprovar
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/testimonials/<?= $testimonial['id'] ?>/reject" class="inline">
                                            <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Rejeitar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Depoimentos Aprovados -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors duration-200" onclick="toggleSection('testimonials-approved')">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-900">Depoimentos Aprovados</h2>
                        <p class="text-sm text-gray-600 mt-0.5">
                            <span class="font-semibold text-emerald-600"><?= count($approvedTestimonials) ?></span> depoimentos aprovados
                        </p>
                    </div>
                </div>
                <svg class="dropdown-arrow w-6 h-6 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
                        
            <div id="testimonials-approved" class="collapsible-content hidden border-t border-gray-200">
                <div class="p-6">
                    <?php if (empty($approvedTestimonials)): ?>
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Nenhum depoimento aprovado</h3>
                            <p class="text-gray-600">Os depoimentos aprovados aparecerão aqui.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach ($approvedTestimonials as $testimonial): ?>
                                <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl p-5 flex items-start justify-between gap-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center">
                                                <span class="text-white font-bold text-xs">
                                                    <?= strtoupper(substr($testimonial['author_name'], 0, 2)) ?>
                                                </span>
                                            </div>
                                            <span class="font-semibold text-gray-900"><?= htmlspecialchars($testimonial['author_name']) ?></span>
                                        </div>
                                        <p class="text-gray-700 text-sm leading-relaxed"><?= nl2br(htmlspecialchars($testimonial['content'])) ?></p>
                                    </div>
                                    <form method="POST" action="/admin/testimonials/<?= $testimonial['id'] ?>/delete" class="inline">
                                        <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:shadow-md transition-all duration-200" onclick="return confirm('Excluir este depoimento aprovado?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Chats em Espera -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors duration-200" onclick="toggleSection('chats-waiting')">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-900">Chats em Espera</h2>
                        <p class="text-sm text-gray-600 mt-0.5">
                            <span class="font-semibold text-yellow-600"><?= count($waitingChats) ?></span> conversas aguardando atendimento
                        </p>
                    </div>
                </div>
                <svg class="dropdown-arrow w-6 h-6 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
                        
            <div id="chats-waiting" class="collapsible-content hidden border-t border-gray-200">
                <div class="p-6">
                    <?php if (empty($waitingChats)): ?>
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Nenhum chat em espera</h3>
                            <p class="text-gray-600">Todas as conversas estão sendo atendidas.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($waitingChats as $chat): ?>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-lg">⏳</span>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Chat #<?= $chat['id'] ?></h3>
                                                <p class="text-sm text-gray-600">
                                                    Usuária: <span class="font-medium"><?= htmlspecialchars($chat['user_name']) ?></span>
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    Solicitado em <?= date('d/m/Y H:i', strtotime($chat['created_at'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <form method="POST" action="/conversa/<?= $chat['id'] ?>/accept" class="inline">
                                            <button type="submit" class="btn btn-success flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Atender
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Gerenciamento de Chats -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors duration-200" onclick="toggleSection('chats-active')">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-900">Chats Ativos</h2>
                        <p class="text-sm text-gray-600 mt-0.5">
                            <span class="font-semibold text-cyan-600"><?= count($activeChats) ?></span> conversas em andamento
                        </p>
                    </div>
                </div>
                <svg class="dropdown-arrow w-6 h-6 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
                        
            <div id="chats-active" class="collapsible-content hidden border-t border-gray-200">
                <div class="p-6">
                    <?php if (empty($activeChats)): ?>
                        <div class="text-center py-16">
                            <div class="w-20 h-20 bg-cyan-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Nenhum chat ativo</h3>
                            <p class="text-gray-600">Não há conversas em andamento no momento.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($activeChats as $chat): ?>
                                <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-full flex items-center justify-center shadow-md">
                                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-900 text-lg"><?= htmlspecialchars($chat['user_name']) ?></h3>
                                                <p class="text-sm text-gray-600 flex items-center gap-1 mt-0.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    Atendido por: <span class="font-semibold"><?= htmlspecialchars($chat['volunteer_name']) ?></span>
                                                </p>
                                                <p class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                    </svg>
                                                    Chat #<?= $chat['id'] ?> • Iniciado em <?= date('d/m/Y H:i', strtotime($chat['created_at'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <a href="/conversa/<?= $chat['id'] ?>" class="inline-flex items-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Ver Chat
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.dropdown-arrow {
    transition: transform 0.2s ease;
}

.dropdown-arrow.open {
    transform: rotate(180deg);
}

.collapsible-content {
    transition: all 0.3s ease;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease;
}
</style>

<script>
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const arrow = content.previousElementSibling.querySelector('.dropdown-arrow');
        
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        arrow.classList.add('open');
    } else {
        content.classList.add('hidden');
        arrow.classList.remove('open');
    }
}

// Abrir automaticamente seções com conteúdo
document.addEventListener('DOMContentLoaded', function() {
    // Abrir depoimentos pendentes se houver
    const pendingTestimonials = document.getElementById('testimonials-pending');
    if (pendingTestimonials && !pendingTestimonials.querySelector('.text-center')) {
        toggleSection('testimonials-pending');
    }
    
    // Abrir chats em espera se houver
    const waitingChats = document.getElementById('chats-waiting');
    if (waitingChats && !waitingChats.querySelector('.text-center')) {
        toggleSection('chats-waiting');
    }
});
</script>

<?php include BASE_PATH . '/app/Views/layout/footer.php'; ?>
