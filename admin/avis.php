<?php
require_once '../config.php';

$reviews = Avis::getAllAvis();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération Avis - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css">

    <style>
        /* DataTables Custom Overrides */
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
        .dt-paging-button {
            border-radius: 0.75rem !important;
            font-weight: bold !important;
            margin: 0 2px !important;
        }
        .dt-paging-button.current {
            background: #111827 !important;
            color: white !important;
            border: none !important;
        }
        .dt-paging-button:hover:not(.current) {
            background: #f3f4f6 !important;
            color: #111827 !important;
            border: none !important;
        }
        .star-active { color: #fbbf24; }
        .star-inactive { color: #e5e7eb; }
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
                
                <a href="articles.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-newspaper mr-4"></i> Blog / Articles
                    </div>
                    <span class="bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-full">3</span>
                </a>

                <a href="avis.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
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

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Modération <span class="text-red-600 italic">Avis.</span></h1>
                    <p class="text-gray-400">Gérez la e-réputation de MaBagnole.</p>
                </div>
                
                <div class="flex items-center gap-4 bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
                    <div class="text-right">
                        <p class="text-[10px] font-black text-gray-300 uppercase">Note Moyenne</p>
                        <p class="text-xl font-black text-gray-900"><?= number_format(Avis::getAvgReviews(), 1) ?> / 5</p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-400 text-white rounded-xl flex items-center justify-center shadow-lg shadow-yellow-100">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-x-auto p-4">
                <table id="avisTable" class="w-full text-left border-collapse min-w-[900px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Client</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Véhicule</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Note</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest w-1/3">Commentaire</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Date</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest">Statut</th>
                            <th class="p-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($reviews as $review): ?>
                            <?php 
                                $initials = strtoupper(substr($review['prenom'], 0, 1) . substr($review['nom'], 0, 1)); 
                                $isDeleted = $review['is_deleted'] == 1;
                            ?>
                            <tr class="group hover:bg-gray-50 transition <?= $isDeleted ? 'opacity-60 bg-gray-50' : '' ?>">
                                
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center font-black text-xs text-gray-400 uppercase shadow-inner">
                                            <?= $initials ?>
                                        </div>
                                        <span class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($review["nom"] . " " . $review["prenom"]) ?></span>
                                    </div>
                                </td>

                                <td class="p-6">
                                    <span class="text-xs font-bold text-red-600 uppercase italic"><?= htmlspecialchars($review["marque"] . " " . $review["modele"]) ?></span>
                                </td>

                                <td class="p-6">
                                    <div class="flex text-[10px] gap-1">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $review["note"] ? 'star-active' : 'star-inactive' ?>"></i>
                                        <?php endfor; ?>
                                        <span class="ml-2 font-bold text-gray-400"><?= $review["note"] ?>/5</span>
                                    </div>
                                </td>

                                <td class="p-6">
                                    <p class="text-xs text-gray-500 italic line-clamp-2 max-w-xs">
                                        "<?= htmlspecialchars($review["commentaire"]) ?>"
                                    </p>
                                </td>

                                <td class="p-6">
                                    <span class="text-xs font-bold text-gray-400"><?= date('d/m/Y', strtotime($review['created_at'])) ?></span>
                                </td>

                                <td class="p-6">
                                    <?php if (!$isDeleted): ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-[9px] font-black uppercase tracking-wide">
                                            <i class="fas fa-eye"></i> Visible
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-200 text-gray-500 text-[9px] font-black uppercase tracking-wide">
                                            <i class="fas fa-eye-slash"></i> Masqué
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="p-6 text-right">
                                    <form action="../actions/toggle_avis.php" method="POST">
                                        <input type="hidden" name="avis_id" value="<?= $review['id'] ?>">
                                        
                                        <?php if (!$isDeleted): ?>
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="w-8 h-8 bg-red-50 text-red-400 rounded-xl hover:bg-red-600 hover:text-white transition shadow-sm flex items-center justify-center" title="Masquer cet avis">
                                                <i class="fas fa-eye-slash text-xs"></i>
                                            </button>
                                        <?php else: ?>
                                            <input type="hidden" name="action" value="restore">
                                            <button type="submit" class="w-8 h-8 bg-green-50 text-green-600 rounded-xl hover:bg-green-600 hover:text-white transition shadow-sm flex items-center justify-center" title="Restaurer cet avis">
                                                <i class="fas fa-eye text-xs"></i>
                                            </button>
                                        <?php endif; ?>
                                    </form>
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
            $('#avisTable').DataTable({
                // French Language
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
                },
                
                // Config
                pageLength: 5,
                lengthChange: false,
                searching: true,
                info: false,
                ordering: true,

                // Disable sorting on Commentaire (col 3) and Actions (col 6)
                columnDefs: [
                    { orderable: false, targets: [3, 6] } 
                ],

                // Layout
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