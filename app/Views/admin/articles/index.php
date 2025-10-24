<?php
$title = 'Admin - Artigos';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<main class="py-8 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Gerenciar Artigos</h1>
                <p class="text-gray-600 mt-2">Crie e gerencie artigos do blog da Rede Elas</p>
            </div>
            <a href="/admin/articles/create" class="btn btn-primary flex items-center gap-2 px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Novo Artigo
            </a>
        </div>

        <!-- Mensagens -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['success']) ?></span>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['error']) ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Lista de Artigos -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <?php if (!empty($articles)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Título</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Slug</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Atualizado</th>
                                <th class="px-6 py-4 text-right text-sm font-bold text-gray-900">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($articles as $a): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900"><?= htmlspecialchars($a['title']) ?></div>
                                    <?php if ($a['excerpt']): ?>
                                        <div class="text-sm text-gray-500 mt-1 line-clamp-2"><?= htmlspecialchars(substr($a['excerpt'], 0, 100)) ?>...</div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <code class="bg-gray-100 px-3 py-1.5 rounded-md text-xs font-mono"><?= htmlspecialchars($a['slug']) ?></code>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($a['is_published']): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Publicado
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Rascunho
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <?= date('d/m/Y H:i', strtotime($a['updated_at'])) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/admin/articles/<?= $a['id'] ?>/edit" class="btn btn-outline flex items-center gap-1.5 text-sm px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Editar
                                        </a>
                                        <form action="/admin/articles/<?= $a['id'] ?>/delete" method="POST" class="inline">
                                            <button type="submit" class="btn btn-danger flex items-center gap-1.5 text-sm px-4 py-2 rounded-lg font-medium transition-all duration-200" onclick="return confirm('Tem certeza que deseja excluir este artigo?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Nenhum artigo encontrado</h3>
                    <p class="text-gray-600 mb-8 text-lg">Comece criando seu primeiro artigo para o blog.</p>
                    <a href="/admin/articles/create" class="inline-flex items-center gap-2 btn btn-primary px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Criar Primeiro Artigo
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>