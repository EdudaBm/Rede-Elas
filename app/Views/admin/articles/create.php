<?php
$title = 'Novo Artigo - Admin';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<main class="py-8 px-4 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-6">
                <a href="/admin/articles" 
                   class="flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 hover:shadow-sm transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Criar Novo Artigo</h1>
                    <p class="text-gray-600 mt-1">Crie um novo artigo para o blog da Rede Elas</p>
                </div>
            </div>
        </div>

        <!-- Mensagens -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-r-lg shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span><?= htmlspecialchars($_SESSION['error']) ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Formulário -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Informações do Artigo</h2>
                <p class="text-sm text-gray-600 mt-1">Preencha os campos abaixo para criar seu artigo</p>
            </div>

            <form action="/admin/articles/create" method="POST" class="p-8 space-y-8">
                <!-- Título -->
                <div class="space-y-2">
                    <label for="title" class="form-label text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Título do Artigo
                    </label>
                    <input type="text" name="title" id="title"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                           placeholder="Digite o título do artigo..."
                           required />
                </div>

                <!-- Slug -->
                <div class="space-y-2">
                    <label for="slug" class="form-label text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        Slug (URL amigável)
                    </label>
                    <div class="flex items-center gap-2 bg-gray-50 border border-gray-300 rounded-lg px-4 py-3 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent transition-all duration-200">
                        <span class="text-gray-500 text-sm font-medium whitespace-nowrap">/blog/</span>
                        <input type="text" name="slug" id="slug"
                               class="flex-1 bg-transparent border-none outline-none text-gray-900"
                               placeholder="ex: direitos-das-mulheres"
                               required />
                    </div>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5 mt-2">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Será gerado automaticamente baseado no título
                    </p>
                </div>

                <!-- Resumo -->
                <div class="space-y-2">
                    <label for="excerpt" class="form-label text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Resumo
                        <span class="text-xs font-normal text-gray-500">(opcional)</span>
                    </label>
                    <textarea name="excerpt" id="excerpt"
                              class="form-textarea w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none"
                              rows="3"
                              placeholder="Breve descrição do artigo que aparecerá na listagem..."></textarea>
                </div>

                <!-- Imagem de Capa -->
                <div class="space-y-2">
                    <label for="cover_image" class="form-label text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Imagem de Capa
                        <span class="text-xs font-normal text-gray-500">(opcional)</span>
                    </label>
                    <input type="url" name="cover_image" id="cover_image"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                           placeholder="https://exemplo.com/imagem.jpg" />
                    <p class="text-xs text-gray-500 flex items-center gap-1.5 mt-2">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        URL da imagem que aparecerá como capa do artigo
                    </p>
                </div>

                <!-- Conteúdo -->
                <div class="space-y-2">
                    <label for="content" class="form-label text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Conteúdo do Artigo
                    </label>
                    <textarea name="content" id="content"
                              class="form-textarea w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none font-mono text-sm"
                              rows="15"
                              placeholder="Escreva o conteúdo do artigo aqui..."
                              required></textarea>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5 mt-2">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Use quebras de linha para separar parágrafos
                    </p>
                </div>

                <!-- Opções de Publicação -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center h-6">
                            <input id="is_published" type="checkbox" name="is_published" value="1"
                                   class="h-5 w-5 text-primary border-gray-300 rounded focus:ring-2 focus:ring-primary cursor-pointer" />
                        </div>
                        <div class="flex-1">
                            <label for="is_published" class="text-gray-900 font-semibold cursor-pointer flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Publicar imediatamente
                            </label>
                            <p class="text-sm text-gray-600 mt-1">
                                Se desmarcado, o artigo será salvo como rascunho
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Salvar Artigo
                    </button>
                    <a href="/admin/articles" class="btn btn-outline flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-semibold border-2 hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Dicas -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Dicas para um bom artigo</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Use títulos claros e descritivos</li>
                        <li>• O resumo ajuda na prévia do artigo nas listagens</li>
                        <li>• Revise o conteúdo antes de publicar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Gerar slug automaticamente baseado no título
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '') // Remove acentos
        .replace(/[^a-z0-9\s-]/g, '') // Remove caracteres especiais
        .replace(/\s+/g, '-') // Substitui espaços por hífens
        .replace(/-+/g, '-') // Remove hífens duplicados
        .trim();

    document.getElementById('slug').value = slug;
});

// Contador de caracteres para o resumo
document.getElementById('excerpt').addEventListener('input', function() {
    const maxLength = 300;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;

    // Criar ou atualizar contador
    let counter = document.getElementById('excerpt-counter');
    if (!counter) {
        counter = document.createElement('div');
        counter.id = 'excerpt-counter';
        counter.className = 'text-xs mt-2 font-medium flex items-center gap-1.5';
        this.parentNode.appendChild(counter);
    }

    counter.innerHTML = `
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        ${currentLength}/${maxLength} caracteres
    `;

    if (remaining < 0) {
        counter.className = 'text-xs mt-2 font-medium flex items-center gap-1.5 text-red-600';
    } else if (remaining < 50) {
        counter.className = 'text-xs mt-2 font-medium flex items-center gap-1.5 text-yellow-600';
    } else {
        counter.className = 'text-xs mt-2 font-medium flex items-center gap-1.5 text-gray-600';
    }
});
</script>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>