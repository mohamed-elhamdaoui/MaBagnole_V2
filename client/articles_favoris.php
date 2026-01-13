<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Favoris - MaBagnole</title>
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

                <a href="mes_articles.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-pen-nib mr-4"></i> Mes Articles
                </a>

                <a href="articles_favoris.php" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
                    <i class="fas fa-bookmark mr-4 text-red-600"></i> Articles Favoris
                </a>

                <div class="my-4 border-t border-gray-100 mx-4"></div>

                <a href="profil.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-user-circle mr-4"></i> Mon Profil
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="#" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900">Ma liste de <span class="text-red-600">Lecture.</span></h1>
                        <p class="text-gray-400 text-sm mt-1">Retrouvez ici les articles que vous avez sauvegardés pour plus tard.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group relative">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=800" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <button class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center bg-white/90 backdrop-blur-md rounded-full shadow-sm text-red-600 hover:bg-red-600 hover:text-white transition z-10" title="Retirer des favoris">
                                <i class="fas fa-bookmark text-xs"></i>
                            </button>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-blue-600 text-[10px] font-bold uppercase tracking-widest bg-blue-50 px-2 py-1 rounded-md">Mécanique</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-gray-400 text-xs font-semibold">Il y a 2 jours</span>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 mb-2 leading-snug group-hover:text-red-600 transition">
                                Les 5 bruits moteur qui doivent vous inquiéter immédiatement
                            </h3>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                Un cliquetis ? Un sifflement ? Apprenez à diagnostiquer les pannes avant qu'il ne soit trop tard et que la facture ne grimpe.
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-[10px] font-bold text-white">
                                        M
                                    </div>
                                    <span class="text-xs font-bold text-gray-500">Par Mehdi G.</span>
                                </div>
                                <a href="#" class="text-xs font-bold text-gray-900 flex items-center hover:text-red-600 transition group-hover/link:underline">
                                    Lire <i class="fas fa-arrow-right ml-1 text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group relative">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&q=80&w=800" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <button class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center bg-white/90 backdrop-blur-md rounded-full shadow-sm text-red-600 hover:bg-red-600 hover:text-white transition z-10" title="Retirer des favoris">
                                <i class="fas fa-bookmark text-xs"></i>
                            </button>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-green-600 text-[10px] font-bold uppercase tracking-widest bg-green-50 px-2 py-1 rounded-md">Électrique</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-gray-400 text-xs font-semibold">15 Déc 2023</span>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 mb-2 leading-snug group-hover:text-red-600 transition">
                                Tesla Model 3 vs BYD Seal : Le duel final
                            </h3>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                Comparatif complet des deux berlines électriques les plus vendues du moment. Autonomie, prix, finitions... qui gagne ?
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-[10px] font-bold text-white">
                                        S
                                    </div>
                                    <span class="text-xs font-bold text-gray-500">Par Sarah L.</span>
                                </div>
                                <a href="#" class="text-xs font-bold text-gray-900 flex items-center hover:text-red-600 transition">
                                    Lire <i class="fas fa-arrow-right ml-1 text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group relative">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&q=80&w=800" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <button class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center bg-white/90 backdrop-blur-md rounded-full shadow-sm text-red-600 hover:bg-red-600 hover:text-white transition z-10" title="Retirer des favoris">
                                <i class="fas fa-bookmark text-xs"></i>
                            </button>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-yellow-600 text-[10px] font-bold uppercase tracking-widest bg-yellow-50 px-2 py-1 rounded-md">Collection</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-gray-400 text-xs font-semibold">30 Nov 2023</span>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 mb-2 leading-snug group-hover:text-red-600 transition">
                                Investir dans une voiture de collection en 2024
                            </h3>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                Les Youngtimers ont la cote ! Voici les modèles dont la valeur risque d'exploser cette année selon les experts.
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center text-[10px] font-bold text-white">
                                        K
                                    </div>
                                    <span class="text-xs font-bold text-gray-500">Par Karim B.</span>
                                </div>
                                <a href="#" class="text-xs font-bold text-gray-900 flex items-center hover:text-red-600 transition">
                                    Lire <i class="fas fa-arrow-right ml-1 text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

</body>
</html>