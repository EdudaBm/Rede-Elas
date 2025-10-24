<?php
$title = htmlspecialchars($article['title']) . ' - Blog';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<article class="py-12 px-4 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center gap-2 text-sm text-gray-600">
                <li>
                    <a href="/" class="hover:text-primary transition-colors">Início</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li>
                    <a href="/blog" class="hover:text-primary transition-colors">Blog</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="text-gray-900 font-medium">
                    <?= htmlspecialchars($article['title']) ?>
                </li>
            </ol>
        </nav>

        <!-- Artigo -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <?php if (!empty($article['cover_image'])): ?>
            <!-- Imagem de Capa -->
            <div class="h-64 md:h-80 w-full">
                <img src="<?= htmlspecialchars($article['cover_image']) ?>" 
                     alt="<?= htmlspecialchars($article['title']) ?>"
                     class="w-full h-full object-cover" />
            </div>
            <?php endif; ?>
            
            <!-- Header do Artigo -->
            <div class="bg-gradient-to-br from-primary to-primary-hover p-12 text-white">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <time datetime="<?= $article['created_at'] ?>" class="text-white/90 font-medium">
                        <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                    </time>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                    <?= htmlspecialchars($article['title']) ?>
                </h1>
                <?php if ($article['excerpt']): ?>
                    <p class="text-xl text-white/90 leading-relaxed">
                        <?= htmlspecialchars($article['excerpt']) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Conteúdo -->
            <div class="p-12">
                <div class="prose prose-lg max-w-none">
                    <?php
                    $content = htmlspecialchars($article['content']);
                    $paragraphs = explode("\n", $content);
                    foreach ($paragraphs as $paragraph):
                        if (trim($paragraph)):
                    ?>
                        <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                            <?= $paragraph ?>
                        </p>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>

            <!-- Footer do Artigo -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 px-12 py-8 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Última atualização: <?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></span>
                    </div>
                    <a href="/blog" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-hover transition-colors group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Voltar ao blog
                    </a>
                </div>
            </div>
        </div>

        <!-- Informações de Apoio -->
        <div class="mt-8 bg-gradient-to-br from-primary-light to-secondary rounded-2xl shadow-lg border border-gray-200 p-8">
            <div class="flex gap-4">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Precisa de Apoio?
                    </h3>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Se você está passando por uma situação de violência, não hesite em buscar ajuda. 
                        Nossa equipe está pronta para te apoiar.
                    </p>
                    <a href="/conversa" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Iniciar Chat de Apoio
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>