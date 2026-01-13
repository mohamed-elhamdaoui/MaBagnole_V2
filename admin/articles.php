<?php
require_once '../config.php';
$articles = Article::getAllArticlesAllStates();


$en_attende = Article::countEnAttend();
$approuve = Article::countEnPublie();

if(isset($_POST["approuve"])){
    $app_id = $_POST["article_id"]; 
    $approuve = Article::approuveArticle($app_id);
    if($approuve){
        header("Location: /admin/articles.php");
        exit();
    }else{
        $error ="Failed approuve!";
        echo $error;
    }
}
if(isset($_POST["rejete"])){
    $rej_id = $_POST["article_id"]; 
    $rejete = Article::rejeteArticle($rej_id);
    if($rejete){
        header("Location: /admin/articles.php");
        exit();
    }else{
        $error ="Failed rejete !";
        echo $error;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Blog - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">

    <style>
        .dt-search input {
            background-color: #f9fafb;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s;
        }

        .dt-search input:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 1px #dc2626;
        }

        /* Fix Pagination Buttons */
        .dt-paging-button {
            border-radius: 0.75rem !important;
            font-weight: bold !important;
            margin: 0 2px !important;
        }

        .dt-paging-button.current {
            background: #111827 !important;
            /* gray-900 */
            color: white !important;
            border: none !important;
        }

        .dt-paging-button:hover:not(.current) {
            background: #f3f4f6 !important;
            color: #111827 !important;
            border: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center border-b border-gray-50">
                <div class="w-20 h-20 bg-gray-900 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-xl shadow-gray-200 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-lg italic">Ma<span class="text-red-600">Bagnole</span></h2>
                <span class="text-[10px] bg-red-100 px-3 py-1 rounded-full uppercase font-black text-red-600 mt-2 inline-block">Administrateur</span>
            </div>

          <nav class="flex-1 p-6 space-y-2">
    <a href="index.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
        <i class="fas fa-chart-line mr-4"></i> Dashboard
    </a>
    <a href="vehicules.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
        <i class="fas fa-car mr-4"></i> Véhicules
    </a>
    <a href="categories.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
        <i class="fas fa-tags mr-4"></i> Catégories
    </a>
    <a href="reservations.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
        <i class="fas fa-calendar-check mr-4"></i> Réservations
    </a>
    
    <a href="articles.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition justify-between">
        <div class="flex items-center">
            <i class="fas fa-newspaper mr-4"></i> Blog / Articles
        </div>
        <span class="bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-full shadow-md shadow-red-200">3</span>
    </a>

    <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
        <i class="fas fa-star mr-4"></i> Avis Clients
    </a>
    
    <div class="pt-10">
        <a href="../index.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition text-sm">
            <i class="fas fa-eye mr-4"></i> Voir le site public
        </a>
    </div>
</nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12 overflow-y-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Gestion du <span class="text-red-600 italic">Blog.</span></h1>
                    <p class="text-gray-400">Validez les articles de la communauté et gérez le contenu.</p>
                </div>
                <button class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold shadow-xl hover:bg-red-600 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> Rédiger un article
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">En Attente</p>
                        <h3 class="text-3xl font-black text-yellow-500 mt-1"><?= $en_attende ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Publiés</p>
                        <h3 class="text-3xl font-black text-green-600 mt-1"><?= $approuve ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Vues</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-1">12.5k</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mb-6 border-b border-gray-200 pb-4">
                <button class="px-4 py-2 bg-gray-900 text-white rounded-xl font-bold text-xs uppercase tracking-wide">Tous</button>
                <button class="px-4 py-2 bg-white text-gray-500 hover:bg-gray-100 rounded-xl font-bold text-xs uppercase tracking-wide transition">En attente</button>
                <button class="px-4 py-2 bg-white text-gray-500 hover:bg-gray-100 rounded-xl font-bold text-xs uppercase tracking-wide transition">Publiés</button>
            </div>

            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-x-auto p-4">
                <table id="articlesTable" class="w-full text-left border-collapse min-w-[800px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Article</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Auteur</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Catégorie</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Statut</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($articles as $article): ?>
                            <tr class="group hover:bg-gray-50 transition <?= $article["statut"] === 'approuve' ? 'opacity-90' : '' ?>">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-12 rounded-xl bg-gray-200 overflow-hidden <?= $article["statut"] === 'approuve' ? 'grayscale group-hover:grayscale-0 transition' : '' ?>">
                                            <img src="<?= $article["image_url"] ?>" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($article["titre"]) ?></h4>
                                            <p class="text-[10px] text-gray-400 mt-1">
                                                <?= $article["statut"] === 'approuve'
                                                    ? 'Publié le ' . date("d M Y", strtotime($article["created_at"]))
                                                    : 'Soumis le ' . date("d M Y", strtotime($article["created_at"])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">
                                            <?= strtoupper(substr($article["auteur_nom"], 0, 1)) ?>
                                        </div>
                                        <span class="text-sm font-bold text-gray-700"><?= htmlspecialchars($article["auteur_nom"] . " " . $article["auteur_prenom"]) ?></span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider"><?= htmlspecialchars($article["nom"]) ?></span>
                                </td>
                                <td class="p-6">
                                    <?php if ($article["statut"] === 'approuve'): ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-wide">
                                            <i class="fas fa-check-circle text-[9px]"></i> Publié
                                        </span>
                                    <?php elseif ($article["statut"] === 'en_attente'): ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-[10px] font-black uppercase tracking-wide">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> En attente
                                        </span>
                                    <?php elseif ($article["statut"] === 'rejete'): ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-black uppercase tracking-wide">
                                            <i class="fas fa-times-circle text-[9px]"></i> Rejeté
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <?php if ($article["statut"] === 'approuve'): ?>
                                            <!-- Boutons pour un article déjà publié -->
                                            <button class="w-8 h-8 rounded-xl bg-gray-50 text-gray-400 hover:bg-gray-200 transition flex items-center justify-center" title="Dépublier">
                                                <i class="fas fa-ban text-xs"></i>
                                            </button>
                                            <button class="w-8 h-8 rounded-xl bg-gray-50 text-gray-400 hover:bg-red-600 hover:text-white transition flex items-center justify-center" title="Supprimer">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        <?php else: ?>
                                            <!-- Formulaire pour valider -->
                                            <form method="POST" action="" class="inline">
                                                <input type="hidden" name="article_id" value="<?= $article["id"] ?>">
                                                <button name="approuve"  type="submit" class="w-8 h-8 rounded-xl bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition flex items-center justify-center" title="Valider & Publier">
                                                    <i class="fas fa-check text-xs"></i>
                                                </button>
                                            </form>

                                            <!-- Formulaire pour refuser -->
                                            <form method="POST" action="" class="inline">
                                                <input type="hidden" name="article_id" value="<?= $article["id"] ?>">
                                                <button name="rejete" type="submit" class="w-8 h-8 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center" title="Refuser">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </form>

                                            <!-- Bouton lecture (pas besoin de form) -->
                                            <button class="w-8 h-8 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-900 hover:text-white transition flex items-center justify-center" title="Lire l'article">
                                                <i class="fas fa-eye text-xs"></i>
                                            </button>
                                        <?php endif; ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {
            $('#articlesTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                },
                pageLength: 5,
                lengthChange: false,
                searching: true,
                info: false,

                // Disable sorting on the last column (Actions)
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],

                layout: {
                    topStart: null,
                    topEnd: 'search',
                    bottomStart: null,
                    bottomEnd: 'paging'
                }
            });
        });
    </script>
</body>

</html>