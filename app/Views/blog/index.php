<?php
// app/Views/blog/index.php - Página do blog
$title = 'Blog - Artigos Informativos';
require_once BASE_PATH . '/app/Views/layout/header.php';
?>

<!-- Hero Section -->
<section class="hero-section bg-gradient-to-br from-secondary to-white py-16 px-4  md:">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-fade-in">
                Blog - Artigos Informativos
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Informações importantes sobre violência doméstica, direitos das mulheres e recursos de apoio
            </p>
        </div>
    </div>
</section>

<main class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Artigos -->
        <div class="space-y-6">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div class="flex flex-col md:flex-row">
                        <?php if (!empty($article['cover_image'])): ?>
                        <div class="md:w-1/3 h-48 md:h-auto">
                            <img src="<?= htmlspecialchars($article['cover_image']) ?>" 
                                 alt="<?= htmlspecialchars($article['title']) ?>"
                                 class="w-full h-full object-cover" />
                        </div>
                        <?php endif; ?>
                        <div class="flex-1 p-6">
                            <div class="flex items-start space-x-4">
                                <?php if (empty($article['cover_image'])): ?>
                                <div class="w-16 h-16 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-2xl">📝</span>
                                </div>
                                <?php endif; ?>
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                        <a href="/blog/<?= htmlspecialchars($article['slug']) ?>" class="hover:underline">
                                            <?= htmlspecialchars($article['title']) ?>
                                        </a>
                                    </h2>
                                    <?php if (!empty($article['excerpt'])): ?>
                                    <p class="text-gray-600 mb-4 leading-relaxed">
                                        <?= htmlspecialchars($article['excerpt']) ?>
                                    </p>
                                    <?php endif; ?>
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <?php if (!empty($article['published_at'])): ?>
                                                📅 <?= date('d/m/Y', strtotime($article['published_at'])) ?>
                                            <?php else: ?>
                                                📅 Rascunho
                                            <?php endif; ?>
                                            <?php if (!empty($article['author_name'])): ?>
                                                • Por <?= htmlspecialchars($article['author_name']) ?>
                                            <?php endif; ?>
                                        </div>
                                        <a href="/blog/<?= htmlspecialchars($article['slug']) ?>" class="text-sm bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                            Ler Artigo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="bg-secondary rounded-2xl p-8 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum artigo publicado ainda</h3>
                    <p class="text-gray-600">Assim que publicarmos conteúdos, eles aparecerão aqui.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 bg-gradient-to-br from-primary to-primary-hover rounded-2xl p-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-4">
                Precisa de Apoio Imediato?
            </h2>
            <p class="text-primary-light mb-6">
                Nossa equipe está disponível 24 horas por dia, 7 dias por semana para te apoiar
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/conversa" class="bg-white hover:bg-gray-100 text-primary font-semibold px-6 py-3 rounded-lg transition-all duration-200">
                    Iniciar Chat de Apoio
                </a>
                <a href="/depoimentos" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary font-semibold px-6 py-3 rounded-lg transition-all duration-200">
                    Ver Histórias de Superação
                </a>
            </div>
        </div>

        <!-- Recursos Adicionais -->
        <div class="mt-12 grid md:grid-cols-2 gap-6">
            <div class="bg-primary-light border border-primary rounded-lg p-6">
                <h3 class="font-semibold text-foreground mb-3">Recursos Úteis</h3>
                <ul class="list-disc pl-5 text-sm text-foreground/80 space-y-2">
                    <li>Central de Atendimento à Mulher - 180</li>
                    <li>Polícia Militar - 190</li>
                    <li>CVV (Apoio Emocional) - 188</li>
                    <li>Delegacias da Mulher</li>
                </ul>
            </div>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="font-semibold text-green-900 mb-3">Apoio Legal</h3>
                <ul class="text-sm text-green-700 space-y-2">
                    <li>• Defensoria Pública</li>
                    <li>• Núcleos de Prática Jurídica</li>
                    <li>• ONGs especializadas</li>
                    <li>• Assistência Social</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php require_once BASE_PATH . '/app/Views/layout/footer.php'; ?>
