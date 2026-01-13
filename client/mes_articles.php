<?php
require_once '../config.php';

$id = $_SESSION['id'];

$mesArticles = Article::getArticleBySingleUser($id)

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Articles - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center md:hidden">
        <span class="font-bold text-red-600 italic">MaBagnole</span>
        <button class="text-gray-500"><i class="fas fa-bars text-xl"></i></button>
    </nav>

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-tr from-red-600 to-red-400 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl font-black shadow-lg shadow-red-100 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-xl">Ahmed Benali</h2>
                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded-full uppercase font-bold text-gray-400">Client Premium</span>
            </div>

            <nav class="flex-1 px-6 space-y-1">
                <a href="dashboard.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-calendar-check mr-4"></i> Mes Locations
                </a>

                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-star mr-4"></i> Mes Avis
                </a>

                <div class="my-4 border-t border-gray-100 mx-4"></div>
                <span class="px-4 text-[10px] uppercase font-bold text-gray-400 tracking-widest">Blog & Communauté</span>

                <a href="mes_articles.php" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
                    <i class="fas fa-pen-nib mr-4 text-red-600"></i> Mes Articles
                </a>

                <a href="articles_favoris.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition group">
                    <i class="fas fa-bookmark mr-4 group-hover:text-red-600 transition"></i> Articles Favoris
                </a>

                <div class="my-4 border-t border-gray-100 mx-4"></div>

                <a href="profil.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-user-circle mr-4"></i> Mon Profil
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="/auth/logout.php" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-black text-gray-900">Gérer mes <span class="text-red-600">Articles.</span></h1>
                    <a href="/blog/ajouter-article.php" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-red-600 transition text-xs uppercase tracking-widest flex items-center">
                        <i class="fas fa-pen-nib mr-2"></i> Rédiger un article
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <?php if (!empty($mesArticles)): ?>
                        <?php foreach ($mesArticles as $article): ?>
                            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group">
                                <div class="h-48 bg-gray-200 relative overflow-hidden">
                                    <img src="<?= $article["image_url"] ?>" alt="Car" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div class="absolute top-4 left-4">
                                        <?php switch ($article["statut"]) {
                                            case "approuve": ?>
                                                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-green-200">
                                                    <i class="fas fa-check-circle mr-1"></i> Publié
                                                </span>
                                                <?php break; 

                                                case "en_attente": ?>
                                                <span class="bg-yellow-100 text-yellow-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-200">
                                                    <i class="fas fa-clock mr-1"></i> En attente
                                                </span>
                                                <?php break; 

                                                case "rejete": ?>
                                                <span class="bg-red-100 text-red-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-red-200">
                                                    <i class="fas fa-times-circle mr-1"></i> Rejeté
                                                </span>
                                                <?php break; ?>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-red-600 text-xs font-bold uppercase tracking-widest"><?= $article["nom"] ?></span>
                                        <span class="text-gray-300 text-xs">•</span>
                                        <span class="text-gray-400 text-xs font-semibold"><?= date("d M Y", strtotime($article["created_at"])) ?></span>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-3 leading-tight group-hover:text-red-600 transition">
                                        <?= $article["titre"] ?>
                                    </h3>
                                    <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                        <?= $article["contenu"] ?>
                                    </p>

                                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                        <div class="flex gap-2">
                                            <button class="w-8 h-8 rounded-full bg-gray-50 text-blue-600 hover:bg-blue-50 flex items-center justify-center transition">
                                                <i class="fas fa-pen text-xs"></i>
                                            </button>
                                            <button class="w-8 h-8 rounded-full bg-gray-50 text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </div>
                                        <a href="#" class="text-xs font-bold text-gray-900 flex items-center hover:text-red-600 transition">
                                            Lire <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center">
                            <i class="fas fa-info-circle mr-2"></i> Aucun article n’a encore été publié.
                        </div>
                    <?php endif; ?>
                    <!-- <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&q=80&w=800" alt="Car" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80">
                            <div class="absolute top-4 left-4">
                                <span class="bg-yellow-100 text-yellow-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-yellow-200">
                                    <i class="fas fa-clock mr-1"></i> Brouillon
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-red-600 text-xs font-bold uppercase tracking-widest">Roadtrip</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-gray-400 text-xs font-semibold">Modifié il y a 2h</span>
                            </div>
                            <h3 class="font-bold text-xl text-gray-900 mb-3 leading-tight group-hover:text-red-600 transition">
                                Les meilleures routes côtières du Maroc
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                Un guide complet pour un voyage inoubliable de Tanger à Agadir. Découvrez les spots cachés...
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex gap-2">
                                    <button class="w-8 h-8 rounded-full bg-gray-50 text-blue-600 hover:bg-blue-50 flex items-center justify-center transition">
                                        <i class="fas fa-pen text-xs"></i>
                                    </button>
                                    <button class="w-8 h-8 rounded-full bg-gray-50 text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>
                                <span class="text-xs font-bold text-gray-400 italic">Non publié</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800" alt="Car" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i> Publié
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-red-600 text-xs font-bold uppercase tracking-widest">Nouveautés</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-gray-400 text-xs font-semibold">10 Nov 2023</span>
                            </div>
                            <h3 class="font-bold text-xl text-gray-900 mb-3 leading-tight group-hover:text-red-600 transition">
                                Nouvelle BMW Série 4 : Notre test complet
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                Nous avons eu la chance de tester la dernière née de la gamme BMW. Performance, confort et design...
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex gap-2">
                                    <button class="w-8 h-8 rounded-full bg-gray-50 text-blue-600 hover:bg-blue-50 flex items-center justify-center transition">
                                        <i class="fas fa-pen text-xs"></i>
                                    </button>
                                    <button class="w-8 h-8 rounded-full bg-gray-50 text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </div>
                                <a href="#" class="text-xs font-bold text-gray-900 flex items-center hover:text-red-600 transition">
                                    Lire <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div> -->

                </div>

                <div class="hidden text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200 mt-6">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-2xl text-red-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Aucun article rédigé</h3>
                    <p class="text-gray-400 text-sm mb-6">Partagez votre passion automobile avec la communauté.</p>
                    <button class="text-red-600 font-bold text-sm hover:underline">Créer mon premier article</button>
                </div>

            </div>
        </main>
    </div>

</body>

</html>