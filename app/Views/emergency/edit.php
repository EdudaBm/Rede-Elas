<?php
// app/Views/emergency/edit.php - Página de edição de contato de emergência
$title = 'Editar Contato de Emergência';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<main class="py-12 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-2xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                Editar Contato de Emergência
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Atualize as informações do seu contato de emergência
            </p>
        </div>

        <!-- Mensagens -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3 animate-slide-up">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414-1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['error']) ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Formulário -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-8 py-6 border-b border-red-200">
                <h2 class="text-2xl font-bold text-gray-900">Editar Informações do Contato</h2>
                <p class="text-sm text-gray-600 mt-1">Atualize os dados da pessoa de confiança</p>
            </div>

            <form method="POST" action="/emergency/<?= $contact['id'] ?>/edit" class="p-8 space-y-6">
                <!-- Nome do Contato -->
                <div class="space-y-2">
                    <label for="contact_name" class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nome do Contato
                    </label>
                    <input 
                        type="text" 
                        id="contact_name" 
                        name="contact_name" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="Digite o nome completo"
                        value="<?= htmlspecialchars($contact['contact_name']) ?>"
                    >
                </div>

                <!-- Telefone -->
                <div class="space-y-2">
                    <label for="contact_phone" class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Telefone
                    </label>
                    <input 
                        type="tel" 
                        id="contact_phone" 
                        name="contact_phone" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="(11) 99999-9999"
                        value="<?= htmlspecialchars($contact['contact_phone']) ?>"
                    >
                    <p class="text-xs text-gray-500 flex items-center gap-1.5 mt-2">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Inclua o código de área e use apenas números, parênteses, hífens ou espaços
                    </p>
                </div>

                <!-- Relacionamento -->
                <div class="space-y-2">
                    <label for="contact_relationship" class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Relacionamento
                    </label>
                    <div class="relative">
                        <select 
                            id="contact_relationship" 
                            name="contact_relationship" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 appearance-none bg-white cursor-pointer"
                        >
                            <option value="">Selecione o relacionamento</option>
                            <option value="Família" <?= ($contact['contact_relationship'] === 'Família') ? 'selected' : '' ?>>Família</option>
                            <option value="Amigo(a)" <?= ($contact['contact_relationship'] === 'Amigo(a)') ? 'selected' : '' ?>>Amigo(a)</option>
                            <option value="Cônjuge" <?= ($contact['contact_relationship'] === 'Cônjuge') ? 'selected' : '' ?>>Cônjuge</option>
                            <option value="Pai/Mãe" <?= ($contact['contact_relationship'] === 'Pai/Mãe') ? 'selected' : '' ?>>Pai/Mãe</option>
                            <option value="Irmão(ã)" <?= ($contact['contact_relationship'] === 'Irmão(ã)') ? 'selected' : '' ?>>Irmão(ã)</option>
                            <option value="Outro" <?= ($contact['contact_relationship'] === 'Outro') ? 'selected' : '' ?>>Outro</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Contato Principal -->
                <div class="space-y-2">
                    <div class="flex items-start gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <input 
                            type="checkbox" 
                            id="is_primary" 
                            name="is_primary" 
                            value="1"
                            class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                            <?= $contact['is_primary'] ? 'checked' : '' ?>
                        >
                        <div>
                            <label for="is_primary" class="text-sm font-semibold text-gray-900 cursor-pointer">
                                Definir como contato principal
                            </label>
                            <p class="text-xs text-gray-600 mt-1">
                                O contato principal será priorizado em situações de emergência. 
                                Se você já tem um contato principal, este será substituído.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Salvar Alterações
                    </button>
                    <a href="/emergency" class="flex-1 bg-white border-2 border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Informações de Segurança -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl shadow-lg p-8">
            <div class="flex gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Importante sobre Edição de Contatos</h3>
                    <ul class="space-y-2 text-blue-800">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="leading-relaxed">Mantenha as informações sempre atualizadas e precisas</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="leading-relaxed">Verifique se o número de telefone está correto antes de salvar</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="leading-relaxed">Apenas um contato pode ser marcado como principal por vez</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="leading-relaxed">As alterações serão refletidas imediatamente no botão de emergência</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slide-up 0.3s ease-out;
}
</style>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>
