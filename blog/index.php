<?php
require_once '../config.php';

$articles = Article::getAllArtcile();


$themes = Theme::getAllTheme() ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Actualités | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #dc2626;
        }
    </style>
</head>

<body class="bg-[#0a0a0a] text-white font-sans selection:bg-red-600 selection:text-white">

    <?php include '../includes/header.php'; ?>

    <div class="relative pt-40 pb-20 px-6 border-b border-white/5 bg-[url('https://images.unsplash.com/photo-1493238792015-164e850400eb?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat bg-fixed">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-[#0a0a0a]/90 to-[#0a0a0a]"></div>

        <div class="container mx-auto relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter uppercase mb-6">
                L'Univers <span class="text-red-600">Passion.</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-base font-medium mb-10">
                Découvrez les derniers essais, conseils mécaniques et récits de roadtrips de notre communauté.
            </p>

            <div class="max-w-xl mx-auto relative group">
                <input type="text" placeholder="Rechercher un article, un essai..."
                    class="w-full bg-white/5 backdrop-blur-md border border-white/10 rounded-full py-4 pl-6 pr-14 text-white placeholder-gray-500 outline-none focus:border-red-600 transition-all font-bold text-sm shadow-xl">
                <button class="absolute right-2 top-2 bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-white hover:text-red-600 transition shadow-lg shadow-red-600/20">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    
    <main class="container mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-12">

            <aside class="w-full lg:w-1/4 space-y-8">

                <a href="/blog/ajouter-article.php" class="block w-full bg-white text-black py-4 rounded-2xl font-black text-center uppercase tracking-widest text-xs hover:bg-red-600 hover:text-white transition-all shadow-xl hover:shadow-red-600/20 group">
                    <i class="fas fa-pen-nib mr-2 group-hover:rotate-12 transition-transform"></i> Rédiger un article
                </a>

                <div class="bg-[#111] p-6 rounded-[30px] border border-white/5">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 flex items-center">
                        <i class="fas fa-layer-group mr-2 text-red-600"></i> Thèmes
                    </h3>
                    <ul class="space-y-3">
                        <?php foreach ($themes as $theme): ?>
                            <li>
                                <a href="#" class="flex items-center justify-between group p-2 rounded-xl hover:bg-white/5 transition">
                                    <span class="text-sm font-bold text-gray-300 group-hover:text-white transition"><?= $theme["nom"] ?></span>
                                    <span class="text-[10px] bg-white/5 px-2 py-1 rounded text-gray-500 group-hover:bg-red-600 group-hover:text-white transition"><?= $theme["nmbr_aricle"] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>

                        <!-- <li>
                            <a href="#" class="flex items-center justify-between group p-2 rounded-xl hover:bg-white/5 transition">
                                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition">Mécanique</span>
                                <span class="text-[10px] bg-white/5 px-2 py-1 rounded text-gray-500 group-hover:bg-red-600 group-hover:text-white transition">8</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group p-2 rounded-xl hover:bg-white/5 transition">
                                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition">Roadtrips</span>
                                <span class="text-[10px] bg-white/5 px-2 py-1 rounded text-gray-500 group-hover:bg-red-600 group-hover:text-white transition">5</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between group p-2 rounded-xl hover:bg-white/5 transition">
                                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition">Nouveautés</span>
                                <span class="text-[10px] bg-white/5 px-2 py-1 rounded text-gray-500 group-hover:bg-red-600 group-hover:text-white transition">20</span>
                            </a>
                        </li> -->
                    </ul>
                </div>

                <div class="bg-[#111] p-6 rounded-[30px] border border-white/5">
                    <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 flex items-center">
                        <i class="fas fa-hashtag mr-2 text-red-600"></i> Trending Tags
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 hover:border-red-600 hover:text-white transition uppercase">#Tesla</a>
                        <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 hover:border-red-600 hover:text-white transition uppercase">#Vitesse</a>
                        <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 hover:border-red-600 hover:text-white transition uppercase">#Luxe</a>
                        <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 hover:border-red-600 hover:text-white transition uppercase">#Entretien</a>
                        <a href="#" class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-gray-400 hover:border-red-600 hover:text-white transition uppercase">#Maroc</a>
                    </div>
                </div>
            </aside>

            <div class="flex-1">

                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-black italic uppercase">Articles Récents</h2>
                    <div class="flex items-center gap-2">
                        <select class="bg-[#111] border border-white/10 text-white text-xs font-bold py-2 px-4 rounded-xl outline-none focus:border-red-600">
                            <option>Plus récents</option>
                            <option>Plus populaires</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php foreach ($articles as $article) : ?>
                        <article class="bg-[#111] rounded-[35px] overflow-hidden border border-white/5 hover:border-red-600/50 transition-all duration-300 group shadow-lg flex flex-col">
                            <div class="h-52 overflow-hidden relative">
                                <img src="<?= $article->getImageUrl() ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-red-600 text-white text-[9px] font-black uppercase px-3 py-1 rounded-full tracking-widest shadow-lg"><?= $article->getArticleTheme($article->getThemeId()) ?></span>
                                </div>
                                <button class="absolute top-4 right-4 w-8 h-8 bg-black/50 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-red-600 hover:scale-110 transition">
                                    <i class="far fa-heart text-xs"></i>
                                </button>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="mb-4">
                                    <div class="flex gap-2 mb-3">
                                        <span class="text-[9px] text-gray-500 font-bold">#Tesla</span>
                                        <span class="text-[9px] text-gray-500 font-bold">#Electrique</span>
                                    </div>
                                    <h3 class="text-xl font-black text-white italic uppercase leading-tight mb-3 group-hover:text-red-600 transition">
                                        <?= $article->getTitre() ?>
                                    </h3>
                                    <p class="text-gray-500 text-xs line-clamp-3 leading-relaxed">
                                        <?= $article->getContenu() ?>
                                    </p>
                                </div>

                                <div class="mt-auto flex items-center justify-between border-t border-white/5 pt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-700 overflow-hidden">
                                            <img src="https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-white">Karim B.</p>
                                            <p class="text-[9px] text-gray-500">Il y a 2 jours</p>
                                        </div>
                                    </div>
                                    <a href="/blog/article-details.php?id=<?= $article->getId() ?>" class="text-white text-[10px] font-black uppercase tracking-widest hover:underline decoration-red-600 underline-offset-4">
                                        Lire <i class="fas fa-arrow-right ml-1 text-red-600"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach;  ?>
                    <!-- <article class="bg-[#111] rounded-[35px] overflow-hidden border border-white/5 hover:border-red-600/50 transition-all duration-300 group shadow-lg flex flex-col">
                        <div class="h-52 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=2072&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white text-[9px] font-black uppercase px-3 py-1 rounded-full tracking-widest shadow-lg">Mécanique</span>
                            </div>
                            <button class="absolute top-4 right-4 w-8 h-8 bg-black/50 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-red-600 hover:scale-110 transition">
                                <i class="fas fa-heart text-xs"></i> </button>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <div class="flex gap-2 mb-3">
                                    <span class="text-[9px] text-gray-500 font-bold">#Entretien</span>
                                    <span class="text-[9px] text-gray-500 font-bold">#Tips</span>
                                </div>
                                <h3 class="text-xl font-black text-white italic uppercase leading-tight mb-3 group-hover:text-red-600 transition">
                                    5 Astuces pour prolonger la vie de votre moteur
                                </h3>
                                <p class="text-gray-500 text-xs line-clamp-3 leading-relaxed">
                                    La vidange n'est pas la seule chose à surveiller. Découvrez nos conseils d'experts pour garder votre véhicule au top...
                                </p>
                            </div>

                            <div class="mt-auto flex items-center justify-between border-t border-white/5 pt-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 overflow-hidden">
                                        <img src="https://i.pravatar.cc/100?img=12" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-white">Sarah L.</p>
                                        <p class="text-[9px] text-gray-500">Il y a 5 jours</p>
                                    </div>
                                </div>
                                <a href="article_details.php?id=2" class="text-white text-[10px] font-black uppercase tracking-widest hover:underline decoration-red-600 underline-offset-4">
                                    Lire <i class="fas fa-arrow-right ml-1 text-red-600"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <article class="bg-[#111] rounded-[35px] overflow-hidden border border-white/5 hover:border-red-600/50 transition-all duration-300 group shadow-lg flex flex-col">
                        <div class="h-52 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center border border-white/50 group-hover:scale-110 transition">
                                    <i class="fas fa-play text-white ml-1"></i>
                                </div>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="bg-purple-600 text-white text-[9px] font-black uppercase px-3 py-1 rounded-full tracking-widest shadow-lg">Roadtrips</span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <div class="flex gap-2 mb-3">
                                    <span class="text-[9px] text-gray-500 font-bold">#Voyage</span>
                                    <span class="text-[9px] text-gray-500 font-bold">#4x4</span>
                                </div>
                                <h3 class="text-xl font-black text-white italic uppercase leading-tight mb-3 group-hover:text-red-600 transition">
                                    Roadtrip : 3 Jours dans le désert d'Agafay
                                </h3>
                                <p class="text-gray-500 text-xs line-clamp-3 leading-relaxed">
                                    Une aventure inoubliable au volant du nouveau Land Rover Defender. Regardez notre vlog complet sur cette expérience.
                                </p>
                            </div>

                            <div class="mt-auto flex items-center justify-between border-t border-white/5 pt-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 overflow-hidden">
                                        <img src="https://i.pravatar.cc/100?img=8" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-white">Youssef M.</p>
                                        <p class="text-[9px] text-gray-500">Il y a 1 semaine</p>
                                    </div>
                                </div>
                                <a href="article_details.php?id=3" class="text-white text-[10px] font-black uppercase tracking-widest hover:underline decoration-red-600 underline-offset-4">
                                    Voir <i class="fas fa-arrow-right ml-1 text-red-600"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <article class="bg-[#111] rounded-[35px] overflow-hidden border border-white/5 hover:border-red-600/50 transition-all duration-300 group shadow-lg flex flex-col">
                        <div class="h-52 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=2036&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-600 text-white text-[9px] font-black uppercase px-3 py-1 rounded-full tracking-widest shadow-lg">Nouveautés</span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <div class="flex gap-2 mb-3">
                                    <span class="text-[9px] text-gray-500 font-bold">#BMW</span>
                                    <span class="text-[9px] text-gray-500 font-bold">#Sport</span>
                                </div>
                                <h3 class="text-xl font-black text-white italic uppercase leading-tight mb-3 group-hover:text-red-600 transition">
                                    La nouvelle BMW M4 arrive au Maroc
                                </h3>
                                <p class="text-gray-500 text-xs line-clamp-3 leading-relaxed">
                                    Prix, disponibilité et caractéristiques techniques. Tout ce qu'il faut savoir sur la bête allemande.
                                </p>
                            </div>

                            <div class="mt-auto flex items-center justify-between border-t border-white/5 pt-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 overflow-hidden">
                                        <img src="https://i.pravatar.cc/100?img=59" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-white">Admin</p>
                                        <p class="text-[9px] text-gray-500">Hier</p>
                                    </div>
                                </div>
                                <a href="article_details.php?id=4" class="text-white text-[10px] font-black uppercase tracking-widest hover:underline decoration-red-600 underline-offset-4">
                                    Lire <i class="fas fa-arrow-right ml-1 text-red-600"></i>
                                </a>
                            </div>
                        </div>
                    </article> -->

                </div>

                <div class="mt-16 flex justify-center">
                    <nav class="flex items-center gap-2">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-gray-500 hover:bg-white/10 hover:text-white transition">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-600 text-white font-black shadow-lg shadow-red-600/20">1</a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-gray-500 hover:bg-white/10 hover:text-white transition font-bold">2</a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-gray-500 hover:bg-white/10 hover:text-white transition font-bold">3</a>
                        <span class="text-gray-600 px-2">...</span>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-gray-500 hover:bg-white/10 hover:text-white transition">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>

            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>